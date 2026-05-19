<?php
class WPTS_Settings_API {

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'settings_init']);
        add_action('admin_notices', [$this, 'show_configuration_notices']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'Scheduler Settings',
            'Scheduler Settings',
            'manage_options',
            'wpts_settings',
            [$this, 'settings_page_html'],
            'dashicons-admin-generic'
        );
    }

    public function settings_init() {
        // General Settings
        register_setting('wpts_settings_general', 'wpts_settings_general');

        add_settings_section('wpts_general_section', 'General & Availability', null, 'wpts_settings_general');

        add_settings_field('meeting_provider', 'Meeting Provider', [$this, 'render_field_provider_select'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'meeting_provider', 'group' => 'wpts_settings_general']);

        add_settings_field('admin_email', 'Admin Notification Email', [$this, 'render_field_text'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'admin_email', 'group' => 'wpts_settings_general']);
        add_settings_field('phone_number', 'Contact Phone Number', [$this, 'render_field_text'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'phone_number', 'group' => 'wpts_settings_general']);
        add_settings_field('buffer_time', 'Buffer Time (minutes)', [$this, 'render_field_number'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'buffer_time', 'group' => 'wpts_settings_general']);
        add_settings_field('timezone', 'Base Timezone', [$this, 'render_field_timezone'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'timezone', 'group' => 'wpts_settings_general']);

        add_settings_field('availability', 'Weekly Availability', [$this, 'render_field_availability'], 'wpts_settings_general', 'wpts_general_section', ['id' => 'availability', 'group' => 'wpts_settings_general']);
        
        // Microsoft Teams API Settings
        register_setting('wpts_settings_teams', 'wpts_settings_teams');
        add_settings_section('wpts_teams_section', 'Microsoft Teams API Credentials', [$this, 'teams_section_callback'], 'wpts_settings_teams');
        
        add_settings_field('tenant_id', 'Tenant ID', [$this, 'render_field_text'], 'wpts_settings_teams', 'wpts_teams_section', ['id' => 'tenant_id', 'group' => 'wpts_settings_teams']);
        add_settings_field('client_id', 'Client ID', [$this, 'render_field_text'], 'wpts_settings_teams', 'wpts_teams_section', ['id' => 'client_id', 'group' => 'wpts_settings_teams']);
        add_settings_field('client_secret', 'Client Secret', [$this, 'render_field_password'], 'wpts_settings_teams', 'wpts_teams_section', ['id' => 'client_secret', 'group' => 'wpts_settings_teams']);
        add_settings_field('organizer_user_id', 'Organizer User ID/UPN', [$this, 'render_field_text'], 'wpts_settings_teams', 'wpts_teams_section', ['id' => 'organizer_user_id', 'group' => 'wpts_settings_teams']);
        
        // Google Meet API Settings
        register_setting('wpts_settings_google_meet', 'wpts_settings_google_meet');
        add_settings_section('wpts_google_meet_section', 'Google Meet API Configuration', [$this, 'google_meet_section_callback'], 'wpts_settings_google_meet');
        
        add_settings_field('client_id', 'Client ID', [$this, 'render_field_text'], 'wpts_settings_google_meet', 'wpts_google_meet_section', ['id' => 'client_id', 'group' => 'wpts_settings_google_meet']);
        add_settings_field('client_secret', 'Client Secret', [$this, 'render_field_password'], 'wpts_settings_google_meet', 'wpts_google_meet_section', ['id' => 'client_secret', 'group' => 'wpts_settings_google_meet']);
        add_settings_field('calendar_id', 'Calendar ID', [$this, 'render_field_text'], 'wpts_settings_google_meet', 'wpts_google_meet_section', ['id' => 'calendar_id', 'group' => 'wpts_settings_google_meet']);
        add_settings_field('google_meet_auth', 'Authorization', [$this, 'render_google_meet_auth'], 'wpts_settings_google_meet', 'wpts_google_meet_section', ['id' => 'google_meet_auth', 'group' => 'wpts_settings_google_meet']);

        // Blocked Slots Settings
        register_setting('wpts_blocked_slots', 'wpts_blocked_slots');
        add_settings_section('wpts_blocked_section', 'Manually Blocked Slots', [$this, 'blocked_section_callback'], 'wpts_blocked_slots');
        add_settings_field('blocked_manager', 'Manage Blocked Slots', [$this, 'render_blocked_slots_manager'], 'wpts_blocked_slots', 'wpts_blocked_section');
    }

    public function settings_page_html() {
        if (!current_user_can('manage_options')) {
            return;
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <h2 class="nav-tab-wrapper">
                <a href="?page=wpts_settings&tab=general" class="nav-tab <?php echo (!isset($_GET['tab']) || $_GET['tab'] == 'general') ? 'nav-tab-active' : ''; ?>">General</a>
                <a href="?page=wpts_settings&tab=blocked" class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'blocked') ? 'nav-tab-active' : ''; ?>">Blocked Slots</a>
                <a href="?page=wpts_settings&tab=teams" class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'teams') ? 'nav-tab-active' : ''; ?>">MS Teams API</a>
                <a href="?page=wpts_settings&tab=google_meet" class="nav-tab <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'google_meet') ? 'nav-tab-active' : ''; ?>">Google Meet API</a>
            </h2>
            <form action="options.php" method="post">
                <?php
                $tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
                if ($tab == 'teams') {
                    settings_fields('wpts_settings_teams');
                    do_settings_sections('wpts_settings_teams');
                } elseif ($tab == 'google_meet') {
                    $this->handle_google_meet_actions();
                    settings_fields('wpts_settings_google_meet');
                    do_settings_sections('wpts_settings_google_meet');
                } elseif ($tab == 'blocked') {
                    settings_fields('wpts_blocked_slots');
                    do_settings_sections('wpts_blocked_slots');
                } else {
                    settings_fields('wpts_settings_general');
                    do_settings_sections('wpts_settings_general');
                }
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        <?php
    }

    public function render_field_text($args) {
        $options = get_option($args['group']);
        $value = isset($options[$args['id']]) ? $options[$args['id']] : '';
        echo '<input type="text" id="' . esc_attr($args['id']) . '" name="' . esc_attr($args['group']) . '[' . esc_attr($args['id']) . ']" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public function render_field_password($args) {
        $options = get_option($args['group']);
        $value = isset($options[$args['id']]) ? $options[$args['id']] : '';
        echo '<input type="password" id="' . esc_attr($args['id']) . '" name="' . esc_attr($args['group']) . '[' . esc_attr($args['id']) . ']" value="' . esc_attr($value) . '" class="regular-text">';
    }

     public function render_field_number($args) {
        $options = get_option($args['group']);
        $value = isset($options[$args['id']]) ? $options[$args['id']] : '0';
        echo '<input type="number" id="' . esc_attr($args['id']) . '" name="' . esc_attr($args['group']) . '[' . esc_attr($args['id']) . ']" value="' . esc_attr($value) . '" min="0">';
    }



    public function render_field_timezone($args) {
        $options = get_option($args['group']);
        $current_tz = isset($options[$args['id']]) ? $options[$args['id']] : 'Asia/Kolkata';
        echo wp_timezone_choice($current_tz, 'wpts_settings_general[timezone]');
    }

    public function render_field_availability($args) {
        $options = get_option($args['group']);
        $availability = isset($options[$args['id']]) ? $options[$args['id']] : [];
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days as $day) {
            $day_key = strtolower($day);
            $start = isset($availability[$day_key]['start']) ? $availability[$day_key]['start'] : '';
            $end = isset($availability[$day_key]['end']) ? $availability[$day_key]['end'] : '';
            $enabled = isset($availability[$day_key]['enabled']) ? 'checked' : '';
            ?>
            <div style="margin-bottom: 10px;">
                <label style="display: inline-block; width: 100px;">
                    <input type="checkbox" name="<?php echo esc_attr($args['group']); ?>[<?php echo esc_attr($args['id']); ?>][<?php echo $day_key; ?>][enabled]" value="1" <?php echo $enabled; ?>>
                    <?php echo $day; ?>
                </label>
                <input type="time" name="<?php echo esc_attr($args['group']); ?>[<?php echo esc_attr($args['id']); ?>][<?php echo $day_key; ?>][start]" value="<?php echo esc_attr($start); ?>"> to
                <input type="time" name="<?php echo esc_attr($args['group']); ?>[<?php echo esc_attr($args['id']); ?>][<?php echo $day_key; ?>][end]" value="<?php echo esc_attr($end); ?>">
            </div>
            <?php
        }
    }
    
    public function teams_section_callback() {
        echo '<p>Enter your Microsoft Azure App credentials below. You can obtain these from the Azure Active Directory portal for your organization.</p>';
        echo '<h3>Instructions:</h3>';
        echo '<ol>';
        echo '<li>Go to <a href="https://portal.azure.com/" target="_blank">Azure Portal</a> > Azure Active Directory > App registrations > New registration.</li>';
        echo '<li>Give it a name (e.g., "WordPress Scheduler App") and choose "Accounts in this organizational directory only". Click Register.</li>';
        echo '<li>On the app\'s Overview page, copy the <strong>Application (client) ID</strong> and <strong>Directory (tenant) ID</strong>.</li>';
        echo '<li>Go to "Certificates & secrets", create a new client secret, and copy its <strong>Value</strong> immediately (it won\'t be shown again).</li>';
        echo '<li>Go to "API permissions" > Add a permission > Microsoft Graph > Application permissions.</li>';
        echo '<li>Select <strong>OnlineMeetings.ReadWrite.All</strong> and add the permission.</li>';
        echo '<li>Click the "Grant admin consent for [Your Org]" button. The status should turn green.</li>';
        echo '<li>The <strong>Organizer User ID/UPN</strong> is the email address or Object ID of the user on whose behalf meetings will be created (e.g., <code>scheduling.bot@yourcompany.com</code>). This user must have a Teams license.</li>';
        echo '<li><strong>Crucial Final Step (requires Teams Admin):</strong> An administrator must create an <a href="https://learn.microsoft.com/en-us/graph/cloud-communication-online-meeting-application-access-policy" target="_blank">application access policy</a> in PowerShell to allow this app to create meetings. Example: <code>New-CsApplicationAccessPolicy -Identity "Scheduler-Policy" -AppIds "YOUR-CLIENT-ID" -Description "Policy for WP Scheduler App"</code> then <code>Grant-CsApplicationAccessPolicy -PolicyName "Scheduler-Policy" -Identity "ORGANIZER-USER-ID"</code>.</li>';
        echo '</ol>';
    }

    public function google_meet_section_callback() {
        echo '<p>Configure Google Meet integration using Google Calendar API. This provides the most reliable and feature-rich meeting experience.</p>';
        echo '<h3>Setup Instructions:</h3>';
        echo '<ol>';
        echo '<li>Go to <a href="https://console.cloud.google.com/" target="_blank">Google Cloud Console</a></li>';
        echo '<li>Create a new project or select an existing one</li>';
        echo '<li>Enable the <strong>Google Calendar API</strong> in the API Library</li>';
        echo '<li>Go to "Credentials" > "Create Credentials" > "OAuth 2.0 Client IDs"</li>';
        echo '<li>Configure the OAuth consent screen if prompted</li>';
        echo '<li>Set Application Type to "Web application"</li>';
        echo '<li>Add this URL to "Authorized redirect URIs": <code>' . admin_url('admin.php?page=wpts_settings&tab=google_meet&action=oauth_callback') . '</code></li>';
        echo '<li>Copy the <strong>Client ID</strong> and <strong>Client Secret</strong> to the fields below</li>';
        echo '<li>Save settings and click "Authorize with Google" to complete setup</li>';
        echo '</ol>';
        echo '<p><strong>Benefits of Google Meet:</strong></p>';
        echo '<ul>';
        echo '<li>✅ Automatic calendar invitations</li>';
        echo '<li>✅ Professional meeting experience</li>';
        echo '<li>✅ Reliable video quality</li>';
        echo '<li>✅ Mobile app support</li>';
        echo '<li>✅ Screen sharing and recording</li>';
        echo '<li>✅ Integration with Google Workspace</li>';
        echo '</ul>';
    }

    public function handle_google_meet_actions() {
        if (isset($_GET['action'])) {
            $google_meet_api = new WPTS_Google_Meet_API();
            
            switch ($_GET['action']) {
                case 'oauth_callback':
                    if (isset($_GET['code'])) {
                        $result = $google_meet_api->handle_oauth_callback($_GET['code']);
                        if (is_wp_error($result)) {
                            echo '<div class="notice notice-error"><p>Authorization failed: ' . $result->get_error_message() . '</p></div>';
                        } else {
                            echo '<div class="notice notice-success"><p>Successfully authorized with Google! You can now use Google Meet.</p></div>';
                        }
                    }
                    break;
                    
                case 'test_connection':
                    $result = $google_meet_api->test_connection();
                    if (is_wp_error($result)) {
                        echo '<div class="notice notice-error"><p>Connection test failed: ' . $result->get_error_message() . '</p></div>';
                    } else {
                        echo '<div class="notice notice-success"><p>Connection successful! Calendar: ' . $result['calendar_name'] . '</p></div>';
                    }
                    break;
                    
                case 'revoke_access':
                    $google_meet_api->revoke_access();
                    echo '<div class="notice notice-success"><p>Access revoked successfully.</p></div>';
                    break;
            }
        }
    }

    public function render_google_meet_auth($args) {
        $google_meet_api = new WPTS_Google_Meet_API();
        $settings = get_option('wpts_settings_google_meet', []);
        
        if (!empty($settings['client_id']) && !empty($settings['client_secret'])) {
            if (!empty($settings['access_token'])) {
                echo '<div style="background: #d4edda; border: 1px solid #c3e6cb; padding: 12px; border-radius: 4px; margin-bottom: 10px;">';
                echo '<strong>✅ Authorized</strong> - Google Meet is ready to use!';
                echo '</div>';
                
                echo '<p>';
                echo '<a href="?page=wpts_settings&tab=google_meet&action=test_connection" class="button">Test Connection</a> ';
                echo '<a href="?page=wpts_settings&tab=google_meet&action=revoke_access" class="button" onclick="return confirm(\'Are you sure you want to revoke access?\')">Revoke Access</a>';
                echo '</p>';
            } else {
                $auth_url = $google_meet_api->get_auth_url();
                if (!is_wp_error($auth_url)) {
                    echo '<div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 12px; border-radius: 4px; margin-bottom: 10px;">';
                    echo '<strong>⚠️ Authorization Required</strong> - Click the button below to authorize with Google.';
                    echo '</div>';
                    
                    echo '<p>';
                    echo '<a href="' . esc_url($auth_url) . '" class="button button-primary">Authorize with Google</a>';
                    echo '</p>';
                } else {
                    echo '<div style="background: #f8d7da; border: 1px solid #f5c6cb; padding: 12px; border-radius: 4px;">';
                    echo '<strong>❌ Configuration Error:</strong> Could not generate authorization URL. Please ensure your Client ID and Client Secret are correct. The server reported: <br><em>' . esc_html($auth_url->get_error_message()) . '</em>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div style="background: #f8d7da; border: 1px solid #f5c6cb; padding: 12px; border-radius: 4px;">';
            echo '<strong>❌ Missing Configuration</strong> - Please enter your Client ID and Client Secret above, then save settings.';
            echo '</div>';
        }
    }

    public function render_field_provider_select($args) {
        $options = get_option($args['group']);
        $value = isset($options[$args['id']]) ? $options[$args['id']] : 'google_meet';
        ?>
        <select id="<?php echo esc_attr($args['id']); ?>" name="<?php echo esc_attr($args['group']); ?>[<?php echo esc_attr($args['id']); ?>]">
            <option value="google_meet" <?php selected($value, 'google_meet'); ?>>Google Meet (Recommended)</option>
            <option value="teams" <?php selected($value, 'teams'); ?>>Microsoft Teams (Requires API Setup)</option>
            <option value="jitsi" <?php selected($value, 'jitsi'); ?>>Jitsi Meet (Free & Simple)</option>
        </select>
        <p class="description">
            Select your preferred meeting provider. Google Meet is recommended for the best experience and reliability.
        </p>
        <?php
    }

    /**
     * Show configuration notices for meeting providers
     */
    public function show_configuration_notices() {
        // Only show on plugin settings page
        if (!isset($_GET['page']) || $_GET['page'] !== 'wpts_settings') {
            return;
        }

        $general_settings = get_option('wpts_settings_general', []);
        $provider = isset($general_settings['meeting_provider']) ? $general_settings['meeting_provider'] : 'google_meet';

        if ($provider === 'google_meet') {
            $google_meet_api = new WPTS_Google_Meet_API();
            
            if (!$google_meet_api->is_configured()) {
                ?>
                <div class="notice notice-warning">
                    <p>
                        <strong>Google Meet Configuration Required:</strong> 
                        Google Meet is selected as your meeting provider but is not properly configured. 
                        Please configure the Client ID, Client Secret, and authorize the integration in the 
                        <a href="?page=wpts_settings&tab=google_meet">Google Meet API tab</a>.
                        <br><em>Note: Bookings will automatically fall back to Jitsi Meet until Google Meet is properly configured.</em>
                    </p>
                </div>
                <?php
            } else {
                // Test the connection
                $test_result = $google_meet_api->test_connection();
                if (is_wp_error($test_result)) {
                    ?>
                    <div class="notice notice-error">
                        <p>
                            <strong>Google Meet Connection Error:</strong> 
                            <?php echo esc_html($test_result->get_error_message()); ?>
                            Please check your configuration in the 
                            <a href="?page=wpts_settings&tab=google_meet">Google Meet API tab</a>.
                            <br><em>Note: Bookings will automatically fall back to Jitsi Meet until this is resolved.</em>
                        </p>
                    </div>
                    <?php
                }
            }
        }
    }

    public function blocked_section_callback() {
        echo '<p>Manually block specific dates and times to prevent bookings (e.g., holidays, personal time).</p>';
    }

    public function render_blocked_slots_manager() {
        $blocked_slots = get_option('wpts_blocked_slots', []);
        ?>
        <div id="wpts-blocked-slots-container">
            <table class="widefat striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="wpts-blocked-list">
                    <?php 
                    if (!empty($blocked_slots)) {
                        foreach ($blocked_slots as $index => $slot) {
                            $this->render_blocked_slot_row($index, $slot);
                        }
                    }
                    ?>
                </tbody>
            </table>
            
            <p>
                <button type="button" class="button button-secondary" id="wpts-add-blocked-slot">Add Blocked Slot</button>
            </p>
        </div>

        <script>
        jQuery(document).ready(function($) {
            let slotIndex = <?php echo empty($blocked_slots) ? 0 : max(array_keys($blocked_slots)) + 1; ?>;
            
            $('#wpts-add-blocked-slot').on('click', function() {
                const row = `
                    <tr>
                        <td>
                            <input type="date" name="wpts_blocked_slots[${slotIndex}][date]" required>
                        </td>
                        <td>
                            <input type="time" name="wpts_blocked_slots[${slotIndex}][start]" required>
                        </td>
                        <td>
                            <input type="time" name="wpts_blocked_slots[${slotIndex}][end]" required>
                        </td>
                        <td>
                            <button type="button" class="button button-link-delete wpts-remove-slot">Remove</button>
                        </td>
                    </tr>
                `;
                $('#wpts-blocked-list').append(row);
                slotIndex++;
            });
            
            $(document).on('click', '.wpts-remove-slot', function() {
                $(this).closest('tr').remove();
            });
        });
        </script>
        <?php
    }

    private function render_blocked_slot_row($index, $slot) {
        ?>
        <tr>
            <td>
                <input type="date" name="wpts_blocked_slots[<?php echo esc_attr($index); ?>][date]" value="<?php echo esc_attr($slot['date']); ?>" required>
            </td>
            <td>
                <input type="time" name="wpts_blocked_slots[<?php echo esc_attr($index); ?>][start]" value="<?php echo esc_attr($slot['start']); ?>" required>
            </td>
            <td>
                <input type="time" name="wpts_blocked_slots[<?php echo esc_attr($index); ?>][end]" value="<?php echo esc_attr($slot['end']); ?>" required>
            </td>
            <td>
                <button type="button" class="button button-link-delete wpts-remove-slot">Remove</button>
            </td>
        </tr>
        <?php
    }
}
