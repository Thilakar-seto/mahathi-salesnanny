<style>

    /* 2. Main Section Container */
    .footer-section {
background: #fff;
        padding: 40px 20px;
        width: 100%;
        box-sizing: border-box;
        font-family: "Inter", sans-serif;
        -webkit-font-smoothing: antialiased;
        color: #000;
    }

    /* 3. Inner Content Wrapper */
    .footer-content {
    width: 100%;
    max-width: 1400px;
    padding-inline: clamp(20px, 4vw, 48px);
    margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 30px; /* Space around the divider */
    }

    /* 4. Top Row: Logo (Left) and Socials (Right) */
    .footer-row-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-end; /* Aligns icons visually with logo bottom */
        width: 100%;
    }

    .footer-logo-link {
        display: inline-block;
        text-decoration: none;
        line-height: 0; /* Removes extra space under image */
    }

    .footer-logo-img {
        height: 32px; /* Adjusted to match scale in image */
        width: auto;
        display: block;
    }

    .footer-social-group {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .footer-social-link {
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .footer-social-link:hover {
        color: #00ccdd;
        transform: translateY(-2px);
    }

    .footer-social-icon {
        width: 20px;
        height: 20px;
    }

    /* 5. Horizontal Divider */
    .footer-divider {
        width: 100%;
        height: 1px;
        background-color: #444444; /* Subtle gray line */
        border: none;
        margin: 0;
    }

    /* 6. Bottom Row: Copyright (Left) and Privacy (Right) */
    .footer-row-bottom {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 100%;
    }

    .footer-copyright-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 14px;
        line-height: 1.5;
    }

    .footer-link-highlight {
        color: #00ccdd;
        text-decoration: none;
        font-weight: 600;
        transition: opacity 0.2s;
    }

    .footer-link-highlight:hover {
        opacity: 0.8;
    }

    .footer-privacy-link {
        color: #000;
        text-decoration: none;
        font-size: 14px;
        font-weight: 400;
        transition: color 0.2s;
        white-space: nowrap; /* Prevents wrapping */
    }

    .footer-privacy-link:hover {
        color: #00ccdd;
    }

    /* 7. Responsive Design (Mobile) */
    @media (max-width: 768px) {
        .footer-section {
            padding: 30px 20px;
        }

        .footer-content {
            gap: 20px;
        }

        .footer-row-top {
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .footer-row-bottom {
            flex-direction: column-reverse; /* Privacy usually goes below copyright on mobile */
            align-items: center;
            text-align: center;
            gap: 20px;
        }
    }
</style>

<footer class="footer-section">
    <div class="footer-content">
        
        <!-- Top Row -->
        <div class="footer-row-top">
            <!-- Logo Left -->
            <a href="/" class="footer-logo-link" aria-label="Home">
                <img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-logo-og.png" alt="Integration Go">
            </a>

            <!-- Socials Right -->
            <div class="footer-social-group">
                <a href="https://www.linkedin.com/company/sales-nanny-solutions-private-limited/" class="footer-social-link" aria-label="LinkedIn" target="_blank">
                    <svg class="footer-social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <a href="https://www.facebook.com/profile.php?id=100089957388229" class="footer-social-link" aria-label="Facebook" target="_blank">
                    <svg class="footer-social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
                <a href="https://www.instagram.com/salesnanny_official/" class="footer-social-link" aria-label="Instagram" target="_blank">
                    <svg class="footer-social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="https://x.com/TheSalesNanny" class="footer-social-link" aria-label="Twitter" target="_blank">
                <svg class="footer-social-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M453.2 112L523.8 112L369.6 288.2L551 528L409 528L297.7 382.6L170.5 528L99.8 528L264.7 339.5L90.8 112L236.4 112L336.9 244.9L453.2 112zM428.4 485.8L467.5 485.8L215.1 152L173.1 152L428.4 485.8z"/></svg>
                </a>
                <a href="https://www.youtube.com/@SalesNanny" class="footer-social-link" aria-label="YouTube" target="_blank">
                    <svg class="footer-social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Divider Line -->
        <hr class="footer-divider">

        <!-- Bottom Row -->
        <div class="footer-row-bottom">
            <!-- Copyright Left -->
            <div class="footer-copyright-group">
                <span>Copyright © 2026 SalesNanny Solutions Pvt Ltd. All rights reserved.</span>
                <!-- <span>Designed by <a href="https://salesnanny.com/" class="footer-link-highlight">SalesNanny Solutions Pvt Ltd</a></span> -->
            </div>

            <!-- Privacy Right -->
            <a href="/privacy-policy" class="footer-privacy-link">Privacy Policy</a>
        </div>

    </div>
</footer>
<a href="https://api.whatsapp.com/send?phone=81223 46800" target="_blank" rel="noopener" id="whatsapp-icon" aria-label="Chat with us on WhatsApp">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 175.216 175.552">
    <defs>
      <linearGradient id="b" x1="85.915" x2="86.535" y1="32.567" y2="137.092" gradientUnits="userSpaceOnUse">
        <stop offset="0" stop-color="#57d163"></stop>
        <stop offset="1" stop-color="#23b33a"></stop>
      </linearGradient>
      <filter id="a" width="1.115" height="1.114" x="-.057" y="-.057" color-interpolation-filters="sRGB">
        <feGaussianBlur stdDeviation="3.531"></feGaussianBlur>
      </filter>
    </defs>
    <path fill="#b3b3b3" d="m54.532 138.45 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.523h.023c33.707 0 61.139-27.426 61.153-61.135.006-16.335-6.349-31.696-17.895-43.251A60.75 60.75 0 0 0 87.94 25.983c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.558zm-40.811 23.544L24.16 123.88c-6.438-11.154-9.825-23.808-9.821-36.772.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954zm0 0" filter="url(#a)"></path>
    <path fill="#fff" d="m12.966 161.238 10.439-38.114a73.42 73.42 0 0 1-9.821-36.772c.017-40.556 33.021-73.55 73.578-73.55 19.681.01 38.154 7.669 52.047 21.572s21.537 32.383 21.53 52.037c-.018 40.553-33.027 73.553-73.578 73.553h-.032c-12.313-.005-24.412-3.094-35.159-8.954z"></path>
    <path fill="url(#linearGradient1780)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.312-6.179 22.559 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.518 31.126 8.524h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.929z"></path>
    <path fill="url(#b)" d="M87.184 25.227c-33.733 0-61.166 27.423-61.178 61.13a60.98 60.98 0 0 0 9.349 32.535l1.455 2.313-6.179 22.558 23.146-6.069 2.235 1.324c9.387 5.571 20.15 8.517 31.126 8.523h.023c33.707 0 61.14-27.426 61.153-61.135a60.75 60.75 0 0 0-17.895-43.251 60.75 60.75 0 0 0-43.235-17.928z"></path>
    <path fill="#fff" fill-rule="evenodd" d="M68.772 55.603c-1.378-3.061-2.828-3.123-4.137-3.176l-3.524-.043c-1.226 0-3.218.46-4.902 2.3s-6.435 6.287-6.435 15.332 6.588 17.785 7.506 19.013 12.718 20.381 31.405 27.75c15.529 6.124 18.689 4.906 22.061 4.6s10.877-4.447 12.408-8.74 1.532-7.971 1.073-8.74-1.685-1.226-3.525-2.146-10.877-5.367-12.562-5.981-2.91-.919-4.137.921-4.746 5.979-5.819 7.206-2.144 1.381-3.984.462-7.76-2.861-14.784-9.124c-5.465-4.873-9.154-10.891-10.228-12.73s-.114-2.835.808-3.751c.825-.824 1.838-2.147 2.759-3.22s1.224-1.84 1.836-3.065.307-2.301-.153-3.22-4.032-10.011-5.666-13.647"></path>
  </svg>
</a>
<style>
  
#whatsapp-icon {
  position: fixed;
  bottom: 25px;
  right: 25px;
  width: 65px;
  height: 65px;
  background: white;
  border-radius: 50%;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  z-index: 1000;
  overflow: hidden;
}
</style>

<script>
window.themeSettings = {
    themeUrl: '<?php echo get_template_directory_uri(); ?>',
    ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('contactus_form'); ?>',
    videoId: 'qjSubbShzrA'
};
</script>
<script>
// Set up AJAX configuration and load Calendly tracker
window.ajax_object = {
    ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('contactus_form'); ?>',
    contactus_nonce: '<?php echo wp_create_nonce('contactus_form'); ?>'
};

// Load the Calendly tracker script
document.addEventListener('DOMContentLoaded', function() {
    var calendlyScript = document.createElement('script');
    calendlyScript.src = '<?php echo get_template_directory_uri(); ?>/assets/js/calendly-tracker.js';
    document.head.appendChild(calendlyScript);
});
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/contactus-form.js" defer></script>
</body>
</html>