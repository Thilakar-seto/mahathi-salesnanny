<style>
    img {
        width: revert-layer;
    }
    .header {
        background-color: #000 !important;
    }
    </style>
<div id="wpts-scheduler">

    <!-- Persistent Info Panel (Left Side) -->
    <div id="wpts-info-panel">
        <div class="wpts-back-button-container">
            <button id="wpts-back-button" class="wpts-back-btn" style="display: none;">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="wpts-logo-container">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png" width="64" height="64" alt="SalesNanny Logo">
        </div>
        <div id="wpts-info-static">
            <h3>Welcome to SalesNanny</h3>
            <h2>Discussion about Business Growth</h2>
            <div class="wpts-info-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span id="wpts-info-duration">1 hr</span>
            </div>
            <div class="wpts-info-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9A2.25 2.25 0 004.5 18.75z" /></svg>
                <span>Web conferencing details provided upon confirmation.</span>
            </div>
            <div class="wpts-info-item" id="wpts-selected-time-info" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 012.25 2.25v7.5" /></svg>
                <span id="wpts-selected-time-display"></span>
            </div>
            
        </div>
        <div class="wpts-info-description">
            <p>Please choose a date and time that works for you. After booking, you’ll receive all the details for the meeting.</p><p>
If you don’t see a suitable slot, feel free to book any time and we’ll adjust it, or simply email us your preferred time.</p><p>
Looking forward to connecting!</p>
        </div>
    </div>

    <!-- Main Interactive Panel (Right Side) -->
    <div id="wpts-main-panel">
        <div id="wpts-loader" class="wpts-hidden"><div class="wpts-spinner"></div></div>
        
        <!-- Calendly Corner Badge -->
        <!-- <div class="wpts-corner-badge">
            <span>Powered by<br>Calendly</span>
        </div> -->

        <!-- Step 1: Event Type Selection -->
        <div id="wpts-step-1-event-type" class="wpts-step wpts-active">
        <h2 class="wpts-step-title">Discussion with SalesNanny Team</h2>
            <h3 class="wpts-step-subtitle">Select your meeting duration</h3>
            <div class="wpts-event-grid">
                <?php if ($event_types->have_posts()) : ?>
                    <?php while ($event_types->have_posts()) : $event_types->the_post(); 
                        $is_popular = get_post_meta(get_the_ID(), '_event_is_popular', true);
                        $popular_class = ($is_popular === '1') ? ' wpts-is-popular' : '';
                    ?>
                        <button class="wpts-event-card<?php echo $popular_class; ?>" data-event-id="<?php echo get_the_ID(); ?>" data-duration="<?php echo get_post_meta(get_the_ID(), '_event_duration', true); ?>">
                        <?php if ($is_popular === '1') : ?>
                            <span class="wpts-popular-tag">Recommended</span>
                        <?php endif; ?>
                            <h3><?php echo get_post_meta(get_the_ID(), '_event_duration', true); ?> min</h3>
                            <span class="wpts-arrow-icon">&rarr;</span>
                        </button>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>No event types are currently available.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Step 2: Date & Time Picker -->
        <div id="wpts-step-2-datetime" class="wpts-step">
            <h2 class="wpts-step-title">Select a Date & Time</h2>
            <div class="wpts-calendar-header">
                <button id="wpts-prev-month" class="wpts-icon-button" aria-label="Go to previous month">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.4806 15.9941C13.8398 15.6529 13.8398 15.0998 13.4806 14.7586L8.47062 10L13.4806 5.24142C13.8398 4.90024 13.8398 4.34707 13.4806 4.00589C13.1214 3.66471 12.539 3.66471 12.1798 4.00589L6.51941 9.38223C6.1602 9.72342 6.1602 10.2766 6.51941 10.6178L12.1798 15.9941C12.539 16.3353 13.1214 16.3353 13.4806 15.9941Z" fill="currentColor"></path>
                    </svg>
                </button>
                <h3 id="wpts-month-year" class="wpts-month-label">July 2025</h3>
                <button id="wpts-next-month" class="wpts-icon-button" aria-label="Go to next month">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" role="img">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6.51941 15.9941C6.1602 15.6529 6.1602 15.0998 6.51941 14.7586L11.5294 10L6.51941 5.24142C6.1602 4.90024 6.1602 4.34707 6.51941 4.00589C6.87862 3.66471 7.46101 3.66471 7.82022 4.00589L13.4806 9.38223C13.8398 9.72342 13.8398 10.2766 13.4806 10.6178L7.82022 15.9941C7.46101 16.3353 6.87862 16.3353 6.51941 15.9941Z" fill="currentColor"></path>
                    </svg>
                </button>
            </div>
            <div class="wpts-datetime-container">
                <div class="wpts-calendar-wrapper">
                    <div id="wpts-calendar-grid"></div>
                    <label for="wpts-timezone-selector" style="font-size: 12px; color: #666; margin: 15px 0; display: block;">Your timezone:</label>
                    <select id="wpts-timezone-selector" class="wpts-timezone-select">
                        <option value="America/New_York">Eastern Time (US & Canada)</option>
                        <option value="America/Chicago">Central Time (US & Canada)</option>
                        <option value="America/Denver">Mountain Time (US & Canada)</option>
                        <option value="America/Los_Angeles">Pacific Time (US & Canada)</option>
                        <option value="America/Anchorage">Alaska Time (US)</option>
                        <option value="Pacific/Honolulu">Hawaii Time (US)</option>
                        <option value="America/Toronto">Eastern Time (Canada)</option>
                        <option value="America/Vancouver">Pacific Time (Canada)</option>
                        <option value="Europe/London">Greenwich Mean Time (UK)</option>
                        <option value="Europe/Paris">Central European Time (France)</option>
                        <option value="Europe/Berlin">Central European Time (Germany)</option>
                        <option value="Europe/Rome">Central European Time (Italy)</option>
                        <option value="Europe/Madrid">Central European Time (Spain)</option>
                        <option value="Europe/Amsterdam">Central European Time (Netherlands)</option>
                        <option value="Europe/Stockholm">Central European Time (Sweden)</option>
                        <option value="Europe/Oslo">Central European Time (Norway)</option>
                        <option value="Europe/Copenhagen">Central European Time (Denmark)</option>
                        <option value="Europe/Helsinki">Eastern European Time (Finland)</option>
                        <option value="Europe/Moscow">Moscow Time (Russia)</option>
                                <option value="Asia/Dubai">Gulf Standard Time (UAE)</option>
        <option value="Asia/Kolkata">India Standard Time (India)</option>
        <option value="Asia/Calcutta">India Standard Time (Calcutta)</option>
                        <option value="Asia/Dhaka">Bangladesh Standard Time (Bangladesh)</option>
                        <option value="Asia/Karachi">Pakistan Standard Time (Pakistan)</option>
                        <option value="Asia/Kathmandu">Nepal Time (Nepal)</option>
                        <option value="Asia/Colombo">Sri Lanka Time (Sri Lanka)</option>
                        <option value="Asia/Bangkok">Indochina Time (Thailand)</option>
                        <option value="Asia/Ho_Chi_Minh">Indochina Time (Vietnam)</option>
                        <option value="Asia/Singapore">Singapore Time (Singapore)</option>
                        <option value="Asia/Kuala_Lumpur">Malaysia Time (Malaysia)</option>
                        <option value="Asia/Manila">Philippines Time (Philippines)</option>
                        <option value="Asia/Jakarta">Western Indonesia Time (Indonesia)</option>
                        <option value="Asia/Shanghai">China Standard Time (China)</option>
                        <option value="Asia/Hong_Kong">Hong Kong Time (Hong Kong)</option>
                        <option value="Asia/Taipei">Taiwan Time (Taiwan)</option>
                        <option value="Asia/Seoul">Korea Standard Time (South Korea)</option>
                        <option value="Asia/Tokyo">Japan Standard Time (Japan)</option>
                        <option value="Australia/Sydney">Australian Eastern Time (Sydney)</option>
                        <option value="Australia/Melbourne">Australian Eastern Time (Melbourne)</option>
                        <option value="Australia/Brisbane">Australian Eastern Time (Brisbane)</option>
                        <option value="Australia/Perth">Australian Western Time (Perth)</option>
                        <option value="Australia/Adelaide">Australian Central Time (Adelaide)</option>
                        <option value="Pacific/Auckland">New Zealand Time (New Zealand)</option>
                        <option value="Pacific/Fiji">Fiji Time (Fiji)</option>
                        <option value="Africa/Cairo">Eastern European Time (Egypt)</option>
                        <option value="Africa/Johannesburg">South Africa Time (South Africa)</option>
                        <option value="Africa/Lagos">West Africa Time (Nigeria)</option>
                        <option value="Africa/Nairobi">East Africa Time (Kenya)</option>
                        <option value="America/Mexico_City">Central Time (Mexico)</option>
                        <option value="America/Sao_Paulo">Brasília Time (Brazil)</option>
                        <option value="America/Buenos_Aires">Argentina Time (Argentina)</option>
                        <option value="America/Lima">Peru Time (Peru)</option>
                        <option value="America/Bogota">Colombia Time (Colombia)</option>
                        <option value="America/Caracas">Venezuela Time (Venezuela)</option>
                        <option value="Atlantic/Reykjavik">Greenwich Mean Time (Iceland)</option>
                        <option value="UTC">Coordinated Universal Time (UTC)</option>
                    </select>
                </div>
                <div id="wpts-time-slots">
                    <p class="wpts-time-placeholder">Select a date to see available times.</p>
                </div>
            </div>
            <!-- <div class="wpts-timezone-info">
                <div class="wpts-timezone-display">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3s-4.5 4.03-4.5 9 2.015 9 4.5 9z" />
                    </svg>
                    <span>
                        <strong>All times shown in your timezone</strong><br>
                        <span id="wpts-calendar-timezone-display">Detecting timezone...</span>
                    </span>
                </div>
                <div class="wpts-timezone-conversion" id="wpts-timezone-conversion" style="display: none;">
                    <small>Host availability: <span id="wpts-host-time-display"></span></small>
                </div>
            </div> -->
            <!-- <div class="wpts-info-item wpts-timezone-selector">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3s-4.5 4.03-4.5 9 2.015 9 4.5 9z" /></svg>
                <div class="wpts-timezone-dropdown-container">
                    
                </div>
            </div> -->
        </div>

        <!-- Step 3: User Details Form -->
        <div id="wpts-step-3-details" class="wpts-step">
            <h2 class="wpts-step-title">Enter Details</h2>
            <form id="wpts-booking-form">
                <div class="wpts-form-group">
                    <label for="wpts-name">Name *</label>
                    <input type="text" id="wpts-name" name="name" required>
                </div>
                <div class="wpts-form-group">
                    <label for="wpts-email">Email *</label>
                    <input type="email" id="wpts-email" name="email" required>
                </div>
                <div class="wpts-form-group">
                    <button type="button" class="wpts-add-guests-btn">Add Guests</button>
                </div>
                <div class="wpts-guests-section" style="display: none;">
                    <div class="wpts-guests-header">
                        <h4>Guest Emails</h4>
                        <p>Add email addresses of people you'd like to invite to this meeting.</p>
                    </div>
                    <div class="wpts-guests-list">
                        <div class="wpts-guest-input-group">
                            <input type="email" name="guest_emails[]" class="wpts-guest-email" placeholder="guest@example.com">
                            <button type="button" class="wpts-remove-guest-btn" style="display: none;">×</button>
                        </div>
                    </div>
                    <button type="button" class="wpts-add-more-guests-btn">+ Add Another Guest</button>
                </div>
                <div class="wpts-form-group">
                    <label for="wpts-additional-info">Please share anything that will help prepare for our meeting.</label>
                    <textarea id="wpts-additional-info" name="additional_info" rows="4" placeholder="Please share anything that will help prepare for our meeting."></textarea>
                </div>
                <div class="wpts-form-group">
                    <label for="wpts-documents">Attach Documents (Optional)</label>
                    <p style="font-size: 12px; color: #666; margin: 5px 0 10px 0;">Upload any relevant documents (PDF, DOC, DOCX, JPG, PNG, XLS, XLSX - Max 10MB each)</p>
                    <input type="file" id="wpts-documents" name="booking_documents[]" multiple accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.xls,.xlsx" style="border: 1px solid #e5e7eb; padding: 10px; border-radius: 8px; width: 100%; background: #f9fafb;">
                    <div id="wpts-file-list" style="margin-top: 10px; font-size: 13px; color: #666;"></div>
                </div>
                <div class="wpts-terms-agreement">
                    <p>By proceeding, you confirm that you have read and agree to <a href="<?php echo home_url('/privacy-policy'); ?>" class="wpts-link" target="_blank">Privacy Policy</a>.</p>
                </div>
                <input type="hidden" id="wpts-selected-event-id" name="event_id">
                <input type="hidden" id="wpts-selected-slot-timestamp" name="slot_timestamp">
                <button type="submit" class="wpts-button">Schedule Event</button>
            </form>
        </div>

        <!-- Step 4: Confirmation Message -->
        <div id="wpts-step-4-confirmation" class="wpts-step">
            <div class="wpts-confirmation-content">
                <div class="wpts-logo-container">
                    <div class="wpts-logo-square">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png" alt="SalesNanny Logo" class="wpts-logo-image">
                </div>
                </div>
                
                <h2 class="wpts-confirmation-title"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="none">
  <circle cx="12" cy="12" r="11" stroke="#16A34A" stroke-width="2"/>
  <path d="M7 12.5l3.5 3.5L17 8" stroke="#16A34A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
 Booking Confirmed</h2>
                <p class="wpts-confirmation-subtitle">Thank you for scheduling a meeting with SalesNanny!</p>
                
                <div class="wpts-meeting-details-card">
                    <div class="wpts-meeting-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 012.25 2.25v7.5"></path></svg>
                        <span id="wpts-confirmation-date">July 20, 2025</span>
                        </div>
                    <div class="wpts-meeting-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        <span id="wpts-confirmation-time">4:00 PM - 5:00 PM (UTC)</span>
                        </div>
                    <div class="wpts-meeting-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                        <a href="#" class="wpts-meeting-link">Meeting link will be provided</a>
                    </div>
                </div>
                
                <div class="wpts-next-steps">
                    <h4>Next Steps:</h4>
                    <p>You'll receive an email confirmation shortly with all the details.</p>
                    </div>
                
                <div class="wpts-contact-info">
                    <h4>Contact Information:</h4>
                    <p>Need to reschedule or have questions? Contact us at <a href="mailto:support@salesnanny.com">support@salesnanny.com</a> or call <a href="tel:+918122346800">+91 8122346800</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /**
 * Timezone Detection and Auto-Selection
 * Automatically detects user's timezone and updates the selector
 */

(function() {
    'use strict';

    // Timezone mapping with user-friendly names
    const timezoneMapping = {
        'America/New_York': 'Eastern Time (US & Canada)',
        'America/Chicago': 'Central Time (US & Canada)',
        'America/Denver': 'Mountain Time (US & Canada)',
        'America/Los_Angeles': 'Pacific Time (US & Canada)',
        'America/Anchorage': 'Alaska Time (US)',
        'Pacific/Honolulu': 'Hawaii Time (US)',
        'America/Toronto': 'Eastern Time (Canada)',
        'America/Vancouver': 'Pacific Time (Canada)',
        'Europe/London': 'Greenwich Mean Time (UK)',
        'Europe/Paris': 'Central European Time (France)',
        'Europe/Berlin': 'Central European Time (Germany)',
        'Europe/Rome': 'Central European Time (Italy)',
        'Europe/Madrid': 'Central European Time (Spain)',
        'Europe/Amsterdam': 'Central European Time (Netherlands)',
        'Europe/Stockholm': 'Central European Time (Sweden)',
        'Europe/Oslo': 'Central European Time (Norway)',
        'Europe/Copenhagen': 'Central European Time (Denmark)',
        'Europe/Helsinki': 'Eastern European Time (Finland)',
        'Europe/Moscow': 'Moscow Time (Russia)',
        'Asia/Dubai': 'Gulf Standard Time (UAE)',
        'Asia/Kolkata': 'India Standard Time (India)',
        'Asia/Calcutta': 'India Standard Time (Calcutta)',
        'Asia/Dhaka': 'Bangladesh Standard Time (Bangladesh)',
        'Asia/Karachi': 'Pakistan Standard Time (Pakistan)',
        'Asia/Kathmandu': 'Nepal Time (Nepal)',
        'Asia/Colombo': 'Sri Lanka Time (Sri Lanka)',
        'Asia/Bangkok': 'Indochina Time (Thailand)',
        'Asia/Ho_Chi_Minh': 'Indochina Time (Vietnam)',
        'Asia/Singapore': 'Singapore Time (Singapore)',
        'Asia/Kuala_Lumpur': 'Malaysia Time (Malaysia)',
        'Asia/Manila': 'Philippines Time (Philippines)',
        'Asia/Jakarta': 'Western Indonesia Time (Indonesia)',
        'Asia/Shanghai': 'China Standard Time (China)',
        'Asia/Hong_Kong': 'Hong Kong Time (Hong Kong)',
        'Asia/Taipei': 'Taiwan Time (Taiwan)',
        'Asia/Seoul': 'Korea Standard Time (South Korea)',
        'Asia/Tokyo': 'Japan Standard Time (Japan)',
        'Australia/Sydney': 'Australian Eastern Time (Sydney)',
        'Australia/Melbourne': 'Australian Eastern Time (Melbourne)',
        'Australia/Brisbane': 'Australian Eastern Time (Brisbane)',
        'Australia/Perth': 'Australian Western Time (Perth)',
        'Australia/Adelaide': 'Australian Central Time (Adelaide)',
        'Pacific/Auckland': 'New Zealand Time (New Zealand)',
        'Pacific/Fiji': 'Fiji Time (Fiji)',
        'Africa/Cairo': 'Eastern European Time (Egypt)',
        'Africa/Johannesburg': 'South Africa Time (South Africa)',
        'Africa/Lagos': 'West Africa Time (Nigeria)',
        'Africa/Nairobi': 'East Africa Time (Kenya)',
        'America/Mexico_City': 'Central Time (Mexico)',
        'America/Sao_Paulo': 'Brasília Time (Brazil)',
        'America/Buenos_Aires': 'Argentina Time (Argentina)',
        'America/Lima': 'Peru Time (Peru)',
        'America/Bogota': 'Colombia Time (Colombia)',
        'America/Caracas': 'Venezuela Time (Venezuela)',
        'Atlantic/Reykjavik': 'Greenwich Mean Time (Iceland)',
        'UTC': 'Coordinated Universal Time (UTC)'
    };

    /**
     * Detect user's timezone using JavaScript Intl API
     */
    function detectUserTimezone() {
        try {
            // Use Intl.DateTimeFormat to get the user's timezone
            const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            console.log('Detected timezone:', timezone);
            return timezone;
        } catch (error) {
            console.warn('Could not detect timezone:', error);
            // Fallback to UTC if detection fails
            return 'UTC';
        }
    }

    /**
     * Get current time in the specified timezone
     */
    function getCurrentTimeInTimezone(timezone) {
        try {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-GB', {
                timeZone: timezone,
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            return timeString;
        } catch (error) {
            console.warn('Could not get time for timezone:', timezone, error);
            return '';
        }
    }

    /**
     * Update the timezone selector with the detected timezone
     */
    function updateTimezoneSelector(detectedTimezone) {
        const selector = document.getElementById('wpts-timezone-selector');
        const display = document.getElementById('wpts-current-timezone-display');
        
        if (!selector) {
            console.warn('Timezone selector not found');
            return;
        }

        // Check if the detected timezone exists in our options
        const option = selector.querySelector(`option[value="${detectedTimezone}"]`);
        
        if (option) {
            // Set the detected timezone as selected
            selector.value = detectedTimezone;
            
            // Update the display text
            if (display) {
                const timezoneName = timezoneMapping[detectedTimezone] || detectedTimezone;
                const currentTime = getCurrentTimeInTimezone(detectedTimezone);
                display.textContent = `${timezoneName} (${currentTime})`;
            }
            
            console.log('Timezone automatically set to:', detectedTimezone);
        } else {
            console.warn('Detected timezone not found in options:', detectedTimezone);
            // Try to find a close match or fallback
            findClosestTimezone(detectedTimezone);
        }
    }

    /**
     * Find the closest timezone match if exact match not found
     */
    function findClosestTimezone(detectedTimezone) {
        const selector = document.getElementById('wpts-timezone-selector');
        
        // Special handling for common timezone aliases
        const aliases = {
            'Asia/Calcutta': 'Asia/Kolkata',
            'US/Eastern': 'America/New_York',
            'US/Central': 'America/Chicago',
            'US/Mountain': 'America/Denver',
            'US/Pacific': 'America/Los_Angeles'
        };
        
        if (aliases[detectedTimezone]) {
            selector.value = aliases[detectedTimezone];
            updateTimezoneDisplay(aliases[detectedTimezone]);
            console.log('Using alias timezone:', aliases[detectedTimezone], 'for', detectedTimezone);
            return;
        }
        
        // Try to find by region (e.g., if Asia/Calcutta detected, use Asia/Kolkata)
        const region = detectedTimezone.split('/')[0];
        const fallbackOptions = Array.from(selector.options).filter(option => 
            option.value.startsWith(region + '/')
        );
        
        if (fallbackOptions.length > 0) {
            const fallbackTimezone = fallbackOptions[0].value;
            selector.value = fallbackTimezone;
            updateTimezoneDisplay(fallbackTimezone);
            console.log('Using fallback timezone:', fallbackTimezone);
        } else {
            // Final fallback based on UTC offset
            setTimezoneByOffset();
        }
    }

    /**
     * Set timezone based on UTC offset as final fallback
     */
    function setTimezoneByOffset() {
        const now = new Date();
        const offsetMinutes = now.getTimezoneOffset();
        const offsetHours = -offsetMinutes / 60;
        
        // Common timezone mappings by UTC offset
        const offsetTimezones = {
            '-12': 'Pacific/Fiji',
            '-11': 'Pacific/Honolulu',
            '-10': 'Pacific/Honolulu',
            '-9': 'America/Anchorage',
            '-8': 'America/Los_Angeles',
            '-7': 'America/Denver',
            '-6': 'America/Chicago',
            '-5': 'America/New_York',
            '-4': 'America/Caracas',
            '-3': 'America/Sao_Paulo',
            '-2': 'Atlantic/Reykjavik',
            '-1': 'Atlantic/Reykjavik',
            '0': 'Europe/London',
            '1': 'Europe/Paris',
            '2': 'Europe/Berlin',
            '3': 'Europe/Moscow',
            '4': 'Asia/Dubai',
            '5': 'Asia/Karachi',
            '5.5': 'Asia/Kolkata',
            '6': 'Asia/Dhaka',
            '7': 'Asia/Bangkok',
            '8': 'Asia/Singapore',
            '9': 'Asia/Tokyo',
            '10': 'Australia/Sydney',
            '11': 'Pacific/Fiji',
            '12': 'Pacific/Auckland'
        };
        
        const fallbackTimezone = offsetTimezones[offsetHours.toString()] || 'UTC';
        const selector = document.getElementById('wpts-timezone-selector');
        
        if (selector) {
            selector.value = fallbackTimezone;
            updateTimezoneDisplay(fallbackTimezone);
            console.log('Using offset-based fallback timezone:', fallbackTimezone, 'for offset:', offsetHours);
        }
    }

    /**
     * Update the timezone display text
     */
    function updateTimezoneDisplay(timezone) {
        const display = document.getElementById('wpts-current-timezone-display');
        const calendarDisplay = document.getElementById('wpts-calendar-timezone-display');
        
        if (display) {
            const timezoneName = timezoneMapping[timezone] || timezone;
            const currentTime = getCurrentTimeInTimezone(timezone);
            display.textContent = `${timezoneName} (${currentTime})`;
        }
        
        if (calendarDisplay) {
            const timezoneName = timezoneMapping[timezone] || timezone;
            const currentTime = getCurrentTimeInTimezone(timezone);
            calendarDisplay.textContent = `${timezoneName} (${currentTime})`;
        }
    }

    /**
     * Update time display every minute
     */
    function startTimeUpdater() {
        setInterval(() => {
            const selector = document.getElementById('wpts-timezone-selector');
            if (selector && selector.value) {
                updateTimezoneDisplay(selector.value);
            }
        }, 60000); // Update every minute
    }

    /**
     * Initialize timezone detection when DOM is ready
     */
    function initializeTimezoneDetection() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(autoDetectTimezone, 50);
            });
        } else {
            // Run immediately if DOM is already loaded
            autoDetectTimezone();
        }
    }

    /**
     * Main function to auto-detect and set timezone
     */
    function autoDetectTimezone() {
        console.log('Initializing timezone auto-detection...');
        
        const detectedTimezone = detectUserTimezone();
        console.log('Detected timezone:', detectedTimezone);
        
        updateTimezoneSelector(detectedTimezone);
        
        // Start the time updater
        startTimeUpdater();
        
        // Add event listener for manual timezone changes
        const selector = document.getElementById('wpts-timezone-selector');
        if (selector) {
            selector.addEventListener('change', function() {
                updateTimezoneDisplay(this.value);
                console.log('Timezone manually changed to:', this.value);
            });
        }
        
        // Log final selected timezone
        console.log('Final selected timezone:', selector ? selector.value : 'selector not found');
    }

    // Initialize when script loads
    initializeTimezoneDetection();

    // Export functions for external use
    window.WPTSTimezone = {
        detectUserTimezone: detectUserTimezone,
        updateTimezoneSelector: updateTimezoneSelector,
        getCurrentTimeInTimezone: getCurrentTimeInTimezone
    };

})(); </script>
<style>
    /* =========================================
 *  WP Teams Scheduler - Modern Premium UI
 * ========================================= */

/* Global Setup */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

html {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background-color: #f0f0f0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-image: url('<?php echo get_template_directory_uri(); ?>/assets/meetingbg.webp');
}

:root {
    --wpts-color-primary: #0069ff;
    --wpts-color-primary-dark: #0041a8;
    --wpts-color-primary-light: #e6f2ff;
    --wpts-text-dark: #1a1a1a;
    --wpts-text-medium: #4b5563;
    --wpts-text-light: #9ca3af;
    --wpts-border-color: #e5e7eb;
    --wpts-radius: 14px;
    --wpts-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    --wpts-shadow-hover: 0 12px 28px rgba(0, 105, 255, 0.18);
}

/* Scheduler Container */
#wpts-scheduler {
    max-width: 940px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(14px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.25);
    box-shadow: var(--wpts-shadow);
    display: grid;
    grid-template-columns: 380px 1fr;
    overflow: hidden;
}

/* Info Panel */
#wpts-info-panel {
    background: linear-gradient(180deg, #f9fafb, #f1f5f9);
    border-right: 1px solid var(--wpts-border-color);
    padding: 40px 32px;
    display: flex;
    flex-direction: column;
}

/* Logo */
.wpts-logo-container img {
    border-radius: var(--wpts-radius);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
}
.wpts-logo-container img:hover {
    transform: scale(1.05);
}

/* Step Panels */
.wpts-step {
    padding: 40px 48px;
    display: none;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: opacity 0.4s ease, transform 0.4s ease;
}
.wpts-step.wpts-active {
    display: block;
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    animation: fadeSlideUp 0.45s ease;
}
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Titles */
.wpts-step-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 32px;
    text-align: center;
    color: var(--wpts-text-dark);
}

/* Event Cards */
.wpts-event-card {
    background: linear-gradient(145deg, #ffffff, #f4f7fb);
    border: 1px solid var(--wpts-border-color);
    border-radius: var(--wpts-radius);
    padding: 28px;
    transition: all 0.3s ease;
    box-shadow: var(--wpts-shadow);
}
.wpts-event-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--wpts-shadow-hover);
    border-color: var(--wpts-color-primary);
}
.wpts-event-card h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 6px;
    color: var(--wpts-text-dark);
}
.wpts-event-card p {
    color: var(--wpts-text-light);
}

/* Calendar */
.wpts-day {
    height: 38px;
    width: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s ease;
}
.wpts-day.wpts-available:hover {
    background: var(--wpts-color-primary-light);
    color: var(--wpts-color-primary);
    transform: scale(1.1);
}
.wpts-day.wpts-selected {
    background: var(--wpts-color-primary);
    color: #fff;
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(0, 105, 255, 0.3);
}

/* Time Slots */
.wpts-time-slot {
    border-radius: 999px; /* pill style */
    padding: 10px 18px;
    border: 2px solid var(--wpts-color-primary);
    color: var(--wpts-color-primary);
    background: #fff;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.wpts-time-slot:hover {
    background: var(--wpts-color-primary);
    color: #fff;
    transform: scale(1.05);
}

/* Form */
.wpts-form-group input,
.wpts-form-group textarea {
    border-radius: var(--wpts-radius);
    border: 1px solid var(--wpts-border-color);
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.25s ease;
}
.wpts-form-group input:focus,
.wpts-form-group textarea:focus {
    border-color: var(--wpts-color-primary);
    box-shadow: 0 0 0 4px var(--wpts-color-primary-light);
}

/* Primary Button */
.wpts-button {
    border-radius: var(--wpts-radius);
    padding: 16px 24px;
    font-size: 16px;
    font-weight: 600;
    background: linear-gradient(135deg, #0069ff, #0041a8);
    color: #fff;
    transition: all 0.3s ease;
}
.wpts-button:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: var(--wpts-shadow-hover);
}

/* Confirmation */
.wpts-confirmation-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--wpts-text-dark);
}
.wpts-confirmation-subtitle {
    font-size: 16px;
    color: var(--wpts-text-medium);
}
.wpts-meeting-details-card {
    background: #f9fafb;
    border-radius: var(--wpts-radius);
    padding: 24px;
    box-shadow: var(--wpts-shadow);
}
</style>