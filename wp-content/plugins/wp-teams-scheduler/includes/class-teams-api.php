<?php
class WPTS_Teams_API {

    private $settings;

    public function __construct() {
        $this->settings = get_option('wpts_settings_teams');
        // Override Teams credentials from wp-config.php if defined
        if (defined('WPTS_TEAMS_TENANT_ID')) {
            $this->settings['tenant_id'] = WPTS_TEAMS_TENANT_ID;
        }
        if (defined('WPTS_TEAMS_CLIENT_ID')) {
            $this->settings['client_id'] = WPTS_TEAMS_CLIENT_ID;
        }
        if (defined('WPTS_TEAMS_CLIENT_SECRET')) {
            $this->settings['client_secret'] = WPTS_TEAMS_CLIENT_SECRET;
        }
        if (defined('WPTS_TEAMS_ORGANIZER_USER_ID')) {
            $this->settings['organizer_user_id'] = WPTS_TEAMS_ORGANIZER_USER_ID;
        }
        
        // Add SSL verification filters for development
        if (defined('WPTS_DISABLE_SSL_VERIFY') && WPTS_DISABLE_SSL_VERIFY) {
            add_filter('https_ssl_verify', '__return_false');
            add_filter('https_local_ssl_verify', '__return_false');
        }
    }

    private function get_access_token() {
        $token = get_transient('wpts_teams_access_token');
        if (false !== $token) {
            return $token;
        }

        if (empty($this->settings['tenant_id']) || empty($this->settings['client_id']) || empty($this->settings['client_secret'])) {
            $missing_creds = [];
            if (empty($this->settings['tenant_id'])) $missing_creds[] = 'tenant_id';
            if (empty($this->settings['client_id'])) $missing_creds[] = 'client_id';
            if (empty($this->settings['client_secret'])) $missing_creds[] = 'client_secret';
            
            return new WP_Error('missing_creds', 'Microsoft Teams API credentials are not set: ' . implode(', ', $missing_creds));
        }

        $url = 'https://login.microsoftonline.com/' . $this->settings['tenant_id'] . '/oauth2/v2.0/token';
        
        $body = [
            'client_id'     => $this->settings['client_id'],
            'client_secret' => $this->settings['client_secret'],
            'scope'         => 'https://graph.microsoft.com/.default',
            'grant_type'    => 'client_credentials',
        ];

        $response = wp_remote_post($url, [
            'method'  => 'POST',
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'body'    => $body,
        ]);

        if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
            // Log detailed error for debugging
            $error_details = [
                'is_wp_error' => is_wp_error($response),
                'response_code' => wp_remote_retrieve_response_code($response),
                'response_body' => wp_remote_retrieve_body($response),
                'response_headers' => wp_remote_retrieve_headers($response),
                'request_url' => $url,
                'request_body' => $body
            ];
            return new WP_Error('token_error', 'Could not retrieve access token. Check error logs for details.');
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);
        $token = $data['access_token'];

        // Cache for 55 minutes (token is valid for 60)
        set_transient('wpts_teams_access_token', $token, 55 * 60);

        return $token;
    }

    public function create_teams_meeting($subject, $start_datetime_utc, $end_datetime_utc, $attendees = [], $agenda = '', $location = '', $form_data = []) {
        $access_token = $this->get_access_token();
        if (is_wp_error($access_token)) {
            return $access_token;
        }

        $organizer_id = !empty($this->settings['organizer_user_id']) ? $this->settings['organizer_user_id'] : null;
        if(!$organizer_id) {
            return new WP_Error('missing_organizer', 'Organizer User ID is not set in Teams settings.');
        }
        
        // Organizer ID used for the request

        // Try different user ID formats
        // First try with the ID as-is (could be Object ID, email, or UPN)
        $url = 'https://graph.microsoft.com/v1.0/users/' . urlencode($organizer_id) . '/events';

        // Convert UTC datetime to local timezone format
        $start_datetime_local = $this->convert_utc_to_local($start_datetime_utc);
        $end_datetime_local = $this->convert_utc_to_local($end_datetime_utc);
        
        // Prepare dynamic content
        $meeting_content = $this->build_meeting_content($subject, $agenda, $form_data);
        // Normalize incoming form data using POST/GET fallbacks
        $form_data = $this->normalize_form_data($form_data);
        $attendees_array = $this->prepare_attendees($attendees, $form_data);
        if (is_wp_error($attendees_array)) {
            return $attendees_array;
        }
        $meeting_location = !empty($location) ? $location : "Microsoft Teams Meeting";

        $body = [
            "subject" => $subject,
            "body" => [
                "contentType" => "HTML",
                "content" => $meeting_content
            ],
            "start" => [
                "dateTime" => $start_datetime_local['datetime'],
                "timeZone" => $start_datetime_local['timezone']
            ],
            "end" => [
                "dateTime" => $end_datetime_local['datetime'],
                "timeZone" => $end_datetime_local['timezone']
            ],
            "location" => [
                "displayName" => $meeting_location
            ],
            "attendees" => $attendees_array,
            "isOnlineMeeting" => true,
            "onlineMeetingProvider" => "teamsForBusiness"
        ];

        $response = wp_remote_post($url, [
            'method'  => 'POST',
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type'  => 'application/json',
            ],
            'body'    => json_encode($body),
            'timeout' => 45, // Increased timeout for Graph API
        ]);

        $response_code = wp_remote_retrieve_response_code($response);
        
        if (is_wp_error($response) || !in_array($response_code, [200, 201, 202])) {
            // Log detailed error for debugging
            $error_details = [
                'is_wp_error' => is_wp_error($response),
                'response_code' => wp_remote_retrieve_response_code($response),
                'response_body' => wp_remote_retrieve_body($response),
                'response_headers' => wp_remote_retrieve_headers($response),
                'request_url' => $url,
                'request_body' => $body,
                'access_token_length' => strlen($access_token)
            ];
            error_log('WPTS Error: Teams Meeting Creation Failed: ' . print_r($error_details, true));
            return new WP_Error('meeting_creation_error', 'Failed to create Microsoft Teams meeting. Check error logs for details.');
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        // Try to extract a join URL directly from the create response
        $join_url = $this->extract_join_url($data);

        // For /events creation, Graph often doesn't include the meeting URL immediately.
        // If missing, retrieve the event with $select/$expand to get the onlineMeeting data.
        if (!$join_url && isset($data['id'])) {
            $event_lookup_url = 'https://graph.microsoft.com/v1.0/users/' . urlencode($organizer_id)
                . '/events/' . urlencode($data['id'])
                . '?$select=onlineMeeting,onlineMeetingUrl,webLink&$expand=onlineMeeting';

            $event_resp = wp_remote_get($event_lookup_url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'Content-Type'  => 'application/json',
                ],
            ]);

            if (!is_wp_error($event_resp) && 200 === wp_remote_retrieve_response_code($event_resp)) {
                $event_data = json_decode(wp_remote_retrieve_body($event_resp), true);
                $join_url = $this->extract_join_url($event_data);
            }
        }

        return $join_url ? $join_url : new WP_Error('no_join_url', 'Meeting created but no join URL was returned.');
    }

    /**
     * Convert UTC datetime to local timezone format
     */
    private function convert_utc_to_local($utc_datetime) {
        // Create DateTime object from UTC
        $utc = new DateTime($utc_datetime, new DateTimeZone('UTC'));
        
        // Convert to India Standard Time (you can make this configurable)
        $local = clone $utc;
        $local->setTimezone(new DateTimeZone('Asia/Kolkata'));
        
        return [
            'datetime' => $local->format('Y-m-d\TH:i:s'),
            'timezone' => 'India Standard Time'
        ];
    }

    /**
     * Build meeting content dynamically
     */
    
    private function build_meeting_content($subject, $agenda, $form_data) {
        $content = "<h2>📅 " . esc_html($subject) . "</h2>";
        
        if (!empty($agenda)) {
            $content .= "<h3>📋 Agenda</h3>";
            $content .= "<p>" . esc_html($agenda) . "</p>";
        }
        
        // Add meeting notes from form if provided
        if (!empty($form_data['notes'])) {
            $content .= "<h3>📝 Meeting Preparation Notes</h3>";
            $content .= "<div style='background-color: #f8f9fa; padding: 10px; border-radius: 4px; border-left: 4px solid #0078d4;'>";
            $content .= "<p>" . esc_html($form_data['notes']) . "</p>";
            $content .= "</div>";
        }
        
        $content .= "<h3>💡 Meeting Details</h3>";
        $content .= "<p>• Platform: Microsoft Teams</p>";
        $content .= "<p>• Please join a few minutes early to test your audio and video</p>";
        $content .= "<p>• Use headphones for better audio quality</p>";
        
        return $content;
    }

    /**
     * Normalize form data by merging provided $form_data with $_POST/$_GET and
     * supporting common alternative field names.
     */
    private function normalize_form_data($form_data) {
        $normalized = is_array($form_data) ? $form_data : [];

        $request = [];
        if (!empty($_POST) && is_array($_POST)) {
            $request = array_merge($request, $_POST);
        }
        if (!empty($_GET) && is_array($_GET)) {
            $request = array_merge($request, $_GET);
        }

        // Helper to pick first available value by keys
        $pick = function(array $keys) use ($normalized, $request) {
            foreach ($keys as $key) {
                if (isset($normalized[$key]) && $normalized[$key] !== '') {
                    return $normalized[$key];
                }
                if (isset($request[$key]) && $request[$key] !== '') {
                    return $request[$key];
                }
            }
            return '';
        };

        if (empty($normalized['name'])) {
            $normalized['name'] = $pick(['name','full_name','fullName','first_name','firstName']);
        }
        if (empty($normalized['email'])) {
            $normalized['email'] = $pick(['email','email_address','emailAddress','your-email','attendee_email','guest_email']);
        }
        if (empty($normalized['notes'])) {
            $normalized['notes'] = $pick(['notes','message','comments','question','additional_information']);
        }

        // Normalize guests: can be array of emails, CSV string, or structured array
        if (empty($normalized['guests'])) {
            $guests = $pick(['guests','guest_emails']);
            if (is_string($guests) && $guests !== '') {
                $emails = preg_split('/[\s,;]+/', $guests);
                $normalized['guests'] = [];
                foreach ($emails as $email) {
                    if (!is_email($email)) continue;
                    $local = sanitize_email($email);
                    $name = ucfirst(preg_replace('/[^a-z]+/i',' ', strstr($local, '@', true)));
                    $normalized['guests'][] = [
                        'email' => $local,
                        'name' => trim($name) ?: $local,
                        'type' => 'optional'
                    ];
                }
            } elseif (isset($request['guests']) && is_array($request['guests'])) {
                $normalized['guests'] = $request['guests'];
            }
        }

        // Final sanitization
        if (!empty($normalized['email'])) {
            $normalized['email'] = sanitize_email($normalized['email']);
        }
        if (!empty($normalized['name'])) {
            $normalized['name'] = sanitize_text_field($normalized['name']);
        }
        if (!empty($normalized['notes'])) {
            $normalized['notes'] = sanitize_textarea_field($normalized['notes']);
        }

        return $normalized;
    }

    /**
     * Prepare attendees array dynamically
     */
    private function prepare_attendees($attendees, $form_data) {
        $attendees_array = [];
        
        // Extract attendee info from form data (like Calendly form)
        if (!empty($form_data)) {
            // Primary attendee from form fields
            if (isset($form_data['name']) && isset($form_data['email'])) {
                $attendees_array[] = [
                    'emailAddress' => [
                        'address' => sanitize_email($form_data['email']),
                        'name' => sanitize_text_field($form_data['name'])
                    ],
                    'type' => 'required'
                ];
            } else {
                // Missing required attendee data
            }
            
            // Additional guests if provided
            if (isset($form_data['guests']) && is_array($form_data['guests'])) {
                foreach ($form_data['guests'] as $guest) {
                    if (!empty($guest['email']) && !empty($guest['name'])) {
                        $attendees_array[] = [
                            'emailAddress' => [
                                'address' => sanitize_email($guest['email']),
                                'name' => sanitize_text_field($guest['name'])
                            ],
                            'type' => isset($guest['type']) ? $guest['type'] : 'optional'
                        ];
                    }
                }
            }
        }
        
        // Fallback to provided attendees if no form data
        if (empty($attendees_array) && !empty($attendees)) {
            foreach ($attendees as $attendee) {
                $attendees_array[] = [
                    'emailAddress' => [
                        'address' => $attendee['email'],
                        'name' => $attendee['name']
                    ],
                    'type' => isset($attendee['type']) ? $attendee['type'] : 'required'
                ];
            }
        }
        
        // If still empty, return error to avoid hard-coded fallbacks
        if (empty($attendees_array)) {
            return new WP_Error('missing_attendee_email', 'No attendee email provided.');
        }

        return $attendees_array;
    }

    /**
     * Extract a usable join URL from various Graph responses
     */
    private function extract_join_url($data) {
        if (empty($data) || !is_array($data)) {
            return null;
        }

        // 1) Direct properties that sometimes appear
        foreach (['joinUrl', 'joinWebUrl', 'onlineMeetingUrl'] as $key) {
            if (!empty($data[$key]) && filter_var($data[$key], FILTER_VALIDATE_URL)) {
                return $data[$key];
            }
        }

        // 2) Nested onlineMeeting object
        if (!empty($data['onlineMeeting']) && is_array($data['onlineMeeting'])) {
            $om = $data['onlineMeeting'];
            foreach (['joinUrl', 'joinWebUrl'] as $key) {
                if (!empty($om[$key]) && filter_var($om[$key], FILTER_VALIDATE_URL)) {
                    return $om[$key];
                }
            }
        }

        // 3) Fallback to webLink (OWA event link) if present
        if (!empty($data['webLink']) && filter_var($data['webLink'], FILTER_VALIDATE_URL)) {
            return $data['webLink'];
        }

        return null;
    }
}