<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Search Engine Bot Support -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    
    <!-- Delayed GTM Loading Script -->
     <script>
        function loadGTM(w,d,s,l,i){
            w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        }

        // Check if mobile device
        if (/Mobi|Android/i.test(navigator.userAgent)) {
            // Delay GTM load by 5 seconds on mobile
            setTimeout(function() {
                loadGTM(window,document,'script','dataLayer','GTM-58VT3MF2');
            }, 5000);
        } else {
            // Load immediately on desktop, but after initial paint
            if (window.requestIdleCallback) {
                requestIdleCallback(() => {
                    loadGTM(window,document,'script','dataLayer','GTM-58VT3MF2');
                });
            } else {
                // Fallback for browsers that don't support requestIdleCallback
                setTimeout(() => {
                    loadGTM(window,document,'script','dataLayer','GTM-58VT3MF2');
                }, 1);
            }
        }
    </script>  
 

    <?php if (is_front_page() || is_home()): ?>
<?php endif; ?>
    <?php
    // Get current post/page ID, fallback to home if needed
    $current_id = get_queried_object_id();
    
    // Get default values from options
    $default_title = get_option('default_meta_title');
    $default_description = get_option('default_meta_description');
    
    // Get custom meta values if they exist
    $meta_title = get_post_meta($current_id, '_meta_title', true);
    $meta_description = get_post_meta($current_id, '_meta_description', true);
    
    // Special handling for archive, category, and taxonomy pages
    if (is_archive() || is_category() || is_tax()) {
        $term = get_queried_object();
        if (is_object($term) && property_exists($term, 'term_id')) {
            $meta_title = get_term_meta($term->term_id, '_meta_title', true);
            $meta_description = get_term_meta($term->term_id, '_meta_description', true);
        }
        
        // Special handling for glossary archive
        if (is_post_type_archive('glossary')) {
            $meta_title = get_option('glossary_archive_meta_title') ?: 'Supply Chain Visibility Glossary | SalesNanny';
            $meta_description = get_option('glossary_archive_meta_description') ?: 'Your complete resource for supply chain visibility. This glossary covers key terms, and concepts, enhancing visibility and tracking across your operations.';
        }
        
        // Special handling for author archives
        if (is_author()) {
            $author = get_queried_object();
            $author_name = $author->display_name;
            $author_bio = $author->description;
            $meta_title = $author_name . ' - Author at SalesNanny';
            $meta_description = !empty($author_bio) ? wp_trim_words($author_bio, 30, '...') : 'Articles written by ' . $author_name . ' at SalesNanny';
        }
    }
    
    // Special handling for single glossary terms
    if (is_singular('glossary')) {
        // Get custom meta values if available
        $custom_meta_title = get_post_meta(get_the_ID(), '_glossary_meta_title', true);
        $custom_meta_description = get_post_meta(get_the_ID(), '_glossary_meta_description', true);
        
        // Use custom meta if available
        if (!empty($custom_meta_title)) {
            $meta_title = $custom_meta_title;
        } else if (empty($meta_title)) {
            $meta_title = get_the_title() . ' | Supply Chain Glossary | SalesNanny';
        }
        
        if (!empty($custom_meta_description)) {
            $meta_description = $custom_meta_description;
        } else if (empty($meta_description)) {
            // Get post content and create a short excerpt
            $content = get_the_content();
            $excerpt = wp_trim_words(strip_shortcodes($content), 30, '...');
            $meta_description = $excerpt ?: 'Learn the definition of ' . get_the_title() . ' and its importance in supply chain management with SalesNanny.';
        }
    }
    
    // Build final title with fallbacks
    $final_title = $meta_title ?: ($default_title ? 
        str_replace('{site_name}', get_bloginfo('name'), $default_title) : 
        wp_get_document_title());
    
    // Build final description with fallbacks
    $final_description = $meta_description ?: ($default_description ?: 
        get_bloginfo('description'));
    ?>
    <title><?php echo esc_html($final_title); ?></title>
    <?php
    // Get the current URL based on page type
    if (is_front_page()) {
        $current_url = home_url('/');
    } elseif (is_post_type_archive('glossary')) {
        // Use the post type archive URL for glossary
        $current_url = get_post_type_archive_link('glossary');
    } elseif (is_author()) {
        // Use proper author archive URL
        $current_url = get_author_posts_url(get_queried_object_id());
    } elseif (is_archive() || is_category() || is_tax()) {
        $current_url = get_term_link(get_queried_object());
    } else {
        $current_url = get_permalink();
    }
    ?>
    <link rel="canonical" href="<?php echo esc_url($current_url); ?>">
    <?php pagination_canonical_links(); ?>
    <meta name="title" content="<?php echo esc_attr($final_title); ?>">
    <meta name="description" content="<?php echo esc_attr($final_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url($current_url); ?>">
    <meta property="og:title" content="<?php echo esc_attr($final_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($final_description); ?>">
    <meta property="og:image" content="<?php 
        if (is_single() && has_post_thumbnail()) {
            echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
        } elseif (is_singular('glossary') && has_post_thumbnail()) {
            // Handle single glossary terms with thumbnails
            echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
        } elseif (is_post_type_archive('glossary')) {
            // Specific image for glossary archive
            echo get_template_directory_uri() . '/assets/ogtag.png'; // Create this image or use another appropriate one
        } else {
            echo get_template_directory_uri() . '/assets/ogtag.png';
        }
    ?>">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo esc_url($current_url); ?>">
    <meta property="twitter:title" content="<?php echo esc_attr($final_title); ?>">
    <meta property="twitter:description" content="<?php echo esc_attr($final_description); ?>">
    <meta property="twitter:image" content="<?php 
        if (is_single() && has_post_thumbnail()) {
            echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full'));
        } else {
            echo get_template_directory_uri() . '/assets/salesnanny-logo-og.png';
        }
    ?>">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/inter_5.2.6_latin-wght-normal.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicon configuration -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-favi-logo.png">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Global Top Digital Marketing Agency | SalesNanny",
      "url": "<?php echo home_url(); ?>",
      "logo": "<?php echo get_template_directory_uri(); ?>/assets/salesnanny-logo-og.png",
      "description": "Boost your leads and sales with SalesNanny, a digital marketing agency providing effective online solutions. Grow your online presence now!",
      "sameAs": [
        "https://www.linkedin.com/company/sales-nanny-solutions-private-limited/",
        "https://x.com/TheSalesNanny",
        "https://www.facebook.com/profile.php?id=100089957388229",
        "https://www.instagram.com/salesnanny_official/",
        "https://in.pinterest.com/SalesNanny/",
        "https://www.youtube.com/@SalesNanny"
      ],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "contactType": "customer service",
          "email": "support@salesnanny.com"
        }
      ],
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "worldwide"
      }
    }
    </script>
    <?php if (is_single()): 
        global $post;
        $author = get_the_author_meta('display_name', $post->post_author);
        $title = get_the_title($post->ID);
        $url = get_permalink($post->ID);
        $datePublished = get_the_date('c', $post->ID);
        $dateModified = get_the_modified_date('c', $post->ID);
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $imageURL = $image ? $image[0] : '';
        $description = get_the_excerpt($post->ID);
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo esc_url($url); ?>"
        },
        "headline": "<?php echo esc_js($title); ?>",
        "image": "<?php echo esc_url($imageURL); ?>",
        "datePublished": "<?php echo esc_js($datePublished); ?>",
        "dateModified": "<?php echo esc_js($dateModified); ?>",
        "author": {
            "@type": "Person",
            "name": "<?php echo esc_js($author); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?php bloginfo('name'); ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url(get_site_icon_url()); ?>"
            }
        },
        "description": "<?php echo esc_js($description); ?>"
    }
    </script>
    <?php endif; ?>

<?php wp_head(); ?>
    </head>
<body>
<div class="advanced-grid-bg"></div>
    <!-- GTM NoScript - Loaded via JavaScript -->
      <script>
        function loadGTMNoscript() {
            var iframe = document.createElement('iframe');
            iframe.src = 'https://www.googletagmanager.com/ns.html?id=GTM-58VT3MF2';
            iframe.height = '0';
            iframe.width = '0';
            iframe.style.display = 'none';
            iframe.style.visibility = 'hidden';
            
            var noscript = document.createElement('noscript');
            noscript.appendChild(iframe);
            document.body.appendChild(noscript);
        }

        // Same delay logic as above
        if (/Mobi|Android/i.test(navigator.userAgent)) {
            setTimeout(loadGTMNoscript, 5000);
        } else {
            if (window.requestIdleCallback) {
                requestIdleCallback(loadGTMNoscript);
            } else {
                setTimeout(loadGTMNoscript, 1);
            }
        }
    </script>

<style>
    /* ================================
   Font Definitions
================================ */
html {
    overflow-x: hidden;
    scroll-behavior: smooth;
    filter: contrast(1.1);
}

svg {
    filter: contrast(1.1) !important;
}

@media (min-width: 1800px) and (max-width: 2000px) {
  body {
      zoom: 1.25; 

      /* Firefox Fallback */
      -moz-transform: scale(1.25);
      -moz-transform-origin: top center;
      /* When scaling up, you don't usually need to adjust width */
  }
}
/* Inter Variable Font */
@font-face {
    font-family: 'Inter';
    src: url('<?php echo get_template_directory_uri(); ?>/assets/inter_5.2.6_latin-wght-normal.woff2') format('woff2');
    font-weight: 100 900;
    font-style: normal;
    font-display: swap;
}


/* ================================
   Icon Font Overrides (Font Awesome)
================================ */

/* Solid Icons */
.fa-solid, .fas {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 900 !important;
}

/* Regular Icons */
.fa-regular, .far {
    font-family: "Font Awesome 6 Free" !important;
    font-weight: 400 !important;
}

/* Brand Icons */
.fa-brands, .fab {
    font-family: "Font Awesome 6 Brands" !important;
    font-weight: 400 !important;
}

/* ================================
   CSS Reset & Box Model
================================ */

*, *::before, *::after {
    box-sizing: border-box;
}

* {
    margin: 0;
    padding: 0;
}

/* ================================
   Global Typography
================================ */

body,
label,
input,
textarea,
select,
button {
    font-family: "Inter" !important;
    font-weight: 500;
}

/* ================================
   Body Defaults
================================ */

body {
    /* letter-spacing: 0.8px; */
    letter-spacing: -0.04em;
    color: white;
    overflow-y: auto;
    overflow-x: hidden;
    scroll-behavior: smooth;
    position: relative;
}

/* ================================
   Utility / Component Styles
================================ */

.icon-arrow-up {
    width: 18px;
    height: 18px;
    stroke: currentColor;
    stroke-width: 2.5;
}


    /* -----------------------------------------------------------
       RESET & BASE STYLES
    ----------------------------------------------------------- */
    .site-header * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* -----------------------------------------------------------
       LAYOUT: HEADER CONTAINER
    ----------------------------------------------------------- */
    .site-header {
        width: 100%;
        padding: 15px 0;
        color: #fff; 
        position: absolute;
        z-index: 1000;
        background-color: #fff;
    }

    .header-container {
        width: 100%;
  max-width: 1400px;
  padding-inline: clamp(20px, 4vw, 48px);
  margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* -----------------------------------------------------------
       ELEMENT: LOGO
    ----------------------------------------------------------- */
    .header-logo-link {
    height: 100%;
    width: auto;
}

    .header-logo-link img {
        height: 35px;
        width: auto;
    }

    .header-logo-img {
        width: 168px;
        height: auto;
        display: block;
    }

    a.header-logo-link {
        text-decoration: none;
    }

    .header-logo-text {
        font-size: 50px;
        font-weight: 800;
        color: #fff;
        text-decoration: none;
    }

    /* -----------------------------------------------------------
       COMPONENT: NAVIGATION
    ----------------------------------------------------------- */
    .nav-wrapper {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .nav-list {
        display: flex;
        list-style: none;
        gap: 20px;
    }

    .nav-item {
        position: relative;
        display: flex;
        align-items: center;
    }

    .nav-link {
        display: block;
        padding: 12px 20px;
        font-size: 15px;
        font-weight: 600;
        color: #333;
        text-decoration: none;
        border-radius: 30px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #c22034;
        color: #ffffff;
        text-decoration: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-4px);
        /* box-shadow: 0 10px 25px rgba(194, 32, 52, 0.6); */
    }

    /* .nav-link:hover,
    .nav-item:hover .nav-link {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.1);
    } */

    /* -----------------------------------------------------------
       COMPONENT: DROPDOWNS (MEGA MENU)
    ----------------------------------------------------------- */
    .dropdown-container {
        position: absolute;
        top: 100%;
        left: 0;
        width: 250px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        display: none;
        overflow: hidden;
        cursor: default;
        animation: fadeIn 0.2s ease-in-out;
    }

    .nav-item:hover .dropdown-container {
        display: flex;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-content-main {
        flex: 1;
        padding: 30px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dropdown-sidebar {
        width: 280px;
        background-color: #f6f6f6;
        padding: 30px 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dropdown-container.company-dropdown {
        width: 465px;
    }
    
    .dropdown-container.company-dropdown .dropdown-content-main {
        width: 100%;
        flex-direction: row;
    }

    .dropdown-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .dropdown-section-title {
        font-size: 12px;
        color: #757575;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 12px;
        padding-left: 15px;
        position: relative;
    }

    .dropdown-section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        background-color: #c22034;
        border-radius: 50%;
    }

    .dropdown-items-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 24px;
        border-left: 1px dashed #e0e0e0;
        padding-left: 16px;
    }

    .dropdown-link {
        text-decoration: none;
        display: block;
        group: hover;
    }

    .dropdown-item-heading {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
        transition: color 0.2s ease;
        position: relative;
    }

    .dropdown-item-desc {
        font-size: 12px;
        font-weight: 500;
        color: #606060;
        line-height: 1.4;
    }

    .dropdown-link:hover .dropdown-item-heading {
        color: #c22034;
    }

    .dropdown-link:hover .dropdown-item-heading::before {
        content: "";
        position: absolute;
        left: -19px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #c22034;
    }

    /* -----------------------------------------------------------
       COMPONENT: BUTTONS & CTAS
    ----------------------------------------------------------- */
    .btn-download-wrapper {
        position: relative;
    }

    .btn-download {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid #ffffff;
        border-radius: 40px;
        color: #ffffff;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        cursor: default;
        transition: background 0.3s ease;
    }

    .btn-download:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .btn-icon {
        width: 20px;
        height: 20px;
    }

    .dropdown-container.app-dropdown {
        width: 350px;
        right: 0;
        left: auto;
        padding: 24px;
    }

    .btn-download-wrapper:hover .dropdown-container.app-dropdown {
        display: block;
    }

    .app-store-links {
        display: flex;
        gap: 12px;
        margin-top: 15px;
    }
    
    .app-store-img {
        height: 40px;
        width: auto;
    }

    /* -----------------------------------------------------------
       HAMBURGER MENU BUTTON (Mobile Only)
    ----------------------------------------------------------- */
    .hamburger-btn {
        display: none;
        flex-direction: column;
        justify-content: space-around;
        width: 30px;
        height: 25px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        z-index: 1001;
        position: relative;
    }

    .hamburger-line {
        width: 100%;
        height: 3px;
        background-color: #000;
        border-radius: 10px;
        transition: all 0.3s ease;
        transform-origin: center;
    }

    .hamburger-btn.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translateY(10px);
    }

    .hamburger-btn.active .hamburger-line:nth-child(2) {
        opacity: 0;
        transform: translateX(-20px);
    }

    .hamburger-btn.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translateY(-10px);
    }

    /* -----------------------------------------------------------
       MOBILE MENU OVERLAY - FIXED
    ----------------------------------------------------------- */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 998;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        pointer-events: none; /* FIXED: Doesn't block clicks when inactive */
    }

    .mobile-menu-overlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto; /* FIXED: Only blocks clicks when menu is open */
    }

    /* -----------------------------------------------------------
       MOBILE NAVIGATION
    ----------------------------------------------------------- */
    .mobile-nav {
        position: fixed;
        top: 0;
        right: -100%;
        width: 85%;
        max-width: 400px;
        height: 100%;
        background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        z-index: 999;
        overflow-y: auto;
        transition: right 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        padding: 80px 0 30px;
        visibility: hidden;
    }

    .mobile-nav.active {
        right: 0;
        visibility: visible;
    }

    .mobile-nav-list {
        list-style: none;
        padding: 0 20px;
    }

    .mobile-nav-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .mobile-nav-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 15px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .mobile-nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
        padding-left: 20px;
    }

    /* Mobile Dropdown Arrow */
    .mobile-dropdown-arrow {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid #fff;
        transition: transform 0.3s ease;
    }

    .mobile-nav-item.expanded .mobile-dropdown-arrow {
        transform: rotate(180deg);
    }

    /* Mobile Dropdown Container */
    .mobile-dropdown {
        max-height: 0;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.2);
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .mobile-nav-item.expanded .mobile-dropdown {
        max-height: 800px;
    }

    .mobile-dropdown-list {
        list-style: none;
        padding: 10px 0;
    }

    .mobile-dropdown-link {
        display: block;
        padding: 12px 30px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .mobile-dropdown-link:hover {
        color: #fff;
        background: rgba(255, 255, 255, 0.05);
        padding-left: 35px;
    }

    .mobile-dropdown-heading {
        font-weight: 600;
        color: #fff;
        margin-bottom: 3px;
    }

    .mobile-dropdown-desc {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.6);
        line-height: 1.3;
    }

    /* Mobile CTA Button */
    .mobile-cta-wrapper {
        padding: 20px;
        margin-top: 20px;
    }

    .mobile-cta-btn {
        display: block;
        width: 100%;
        padding: 15px 24px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid #ffffff;
        border-radius: 40px;
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .mobile-cta-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* -----------------------------------------------------------
       RESPONSIVE STYLES
    ----------------------------------------------------------- */
    @media (max-width: 991px) {
        .nav-list {
            display: none;
        }
        
        .btn-download-wrapper {
            display: none;
        }

        .hamburger-btn {
            display: flex;
        }

        .header-logo-img {
            width: 140px;
        }

        .header-logo-text {
            font-size: 35px;
        }
    }

    @media (max-width: 768px) {
        .header-container {
            padding: 0 15px;
        }

        .header-logo-text {
            font-size: 28px;
        }

        .mobile-nav {
            width: 90%;
        }
    }

    /* Prevent body scroll when mobile menu is open */
    body.mobile-menu-open {
        overflow: hidden;
    }
</style>

<section>
    <header class="site-header">
        <div class="header-container">
            <!-- Brand Logo -->
            <a class="header-logo-link" href="/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/salesnanny-logo-og.png" alt="Logo" width="245" height="40" fetchpriority="high">
            </a>

            <!-- Desktop Navigation Menu -->
            <div class="nav-wrapper">
                <ul class="nav-list">
                    <!-- Product Dropdown -->
                    <li class="nav-item">
                    <span class="nav-link">Services🔻</span>
                        <div class="dropdown-container">
                            <div class="dropdown-content-main">
                                <!-- <h2 class="dropdown-section-title">Solutions</h2> -->
                                <div style="display: flex; gap: 24px;">
                                    <div class="dropdown-column">
                                        <ul class="dropdown-items-list">
                                            <li>
                                                <a href="./organic-marketing" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Organic Marketing</h4>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./paid-marketing" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Paid Marketing</h4>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./website-development" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Website Development</h4>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./branding" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Branding</h4>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./inside-sales" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Inside Sales</h4>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="./creative" class="dropdown-link">
                                                    <h4 class="dropdown-item-heading">Creative</h4>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Company Dropdown -->
                    <li class="nav-item">
                        <span class="nav-link">Resources🔻</span>
                        <div class="dropdown-container">
                            <div class="dropdown-content-main">
                                <ul class="dropdown-items-list">
                                    <li><a href="/blogs" class="dropdown-link"><h4 class="dropdown-item-heading">Blogs</h4></a></li>
                                    <li><a href="/case-studies" class="dropdown-link"><h4 class="dropdown-item-heading">Case Studies</h4></a></li>
                                    <li><a href="/faqs" class="dropdown-link"><h4 class="dropdown-item-heading">FAQs</h4></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Company Dropdown -->
                    <li class="nav-item">
                        <span class="nav-link">About Us</span>
                        <div class="dropdown-container">
                            <div class="dropdown-content-main">
                                <ul class="dropdown-items-list">
                                    <li><a href="/about-us" class="dropdown-link"><h4 class="dropdown-item-heading">Who we are</h4></a></li>
                                    <li><a href="/our-team" class="dropdown-link"><h4 class="dropdown-item-heading">Our Team</h4></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item"><a href="/contact" class="nav-link">Contact Us</a></li>
                </ul>

                <!-- Download Button with Dropdown -->
                <div class="btn-download-wrapper">
                    <a href="/online-meeting" class="btn-primary">
                        <span>Schedule a Call</span><svg class="icon-arrow-up" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="7" y1="17" x2="17" y2="7"></line>
                        <polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                    </a>
                </div>
            </div>

            <!-- Hamburger Menu Button (Mobile) -->
            <button class="hamburger-btn" id="hamburgerBtn" aria-label="Toggle menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileOverlay"></div>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav" id="mobileNav">
        <ul class="mobile-nav-list">
            <!-- Solutions with Dropdown -->
            <li class="mobile-nav-item" data-dropdown="solutions">
                <a href="#" class="mobile-nav-link mobile-dropdown-trigger">
                    Solutions
                    <span class="mobile-dropdown-arrow"></span>
                </a>
                <div class="mobile-dropdown">
                    <ul class="mobile-dropdown-list">
                        <li>
                            <a href="/organic-marketing" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Organic Marketing</div>
                            </a>
                        </li>
                        <li>
                            <a href="/paid-marketing" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Paid Marketing</div>
                            </a>
                        </li>
                        <li>
                            <a href="/website-development" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Website Development</div>
                            </a>
                        </li>
                        <li>
                            <a href="/branding" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Branding</div>
                            </a>
                        </li>
                        <li>
                            <a href="/inside-sales" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Inside Sales</div>
                            </a>
                        </li>
                        <li>
                            <a href="/creative" class="mobile-dropdown-link">
                                <div class="mobile-dropdown-heading">Creative</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="mobile-nav-item">
                <a href="/pricing" class="mobile-nav-link mobile-direct-link">Pricing</a>
            </li>

            <!-- Resources with Dropdown -->
            <li class="mobile-nav-item" data-dropdown="resources">
                <a href="#" class="mobile-nav-link mobile-dropdown-trigger">
                    Resources
                    <span class="mobile-dropdown-arrow"></span>
                </a>
                <div class="mobile-dropdown">
                    <ul class="mobile-dropdown-list">
                        <li><a href="/blogs" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">Blogs</div></a></li>
                        <li><a href="/news" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">News</div></a></li>
                        <li><a href="/case-studies" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">Case Studies</div></a></li>
                        <li><a href="/faqs" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">FAQs</div></a></li>
                        <li><a href="/contact" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">Contact</div></a></li>
                        <li><a href="/testimonials" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">Testimonials</div></a></li>
                    </ul>
                </div>
            </li>

            <!-- Who we are with Dropdown -->
            <li class="mobile-nav-item" data-dropdown="company">
                <a href="#" class="mobile-nav-link mobile-dropdown-trigger">
                    Who we are
                    <span class="mobile-dropdown-arrow"></span>
                </a>
                <div class="mobile-dropdown">
                    <ul class="mobile-dropdown-list">
                        <li><a href="/about-us" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">About Us</div></a></li>
                        <li><a href="/our-team" class="mobile-dropdown-link"><div class="mobile-dropdown-heading">Our Team</div></a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <!-- Mobile CTA -->
        <div class="mobile-cta-wrapper">
            <a href="/online-meeting" class="mobile-cta-btn">Schedule a Call</a>
        </div>
    </nav>
</section>

<script>
    // Mobile Menu Toggle Functionality
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileNav = document.getElementById('mobileNav');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const body = document.body;

    // Toggle mobile menu
    function toggleMobileMenu() {
        hamburgerBtn.classList.toggle('active');
        mobileNav.classList.toggle('active');
        mobileOverlay.classList.toggle('active');
        body.classList.toggle('mobile-menu-open');
    }

    // Close mobile menu
    function closeMobileMenu() {
        hamburgerBtn.classList.remove('active');
        mobileNav.classList.remove('active');
        mobileOverlay.classList.remove('active');
        body.classList.remove('mobile-menu-open');
    }

    // Event listeners
    hamburgerBtn.addEventListener('click', toggleMobileMenu);
    mobileOverlay.addEventListener('click', closeMobileMenu);

    // Mobile dropdown toggles
    const mobileNavItems = document.querySelectorAll('.mobile-nav-item[data-dropdown]');
    
    mobileNavItems.forEach(item => {
        const trigger = item.querySelector('.mobile-dropdown-trigger');
        
        if (trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other dropdowns
                mobileNavItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('expanded');
                    }
                });
                
                // Toggle current dropdown
                item.classList.toggle('expanded');
            });
        }
    });

    // Close mobile menu ONLY when clicking on direct navigation links
    const directLinks = document.querySelectorAll('.mobile-direct-link, .mobile-dropdown-link, .mobile-cta-btn');
    directLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Allow the link to navigate, then close the menu
            setTimeout(closeMobileMenu, 100);
        });
    });

    // Close menu on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            closeMobileMenu();
        }
    });
</script>