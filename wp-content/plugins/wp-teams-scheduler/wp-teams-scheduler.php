<?php
/**
 * Plugin Name:       WP Teams Scheduler Core
 * Plugin URI:        https://example.com/
 * Description:       Core functionality for the self-hosted Microsoft Teams meeting scheduler.
 * Version:           1.0.0
 * Author:            Your Name
 * Author URI:        https://example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-teams-scheduler
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'WPTS_VERSION', '1.0.0' );
define( 'WPTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
class WP_Teams_Scheduler {

    public function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    private function load_dependencies() {
        require_once WPTS_PLUGIN_DIR . 'includes/class-cpt-setup.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-settings-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-teams-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-jitsi-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-google-meet-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-graph-mail-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-onedrive-api.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-ajax-handler.php';
        require_once WPTS_PLUGIN_DIR . 'includes/class-shortcode-handler.php';
        
        // Load test integration in admin
        // if (is_admin()) {
        //     require_once WPTS_PLUGIN_DIR . 'test-integration.php';
        // }
    }

    private function init_hooks() {
        new WPTS_CPT_Setup();
        new WPTS_Settings_API();
        new WPTS_Ajax_Handler();
        new WPTS_Shortcode_Handler();
    }
}

// Let's get this party started.
new WP_Teams_Scheduler();

/**
 * Helper function to send custom HTML emails.
 *
 * @param string $template_name The name of the template file without .html
 * @param int    $booking_id    The ID of the booking post.
 * @param string $recipient_email The email address to send to.
 * @param string $subject         The email subject.
 */
function wpts_send_booking_email( $template_name, $booking_id, $recipient_email, $subject ) {
    if ( ! $booking_id ) {
        error_log('WPTS Email: No booking ID provided');
        return;
    }

    $template_path = WPTS_PLUGIN_DIR . 'templates/' . $template_name . '.html';
    if ( ! file_exists( $template_path ) ) {
        error_log('WPTS Email: Template not found - ' . $template_path);
        return;
    }

    error_log('WPTS Email: Preparing to send ' . $template_name . ' to ' . $recipient_email);
    $template = file_get_contents( $template_path );

    // Get booking data
    $name         = get_post_meta( $booking_id, '_booking_name', true );
    $email        = get_post_meta( $booking_id, '_booking_email', true );
    $datetime_utc = get_post_meta( $booking_id, '_booking_datetime', true );
    $meeting_link = get_post_meta( $booking_id, '_booking_meeting_link', true );
    $event_type_id = get_post_meta( $booking_id, '_booking_event_type_id', true );
    $user_timezone = get_post_meta( $booking_id, '_booking_user_timezone', true );
    $event_name   = get_the_title( $event_type_id );
    $duration     = get_post_meta( $event_type_id, '_event_duration', true );
    
    // Use user's timezone if available, otherwise fall back to system timezone
    $timezone_string = $user_timezone ?: 'UTC';
    $tz = new DateTimeZone($timezone_string);
    
    // Convert UTC timestamp to user's timezone
    $user_datetime = new DateTime("@$datetime_utc");
    $user_datetime->setTimezone($tz);
    
    // Calculate end time by adding duration
    $end_datetime = clone $user_datetime;
    $end_datetime->add(new DateInterval('PT' . $duration . 'M'));
    
    // Format time for display with start and end times
    $formatted_time = $user_datetime->format('H:i') . ' - ' . $end_datetime->format('H:i') . ', ' . $user_datetime->format('l, F j, Y');
    
    // Get timezone abbreviation
    $timezone_abbreviation = $user_datetime->format('T');
    
    // Get latest blog post from "blogs" category
    $blog_post = get_posts(array(
        'category_name' => 'blogs',
        'numberposts' => 1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    $blog_post_title = 'Discover the latest trends in logistics automation and how CargoWise is revolutionizing the industry.';
    $blog_post_url = home_url('/blog/');
    $blog_post_excerpt = 'Discover the latest trends in logistics automation and how CargoWise is revolutionizing the industry.';
    $blog_post_featured_image = 'https://i.imgur.com/k91b1nU.png'; // Default fallback image
    
    if (!empty($blog_post)) {
        $blog_post_title = $blog_post[0]->post_title;
        $blog_post_url = get_permalink($blog_post[0]->ID);
        $blog_post_excerpt = wp_trim_words($blog_post[0]->post_excerpt ?: $blog_post[0]->post_content, 15, '...');
        
        // Get featured image
        $blog_post_thumbnail_id = get_post_thumbnail_id($blog_post[0]->ID);
        if ($blog_post_thumbnail_id) {
            $blog_post_featured_image = wp_get_attachment_image_url($blog_post_thumbnail_id, 'thumbnail');
        }
    }
    
    // Get latest success story from "success-stories" category
    $success_story = get_posts(array(
        'category_name' => 'success-stories',
        'numberposts' => 1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    $success_story_title = 'See how we helped a client achieve a 40% increase in efficiency with our tailored solutions.';
    $success_story_url = home_url('/success-stories/');
    $success_story_excerpt = 'See how we helped a client achieve a 40% increase in efficiency with our tailored solutions.';
    $success_story_featured_image = 'https://i.imgur.com/uG9kK7A.png'; // Default fallback image
    
    if (!empty($success_story)) {
        $success_story_title = $success_story[0]->post_title;
        $success_story_url = get_permalink($success_story[0]->ID);
        $success_story_excerpt = wp_trim_words($success_story[0]->post_excerpt ?: $success_story[0]->post_content, 15, '...');
        
        // Get featured image
        $success_story_thumbnail_id = get_post_thumbnail_id($success_story[0]->ID);
        if ($success_story_thumbnail_id) {
            $success_story_featured_image = wp_get_attachment_image_url($success_story_thumbnail_id, 'thumbnail');
        }
    }
    
    // Get general settings for contact information
    $general_settings = get_option('wpts_settings_general');
    $admin_email = $general_settings['admin_email'] ?? get_option('admin_email');
    $phone_number = $general_settings['phone_number'] ?? '[phone number]';
    
    // Get additional booking info
    $guest_emails = get_post_meta($booking_id, '_booking_guest_emails', true) ?: [];
    $additional_info = get_post_meta($booking_id, '_booking_additional_info', true) ?: '';
    $uploaded_files = get_post_meta($booking_id, '_booking_uploaded_files', true) ?: [];
    
    // Extract first name from guest email (recipient)
    $guest_first_name = '';
    if (!empty($recipient_email)) {
        // Get the part before @ and capitalize first letter
        $email_parts = explode('@', $recipient_email);
        $guest_first_name = ucfirst(strtolower($email_parts[0]));
    }
    
    // Build guest emails row
    $guest_emails_row = '';
    if (!empty($guest_emails)) {
        $guest_list = '<ul class="guest-list">';
        foreach ($guest_emails as $guest_email) {
            $guest_list .= '<li>' . esc_html($guest_email) . '</li>';
        }
        $guest_list .= '</ul>';
        $guest_emails_row = '<tr><td>Guest Emails:</td><td>' . $guest_list . '</td></tr>';
    }
    
    // Build additional info row
    $additional_info_row = '';
    if (!empty($additional_info)) {
        $additional_info_row = '<tr><td>Additional Info:</td><td><div class="additional-info">' . nl2br(esc_html($additional_info)) . '</div></td></tr>';
    }
    
    // Build uploaded files row (for table-based emails like admin notification)
    $uploaded_files_row = '';
    if (!empty($uploaded_files)) {
        $files_list = '<ul class="attachment-list">';
        foreach ($uploaded_files as $file) {
            $files_list .= '<li>📎 <a href="' . esc_url($file['url']) . '" target="_blank">' . esc_html($file['name']) . '</a></li>';
        }
        $files_list .= '</ul>';
        $uploaded_files_row = '<tr><td>Attached Files:</td><td>' . $files_list . '</td></tr>';
    }
    
    // Build uploaded files section (for div-based emails like guest invitation)
    $uploaded_files_section = '';
    if (!empty($uploaded_files)) {
        $files_list = '<ul class="attachment-list">';
        foreach ($uploaded_files as $file) {
            $files_list .= '<li>📎 <a href="' . esc_url($file['url']) . '" target="_blank" style="color: #ff4916; text-decoration: none; font-weight: 500;">' . esc_html($file['name']) . '</a></li>';
        }
        $files_list .= '</ul>';
        $uploaded_files_section = '<div style="margin: 24px 0;"><h3 style="color: #000; font-size: 16px; margin: 0 0 12px 0;">📎 Attached Files:</h3>' . $files_list . '</div>';
    }
    
    // Build additional info section (for div-based emails like guest invitation)
    $additional_info_section = '';
    if (!empty($additional_info)) {
        $additional_info_section = '<div style="margin: 24px 0;"><h3 style="color: #000; font-size: 16px; margin: 0 0 12px 0;">Additional Information:</h3><div class="additional-info" style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; color: #333;">' . nl2br(esc_html($additional_info)) . '</div></div>';
    }
    
    // Calculate Admin's Local Time
    $admin_timezone = $general_settings['timezone'] ?? 'Asia/Kolkata'; // Default or retrieve
    $admin_tz = new DateTimeZone($admin_timezone);
    
    $admin_datetime = new DateTime("@$datetime_utc");
    $admin_datetime->setTimezone($admin_tz);
    
    $admin_end_datetime = clone $admin_datetime;
    $admin_end_datetime->add(new DateInterval('PT' . $duration . 'M'));
    
    $formatted_time_admin = $admin_datetime->format('H:i') . ' - ' . $admin_end_datetime->format('H:i') . ', ' . $admin_datetime->format('l, F j, Y') . ' (' . $admin_datetime->format('T') . ')';

    // Placeholders
    $placeholders = [
        '{{MEETING_TIME_ADMIN}}' => $formatted_time_admin,
        '{{USER_NAME}}'      => esc_html( $name ),
        '{{USER_EMAIL}}'     => esc_html( $email ),
        '{{GUEST_FIRST_NAME}}' => esc_html( $guest_first_name ),
        '{{MEETING_TIME}}'   => $formatted_time,
        '{{MEETING_LINK}}'   => esc_url( $meeting_link ),
        '{{TEAMS_LINK}}'     => esc_url( $meeting_link ), // Keep for backward compatibility
        '{{EVENT_NAME}}'     => esc_html( $event_name ),
        '{{SITE_TITLE}}'     => get_bloginfo('name'),
        '{{TIMEZONE}}'       => $timezone_abbreviation,
        '{{DURATION}}'       => $duration . ' min',
        '{{BLOG_POST_TITLE}}' => esc_html( $blog_post_title ),
        '{{BLOG_POST_URL}}'   => esc_url( $blog_post_url ),
        '{{BLOG_POST_EXCERPT}}' => esc_html( $blog_post_excerpt ),
        '{{BLOG_POST_FEATURED_IMAGE}}' => esc_url( $blog_post_featured_image ),
        '{{SUCCESS_STORY_TITLE}}' => esc_html( $success_story_title ),
        '{{SUCCESS_STORY_URL}}'   => esc_url( $success_story_url ),
        '{{SUCCESS_STORY_EXCERPT}}' => esc_html( $success_story_excerpt ),
        '{{SUCCESS_STORY_FEATURED_IMAGE}}' => esc_url( $success_story_featured_image ),
        '{{ADMIN_EMAIL}}'    => esc_html( $admin_email ),
        '{{PHONE_NUMBER}}'   => esc_html( $phone_number ),
        '{{SITE_URL}}'       => esc_url( home_url() ),
        '{{GUEST_EMAILS_ROW}}' => $guest_emails_row,
        '{{ADDITIONAL_INFO_ROW}}' => $additional_info_row,
        '{{UPLOADED_FILES_ROW}}' => $uploaded_files_row,
        '{{ADDITIONAL_INFO_SECTION}}' => $additional_info_section,
        '{{UPLOADED_FILES_SECTION}}' => $uploaded_files_section,
    ];

    $body = str_replace( array_keys( $placeholders ), array_values( $placeholders ), $template );

    // Try Microsoft Graph API first (if configured)
    $graph_mail = new WPTS_Graph_Mail_API();
    if ($graph_mail->is_configured()) {
        error_log('WPTS Email: Using Microsoft Graph API to send email to ' . $recipient_email);
        
        // Use the organizer's email for Graph API (must match the authenticated user)
        // The display name can still be customized
        $settings = get_option('wpts_settings_teams', array());
        $from_email = $settings['organizer_user_id'] ?? get_option('admin_email');
        $from_name = get_option('wpts_smtp_from_name', 'SalesNanny Team');
        
        $result = $graph_mail->send_mail($recipient_email, $subject, $body, $from_email, $from_name);
        
        if ($result === true) {
            error_log('WPTS Email: Successfully sent via Microsoft Graph API to ' . $recipient_email);
            return true;
        } else {
            error_log('WPTS Email: Microsoft Graph API failed - ' . (is_wp_error($result) ? $result->get_error_message() : 'Unknown error'));
            error_log('WPTS Email: Falling back to SMTP...');
        }
    }

    // Fallback to SMTP/wp_mail
    error_log('WPTS Email: Using SMTP/wp_mail to send email to ' . $recipient_email);
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: SalesNanny Team <' . get_option('admin_email') . '>';

    $mail_sent = wp_mail( $recipient_email, $subject, $body, $headers );
    
    if ($mail_sent) {
        error_log('WPTS Email: Successfully sent email to ' . $recipient_email);
    } else {
        error_log('WPTS Email: FAILED to send email to ' . $recipient_email);
    }
    
    return $mail_sent;
}
/**
 * Configures PHPMailer to use external SMTP for all outgoing WordPress emails.
 * This ensures reliable email delivery, especially on local and non-configured servers.
 * It pulls credentials securely from wp-config.php constants.
 *
 * @param PHPMailer $phpmailer The PHPMailer object.
 */
function wpts_configure_smtp( $phpmailer ) {
    // Check if our constants are defined before proceeding.
    if ( !defined('WPTS_SMTP_HOST') || !defined('WPTS_SMTP_USER') || !defined('WPTS_SMTP_PASS') ) {
        error_log('WPTS SMTP: Configuration constants not defined');
        return;
    }

    error_log('WPTS SMTP: Configuring SMTP with host: ' . WPTS_SMTP_HOST);
    
    $phpmailer->isSMTP();
    $phpmailer->Host       = WPTS_SMTP_HOST;
    $phpmailer->SMTPAuth   = WPTS_SMTP_AUTH;
    $phpmailer->Port       = WPTS_SMTP_PORT;
    $phpmailer->Username   = WPTS_SMTP_USER;
    $phpmailer->Password   = WPTS_SMTP_PASS;
    $phpmailer->SMTPSecure = WPTS_SMTP_SECURE;
    $phpmailer->From       = WPTS_SMTP_FROM;
    $phpmailer->FromName   = WPTS_SMTP_FROM_NAME;
    
    // Enable debug output for troubleshooting
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $phpmailer->SMTPDebug = 2; // 0 = off, 1 = client, 2 = client and server
        $phpmailer->Debugoutput = function($str, $level) {
            error_log("SMTP Debug ($level): $str");
        };
    }
    
    // Disable SSL verification for localhost (DEVELOPMENT ONLY)
    if (defined('WPTS_DISABLE_SSL_VERIFY') && WPTS_DISABLE_SSL_VERIFY) {
        $phpmailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        error_log('WPTS SMTP: SSL verification disabled for development');
    }
    
    error_log('WPTS SMTP: Configuration complete');
}
add_action( 'phpmailer_init', 'wpts_configure_smtp' );