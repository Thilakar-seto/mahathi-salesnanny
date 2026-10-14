<?php
/**
 * <app-contact-popup> — the "Get in Touch" modal.
 *
 * Rendered once per page (hidden) by footer.php and opened by any element with
 * data-mh-action="open-contact". Submission is handled by assets/js/mahathi.js
 * (admin-ajax action "mahathi_contact", see inc/contact.php).
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$services = mh_data( 'contact-popup' )['services'] ?? array();
?>
<app-contact-popup id="mh-contact-popup" hidden>
  <div class="contact-overlay" data-mh-popup-overlay>
    <div class="contact-modal" role="dialog" aria-modal="true" aria-labelledby="mh-contact-title">
      <button type="button" class="close-btn" aria-label="Close" data-mh-popup-close>×</button>

      <div data-mh-popup-body>
        <h2 class="modal-title" id="mh-contact-title">Get in Touch</h2>
        <p class="popup-subtitle">We'd love to hear from you. Please fill out the form below.</p>

        <form id="mh-contact-form" novalidate>
          <input type="text" name="website" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true">

          <div class="popup-row">
            <div class="field">
              <input type="text" name="firstName" placeholder="First Name" maxlength="50" required>
              <div class="field-error" data-error-for="firstName" hidden>First name is required.</div>
            </div>
            <div class="field">
              <input type="text" name="lastName" placeholder="Last Name" maxlength="50" required>
              <div class="field-error" data-error-for="lastName" hidden>Last name is required.</div>
            </div>
          </div>

          <div class="field">
            <input type="email" name="email" placeholder="Email Address" required>
            <div class="field-error" data-error-for="email" hidden>Please enter a valid email address.</div>
          </div>

          <div class="field">
            <input type="text" name="company" placeholder="Company / Contact Info" maxlength="100" required>
            <div class="field-error" data-error-for="company" hidden>Company / contact info is required.</div>
          </div>

          <div class="field">
            <input type="text" name="mobile" placeholder="Mobile Number" required>
            <div class="field-error" data-error-for="mobile" hidden>Mobile number is required.</div>
          </div>

          <div class="field">
            <select name="service" required>
              <option value="">Select Service</option>
              <?php foreach ( mh_list( $services ) as $service ) : ?>
                <option value="<?= mh_a( $service ) ?>"><?= mh_e( $service ) ?></option>
              <?php endforeach; ?>
            </select>
            <div class="field-error" data-error-for="service" hidden>Please select a service.</div>
          </div>

          <div class="field">
            <textarea name="message" rows="4" placeholder="Your Message" maxlength="1000" required></textarea>
            <div class="field-error" data-error-for="message" hidden>Message is required.</div>
          </div>

          <div class="error-text" data-mh-popup-error hidden></div>

          <button type="submit" class="submit-btn">Submit</button>
        </form>
      </div>

      <div class="success-state" data-mh-popup-success hidden>
        <h2>Thank You!</h2>
        <p>Our team will contact you shortly.</p>
      </div>
    </div>
  </div>
</app-contact-popup>
