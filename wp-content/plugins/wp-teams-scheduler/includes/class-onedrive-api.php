<?php
/**
 * Microsoft OneDrive API Handler
 * Supports small and large (resumable) file uploads
 * Uses the same Azure credentials as Teams API
 */

class WPTS_OneDrive_API {

    private $tenant_id;
    private $client_id;
    private $client_secret;
    private $access_token;

    public function __construct() {
        $this->tenant_id = defined('WPTS_TEAMS_TENANT_ID') ? WPTS_TEAMS_TENANT_ID : '';
        $this->client_id = defined('WPTS_TEAMS_CLIENT_ID') ? WPTS_TEAMS_CLIENT_ID : '';
        $this->client_secret = defined('WPTS_TEAMS_CLIENT_SECRET') ? WPTS_TEAMS_CLIENT_SECRET : '';
    }

    public function is_configured() {
        return !empty($this->tenant_id) && !empty($this->client_id) && !empty($this->client_secret);
    }

    private function get_access_token() {
        if ($this->access_token) {
            return $this->access_token;
        }

        $token_endpoint = "https://login.microsoftonline.com/{$this->tenant_id}/oauth2/v2.0/token";
        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope' => 'https://graph.microsoft.com/.default'
        ];

        $args = [
            'body' => $body,
            'timeout' => 30,
            'sslverify' => !defined('WPTS_DISABLE_SSL_VERIFY') || !WPTS_DISABLE_SSL_VERIFY
        ];

        error_log('OneDrive: Requesting access token...');
        $response = wp_remote_post($token_endpoint, $args);

        if (is_wp_error($response)) {
            error_log('OneDrive: Token request failed - ' . $response->get_error_message());
            return false;
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (isset($body['access_token'])) {
            $this->access_token = $body['access_token'];
            error_log('OneDrive: Access token obtained successfully');
            return $this->access_token;
        }

        error_log('OneDrive: Failed to get access token - ' . json_encode($body));
        return false;
    }

    public function upload_file($file, $booking_id = 0) {
        if (!$this->is_configured()) {
            return new WP_Error('not_configured', 'OneDrive API not configured');
        }

        $access_token = $this->get_access_token();
        if (!$access_token) {
            return new WP_Error('auth_failed', 'Failed to get access token');
        }

        $file_name = sanitize_file_name($file['name']);
        $file_content = file_get_contents($file['tmp_name']);
        $file_size = $file['size'];

        $user_id = defined('WPTS_TEAMS_ORGANIZER_USER_ID') ? WPTS_TEAMS_ORGANIZER_USER_ID : '';
        if (empty($user_id)) {
            return new WP_Error('no_user', 'OneDrive user ID not configured');
        }

        $year = date('Y');
        $month = date('F');

        $base_path = defined('WPTS_ONEDRIVE_BASE_PATH') ? WPTS_ONEDRIVE_BASE_PATH : '';
        $folder_path = !empty($base_path)
            ? "{$base_path}/Booking Documents/{$year}/{$month}/Booking-{$booking_id}"
            : "Booking Documents/{$year}/{$month}/Booking-{$booking_id}";

        error_log('OneDrive: Using folder path - ' . $folder_path);

        // Upload file based on size
        if ($file_size < 4194304) {
            return $this->simple_upload($access_token, $user_id, $folder_path, $file_name, $file_content);
        } else {
            return $this->resumable_upload($access_token, $user_id, $folder_path, $file_name, $file_content, $file_size);
        }
    }

    private function simple_upload($access_token, $user_id, $folder_path, $file_name, $file_content) {
        $this->create_folder_structure($access_token, $user_id, $folder_path);

        $encoded_path = rawurlencode($folder_path . '/' . $file_name);
        $endpoint = "https://graph.microsoft.com/v1.0/users/{$user_id}/drive/root:/{$encoded_path}:/content";

        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/octet-stream'
            ],
            'body' => $file_content,
            'timeout' => 60
        ];

        $response = wp_remote_request($endpoint, array_merge($args, ['method' => 'PUT']));
        if (is_wp_error($response)) return $response;

        $status_code = wp_remote_retrieve_response_code($response);
        if ($status_code === 200 || $status_code === 201) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            $file_id = $body['id'];
            $sharing_link = $this->create_sharing_link($access_token, $user_id, $file_id);

            return [
                'id' => $file_id,
                'name' => $file_name,
                'url' => $sharing_link ?: $body['webUrl'],
                'size' => $body['size'],
                'storage' => 'onedrive',
                'path' => $folder_path . '/' . $file_name
            ];
        }

        return new WP_Error('upload_failed', 'Failed to upload file: ' . wp_remote_retrieve_body($response));
    }

    /**
     * ✅ NEW: Resumable (large file) upload for files >= 4MB
     */
    private function resumable_upload($access_token, $user_id, $folder_path, $file_name, $file_content, $file_size) {
        $this->create_folder_structure($access_token, $user_id, $folder_path);

        // 1️⃣ Create upload session
        $encoded_path = rawurlencode($folder_path . '/' . $file_name);
        $endpoint = "https://graph.microsoft.com/v1.0/users/{$user_id}/drive/root:/{$encoded_path}:/createUploadSession";

        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                '@microsoft.graph.conflictBehavior' => 'rename',
                'description' => 'Uploaded via WordPress (Resumable Upload)'
            ]),
            'timeout' => 30
        ];

        $response = wp_remote_post($endpoint, $args);
        if (is_wp_error($response)) return $response;

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (empty($body['uploadUrl'])) {
            return new WP_Error('upload_session_failed', 'Failed to create upload session.');
        }

        $upload_url = $body['uploadUrl'];
        $chunk_size = 5 * 1024 * 1024; // 5MB chunks
        $offset = 0;

        // 2️⃣ Upload in chunks
        while ($offset < $file_size) {
            $chunk = substr($file_content, $offset, $chunk_size);
            $end = $offset + strlen($chunk) - 1;

            $headers = [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Length' => strlen($chunk),
                'Content-Range' => "bytes {$offset}-{$end}/{$file_size}"
            ];

            $chunk_args = [
                'method' => 'PUT',
                'headers' => $headers,
                'body' => $chunk,
                'timeout' => 120
            ];

            $chunk_response = wp_remote_request($upload_url, $chunk_args);
            if (is_wp_error($chunk_response)) return $chunk_response;

            $status_code = wp_remote_retrieve_response_code($chunk_response);
            if ($status_code >= 400) {
                return new WP_Error('chunk_upload_failed', 'Chunk upload failed: ' . wp_remote_retrieve_body($chunk_response));
            }

            $offset += strlen($chunk);
        }

        // 3️⃣ Final response = file metadata
        $final_body = json_decode(wp_remote_retrieve_body($chunk_response), true);
        if (!empty($final_body['id'])) {
            $sharing_link = $this->create_sharing_link($access_token, $user_id, $final_body['id']);

            return [
                'id' => $final_body['id'],
                'name' => $final_body['name'],
                'url' => $sharing_link ?: $final_body['webUrl'],
                'size' => $final_body['size'],
                'storage' => 'onedrive',
                'path' => $folder_path . '/' . $file_name
            ];
        }

        return new WP_Error('upload_failed', 'Upload did not complete properly.');
    }

    private function create_folder_structure($access_token, $user_id, $folder_path) {
        $folders = explode('/', $folder_path);
        $current_path = '';

        foreach ($folders as $folder) {
            if (empty($folder)) continue;

            $parent_path = empty($current_path) ? '' : $current_path;
            $current_path = empty($current_path) ? $folder : $current_path . '/' . $folder;

            $this->create_folder($access_token, $user_id, $parent_path, $folder);
        }
    }

    private function create_folder($access_token, $user_id, $parent_path, $folder_name) {
        $endpoint = empty($parent_path)
            ? "https://graph.microsoft.com/v1.0/users/{$user_id}/drive/root/children"
            : "https://graph.microsoft.com/v1.0/users/{$user_id}/drive/root:/" . rawurlencode($parent_path) . ":/children";

        $folder_data = [
            'name' => $folder_name,
            'folder' => new stdClass(),
            '@microsoft.graph.conflictBehavior' => 'rename'
        ];

        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($folder_data),
            'timeout' => 30
        ];

        $response = wp_remote_post($endpoint, $args);
        if (!is_wp_error($response)) {
            $status_code = wp_remote_retrieve_response_code($response);
            if ($status_code === 201) {
                error_log('OneDrive: Created folder - ' . $folder_name);
            }
        }
    }

    private function create_sharing_link($access_token, $user_id, $file_id) {
        $endpoint = "https://graph.microsoft.com/v1.0/users/{$user_id}/drive/items/{$file_id}/createLink";

        $link_data = [
            'type' => 'view',
            'scope' => 'organization'
        ];

        $args = [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($link_data),
            'timeout' => 30
        ];

        $response = wp_remote_post($endpoint, $args);
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 201) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            return $body['link']['webUrl'] ?? false;
        }

        return false;
    }

    public function upload_files($files, $booking_id = 0) {
        $uploaded_files = [];
        foreach ($files as $file) {
            $result = $this->upload_file($file, $booking_id);
            if (!is_wp_error($result)) {
                $uploaded_files[] = $result;
            } else {
                error_log('OneDrive: Failed to upload file - ' . $result->get_error_message());
            }
        }
        return $uploaded_files;
    }
}
