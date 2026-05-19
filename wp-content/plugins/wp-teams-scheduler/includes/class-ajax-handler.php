<?php
class WPTS_Ajax_Handler {

    public function __construct() {
        add_action('wp_ajax_wpts_get_available_slots', [$this, 'get_available_slots']);
        add_action('wp_ajax_nopriv_wpts_get_available_slots', [$this, 'get_available_slots']);

        add_action('wp_ajax_wpts_handle_booking', [$this, 'handle_booking']);
        add_action('wp_ajax_nopriv_wpts_handle_booking', [$this, 'handle_booking']);
    }

    public function get_available_slots() {
        check_ajax_referer('wpts_nonce', 'nonce');

        $date_str = sanitize_text_field($_POST['date']); // YYYY-MM-DD
        $event_id = intval($_POST['event_id']);
        $user_timezone = sanitize_text_field($_POST['user_timezone'] ?? 'UTC');
        
        $duration = get_post_meta($event_id, '_event_duration', true);
        if (!$duration) {
            wp_send_json_error(['message' => 'Invalid event type.']);
        }
        
        $general_settings = get_option('wpts_settings_general');
        $base_tz = new DateTimeZone($general_settings['timezone'] ?? 'Asia/Kolkata');
        $buffer = intval($general_settings['buffer_time'] ?? 0);
        $availability = $general_settings['availability'] ?? [];

        $selected_date = new DateTime($date_str, $base_tz);
        $day_of_week = strtolower($selected_date->format('l'));

        if (!isset($availability[$day_of_week]['enabled']) || !$availability[$day_of_week]['enabled']) {
            wp_send_json_success(['slots' => []]); // Day not available
        }

        $start_time_str = $availability[$day_of_week]['start']; // e.g., 09:00
        $end_time_str = $availability[$day_of_week]['end']; // e.g., 17:00

        $day_start = new DateTime($date_str . ' ' . $start_time_str, $base_tz);
        $day_end = new DateTime($date_str . ' ' . $end_time_str, $base_tz);

        // Get existing bookings for the selected date
        $args = [
            'post_type' => 'booking',
            'post_status' => ['publish', 'pending'], // Check pending slots too
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => '_booking_datetime',
                    'value' => [$day_start->getTimestamp(), $day_end->getTimestamp()],
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                ]
            ]
        ];
        $existing_bookings_query = new WP_Query($args);
        $booked_ranges = [];
        if ($existing_bookings_query->have_posts()) {
            foreach ($existing_bookings_query->posts as $booking_post) {
                $booking_start = (int)get_post_meta($booking_post->ID, '_booking_datetime', true);
                $booking_event_id = (int)get_post_meta($booking_post->ID, '_booking_event_type_id', true);
                $booking_duration = (int)get_post_meta($booking_event_id, '_event_duration', true);
                
                if ($booking_duration > 0) {
                    $booking_end = $booking_start + ($booking_duration * 60);
                    $booked_ranges[] = [
                        'start' => $booking_start,
                        'end' => $booking_end
                    ];
                }
            }
        }

        // Add manually blocked slots
        $blocked_slots_option = get_option('wpts_blocked_slots', []);
        if (!empty($blocked_slots_option) && is_array($blocked_slots_option)) {
            foreach ($blocked_slots_option as $slot) {
                // Check if the blocked slot is for the current date
                if (isset($slot['date']) && $slot['date'] === $date_str) {
                    $block_start_str = $slot['date'] . ' ' . $slot['start'];
                    $block_end_str = $slot['date'] . ' ' . $slot['end'];
                    
                    try {
                        $block_start_dt = new DateTime($block_start_str, $base_tz);
                        $block_end_dt = new DateTime($block_end_str, $base_tz);
                        
                        $booked_ranges[] = [
                            'start' => $block_start_dt->getTimestamp(),
                            'end' => $block_end_dt->getTimestamp()
                        ];
                    } catch (Exception $e) {
                        // Invalid date/time format, skip
                        continue;
                    }
                }
            }
        }

        $available_slots = [];
        $slot_interval = new DateInterval('PT' . ($duration + $buffer) . 'M');
        $current_slot = clone $day_start;
        $current_time = new DateTime('now', $base_tz);
        $current_time_ts = $current_time->getTimestamp();
        $trimmed_slots = false;

        while ($current_slot < $day_end) {
            $slot_start_ts = $current_slot->getTimestamp();
            $slot_end_ts = $slot_start_ts + ($duration * 60);

            if ($slot_start_ts <= $current_time_ts) {
                $trimmed_slots = true;
                $current_slot->add($slot_interval);
                continue;
            }
            
            if ($slot_end_ts > $day_end->getTimestamp()) {
                break; // Slot extends past end of availability
            }

            // Check if this slot overlaps with any existing booking
            $has_overlap = false;
            foreach ($booked_ranges as $booked) {
                // Two time ranges overlap if: slot_start < booking_end AND slot_end > booking_start
                if ($slot_start_ts < $booked['end'] && $slot_end_ts > $booked['start']) {
                    $has_overlap = true;
                    break;
                }
            }

            if (!$has_overlap) {
                $available_slots[] = [
                    'value' => $slot_start_ts,
                    'label' => $current_slot->format('g:i A')
                ];
            }
            $current_slot->add($slot_interval);
        }

        // Add host timezone and availability range info for Calendly-style display
        $response_data = [
            'slots' => $available_slots,
            'host_timezone' => $general_settings['timezone'] ?? 'Asia/Kolkata',
            'availability_range' => [
                'start' => $day_start->getTimestamp(),
                'end' => $day_end->getTimestamp()
            ],
            'current_host_time' => $current_time_ts,
            'trimmed_past_slots' => $trimmed_slots,
            'no_future_slots' => $trimmed_slots && empty($available_slots)
        ];
        
        wp_send_json_success($response_data);
    }

    public function handle_booking() {
        check_ajax_referer('wpts_nonce', 'nonce');

        // 1. Sanitize & Validate
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $event_id = intval($_POST['event_id']);
        $slot_timestamp = intval($_POST['slot_timestamp']);
        $user_timezone = sanitize_text_field($_POST['user_timezone'] ?? 'UTC');
        $additional_info = sanitize_textarea_field($_POST['additional_info'] ?? '');

        $general_settings = get_option('wpts_settings_general');
        if (!is_array($general_settings)) {
            $general_settings = [];
        }
        $base_tz = new DateTimeZone($general_settings['timezone'] ?? 'Asia/Kolkata');

        // Process guest emails
        $guest_emails = [];
        if (isset($_POST['guest_emails']) && is_array($_POST['guest_emails'])) {
            foreach ($_POST['guest_emails'] as $guest_email) {
                $guest_email = sanitize_email(trim($guest_email));
                if (!empty($guest_email) && is_email($guest_email)) {
                    // Only add if not already in the array (prevent duplicates)
                    if (!in_array($guest_email, $guest_emails)) {
                        $guest_emails[] = $guest_email;
                    }
                }
            }
        }

        // Handle file uploads - Use OneDrive instead of local server
        $uploaded_files = [];
        error_log('WPTS File Upload: Checking for files...');
        
        if (!empty($_FILES['booking_documents'])) {
            error_log('WPTS File Upload: booking_documents field found');
            
            // Initialize OneDrive API
            $onedrive_api = new WPTS_OneDrive_API();
            $use_onedrive = $onedrive_api->is_configured();
            
            if ($use_onedrive) {
                error_log('WPTS File Upload: Using OneDrive cloud storage');
            } else {
                error_log('WPTS File Upload: OneDrive not configured, using local server');
                // Fallback to local storage if OneDrive not configured
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
            }
            
            $files = $_FILES['booking_documents'];
            
            // Check if it's a single file or multiple files
            if (is_array($files['name'])) {
                $file_count = count($files['name']);
                error_log('WPTS File Upload: Found ' . $file_count . ' file(s)');
                
                for ($i = 0; $i < $file_count; $i++) {
                    // Skip empty file inputs
                    if (empty($files['name'][$i])) {
                        error_log('WPTS File Upload: Skipping empty file at index ' . $i);
                        continue;
                    }
                    
                    error_log('WPTS File Upload: Processing file ' . ($i + 1) . ': ' . $files['name'][$i]);
                    
                    if ($files['error'][$i] === UPLOAD_ERR_OK) {
                        $file_array = array(
                            'name' => $files['name'][$i],
                            'type' => $files['type'][$i],
                            'tmp_name' => $files['tmp_name'][$i],
                            'error' => $files['error'][$i],
                            'size' => $files['size'][$i]
                        );
                        
                        // Validate file type
                        $allowed_types = array('pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'xls', 'xlsx');
                        $file_ext = strtolower(pathinfo($file_array['name'], PATHINFO_EXTENSION));
                        
                        if (in_array($file_ext, $allowed_types) && $file_array['size'] <= 4194304) { // 4MB limit for OneDrive
                            if ($use_onedrive) {
                                // Upload to OneDrive (will use booking_id after it's created)
                                $upload_result = $onedrive_api->upload_file($file_array, 0); // booking_id will be updated later
                                
                                if (!is_wp_error($upload_result)) {
                                    $uploaded_files[] = $upload_result;
                                    error_log('WPTS File Upload: File uploaded to OneDrive successfully!');
                                } else {
                                    error_log('WPTS File Upload: OneDrive upload failed: ' . $upload_result->get_error_message());
                                }
                            } else {
                                // Fallback to local storage
                                $attachment_id = media_handle_sideload($file_array, 0);
                                if (!is_wp_error($attachment_id)) {
                                    $uploaded_files[] = array(
                                        'id' => $attachment_id,
                                        'url' => wp_get_attachment_url($attachment_id),
                                        'name' => $file_array['name'],
                                        'storage' => 'local'
                                    );
                                    error_log('WPTS File Upload: File uploaded to local server');
                                }
                            }
                        } else {
                            if (!in_array($file_ext, $allowed_types)) {
                                error_log('WPTS File Upload: Invalid file type: ' . $file_ext);
                            } else {
                                error_log('WPTS File Upload: File too large (' . $file_array['size'] . ' bytes, max 4194304)');
                            }
                        }
                    } else {
                        error_log('WPTS File Upload: File has upload error: ' . $files['error'][$i]);
                    }
                }
            }
        } else {
            error_log('WPTS File Upload: No files uploaded (booking_documents field empty or missing)');
        }
        
        error_log('WPTS File Upload: Total files uploaded: ' . count($uploaded_files));

        if (empty($name) || !is_email($email) || empty($event_id) || empty($slot_timestamp)) {
            wp_send_json_error(['message' => 'Please fill all required fields.']);
        }

        $current_host_time = new DateTime('now', $base_tz);
        if ($slot_timestamp < $current_host_time->getTimestamp()) {
            wp_send_json_error(['message' => 'This time slot has already passed. Please select another.']);
        }

        // 2. Re-verify availability (critical to prevent double booking)
        // Calculate the time range for the new booking
        $duration = (int) get_post_meta($event_id, '_event_duration', true);
        $new_booking_start = $slot_timestamp;
        $new_booking_end = $slot_timestamp + ($duration * 60);
        
        // Get the date range to check (get bookings for the entire day)
        $booking_date = new DateTime("@$slot_timestamp");
        $booking_date->setTimezone($base_tz);
        
        // Calculate day boundaries in the base timezone
        $day_start_str = $booking_date->format('Y-m-d') . ' 00:00:00';
        $day_end_str = $booking_date->format('Y-m-d') . ' 23:59:59';
        $day_start_obj = new DateTime($day_start_str, $base_tz);
        $day_end_obj = new DateTime($day_end_str, $base_tz);
        
        // Get all bookings for this date
        $args = [
            'post_type' => 'booking',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => '_booking_datetime',
                    'value' => [$day_start_obj->getTimestamp(), $day_end_obj->getTimestamp()],
                    'type' => 'NUMERIC',
                    'compare' => 'BETWEEN'
                ]
            ]
        ];
        $existing = new WP_Query($args);
        
        // Check for overlapping bookings
        if ($existing->have_posts()) {
            foreach ($existing->posts as $existing_booking) {
                $existing_start = (int)get_post_meta($existing_booking->ID, '_booking_datetime', true);
                $existing_event_id = (int)get_post_meta($existing_booking->ID, '_booking_event_type_id', true);
                $existing_duration = (int)get_post_meta($existing_event_id, '_event_duration', true);
                $existing_end = $existing_start + ($existing_duration * 60);
                
                // Check if the new booking overlaps with this existing booking
                // Two ranges overlap if: new_start < existing_end AND new_end > existing_start
                if ($new_booking_start < $existing_end && $new_booking_end > $existing_start) {
                    wp_send_json_error(['message' => 'Sorry, this time slot has just been booked or overlaps with an existing booking. Please select another.']);
                }
            }
        }

        // Check for manual blocks
        $blocked_slots_option = get_option('wpts_blocked_slots', []);
        $booking_date_str = $booking_date->format('Y-m-d');
        
        if (!empty($blocked_slots_option) && is_array($blocked_slots_option)) {
            foreach ($blocked_slots_option as $slot) {
                if (isset($slot['date']) && $slot['date'] === $booking_date_str) {
                    $block_start_str = $slot['date'] . ' ' . $slot['start'];
                    $block_end_str = $slot['date'] . ' ' . $slot['end'];
                    
                    try {
                        $block_start_dt = new DateTime($block_start_str, $base_tz);
                        $block_end_dt = new DateTime($block_end_str, $base_tz);
                        $block_start_ts = $block_start_dt->getTimestamp();
                        $block_end_ts = $block_end_dt->getTimestamp();
                        
                        // Check overlap
                        if ($new_booking_start < $block_end_ts && $new_booking_end > $block_start_ts) {
                            wp_send_json_error(['message' => 'Sorry, this time slot is not available.']);
                        }
                    } catch (Exception $e) {
                        continue;
                    }
                }
            }
        }

        $event_name = get_the_title($event_id);

        // Prepare timestamps
        $start_dt_utc = new DateTime("@$slot_timestamp");
        $start_dt_utc->setTimezone(new DateTimeZone('UTC'));
        
        $end_dt_utc = clone $start_dt_utc;
        $end_dt_utc->add(new DateInterval('PT' . $duration . 'M'));

        // 3. Create Booking Post (Pending state first to reserve slot)
        $post_title = 'Booking for ' . $name . ' - ' . $start_dt_utc->format('Y-m-d @ H:i');
        $post_data = [
            'post_title' => $post_title,
            'post_type' => 'booking',
            'post_status' => 'pending', // Set as pending initially
        ];
        $booking_id = wp_insert_post($post_data);

        if (is_wp_error($booking_id)) {
            wp_send_json_error(['message' => 'Could not save booking.']);
        }

        update_post_meta($booking_id, '_booking_event_type_id', $event_id);
        update_post_meta($booking_id, '_booking_name', $name);
        update_post_meta($booking_id, '_booking_email', $email);
        update_post_meta($booking_id, '_booking_datetime', $slot_timestamp);
        update_post_meta($booking_id, '_booking_status', 'Pending');
        update_post_meta($booking_id, '_booking_user_timezone', $user_timezone);
        update_post_meta($booking_id, '_booking_guest_emails', $guest_emails);
        update_post_meta($booking_id, '_booking_additional_info', $additional_info);
        update_post_meta($booking_id, '_booking_uploaded_files', $uploaded_files);

        $meeting_link = null;
        $teams_enabled = get_post_meta($event_id, '_event_teams_enabled', true);

        // 4. Create Meeting Link based on settings
        $provider = isset($general_settings['meeting_provider']) ? $general_settings['meeting_provider'] : 'google_meet';
        $meeting_subject = 'Discussion with ' . $name . ' and SalesNanny Team - (' . $duration . ' minutes)';

        if ($provider === 'teams') {
            // Keep the per-event toggle for Microsoft Teams only
            if ($teams_enabled) {
                $teams_api = new WPTS_Teams_API();
                $meeting_link = $teams_api->create_teams_meeting(
                    $meeting_subject,
                    $start_dt_utc->format('Y-m-d\TH:i:s\Z'),
                    $end_dt_utc->format('Y-m-d\TH:i:s\Z')
                );

                if (is_wp_error($meeting_link)) {
                    // Cleanup pending booking
                    wp_delete_post($booking_id, true);
                    wp_send_json_error(['message' => 'Error creating Teams meeting link: ' . $meeting_link->get_error_message()]);
                }
            }
        } elseif ($provider === 'google_meet') {
            $google_meet_api = new WPTS_Google_Meet_API();

            // Check if Google Meet is properly configured
            if (!$google_meet_api->is_configured()) {
                // Fallback to Jitsi if Google Meet is not configured
                $jitsi_api = new WPTS_Jitsi_API();
                $meeting_link = $jitsi_api->create_jitsi_meeting($meeting_subject);
            } else {
                $meeting_result = $google_meet_api->create_google_meet_meeting(
                    $meeting_subject,
                    $start_dt_utc->format('Y-m-d\TH:i:s\Z'),
                    $end_dt_utc->format('Y-m-d\TH:i:s\Z'),
                    $email
                );

                if (is_wp_error($meeting_result)) {
                    // Fallback to Jitsi if Google Meet fails
                    $jitsi_api = new WPTS_Jitsi_API();
                    $meeting_link = $jitsi_api->create_jitsi_meeting($meeting_subject);
                } else {
                    $meeting_link = $meeting_result['join_url'];
                }
            }
        } else {
            $jitsi_api = new WPTS_Jitsi_API();
            $meeting_link = $jitsi_api->create_jitsi_meeting($meeting_subject);
        }
        
        // 5. Update Booking Status to Confirmed
        wp_update_post(['ID' => $booking_id, 'post_status' => 'publish']);
        update_post_meta($booking_id, '_booking_status', 'Confirmed');
        if ($meeting_link) {
            update_post_meta($booking_id, '_booking_teams_link', $meeting_link);
            update_post_meta($booking_id, '_booking_meeting_link', $meeting_link);
        }

        // 6. Send Emails
        $admin_email = $general_settings['admin_email'] ?? get_option('admin_email');
        
        // User Confirmation
        error_log('WPTS: Sending user confirmation email to: ' . $email);
        wpts_send_booking_email('email-user-confirmation', $booking_id, $email, 'You are scheduled');
        
        // Send invitations to guests
        if (!empty($guest_emails)) {
            error_log('WPTS: Found ' . count($guest_emails) . ' guest emails to send invitations to');
            foreach ($guest_emails as $guest_email) {
                error_log('WPTS: Sending guest invitation to: ' . $guest_email);
                wpts_send_booking_email('email-guest-invitation', $booking_id, $guest_email, 'Meeting Invitation: ' . $event_name);
            }
        } else {
            error_log('WPTS: No guest emails to send invitations to');
        }
        
        // Admin Notification
        error_log('WPTS: Sending admin notification to: ' . $admin_email);
        wpts_send_booking_email('email-admin-notification', $booking_id, $admin_email, 'New Booking: ' . $event_name . ' with ' . $name);

        // Format confirmation message for user's timezone
        $user_datetime = new DateTime("@$slot_timestamp");
        $user_datetime->setTimezone(new DateTimeZone($user_timezone));
        $formatted_time = $user_datetime->format('l, F j, Y \a\t g:i A T');

        $confirmation_message = 'A calendar invitation has been sent to your email address.';
        if (!empty($guest_emails)) {
            $guest_count = count($guest_emails);
            $confirmation_message .= " Meeting invitations have also been sent to {$guest_count} guest" . ($guest_count > 1 ? 's' : '') . ".";
        }

        wp_send_json_success([
            'message' => $confirmation_message,
            'meeting_link' => $meeting_link,
            'booking_id' => $booking_id
        ]);
    }
}