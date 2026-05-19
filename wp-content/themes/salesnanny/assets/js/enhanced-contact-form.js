jQuery(document).ready(function($) {
    // Enhanced contact form submission
    $('#requestquoteForm').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var $msgDiv = $('#msgSubmit');
        
        // Show loading state
        $submitBtn.prop('disabled', true).text('Submitting...');
        $msgDiv.removeClass('hidden alert-success alert-danger').text('');
        
        // Get formatted phone number from intl-tel-input if available
        var phoneNumber = $form.find('input[name="phone_number"]').val();
        console.log('Raw phone input value:', phoneNumber);
        
        if (window.phoneInput && typeof window.phoneInput.getNumber === 'function') {
            try {
                var formattedNumber = window.phoneInput.getNumber();
                if (formattedNumber && formattedNumber.trim() !== '') {
                    // Add space after country code (e.g., +1234567890 becomes +1 234567890)
                    phoneNumber = formattedNumber.replace(/^(\+\d{1,4})(\d)/, '$1 $2');
                    console.log('Formatted phone number with space:', phoneNumber);
                } else {
                    console.log('intl-tel-input returned empty, using raw value');
                }
            } catch (error) {
                console.log('Error getting formatted phone number:', error);
            }
        } else {
            console.log('intl-tel-input not available, using raw value');
        }
        
        // Collect form data - use form nonce field instead of ajax_object
        var formData = {
            action: 'submit_enhanced_contact',
            contact_nonce: $form.find('input[name="contact_nonce"]').val(),
            full_name: $form.find('input[name="full_name"]').val(),
            business_email: $form.find('input[name="business_email"]').val(),
            phone_number: phoneNumber,
            looking_for: $form.find('select[name="looking_for"]').val(),
            page_url: window.location.href
        };
        
        // Debug logging
        console.log('Form submission data:', formData);
        
        // Clear previous error states
        $form.find('.form-group').removeClass('has-error');
        $form.find('.help-block').text('');
        
        // Client-side validation
        var errors = [];
        if (!formData.full_name.trim()) {
            errors.push({field: 'full_name', message: 'Full name is required'});
        }
        if (!formData.business_email.trim() || !isValidEmail(formData.business_email)) {
            errors.push({field: 'business_email', message: 'Valid business email is required'});
        }
        if (!formData.phone_number.trim()) {
            errors.push({field: 'phone_number', message: 'Phone number is required'});
        }
        if (!formData.looking_for) {
            errors.push({field: 'looking_for', message: 'Please select what you are looking for'});
        }
        
        if (errors.length > 0) {
            errors.forEach(function(error) {
                var $field = $form.find('[name="' + error.field + '"]');
                $field.closest('.form-group').addClass('has-error');
                $field.siblings('.help-block').text(error.message);
            });
            
            $submitBtn.prop('disabled', false).text('Let\'s Get Started');
            return;
        }
        
        // Submit form via AJAX
        $.ajax({
            url: typeof ajax_object !== 'undefined' ? ajax_object.ajax_url : '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('AJAX Success Response:', response);
                if (response.success) {
                    $msgDiv.addClass('alert-success').text(response.message).removeClass('hidden');
                    $form[0].reset();
                    
                    // Track conversion (optional)
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'contact_form_submission', {
                            'event_category': 'engagement',
                            'event_label': formData.looking_for
                        });
                    }
                } else {
                    $msgDiv.addClass('alert-danger').text(response.message).removeClass('hidden');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
                console.error('Response Text:', xhr.responseText);
                $msgDiv.addClass('alert-danger').text('An error occurred. Please try again.').removeClass('hidden');
            },
            complete: function() {
                $submitBtn.prop('disabled', false).text('Let\'s Get Started');
            }
        });
    });
    
    // Email validation function
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Phone number formatting removed to allow plain number input
    
    // Real-time validation feedback
    $('#requestquoteForm input, #requestquoteForm select').on('blur', function() {
        var $field = $(this);
        var $formGroup = $field.closest('.form-group');
        var $helpBlock = $field.siblings('.help-block');
        var value = $field.val().trim();
        var fieldName = $field.attr('name');
        
        $formGroup.removeClass('has-error has-success');
        $helpBlock.text('');
        
        switch(fieldName) {
            case 'full_name':
                if (!value) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Full name is required');
                } else {
                    $formGroup.addClass('has-success');
                }
                break;
                
            case 'business_email':
                if (!value) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Business email is required');
                } else if (!isValidEmail(value)) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Please enter a valid email address');
                } else {
                    $formGroup.addClass('has-success');
                }
                break;
                
            case 'phone_number':
                if (!value) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Phone number is required');
                } else {
                    $formGroup.addClass('has-success');
                }
                break;
                
            case 'looking_for':
                if (!value) {
                    $formGroup.addClass('has-error');
                    $helpBlock.text('Please select what you are looking for');
                } else {
                    $formGroup.addClass('has-success');
                }
                break;
        }
    });
}); 