/**
 * Contact Us Form Handler
 * Handles form submission for the contactus.php page
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Handle contact form submission
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const submitButton = form.find('.xpro-contact-form-submit-button');
            const loadingIcon = submitButton.find('i');
            let messageContainer = $('#contactFormMessage');
            
            // Create message container if it doesn't exist
            if (messageContainer.length === 0) {
                messageContainer = $('<div id="contactFormMessage" style="margin-top: 15px;"></div>');
                form.append(messageContainer);
            }
            
            // Show loading state
            submitButton.prop('disabled', true);
            loadingIcon.show();
            messageContainer.hide();
            
            // Get phone number and country code
            const phoneNumber = form.find('#form-field-phone').val();
            const countryCode = form.find('#countryCode').val() || '+1';
            const fullPhoneNumber = phoneNumber ? countryCode + ' ' + phoneNumber : '';
            
            // Collect form data
            const formData = {
                action: 'contactus_submit',
                'form-field-53ca358': form.find('#form-field-53ca358').val(), // First Name
                'form-field-e7d1df3': form.find('#form-field-e7d1df3').val(), // Email
                'form-field-phone': fullPhoneNumber, // Combined country code + phone
                'form-field-d0e86ec': form.find('#form-field-d0e86ec').val(), // Subject
                'form-field-72f8d88': form.find('#form-field-72f8d88').val(), // Message
                form_action: 'contactus_submit',
                page_url: window.location.href,
                country_code: countryCode // Also send country code separately
            };
            
            // Debug logging
            console.log('Contactus Form Data:', formData);
            console.log('AJAX URL:', ajax_object.ajax_url);
            
            // Send AJAX request
            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log('Success Response:', response);
                    
                    if (response.success) {
                        // Show success message
                        messageContainer.html('<div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-top: 15px;"><i class="fas fa-check-circle" style="margin-right: 8px;"></i>' + response.message + '</div>');
                        messageContainer.show();
                        
                        // Reset form
                        form[0].reset();
                        
                        // Reset country code dropdown if it exists
                        if ($('#selectedCountryCode').length) {
                            $('#selectedCountryCode').text('+1');
                            $('#countryCode').val('+1');
                            
                            // Reset country selection
                            $('.country-option').removeClass('selected');
                            $('.country-option[data-code="+1"]').addClass('selected');
                        }
                        
                        // Hide message after 5 seconds
                        setTimeout(function() {
                            messageContainer.fadeOut();
                        }, 5000);
                    } else {
                        // Show error message
                        messageContainer.html('<div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-top: 15px;"><i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>' + response.message + '</div>');
                        messageContainer.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.error('Response:', xhr.responseText);
                    
                    // Show error message
                    // messageContainer.html('<div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-top: 15px;"><i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>Sorry, there was an error submitting your form. Please try again.</div>');
                    messageContainer.show();
                },
                complete: function() {
                    // Reset button state
                    submitButton.prop('disabled', false);
                    loadingIcon.hide();
                }
            });
        });
    });
})(jQuery); 