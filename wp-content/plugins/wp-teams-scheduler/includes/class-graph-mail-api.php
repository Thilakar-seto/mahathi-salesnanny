<?php
/**
 * Microsoft Graph Mail API Handler
 * Sends emails using Microsoft Graph API instead of SMTP
 * Uses the same Azure credentials as Teams API
 */

class WPTS_Graph_Mail_API {

    private $tenant_id;
    private $client_id;
    private $client_secret;
    private $access_token;

    public function __construct() {
        $settings = get_option('wpts_settings_teams', array());
        $this->tenant_id = $settings['tenant_id'] ?? '';
        $this->client_id = $settings['client_id'] ?? '';
        $this->client_secret = $settings['client_secret'] ?? '';
    }

    /**
     * Check if Graph Mail API is configured
     */
    public function is_configured() {
        return !empty($this->tenant_id) && !empty($this->client_id) && !empty($this->client_secret);
    }

    /**
     * Get access token for Microsoft Graph API
     */
    private function get_access_token() {
        if ($this->access_token) {
            return $this->access_token;
        }

        $token_endpoint = "https://login.microsoftonline.com/{$this->tenant_id}/oauth2/v2.0/token";
        
        $body = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope' => 'https://graph.microsoft.com/.default'
        );

        $args = array(
            'body' => $body,
            'timeout' => 30,
            'sslverify' => !defined('WPTS_DISABLE_SSL_VERIFY') || !WPTS_DISABLE_SSL_VERIFY
        );

        error_log('Graph Mail: Requesting access token...');
        $response = wp_remote_post($token_endpoint, $args);

        if (is_wp_error($response)) {
            error_log('Graph Mail: Token request failed - ' . $response->get_error_message());
            return false;
        }

        $body = json_decode(wp_remote_retrieve_body($response), true);
        
        if (isset($body['access_token'])) {
            $this->access_token = $body['access_token'];
            error_log('Graph Mail: Access token obtained successfully');
            return $this->access_token;
        }

        error_log('Graph Mail: Failed to get access token - ' . json_encode($body));
        return false;
    }

    /**
     * Send email using Microsoft Graph API
     * 
     * @param string $to Recipient email address
     * @param string $subject Email subject
     * @param string $html_body HTML email body
     * @param string $from_email Sender email (must be valid mailbox in your tenant)
     * @param string $from_name Sender display name
     * @return bool|WP_Error
     */
    public function send_mail($to, $subject, $html_body, $from_email = null, $from_name = null) {
        if (!$this->is_configured()) {
            error_log('Graph Mail: Not configured');
            return new WP_Error('not_configured', 'Microsoft Graph Mail API not configured');
        }

        $access_token = $this->get_access_token();
        if (!$access_token) {
            return new WP_Error('auth_failed', 'Failed to get access token');
        }

        // Use configured from email or default
        if (!$from_email) {
            $from_email = get_option('admin_email');
        }
        if (!$from_name) {
            $from_name = get_option('wpts_smtp_from_name', 'SalesNanny Team');
        }

        // Prepare email message
        $message = array(
            'message' => array(
                'subject' => $subject,
                'body' => array(
                    'contentType' => 'HTML',
                    'content' => $html_body
                ),
                'toRecipients' => array(
                    array(
                        'emailAddress' => array(
                            'address' => $to
                        )
                    )
                ),
                'from' => array(
                    'emailAddress' => array(
                        'address' => $from_email,
                        'name' => $from_name
                    )
                )
            ),
            'saveToSentItems' => 'true'
        );

        // Get the user ID or email for the sender
        // Graph API accepts both user ID (GUID) or email address (UPN)
        $user_identifier = defined('WPTS_TEAMS_ORGANIZER_USER_ID') ? WPTS_TEAMS_ORGANIZER_USER_ID : $from_email;
        
        // If it's not an email and looks like a GUID that might be wrong, use the from_email instead
        if (!filter_var($user_identifier, FILTER_VALIDATE_EMAIL) && strlen($user_identifier) > 30) {
            error_log('Graph Mail: User ID appears to be a GUID, trying email instead: ' . $from_email);
            $user_identifier = $from_email;
        }

        // Send email via Microsoft Graph API
        $endpoint = "https://graph.microsoft.com/v1.0/users/{$user_identifier}/sendMail";
        
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode($message),
            'timeout' => 30,
            'sslverify' => !defined('WPTS_DISABLE_SSL_VERIFY') || !WPTS_DISABLE_SSL_VERIFY
        );

        error_log('Graph Mail: Sending email to ' . $to);
        $response = wp_remote_post($endpoint, $args);

        if (is_wp_error($response)) {
            error_log('Graph Mail: Failed to send email - ' . $response->get_error_message());
            return $response;
        }

        $status_code = wp_remote_retrieve_response_code($response);
        
        if ($status_code === 202 || $status_code === 200) {
            error_log('Graph Mail: Email sent successfully to ' . $to);
            return true;
        } else {
            $error_body = wp_remote_retrieve_body($response);
            error_log('Graph Mail: Failed to send email - Status: ' . $status_code . ' - ' . $error_body);
            return new WP_Error('send_failed', 'Failed to send email: ' . $error_body);
        }
    }

    /**
     * Send email to multiple recipients
     * 
     * @param array $recipients Array of email addresses
     * @param string $subject Email subject
     * @param string $html_body HTML email body
     * @param string $from_email Sender email
     * @param string $from_name Sender display name
     * @return array Results for each recipient
     */
    public function send_mail_multiple($recipients, $subject, $html_body, $from_email = null, $from_name = null) {
        $results = array();
        
        foreach ($recipients as $recipient) {
            $result = $this->send_mail($recipient, $subject, $html_body, $from_email, $from_name);
            $results[$recipient] = $result;
            
            // Small delay to avoid rate limiting
            usleep(100000); // 0.1 second delay
        }
        
        return $results;
    }
}

