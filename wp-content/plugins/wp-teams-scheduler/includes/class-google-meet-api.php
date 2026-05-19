<?php
/**
 * Google Meet API Integration
 * 
 * This class handles Google Meet integration through Google Calendar API
 * which automatically creates Google Meet links when events are created.
 */
class WPTS_Google_Meet_API {

    private $settings;
    private $client;

    public function __construct() {
        $this->settings = get_option('wpts_settings_google_meet', []);
        $this->init_client();
    }

    /**
     * Initialize Google Client
     */
    private function init_client() {
        if (!class_exists('Google_Client')) {
            // Load Google Client Library if available
            $autoload_path = WPTS_PLUGIN_DIR . 'vendor/autoload.php';
            if (file_exists($autoload_path)) {
                require_once $autoload_path;
            } else {
                // Fallback: Use REST API directly
                return;
            }
        }

        if (class_exists('Google_Client')) {
            try {
                $this->client = new Google_Client();
                $this->client->setApplicationName('WordPress Teams Scheduler');
                $this->client->setScopes(['https://www.googleapis.com/auth/calendar']);
                $this->client->setAccessType('offline');
                $this->client->setPrompt('select_account consent');
                
                // Disable SSL verification for localhost development
                if ($this->is_localhost()) {
                    $guzzleClient = new \GuzzleHttp\Client([
                        'verify' => false,
                        'timeout' => 30,
                    ]);
                    $this->client->setHttpClient($guzzleClient);
                }
                
                if (!empty($this->settings['client_id']) && !empty($this->settings['client_secret'])) {
                    $this->client->setClientId($this->settings['client_id']);
                    $this->client->setClientSecret($this->settings['client_secret']);
                    $this->client->setRedirectUri($this->get_redirect_uri());
                }
            } catch (Exception $e) {
                $this->client = null;
            }
        }
    }

    /**
     * Get redirect URI for OAuth
     */
    private function get_redirect_uri() {
        return admin_url('admin.php?page=wpts_settings&tab=google_meet&action=oauth_callback');
    }

    /**
     * Check if Google Meet is properly configured
     */
    public function is_configured() {
        return !empty($this->settings['client_id']) && 
               !empty($this->settings['client_secret']) && 
               !empty($this->settings['access_token']);
    }

    /**
     * Get authorization URL
     */
    public function get_auth_url() {
        // If the official Google PHP client library is available, use it.
        if ($this->client) {
            return $this->client->createAuthUrl();
        }

        // Fallback: build the OAuth URL manually so we can work without vendor libraries.
        if (empty($this->settings['client_id']) || empty($this->settings['client_secret'])) {
            return new WP_Error(
                'missing_credentials',
                'Google client credentials not configured. Please enter your Client ID and Client Secret, then save settings.'
            );
        }

        $params = array(
            'client_id' => $this->settings['client_id'],
            'redirect_uri' => $this->get_redirect_uri(),
            'response_type' => 'code',
            'access_type' => 'offline',
            'prompt' => 'select_account consent',
            'scope' => 'https://www.googleapis.com/auth/calendar',
        );

        $auth_base = 'https://accounts.google.com/o/oauth2/v2/auth';

        return $auth_base . '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Handle OAuth callback
     */
    public function handle_oauth_callback($code) {
        // If the Google PHP client library is available, use it.
        if ($this->client) {
            try {
                $token = $this->client->fetchAccessTokenWithAuthCode($code);
                
                if (isset($token['error'])) {
                    return new WP_Error('oauth_error', $token['error_description'] ?? 'OAuth error');
                }

                // Store the token
                $this->settings['access_token'] = $token;
                update_option('wpts_settings_google_meet', $this->settings);

                return true;
            } catch (Exception $e) {
                return new WP_Error('oauth_exception', $e->getMessage());
            }
        }

        // Fallback: exchange the authorization code using the OAuth REST endpoint.
        if (empty($this->settings['client_id']) || empty($this->settings['client_secret'])) {
            return new WP_Error(
                'no_credentials',
                'Google client credentials not configured. Please enter your Client ID and Client Secret, then save settings.'
            );
        }

        $response = wp_remote_post('https://oauth2.googleapis.com/token', array(
            'body' => array(
                'code' => $code,
                'client_id' => $this->settings['client_id'],
                'client_secret' => $this->settings['client_secret'],
                'redirect_uri' => $this->get_redirect_uri(),
                'grant_type' => 'authorization_code',
            ),
            'timeout' => 30,
            'sslverify' => !$this->is_localhost(),
        ));

        if (is_wp_error($response)) {
            return new WP_Error('oauth_http_error', 'Failed to contact Google OAuth server: ' . $response->get_error_message());
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($body['error'])) {
            $message = isset($body['error_description']) ? $body['error_description'] : $body['error'];
            return new WP_Error('oauth_error', $message);
        }

        if (!is_array($body) || empty($body['access_token'])) {
            return new WP_Error('oauth_invalid_response', 'Google OAuth did not return a valid access token.');
        }

        // Add a created timestamp so future enhancements can calculate expiry if needed.
        if (!isset($body['created'])) {
            $body['created'] = time();
        }

        // Store the token (access + refresh if provided)
        $this->settings['access_token'] = $body;
        update_option('wpts_settings_google_meet', $this->settings);

        return true;
    }

    /**
     * Get access token (refresh if needed)
     */
    private function get_access_token() {
        if (empty($this->settings['access_token'])) {
            return new WP_Error('no_token', 'No access token available. Please authorize Google Meet integration.');
        }

        if ($this->client) {
            $this->client->setAccessToken($this->settings['access_token']);
            
            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    try {
                        $token = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                        
                        if (isset($token['error'])) {
                            return new WP_Error('token_refresh_error', 'Failed to refresh access token: ' . $token['error_description']);
                        }
                        
                        $this->settings['access_token'] = $token;
                        update_option('wpts_settings_google_meet', $this->settings);
                    } catch (Exception $e) {
                        return new WP_Error('token_refresh_exception', 'Exception during token refresh: ' . $e->getMessage());
                    }
                } else {
                    return new WP_Error('token_expired', 'Access token expired and no refresh token available. Please re-authorize Google Meet integration.');
                }
            }
        }

        return $this->settings['access_token'];
    }

    /**
     * Create Google Meet meeting via Calendar API
     */
    public function create_google_meet_meeting($subject, $start_datetime_utc, $end_datetime_utc, $attendee_email = null) {
        // Check if properly configured first
        if (!$this->is_configured()) {
            return new WP_Error('not_configured', 'Google Meet is not properly configured. Please configure Client ID, Client Secret, and authorize the integration.');
        }
        
        // If Google Client library is available, use it
        if ($this->client) {
            return $this->create_meeting_with_client($subject, $start_datetime_utc, $end_datetime_utc, $attendee_email);
        }
        
        // Fallback to REST API
        return $this->create_meeting_with_rest($subject, $start_datetime_utc, $end_datetime_utc, $attendee_email);
    }

    /**
     * Create meeting using Google Client Library
     */
    private function create_meeting_with_client($subject, $start_datetime_utc, $end_datetime_utc, $attendee_email) {
        $token = $this->get_access_token();
        if (is_wp_error($token)) {
            return $token;
        }

        try {
            $service = new Google_Service_Calendar($this->client);
            
            $event = new Google_Service_Calendar_Event([
                'summary' => $subject,
                'start' => [
                    'dateTime' => $start_datetime_utc,
                    'timeZone' => 'UTC',
                ],
                'end' => [
                    'dateTime' => $end_datetime_utc,
                    'timeZone' => 'UTC',
                ],
                'conferenceData' => [
                    'createRequest' => [
                        'requestId' => wp_generate_password(32, false),
                        'conferenceSolutionKey' => [
                            'type' => 'hangoutsMeet'
                        ]
                    ]
                ],
                'attendees' => $attendee_email ? [['email' => $attendee_email]] : [],
                'reminders' => [
                    'useDefault' => false,
                    'overrides' => [
                        ['method' => 'email', 'minutes' => 24 * 60],
                        ['method' => 'popup', 'minutes' => 10],
                    ],
                ],
            ]);

            $calendar_id = $this->settings['calendar_id'] ?? 'primary';
            $created_event = $service->events->insert($calendar_id, $event, ['conferenceDataVersion' => 1]);
            
            if ($created_event->getConferenceData() && $created_event->getConferenceData()->getEntryPoints()) {
                $entry_points = $created_event->getConferenceData()->getEntryPoints();
                foreach ($entry_points as $entry_point) {
                    if ($entry_point->getEntryPointType() === 'video') {
                        return [
                            'join_url' => $entry_point->getUri(),
                            'event_id' => $created_event->getId(),
                            'html_link' => $created_event->getHtmlLink()
                        ];
                    }
                }
            }

            return new WP_Error('no_meet_link', 'Event created but no Google Meet link was generated');
            
        } catch (Exception $e) {
            return new WP_Error('meeting_creation_error', 'Failed to create Google Meet: ' . $e->getMessage());
        }
    }

    /**
     * Create meeting using REST API (fallback)
     */
    private function create_meeting_with_rest($subject, $start_datetime_utc, $end_datetime_utc, $attendee_email) {
        $token = $this->get_access_token();
        if (is_wp_error($token)) {
            return $token;
        }

        $calendar_id = $this->settings['calendar_id'] ?? 'primary';
        $url = "https://www.googleapis.com/calendar/v3/calendars/{$calendar_id}/events?conferenceDataVersion=1";

        $event_data = [
            'summary' => $subject,
            'start' => [
                'dateTime' => $start_datetime_utc,
                'timeZone' => 'UTC',
            ],
            'end' => [
                'dateTime' => $end_datetime_utc,
                'timeZone' => 'UTC',
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => wp_generate_password(32, false),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet'
                    ]
                ]
            ],
            'attendees' => $attendee_email ? [['email' => $attendee_email]] : [],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 10],
                ],
            ],
        ];

        $access_token = is_array($token) ? $token['access_token'] : $token;

        $response = wp_remote_post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($event_data),
            'timeout' => 30,
            'sslverify' => !$this->is_localhost(),
        ]);

        if (is_wp_error($response)) {
            return new WP_Error('api_error', 'Failed to connect to Google Calendar API: ' . $response->get_error_message());
        }

        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            $body = wp_remote_retrieve_body($response);
            $error_data = json_decode($body, true);
            $error_message = isset($error_data['error']['message']) ? $error_data['error']['message'] : 'Unknown error';
            return new WP_Error('api_error', "Google Calendar API error ({$response_code}): {$error_message}");
        }

        $event_data = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($event_data['conferenceData']['entryPoints'])) {
            foreach ($event_data['conferenceData']['entryPoints'] as $entry_point) {
                if ($entry_point['entryPointType'] === 'video') {
                    return [
                        'join_url' => $entry_point['uri'],
                        'event_id' => $event_data['id'],
                        'html_link' => $event_data['htmlLink']
                    ];
                }
            }
        }

        return new WP_Error('no_meet_link', 'Event created but no Google Meet link was generated');
    }

    /**
     * Test the connection
     */
    public function test_connection() {
        // Check if client credentials are configured
        if (empty($this->settings['client_id']) || empty($this->settings['client_secret'])) {
            return new WP_Error('no_credentials', 'Google Meet client credentials not configured. Please configure Client ID and Client Secret in plugin settings.');
        }

        $token = $this->get_access_token();
        if (is_wp_error($token)) {
            return $token;
        }

        $access_token = is_array($token) ? $token['access_token'] : $token;
        $url = 'https://www.googleapis.com/calendar/v3/calendars/primary';

        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
            'timeout' => 15,
            'sslverify' => !$this->is_localhost(),
        ]);

        if (is_wp_error($response)) {
            return new WP_Error('connection_error', 'Failed to connect to Google Calendar API: ' . $response->get_error_message());
        }

        $response_code = wp_remote_retrieve_response_code($response);
        if ($response_code !== 200) {
            return new WP_Error('auth_error', 'Authentication failed. Please re-authorize Google Meet integration.');
        }

        $calendar_data = json_decode(wp_remote_retrieve_body($response), true);
        return [
            'success' => true,
            'calendar_name' => $calendar_data['summary'] ?? 'Primary Calendar',
            'calendar_id' => $calendar_data['id'] ?? 'primary'
        ];
    }

    /**
     * Check if we're running on localhost
     */
    private function is_localhost() {
        $server_name = $_SERVER['SERVER_NAME'] ?? '';
        return in_array($server_name, ['localhost', '127.0.0.1', '::1']) || 
               strpos($server_name, '.local') !== false ||
               strpos($server_name, '.test') !== false;
    }

    /**
     * Revoke access token
     */
    public function revoke_access() {
        if (!empty($this->settings['access_token'])) {
            $access_token = is_array($this->settings['access_token']) ? $this->settings['access_token']['access_token'] : $this->settings['access_token'];
            
            wp_remote_post('https://oauth2.googleapis.com/revoke', [
                'body' => ['token' => $access_token],
                'timeout' => 15,
                'sslverify' => !$this->is_localhost(),
            ]);
        }

        $this->settings['access_token'] = null;
        update_option('wpts_settings_google_meet', $this->settings);
        
        return true;
    }
}
?> 