jQuery(document).ready(function($) {
    const scheduler = $('#wpts-scheduler');
    if (!scheduler.length) return;

    let state = {
        currentStep: 'wpts-step-1-event-type',
        selectedEvent: {
            id: null,
            title: '',
            duration: 0,
        },
        selectedSlot: {
            timestamp: null,
            label: '',
            date: '',
        },
        currentDate: new Date(),
        userTimezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
    };

    // Initialize timezone selector with detected timezone
    function initializeTimezoneSelector() {
        const selector = $('#wpts-timezone-selector');
        const detectedTimezone = state.userTimezone;
        
        // Try to select the detected timezone
        if (selector.find(`option[value="${detectedTimezone}"]`).length > 0) {
            selector.val(detectedTimezone);
        } else {
            // Fallback to a reasonable default based on detected timezone
            const timezoneMap = {
                'America/New_York': 'America/New_York',
                'America/Chicago': 'America/Chicago',
                'America/Denver': 'America/Denver',
                'America/Los_Angeles': 'America/Los_Angeles',
                'Europe/London': 'Europe/London',
                'Europe/Paris': 'Europe/Paris',
                'Asia/Tokyo': 'Asia/Tokyo',
                'Asia/Seoul': 'Asia/Seoul',
                'Asia/Shanghai': 'Asia/Shanghai',
                'Asia/Kolkata': 'Asia/Kolkata',
                'Australia/Sydney': 'Australia/Sydney',
            };
            
            // Find closest match
            for (const [key, value] of Object.entries(timezoneMap)) {
                if (detectedTimezone.includes(key.split('/')[1]) || detectedTimezone.includes(key.split('/')[0])) {
                    selector.val(value);
                    break;
                }
            }
        }
        
        // Set initial state
        state.userTimezone = selector.val();
    }

    // --- Timezone Functions ---
    function updateTimezoneDisplay() {
        const now = new Date();
        const timeString = now.toLocaleString('en-GB', {
            timeZone: state.userTimezone,
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });
        
        const timezoneName = now.toLocaleString('en-US', {
            timeZone: state.userTimezone,
            timeZoneName: 'long'
        }).split(', ')[1];
        
        const timezoneDisplay = `${timezoneName} (${timeString})`;
        
        // Update calendar timezone display
        $('.wpts-timezone-display span').html(`<strong>Time zone</strong><br>${timezoneDisplay}`);
        
        // Update info panel timezone display
        $('#wpts-current-timezone-display').text(timezoneDisplay);
    }

    // Load time slots for a specific date
    function loadTimeSlots(selectedDate, eventId) {
        $('#wpts-time-slots').html('<div class="wpts-spinner"></div>');
        
        $.post(wpts_ajax.ajax_url, {
            action: 'wpts_get_available_slots',
            nonce: wpts_ajax.nonce,
            date: selectedDate,
            event_id: eventId,
            user_timezone: state.userTimezone
        }).done(function(response) {
            const slotsContainer = $('#wpts-time-slots');
            slotsContainer.html('');
            const responseData = response.data || {};
            const timezoneLabel = getTimezoneDisplayName(state.userTimezone);
            const timezoneFullName = state.userTimezone ? state.userTimezone.replace(/_/g, ' ') : '';
            const timezoneDescriptor = timezoneFullName
                ? (timezoneLabel ? `${timezoneLabel} (${timezoneFullName})` : timezoneFullName)
                : (timezoneLabel || 'your timezone');
            const serverCurrentDate = responseData.current_host_time ? new Date(responseData.current_host_time * 1000) : null;
            const userCurrentDisplay = serverCurrentDate ? serverCurrentDate.toLocaleString('en-GB', {
                timeZone: state.userTimezone,
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }) : '';
            const cutoffText = userCurrentDisplay ? `${userCurrentDisplay} ${timezoneDescriptor}` : 'the current time';

            if (response.success && responseData.slots && responseData.slots.length > 0) {
                // Show timezone conversion info
                showTimezoneConversion(responseData.host_timezone, responseData.availability_range);
                
                responseData.slots.forEach(slot => {
                    // Display time in user's timezone (Calendly style)
                    const slotTime = new Date(slot.value * 1000);
                    const displayTime = slotTime.toLocaleString('en-GB', {
                        timeZone: state.userTimezone,
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    slotsContainer.append(`<button class="wpts-time-slot" data-timestamp="${slot.value}">${displayTime}</button>`);
                });
            } else {
                if (response.success && responseData.no_future_slots) {
                    slotsContainer.html(`<p class="no-slots-msg">We're fully booked for the rest of today after <strong>${cutoffText}</strong>. Please choose another date.</p>`);
                    return;
                }

                // Check if it's a weekend (Saturday or Sunday)
                const selectedDateObj = new Date(selectedDate + 'T00:00:00');
                const dayOfWeek = selectedDateObj.getDay(); // 0 = Sunday, 6 = Saturday
                
                if (dayOfWeek === 0 || dayOfWeek === 6) {
                    // Weekend message
                    slotsContainer.html('<p class="no-slots-msg">We’re off on weekends! For any urgent queries, please reach out to us at <a href="mailto:support@salesnanny.com">support@salesnanny.com</a>.</p>');
                } else {
                    // Fully booked message for weekdays
                    slotsContainer.html('<p class="no-slots-msg">Sorry, all slots are booked for this day. For any Urgent queries, please reach us at <a href="mailto:support@salesnanny.com">support@salesnanny.com</a>.</p>');
                }
            }
        }).fail(function() {
            $('#wpts-time-slots').html('<p class="wpts-time-placeholder">Error loading time slots. Please try again.</p>');
        });
    }

    // Show timezone conversion info (Calendly style)
    function showTimezoneConversion(hostTimezone, availabilityRange) {
        if (hostTimezone && availabilityRange) {
            const conversionDiv = $('#wpts-timezone-conversion');
            const hostDisplay = $('#wpts-host-time-display');
            
            // Format host availability range
            const hostStart = new Date(availabilityRange.start * 1000);
            const hostEnd = new Date(availabilityRange.end * 1000);
            
            const hostStartTime = hostStart.toLocaleString('en-GB', {
                timeZone: hostTimezone,
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            
            const hostEndTime = hostEnd.toLocaleString('en-GB', {
                timeZone: hostTimezone,
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
            
            const hostTimezoneName = getTimezoneDisplayName(hostTimezone);
            const userTimezoneName = getTimezoneDisplayName(state.userTimezone);
            
            hostDisplay.text(`${hostStartTime}-${hostEndTime} ${hostTimezoneName}`);
            conversionDiv.show();
        }
    }

    // Get user-friendly timezone display name
    function getTimezoneDisplayName(timezone) {
        const timezoneNames = {
            'America/New_York': 'EST',
            'America/Chicago': 'CST',
            'America/Denver': 'MST',
            'America/Los_Angeles': 'PST',
            'Europe/London': 'GMT',
            'Europe/Paris': 'CET',
            'Asia/Kolkata': 'IST',
            'Asia/Dubai': 'GST',
            'Asia/Tokyo': 'JST',
            'Australia/Sydney': 'AEST'
        };
        
        return timezoneNames[timezone] || timezone.split('/').pop().replace('_', ' ');
    }

    // Handle timezone selector change
    function handleTimezoneChange() {
        $('#wpts-timezone-selector').on('change', function() {
            state.userTimezone = $(this).val();
            updateTimezoneDisplay();
            
            // Refresh time slots if a date is selected
            const selectedDate = $('.wpts-day.wpts-selected').data('date');
            if (selectedDate && state.selectedEvent.id) {
                loadTimeSlots(selectedDate, state.selectedEvent.id);
            }
        });
    }

    // --- Core Functions ---
    function showStep(nextStep) {
        const currentStepEl = $(`#${state.currentStep}`);
        const nextStepEl = $(`#${nextStep}`);

        if (currentStepEl.length && window.matchMedia("(min-width: 1025px)").matches) {
            currentStepEl.addClass('is-exiting');
            setTimeout(() => {
                currentStepEl.removeClass('wpts-active is-exiting');
                nextStepEl.addClass('wpts-active');
                updateBackButton();
                updateConfirmationLayout(nextStep);
            }, 300);
        } else {
            $('.wpts-step').removeClass('wpts-active');
            nextStepEl.addClass('wpts-active');
            updateBackButton();
            updateConfirmationLayout(nextStep);
        }
        state.currentStep = nextStep;
    }

    function updateConfirmationLayout(step) {
        const infoPanel = $('#wpts-info-panel');
        const mainPanel = $('#wpts-main-panel');
        const scheduler = $('#wpts-scheduler');
        const isDesktop = window.innerWidth > 1024;
        const isMobile = window.innerWidth <= 768;
        
        if (step === 'wpts-step-4-confirmation') {
            // Hide info panel and modify main panel for confirmation
            infoPanel.hide();
            mainPanel.css({
                'position': 'static',
                'background-color': '#ffffff',
                // 'height': isMobile ? 'auto' : '650px',
                'min-height': isMobile ? '500px' : 'auto',
                'overflow': 'visible',
                'padding': isMobile ? '0' : '40px 48px'
            });
            scheduler.css('grid-template-columns', '1fr');
        } else {
            // Restore normal layout for other steps
            infoPanel.show();
            mainPanel.css({
                'position': 'relative',
                'background-color': '#ffffff',
                'height': 'auto',
                'min-height': 'auto',
                'overflow': 'visible',
                'padding': ''
            });
            // Only apply 2-column grid on desktop
            if (isDesktop) {
                scheduler.css('grid-template-columns', '380px 1fr');
            } else {
                scheduler.css('grid-template-columns', '1fr');
            }
        }
    }

    function updateBackButton() {
        const backButton = $('#wpts-back-button');
        if (state.currentStep === 'wpts-step-1-event-type') {
            backButton.hide();
        } else {
            backButton.show();
        }
    }

    function updateInfoPanel() {
        if (state.selectedEvent.id) {
            $('#wpts-info-panel h2').text(state.selectedEvent.title);
            $('#wpts-info-duration').text(`${state.selectedEvent.duration} min`);
        }
        
        if (state.selectedSlot.timestamp) {
            const selectedDateTime = new Date(state.selectedSlot.timestamp * 1000);
            const timeDisplay = selectedDateTime.toLocaleString('en-US', {
                timeZone: state.userTimezone,
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            $('#wpts-selected-time-display').text(timeDisplay);
            $('#wpts-selected-time-info').show();
        } else {
            $('#wpts-selected-time-info').hide();
        }
    }

    function renderCalendar() {
        const date = state.currentDate;
        const month = date.getMonth();
        const year = date.getFullYear();
        $('#wpts-month-year').text(date.toLocaleString('default', { month: 'long', year: 'numeric' }));

        const firstDayOfMonth = new Date(year, month, 1);
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // --- FIX STARTS HERE ---
        // Get the JS day index (0 for Sunday, 1 for Monday, etc.)
        const startDayIndex = firstDayOfMonth.getDay(); 
        
        // Adjust for a week starting on Monday.
        // If Sunday (0), we need 6 padding days. Otherwise, it's index - 1.
        const paddingDays = (startDayIndex === 0) ? 6 : startDayIndex - 1;
        // --- FIX ENDS HERE ---

        const grid = $('#wpts-calendar-grid');
        grid.html('');
        
        // Add day names
        const dayNames = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];
        dayNames.forEach(name => grid.append(`<div class="wpts-day-name">${name}</div>`));

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < paddingDays; i++) { 
            grid.append('<div class="wpts-day wpts-other-month"></div>'); 
        }
        
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // --- India Holidays (IST) ---
        // Single-day or ranges inclusive in YYYY-MM-DD format
        const indiaHolidays = {
            // 2025 Holidays
            '2025-01-01': 'New Year\'s Day',
            '2025-01-13': 'Additional Holiday for Pongal',
            '2025-01-14..2025-01-15': 'Pongal',
            '2025-03-31': 'Ramzan',
            '2025-04-14': 'Tamil New Year',
            '2025-04-18': 'Good Friday',
            '2025-05-01': 'May Day',
            '2025-08-15': 'Independence Day',
            '2025-10-01': 'Ayudha Pooja',
            '2025-10-02': 'Gandhi Jayanthi & Vijaya Dasami',
            '2025-10-20': 'Deepavali',
            '2025-12-25': 'Christmas',
            '2025-12-31': 'New Year\'s Day',
            
            // 2026 Holidays
            '2026-01-01': 'New Year\'s Day',
            '2026-01-15': 'Pongal',
            '2026-01-16': 'Thiruvalluvar Day',
            '2026-01-26': 'Republic Day',
            '2026-04-03': 'Good Friday',
            '2026-04-14': 'Tamil New Year',
            '2026-05-01': 'May Day',
            '2026-05-28': 'Bakrid',
            '2026-10-02': 'Gandhi Jayanthi',
            '2026-10-19': 'Aaayudha Pooja',
            '2026-10-20': 'Vijaya Dasami',
            '2026-12-25': 'Christmas'
        };

        function isHolidayIST(y, m, d) {
            // Create date in IST to avoid UTC offset issues
            const istDate = new Date(Date.UTC(y, m, d));
            const yyyy = istDate.getUTCFullYear();
            const mm = String(istDate.getUTCMonth() + 1).padStart(2, '0');
            const dd = String(istDate.getUTCDate()).padStart(2, '0');
            const key = `${yyyy}-${mm}-${dd}`;

            if (indiaHolidays[key]) {
                return indiaHolidays[key];
            }

            // Check ranges like 2025-01-14..2025-01-15
            for (const rangeKey in indiaHolidays) {
                if (rangeKey.includes('..')) {
                    const [start, end] = rangeKey.split('..');
                    if (key >= start && key <= end) {
                        return indiaHolidays[rangeKey];
                    }
                }
            }
            return null;
        }

        // Add days of the month
        for (let i = 1; i <= daysInMonth; i++) {
            const dayDate = new Date(year, month, i);
            dayDate.setHours(0, 0, 0, 0);
            
            let classes = 'wpts-day';
            if (dayDate < today) {
                classes += ' wpts-disabled';
            } else {
                classes += ' wpts-available';
            }
            
            const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const holidayName = isHolidayIST(year, month, i);

            let tooltipAttr = '';
            if (holidayName) {
                // Ensure holidays are not selectable: remove available, force disabled
                classes = classes.replace(' wpts-available', '');
                if (!classes.includes('wpts-disabled')) {
                    classes += ' wpts-disabled';
                }
                classes += ' wpts-holiday';
                tooltipAttr = ` data-holiday="${holidayName}" title="${holidayName}"`;
            }

            grid.append(`<div class="${classes}" data-date="${dateString}"${tooltipAttr}>${i}</div>`);
        }

        // Update navigation buttons
        const prevBtn = $('#wpts-prev-month');
        const nextBtn = $('#wpts-next-month');
        
        const currentMonth = new Date(year, month, 1);
        const thisMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        
        if (currentMonth <= thisMonth) {
            prevBtn.prop('disabled', true);
        } else {
            prevBtn.prop('disabled', false);
        }
    }

    function getPreviousStep() {
        switch(state.currentStep) {
            case 'wpts-step-2-datetime':
                return 'wpts-step-1-event-type';
            case 'wpts-step-3-details':
                return 'wpts-step-2-datetime';
            default:
                return 'wpts-step-1-event-type';
        }
    }

    // --- Event Handlers ---
    
    // Back button handler
    $('#wpts-back-button').on('click', function() {
        const previousStep = getPreviousStep();
        showStep(previousStep);
        
        // Reset state based on step
        if (previousStep === 'wpts-step-1-event-type') {
            state.selectedEvent = { id: null, title: '', duration: 0 };
            state.selectedSlot = { timestamp: null, label: '', date: '' };
            $('#wpts-info-panel h2').text('Meeting');
            $('#wpts-info-duration').text('Select an event');
            $('#wpts-selected-time-info').hide();
        } else if (previousStep === 'wpts-step-2-datetime') {
            state.selectedSlot = { timestamp: null, label: '', date: '' };
            $('#wpts-selected-time-info').hide();
        }
    });

    // Event type selection
    $('.wpts-event-card').on('click', function() {
        state.selectedEvent.id = $(this).data('event-id');
        state.selectedEvent.title = $(this).find('h3').text();
        state.selectedEvent.duration = $(this).data('duration');
        updateInfoPanel();
        renderCalendar();
        showStep('wpts-step-2-datetime');
    });

    // Month navigation
    $('#wpts-prev-month, #wpts-next-month').on('click', function() {
        const direction = $(this).attr('id') === 'wpts-prev-month' ? -1 : 1;
        state.currentDate.setMonth(state.currentDate.getMonth() + direction);
        renderCalendar();
        $('#wpts-time-slots').html('<p class="wpts-time-placeholder">Select a date to see available times.</p>');
    });

    // Date selection
    scheduler.on('click', '.wpts-day.wpts-available', function() {
        const selectedDate = $(this).data('date');
        $('.wpts-day').removeClass('wpts-selected');
        $(this).addClass('wpts-selected');
        
        // Store selected date for timezone changes
        state.selectedSlot.date = selectedDate;
        
        // Load time slots using the centralized function
        loadTimeSlots(selectedDate, state.selectedEvent.id);
    });

    // Time slot selection
    scheduler.on('click', '.wpts-time-slot', function() {
        state.selectedSlot.timestamp = $(this).data('timestamp');
        state.selectedSlot.label = $(this).text();
        $('#wpts-selected-event-id').val(state.selectedEvent.id);
        $('#wpts-selected-slot-timestamp').val(state.selectedSlot.timestamp);
        updateInfoPanel();
        showStep('wpts-step-3-details');
    });

    // File upload preview
    $('#wpts-documents').on('change', function() {
        const fileList = $('#wpts-file-list');
        fileList.empty();
        
        if (this.files.length > 0) {
            let totalSize = 0;
            const fileNames = [];
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                totalSize += file.size;
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                fileNames.push(`${file.name} (${fileSizeMB}MB)`);
            }
            
            fileList.html(`<strong>Selected files:</strong><br>${fileNames.join('<br>')}`);
            
            if (totalSize > 10485760 * this.files.length) {
                fileList.append('<br><span style="color: #dc2626;">⚠️ Some files exceed 10MB limit</span>');
            }
        }
    });

    // Form submission
    $('#wpts-booking-form').on('submit', function(e) {
        e.preventDefault();
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.text();
        
        submitBtn.prop('disabled', true).text('Scheduling...');
        $('#wpts-loader').removeClass('wpts-hidden');
        
        // Create FormData object to handle file uploads
        const formData = new FormData(this);
        formData.append('action', 'wpts_handle_booking');
        formData.append('nonce', wpts_ajax.nonce);
        formData.append('user_timezone', state.userTimezone);
        
        // Debug: Check if files are in FormData
        const fileInput = document.getElementById('wpts-documents');
        if (fileInput && fileInput.files.length > 0) {
            console.log('📎 Files selected:', fileInput.files.length);
            for (let i = 0; i < fileInput.files.length; i++) {
                console.log('  File ' + (i+1) + ':', fileInput.files[i].name, '(' + fileInput.files[i].size + ' bytes)');
            }
        } else {
            console.log('📎 No files selected');
        }
        
        // Debug: Log FormData contents
        console.log('📤 FormData contents:');
        for (let pair of formData.entries()) {
            if (pair[1] instanceof File) {
                console.log('  ' + pair[0] + ':', pair[1].name);
            } else {
                console.log('  ' + pair[0] + ':', pair[1]);
            }
        }
        
        // Add guest emails to form data (remove duplicates)
        const guestEmails = [];
        $('.wpts-guest-email').each(function() {
            const email = $(this).val().trim();
            if (email && email !== '' && !guestEmails.includes(email)) {
                guestEmails.push(email);
                formData.append('guest_emails[]', email);
            }
        });
        
        $.ajax({
            url: wpts_ajax.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#wpts-loader').addClass('wpts-hidden');
                if (response.success) {
                    // Update confirmation screen with booking details
                    $('#wpts-confirmation-message').text(response.data.message);
                    $('#wpts-confirmation-event-title').text(state.selectedEvent.title);
                    
                    // Format the selected time for confirmation
                    const selectedDateTime = new Date(state.selectedSlot.timestamp * 1000);
                    const confirmationTime = selectedDateTime.toLocaleString('en-GB', {
                        timeZone: state.userTimezone,
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    }) + ' - ';
                    
                    const endDateTime = new Date(state.selectedSlot.timestamp * 1000 + (state.selectedEvent.duration * 60 * 1000));
                    const endTime = endDateTime.toLocaleString('en-GB', {
                        timeZone: state.userTimezone,
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });
                    
                    const fullDate = selectedDateTime.toLocaleString('en-US', {
                        timeZone: state.userTimezone,
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    // Update date and time displays
                    $('#wpts-confirmation-date').text(selectedDateTime.toLocaleDateString('en-US', {
                        timeZone: state.userTimezone,
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }));
                    
                    $('#wpts-confirmation-time').text(`${confirmationTime}${endTime} (${getTimezoneDisplayName(state.userTimezone)})`);
                    
                    // Update meeting link if available
                    if (response.data.meeting_link) {
                        const meetingLinkElement = $('.wpts-meeting-link');
                        meetingLinkElement.attr('href', response.data.meeting_link);
                        meetingLinkElement.text(response.data.meeting_link);
                    }
                    
                    showStep('wpts-step-4-confirmation');
                } else {
                    alert('Error: ' + response.data.message);
                    submitBtn.prop('disabled', false).text(originalText);
                }
            },
            error: function() {
                $('#wpts-loader').addClass('wpts-hidden');
                alert('Error: Something went wrong. Please try again.');
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    // Guest functionality
    $('.wpts-add-guests-btn').on('click', function() {
        const guestsSection = $('.wpts-guests-section');
        const button = $(this);
        
        if (guestsSection.is(':visible')) {
            guestsSection.slideUp(200);
            button.text('Add Guests');
        } else {
            guestsSection.slideDown(200);
            button.text('Remove Guests');
        }
    });

    // Add more guest input fields
    $('.wpts-add-more-guests-btn').on('click', function() {
        const guestsList = $('.wpts-guests-list');
        const newGuestGroup = $(`
            <div class="wpts-guest-input-group">
                <input type="email" name="guest_emails[]" class="wpts-guest-email" placeholder="guest@example.com">
                <button type="button" class="wpts-remove-guest-btn">×</button>
            </div>
        `);
        
        guestsList.append(newGuestGroup);
        updateRemoveButtons();
    });

    // Remove guest input fields
    $(document).on('click', '.wpts-remove-guest-btn', function() {
        const guestGroup = $(this).closest('.wpts-guest-input-group');
        const guestsList = $('.wpts-guests-list');
        
        guestGroup.remove();
        updateRemoveButtons();
        
        // Hide section if no guests left
        if (guestsList.find('.wpts-guest-input-group').length === 0) {
            $('.wpts-guests-section').slideUp(200);
            $('.wpts-add-guests-btn').text('Add Guests');
        }
    });

    function updateRemoveButtons() {
        const guestGroups = $('.wpts-guest-input-group');
        const removeButtons = $('.wpts-remove-guest-btn');
        
        // Show remove button only if there's more than one guest input
        if (guestGroups.length > 1) {
            removeButtons.show();
        } else {
            removeButtons.hide();
        }
    }

    // --- Initial Load ---
    initializeTimezoneSelector();
    updateBackButton();
    updateTimezoneDisplay();
    handleTimezoneChange();
    
    // Update timezone display every minute
    setInterval(updateTimezoneDisplay, 60000);
    
    // Auto-select if only one event type
    if ($('.wpts-event-card').length === 1) {
        setTimeout(() => {
            $('.wpts-event-card').first().trigger('click');
        }, 500);
    }
    
    // Handle window resize to update layout responsively
    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Update layout based on current step and screen size
            updateConfirmationLayout(state.currentStep);
        }, 250);
    });
});