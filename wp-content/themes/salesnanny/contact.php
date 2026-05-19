<?php
/**
 * Template Name: Contact Us
 */

get_header();
?>
<!-- Fonts & Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/common.css">
<style>
  :root {
    --primary: #C22034;
    --primary-dark: #A11B2B;
    --accent: #1E2152;
    --accent-light: #2A2E70;
    --dark: #0f172a;
    --darker: #020617;
    --light-bg: #f8fafc;
    --border: #e2e8f0;
    --gradient-purple: linear-gradient(180deg, #C22034, #A11B2B);
    --gradient-blue: linear-gradient(180deg, #1E2152, #141638 100%, #0D0F26 0);
    --gradient-orange: linear-gradient(180deg, #C22034, #FF4D5E);
  }

  .hs-container-cta {
    display: none !important;
  }

  .hs-footer-section {
    padding-top: 80px !important;
  }


  /* ========================================
     HERO SECTION - FULL WIDTH BANNER
  =========================================*/
  .hero-banner {
    background: #1d2050;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .hero-banner::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 30px 30px;
    opacity: 0.3;
    pointer-events: none;
  }

  .hero-content {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    z-index: 2;
    padding: 0 20px;
  }

  .hero-title {
    font-size: 48px;
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -1px;
    animation: fadeInUp 0.8s ease forwards;
    position: relative;
  }


  .stat-item {
    text-align: center;
  }

  .stat-number {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    display: block;
  }

  .stat-label {
    font-size: 14px;
    color: rgba(255,255,255,0.8);
    margin-top: 5px;
  }

  /* ========================================
     CONTACT SECTION - OFFSET CARD DESIGN
  =========================================*/
  .contact-section {
    margin-top: -150px;
    padding: 0 5% 100px;
    position: relative;
    z-index: 10;
  }

  .contact-wrapper {
    max-width: 1400px;
    margin: 0 auto;
    background: #fff;
    border-radius: 32px;
    box-shadow: 0 20px 60px -10px rgba(0,0,0,0.1);
    overflow: hidden;
    display: grid;
    grid-template-columns: 400px 1fr;
  }

  /* LEFT SIDEBAR */
  .contact-sidebar {
    background: linear-gradient(180deg, #1E2152, #141638 100%, #0D0F26 0);
    padding: 60px 40px;
    color: #fff;
    position: relative;
    overflow: hidden;
    border: 10px solid;
    border-radius: 36px;
}

  .sidebar-content {
    position: relative;
    z-index: 2;
  }

  .contact-sidebar h1 {
    font-size: 28px;
    margin-bottom: 20px;
  }

  .contact-sidebar p {
    color: rgba(255,255,255,0.7);
    line-height: 1.6;
    margin-bottom: 40px;
  }

  .contact-method {
    background: #fff;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 16px;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: #000;
    display: block;
    place-items: center;
}

  .contact-method:hover {
    /* background: rgba(255,255,255,0.1); */
    border-color: var(--accent-light);
    transform: translateX(8px);
  }

  .method-icon {
    width: 48px;
    height: 48px;
    background: var(--gradient-blue);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 16px;
    color: #fff;
}

  .method-title {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 6px;
  }

  .method-detail {
    font-size: 14px;
    color: #000;
  }

  .social-links {
    display: flex;
    gap: 12px;
    margin-top: 40px;
    justify-content: center;
  }

  .social-icon {
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .social-icon:hover {
    background: var(--gradient-orange);
    border-color: var(--primary);
    transform: translateY(-3px);
  }

  /* RIGHT FORM AREA */
  .form-area {
    padding: 60px;
  }

  .form-header {
    margin-bottom: 40px;
  }

  .form-header h2 {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 32px;
    color: var(--accent);
    margin-bottom: 12px;
  }

  .form-header p {
    color: #64748b;
    font-size: 16px;
  }

  /* MODERN TOGGLE TABS */
  .form-toggle {
    display: inline-flex;
    background: var(--light-bg);
    border: 2px solid var(--border);
    border-radius: 16px;
    padding: 6px;
    margin-bottom: 40px;
  }

  .toggle-btn {
    padding: 12px 28px;
    background: transparent;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 15px;
  }

  .toggle-btn.active {
    background: var(--gradient-purple);
    color: #fff;
    box-shadow: 0 4px 12px rgba(194, 32, 52, 0.3);
  }

  /* FORM GRID */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
  }

  .form-field {
    display: flex;
    flex-direction: column;
  }

  .form-field.full {
    grid-column: span 2;
    margin-bottom: 20px;
  }

  .form-field label {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 10px;
    font-size: 14px;
  }

  .form-field label .required {
    color: var(--primary);
    margin-left: 3px;
  }

  .input-field {
    padding: 16px 18px;
    border: 2px solid var(--border);
    border-radius: 12px;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s ease;
    background: #fff;
  }

  .input-field:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(194, 32, 52, 0.1);
  }

  textarea.input-field {
    min-height: 140px;
    resize: vertical;
  }

  .submit-btn {
    width: 100%;
    padding: 18px;
    background: var(--gradient-purple);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px -5px rgba(194, 32, 52, 0.4);
    margin-top: 16px;
  }

  .submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px -5px rgba(194, 32, 52, 0.5);
  }

  .submit-btn:active {
    transform: translateY(-1px);
  }

  /* ALTERNATIVE CONTENT */
  .alt-content {
    display: none;
    text-align: center;
    padding: 60px 40px;
  }

  .alt-content.active {
    display: block;
    animation: fadeIn 0.4s ease;
  }

  .big-icon {
    width: 100px;
    height: 100px;
    background: var(--gradient-purple);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: #fff;
    margin: 0 auto 30px;
  }

  .alt-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 28px;
    color: var(--accent);
    margin-bottom: 16px;
  }

  .alt-text {
    color: #64748b;
    font-size: 16px;
    margin-bottom: 30px;
  }

  .alt-link {
    display: inline-block;
    padding: 16px 40px;
    background: var(--gradient-purple);
    color: #fff;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .alt-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px -5px rgba(194, 32, 52, 0.4);
  }

  /* SUCCESS MESSAGE */
  .success-message {
    display: none;
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    margin-top: 20px;
    font-weight: 600;
  }

  .success-message.show {
    display: block;
    animation: slideDown 0.4s ease;
  }

  /* ANIMATIONS */
  @keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* RESPONSIVE */
  @media (max-width: 1200px) {
    .contact-wrapper {
      grid-template-columns: 1fr;
    }
    
    .contact-sidebar {
      padding: 50px 40px;
    }

    .form-area {
      padding: 50px 40px;
    }
  }

  @media (max-width: 768px) {
    .hero-banner {
      padding: 80px 5% 60px;
    }

    .hero-title {
      font-size: 42px;
    }

    .stats-row {
      gap: 40px;
    }

    .form-grid {
      grid-template-columns: 1fr;
    }

    .form-field.full {
      grid-column: span 1;
    }

    .form-area, .contact-sidebar {
      padding: 40px 24px;
    }

    .contact-wrapper {
      border-radius: 24px;
    }
  }
</style>

<!-- HTML STRUCTURE -->
<div class="contact-page">
  
  <!-- Hero Banner Section -->
  <section class="hero-banner">
    <div class="hero-content">
      <!-- <h1 class="hero-title">Let's Build Something Amazing Together</h1> -->
    </div>
  </section>

  <!-- Contact Section with Offset Card -->
  <section class="contact-section">
    <div class="contact-wrapper">
      
      <!-- Left Sidebar -->
      <aside class="contact-sidebar">
        <div class="sidebar-content">
          <h1>Get in Touch</h1>
          <p>Choose your preferred way to reach us. We typically respond within 2 hours during business days.</p>

          <a href="mailto:support@salesnanny.com" class="contact-method">
            <div class="method-icon">
              <i class="far fa-envelope"></i>
            </div>
            <div class="method-title">Email Us</div>
            <div class="method-detail">support@salesnanny.com</div>
          </a>

          <a href="https://api.whatsapp.com/send?phone=81223 46800" class="contact-method">
            <div class="method-icon">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div class="method-title">WhatsApp</div>
            <div class="method-detail">+91 81223 46800</div>
          </a>

          <a href="tel:+9181223 46800" class="contact-method">
            <div class="method-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="method-title">Call Us</div>
            <div class="method-detail">24/7 Support</div>
          </a>

          <div class="social-links">
            <a href="https://www.linkedin.com/company/sales-nanny-solutions-private-limited/" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://x.com/TheSalesNanny" class="social-icon" target="_blank"><svg class="footer-social-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M453.2 112L523.8 112L369.6 288.2L551 528L409 528L297.7 382.6L170.5 528L99.8 528L264.7 339.5L90.8 112L236.4 112L336.9 244.9L453.2 112zM428.4 485.8L467.5 485.8L215.1 152L173.1 152L428.4 485.8z"/></svg></a>
            <a href="https://www.facebook.com/profile.php?id=100089957388229" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/salesnanny_official/" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://in.pinterest.com/SalesNanny/" class="social-icon" target="_blank"><i class="fab fa-pinterest-p"></i></a>
            <a href="https://www.youtube.com/@SalesNanny" class="social-icon" target="_blank"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </aside>

      <!-- Right Form Area -->
      <div class="form-area">
        <div class="form-header">
          <h2>Send us a message</h2>
          <p>Fill out the form below and we'll get back to you shortly.</p>
        </div>

        <!-- Toggle Tabs -->
        <div class="form-toggle">
          <button class="toggle-btn active" onclick="switchContent('form')">Contact Form</button>
          <button class="toggle-btn" onclick="switchContent('schedule')">Schedule Call</button>
        </div>

        <!-- Form Content -->
        <div id="formContent" class="form-content-area">
          <form id="contactFormSubmitted">
            <div class="form-grid">
              <div class="form-field">
                <label>Full Name <span class="required">*</span></label>
                <input type="text" id="firstname" class="input-field" placeholder="John" required>
              </div>
              
              <!-- <div class="form-field">
                <label>Last Name <span class="required">*</span></label>
                <input type="text" id="lastname" class="input-field" placeholder="Doe" required>
              </div> -->
              <div class="form-field">
                <label>Email Address <span class="required">*</span></label>
                <input type="email" id="email" class="input-field" placeholder="john@company.com" required>
              </div>
            </div>

            <!-- <div class="form-grid">
              
              
              <div class="form-field">
                <label>Phone Number</label>
                <input type="tel" id="phone" class="input-field" placeholder="+1 (555) 000-0000">
              </div>
            </div> -->

            <div class="form-field full">
              <label>Company Name</label>
              <input type="text" id="company" class="input-field" placeholder="Your Company Inc.">
            </div>

            <div class="form-field full">
              <label>How can we help? <span class="required">*</span></label>
              <textarea id="message" class="input-field" placeholder="Tell us about your project, requirements, or questions..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">
              <i class="fas fa-paper-plane" style="margin-right: 8px;"></i>
              Send Message
            </button>

            <div id="successMsg" class="success-message">
              <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
              Message sent successfully! We'll be in touch soon.
            </div>
          </form>
        </div>

        <!-- Schedule Call Content -->
        <div id="scheduleContent" class="alt-content">
          <div class="big-icon">
            <i class="far fa-calendar-check"></i>
          </div>
          <h3 class="alt-title">Schedule a Consultation</h3>
          <p class="alt-text">Book a 30-minute call with our logistics experts to discuss your needs and explore custom solutions.</p>
          <a href="/online-meeting"_blank" class="alt-link">
            <i class="far fa-calendar" style="margin-right: 8px;"></i>
            View Available Times
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
  // Switch between form and schedule content
  function switchContent(type) {
    const formContent = document.getElementById('formContent');
    const scheduleContent = document.getElementById('scheduleContent');
    const buttons = document.querySelectorAll('.toggle-btn');

    buttons.forEach(btn => btn.classList.remove('active'));

    if (type === 'form') {
      formContent.style.display = 'block';
      scheduleContent.classList.remove('active');
      buttons[0].classList.add('active');
    } else {
      formContent.style.display = 'none';
      scheduleContent.classList.add('active');
      buttons[1].classList.add('active');
    }
  }
</script>

<script>
// Direct nonce for contact form
var contact_nonce = '<?php echo wp_create_nonce('contactus_form'); ?>';

const contactFormEl = document.getElementById('contactFormSubmitted');

if (contactFormEl) {
contactFormEl.addEventListener('submit', function(e) {
    e.preventDefault();

    const submitBtn = this.querySelector('.submit-btn');
    const originalBtnText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Sending...';

    // Read values from this form to avoid null errors on template variants.
    const getValue = (id) => {
        const field = this.querySelector(`#${id}`);
        return field ? field.value.trim() : '';
    };

    const firstname = getValue('firstname');
    const lastname = getValue('lastname');
    const email = getValue('email');
    const phone = getValue('phone');
    const company = getValue('company');
    const message = getValue('message');

    // Prepare data for database using the existing contactus system
    const formData = new FormData();
    formData.append('action', 'contactus_submit');
    formData.append('form-field-53ca358', firstname); // First Name
    formData.append('form-field-1f02457', lastname);  // Last Name
    formData.append('form-field-e7d1df3', email);     // Email
    formData.append('form-field-phone', phone);       // Phone
    // Map Company Name to Subject field so it appears in the dashboard
    formData.append('form-field-d0e86ec', company ? company : 'Contact Form Submission');   // Subject / Company
    formData.append('form-field-72f8d88', message);   // Message
    formData.append('form_action', 'contactus_submit');
    formData.append('page_url', window.location.href);
    
    // Try to get nonce from various sources
    let nonce = null;
    if (typeof global_ajax_object !== 'undefined' && global_ajax_object.contactus_nonce) {
        nonce = global_ajax_object.contactus_nonce;
    } else if (typeof ajax_object !== 'undefined' && ajax_object.nonce) {
        nonce = ajax_object.nonce;
    } else if (typeof contact_nonce !== 'undefined') {
        nonce = contact_nonce;
    }
    
    if (nonce) {
        formData.append('nonce', nonce);
    }

    // Send to database via AJAX
    fetch(typeof global_ajax_object !== 'undefined' ? global_ajax_object.ajax_url : (typeof ajax_object !== 'undefined' ? ajax_object.ajax_url : '/wp-admin/admin-ajax.php'), {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            const successMsg = document.getElementById('successMsg');
            successMsg.classList.add('show');
            
            // Reset form
            document.getElementById('contactFormSubmitted').reset();
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                successMsg.classList.remove('show');
            }, 5000);
        } else {
            throw new Error(data.message || 'Failed to submit form');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Sorry, there was an error sending your message. Please try again.');
    })
    .finally(() => {
        // Reset button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    });
});
}
</script>
<script>
// WordPress Contact Form Integration
document.addEventListener('DOMContentLoaded', function() {
    // Load jQuery if not already loaded
    if (typeof jQuery === 'undefined') {
        var script = document.createElement('script');
        script.src = 'https://code.jquery.com/jquery-3.7.1.min.js';
        script.onload = function() {
            initContactForm();
        };
        document.head.appendChild(script);
    } else {
        initContactForm();
    }
    
    function initContactForm() {
        // Set up AJAX configuration
        window.ajax_object = {
            ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('contactus_form'); ?>'
        };
        
        // Load the contactus form script
        var contactusScript = document.createElement('script');
        contactusScript.src = '<?php echo get_template_directory_uri(); ?>/assets/js/contactus-form.js';
        document.head.appendChild(contactusScript);
        
        // Load the Calendly tracker script
        var calendlyScript = document.createElement('script');
        calendlyScript.src = '<?php echo get_template_directory_uri(); ?>/assets/js/calendly-tracker.js';
        document.head.appendChild(calendlyScript);
    }
});
</script>

</section>


<?php get_footer(); ?>