<?php
/**
 * Mahathi Infotech theme functions.
 *
 * Layout
 * ─────────────────────────────────────────────────────────────────
 *   inc/helpers.php  template helpers (mh_*) used by the page templates
 *   inc/components.php  shared component logic (solution links, mobile cards, tabs)
 *   inc/router.php   route table -> /pages front controller
 *   inc/seo.php      title / meta / Open Graph / JSON-LD, robots.txt, sitemap.xml
 *   inc/setup.php    theme supports, <head> clean-up, stylesheet + script loading
 *   inc/contact.php  "Get in touch" form back end (admin-ajax)
 *   inc/leads.php    lead dashboard back end: submissions table, notes, access, AJAX, CSV export
 *   inc/whatsapp.php new leads posted to a WhatsApp group (Green API; credentials in wp-config-secrets.php)
 *   inc/pas-finder.php  PAS Migration Problem Finder tool: scoring, results e-mail, lead capture
 *   inc/routes.php, inc/styles.php, inc/data/*.php   route, CSS and content data
 *
 * Everything below the includes is the pre-existing back end that is kept as
 * is: security headers, the legacy submissions table, IP/location helpers, the
 * dashboard page auto-create, SMTP configuration and SVG upload hardening.
 *
 * @package Mahathi
 */

define( 'MH_THEME_DIR', get_template_directory() );

require_once MH_THEME_DIR . '/inc/helpers.php';
require_once MH_THEME_DIR . '/inc/components.php';
require_once MH_THEME_DIR . '/inc/router.php';
require_once MH_THEME_DIR . '/inc/seo.php';
require_once MH_THEME_DIR . '/inc/setup.php';
require_once MH_THEME_DIR . '/inc/contact.php';
require_once MH_THEME_DIR . '/inc/leads.php';
require_once MH_THEME_DIR . '/inc/whatsapp.php';
require_once MH_THEME_DIR . '/inc/pas-finder.php';


// ─────────────────────────────────────────────
// 0. SECURITY HEADERS
// ─────────────────────────────────────────────
add_action( 'send_headers', 'salesnanny_add_security_headers' );
function salesnanny_add_security_headers() {
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    header_remove( 'X-Powered-By' );
}

remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// ─────────────────────────────────────────────
// 2. SEO OPTIONS (meta box for pages / posts)
// ─────────────────────────────────────────────
require_once get_template_directory() . '/seo-options.php';

// ─────────────────────────────────────────────
// 11. CONTACT TABLE SETUP
// ─────────────────────────────────────────────
function salesnanny_create_contact_table() {
    global $wpdb;
    $table_name      = $wpdb->prefix . 'contact_submissions';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        full_name tinytext NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20),
        company tinytext,
        request_type varchar(50) NOT NULL,
        message text NOT NULL,
        submission_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45),
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
add_action( 'after_setup_theme', 'salesnanny_create_contact_table' );

// ─────────────────────────────────────────────
// 12. IP ADDRESS HELPER
// ─────────────────────────────────────────────
function get_client_ip_address() {
    $remote = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) &&
         filter_var( $_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP ) ) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        foreach ( explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] ) as $ip ) {
            $ip = trim( $ip );
            if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
                return $ip;
            }
        }
    }
    return filter_var( $remote, FILTER_VALIDATE_IP ) ? $remote : 'unknown';
}

// ─────────────────────────────────────────────
// 13. BROWSER INFO
// ─────────────────────────────────────────────
function get_browser_info() {
    return wp_json_encode( [
        'user_agent'      => sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' ),
        'accept_language' => sanitize_text_field( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '' ),
        'accept_encoding' => sanitize_text_field( $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '' ),
    ] );
}

// ─────────────────────────────────────────────
// 14. LOCATION FROM IP
// ─────────────────────────────────────────────
function get_location_from_ip( $ip_address ) {
    if ( 'unknown' === $ip_address ||
         false === filter_var( $ip_address, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
        return 'Local/Private IP';
    }
    if ( ! defined( 'IPINFO_TOKEN' ) || empty( IPINFO_TOKEN ) ) {
        return 'Location unavailable';
    }
    $api_url  = "https://ipinfo.io/{$ip_address}?token=" . IPINFO_TOKEN;
    $context  = stream_context_create( [ 'http' => [ 'timeout' => 5, 'user_agent' => 'Mahathi/1.0' ] ] );
    $response = @file_get_contents( $api_url, false, $context );
    if ( false === $response ) return 'Location unavailable';
    $data  = json_decode( $response, true );
    $parts = array_filter( [ $data['city'] ?? '', $data['region'] ?? '', $data['country'] ?? '' ] );
    return $parts ? implode( ', ', $parts ) : 'Location unavailable';
}

// ─────────────────────────────────────────────
// 16. SVG UPLOAD — HARDENED
// ─────────────────────────────────────────────
function enable_svg_upload_for_admin( $mimes ) {
    if ( current_user_can( 'administrator' ) ) $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload_for_admin' );

function salesnanny_safe_svg_check( $data, $file, $filename, $mimes ) {
    $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    if ( 'svg' !== $ext ) return $data;
    if ( ! current_user_can( 'administrator' ) ) { $data['ext'] = false; $data['type'] = false; return $data; }
    $handle  = fopen( $file, 'rb' );
    $content = $handle ? fread( $handle, 1024 ) : '';
    if ( $handle ) fclose( $handle );
    if ( false === strpos( strtolower( $content ), '<svg' ) && false === strpos( strtolower( $content ), '<?xml' ) ) {
        $data['ext'] = false; $data['type'] = false; return $data;
    }
    $data['type'] = 'image/svg+xml';
    $data['ext']  = 'svg';
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'salesnanny_safe_svg_check', 10, 4 );

// ─────────────────────────────────────────────
// 23. DASHBOARD PAGE AUTO-CREATE
// ─────────────────────────────────────────────
function create_dashboard_page() {
    if ( ! get_page_by_path( 'contact-dashboard' ) ) {
        $page_id = wp_insert_post( [ 'post_title' => 'Contact Dashboard', 'post_content' => '', 'post_status' => 'publish', 'post_type' => 'page', 'post_name' => 'contact-dashboard', 'page_template' => 'contact-dashboard.php' ] );
        if ( $page_id ) update_post_meta( $page_id, '_wp_page_template', 'contact-dashboard.php' );
    }
}
add_action( 'after_setup_theme', 'create_dashboard_page' );

// ─────────────────────────────────────────────
// 29. SMTP CONFIGURATION
// ─────────────────────────────────────────────
/*
 * Add to wp-config.php:
 *   define('WPTS_SMTP_HOST',      'smtp.example.com');
 *   define('WPTS_SMTP_AUTH',      true);
 *   define('WPTS_SMTP_PORT',      587);
 *   define('WPTS_SMTP_USER',      'user@example.com');
 *   define('WPTS_SMTP_PASS',      'password');
 *   define('WPTS_SMTP_SECURE',    'tls');
 *   define('WPTS_SMTP_FROM',      'hello@mahathiinfotech.com');
 *   define('WPTS_SMTP_FROM_NAME', 'Mahathi Infotech');
 *   define('IPINFO_TOKEN',        'your_ipinfo_token');
 *   define('TEAMS_TENANT_ID',     'your_tenant_id');
 *   define('TEAMS_CLIENT_ID',     'your_client_id');
 *   define('TEAMS_CLIENT_SECRET', 'your_client_secret');
 */
function scheduler_theme_configure_smtp( $phpmailer ) {
    if ( ! defined( 'WPTS_SMTP_HOST' ) || ! defined( 'WPTS_SMTP_USER' ) || ! defined( 'WPTS_SMTP_PASS' ) ) return;
    $phpmailer->isSMTP();
    $phpmailer->Host       = WPTS_SMTP_HOST;
    $phpmailer->SMTPAuth   = defined( 'WPTS_SMTP_AUTH' )    ? WPTS_SMTP_AUTH    : true;
    $phpmailer->Port       = defined( 'WPTS_SMTP_PORT' )    ? WPTS_SMTP_PORT    : 587;
    $phpmailer->Username   = WPTS_SMTP_USER;
    $phpmailer->Password   = WPTS_SMTP_PASS;
    $phpmailer->SMTPSecure = defined( 'WPTS_SMTP_SECURE' )  ? WPTS_SMTP_SECURE  : 'tls';
    $phpmailer->From       = defined( 'WPTS_SMTP_FROM' )    ? WPTS_SMTP_FROM    : WPTS_SMTP_USER;
    $phpmailer->FromName   = defined( 'WPTS_SMTP_FROM_NAME' ) ? WPTS_SMTP_FROM_NAME : 'Mahathi Infotech';
    if ( defined( 'WPTS_DISABLE_SSL_VERIFY' ) && WPTS_DISABLE_SSL_VERIFY ) {
        $phpmailer->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ] ];
    }
}
add_action( 'phpmailer_init', 'scheduler_theme_configure_smtp' );
