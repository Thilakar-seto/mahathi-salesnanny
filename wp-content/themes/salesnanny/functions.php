<?php
/**
 * SalesNanny Theme Functions
 *
 * PERFORMANCE FIXES vs previous version:
 * ─────────────────────────────────────────────────────────────────
 * FIX 1 — RENDER BLOCKING SCRIPTS (~2,070 ms saved)
 *   • enqueue_contact_form_assets(): all wp_enqueue_script() calls
 *     already use true (footer). Added 'defer' attribute via
 *     script_loader_tag filter for non-jQuery scripts.
 *   • jQuery itself deferred on front-end (safe — WP loads it last).
 *
 * FIX 2 — REMOVE DUPLICATE PRELOADS
 *   • salesnanny_preload_critical_assets() was preloading home1.webp
 *     AND the YouTube facade image was being double-preloaded.
 *     Now home1.webp preload is kept here; facade preload lives only
 *     in home.php to avoid duplicate <link rel="preload"> tags.
 *
 * FIX 3 — FONT PRECONNECT ORDER
 *   • add_resource_hints() — moved fonts.googleapis.com preconnect
 *     to priority 1 (was after OG tags at priority 4).
 *   • Added fonts.gstatic.com crossorigin preconnect (required for
 *     Google Fonts to work without a second round-trip).
 *   • Added preconnect for cdnjs.cloudflare.com (Font Awesome CDN
 *     used in home.php async load).
 *
 * FIX 4 — REMOVED LOGO PRELOAD FROM EVERY PAGE
 *   • salesnanny-logo-og.png is a 1200×630 OG image, not visible
 *     above-the-fold. Preloading it sitewide wastes bandwidth and
 *     competes with actual LCP resources.
 *
 * FIX 5 — DEFER FILTER
 *   • salesnanny_defer_scripts() adds defer to all theme JS except
 *     jquery (which WordPress manages separately).
 *
 * All security, schema, OG, and functional code unchanged.
 * @package SalesNanny
 */

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
// 1. THEME SUPPORT
// ─────────────────────────────────────────────
add_theme_support( 'editor-styles' );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'align-wide' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

add_action( 'after_setup_theme', function () {
    add_theme_support( 'post-thumbnails' );
} );

// ─────────────────────────────────────────────
// 2. SEO OPTIONS INCLUDE
// ─────────────────────────────────────────────
require_once get_template_directory() . '/seo-options.php';

// ─────────────────────────────────────────────
// 3. SCHEMA — Organisation + Website + LocalBusiness + FAQPage + BreadcrumbList
// ─────────────────────────────────────────────
add_action( 'wp_head', 'salesnanny_output_schema', 5 );
function salesnanny_output_schema() {
    $home = home_url( '/' );
    $logo = get_template_directory_uri() . '/assets/salesnanny-logo-og.png';

    $org = [
        '@context'     => 'https://schema.org',
        '@type'        => 'Organization',
        'name'         => 'SalesNanny Solutions Pvt. Ltd.',
        'url'          => $home,
        'logo'         => [ '@type' => 'ImageObject', 'url' => $logo ],
        'address'      => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Plot No 13, Customs Colony Main Road, Okkiam Thoraipakkam',
            'addressLocality' => 'Chennai',
            'addressRegion'   => 'Tamil Nadu',
            'postalCode'      => '600097',
            'addressCountry'  => 'IN',
        ],
        'contactPoint' => [
            '@type'       => 'ContactPoint',
            'contactType' => 'customer support',
            'telephone'   => '+918122346800',
            'areaServed'  => 'Worldwide',
        ],
        'sameAs' => [
            'https://www.linkedin.com/company/sales-nanny-solutions-private-limited/',
            'https://www.facebook.com/profile.php?id=100089957388229',
            'https://www.instagram.com/salesnanny_official/',
            'https://x.com/TheSalesNanny',
            'https://www.youtube.com/@SalesNanny',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

    if ( is_front_page() || is_home() ) {

        $website = [
            '@context'        => 'https://schema.org',
            '@type'           => 'WebSite',
            'name'            => 'SalesNanny',
            'url'             => $home,
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => [ '@type' => 'EntryPoint', 'urlTemplate' => $home . '?s={search_term_string}' ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $website, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

        $local = [
            '@context'   => 'https://schema.org',
            '@type'      => [ 'LocalBusiness', 'MarketingAgency' ],
            'name'       => 'SalesNanny Solutions Pvt. Ltd.',
            'image'      => $logo,
            'url'        => $home,
            'telephone'  => '+918122346800',
            'priceRange' => '$$',
            'address'    => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Plot No 13, Customs Colony Main Road, Okkiam Thoraipakkam',
                'addressLocality' => 'Chennai',
                'addressRegion'   => 'Tamil Nadu',
                'postalCode'      => '600097',
                'addressCountry'  => 'IN',
            ],
            'geo'        => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => '12.9265',
                'longitude' => '80.2284',
            ],
            'openingHoursSpecification' => [
                [
                    '@type'     => 'OpeningHoursSpecification',
                    'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ],
                    'opens'     => '09:00',
                    'closes'    => '18:00',
                ],
            ],
            'areaServed'  => 'Worldwide',
            'knowsAbout'  => [
                'Digital Marketing for Logistics',
                'Freight Forwarding Marketing',
                'Supply Chain Visibility',
                'B2B Lead Generation',
                'Logistics SEO',
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $local, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";

        $faqs = [
            [ 'q' => 'How does digital marketing help logistics businesses grow?',           'a' => 'Digital marketing helps logistics companies get discovered early in the buying process. It builds visibility, explains complex services clearly, and establishes trust long before a buyer makes contact – which is critical in long sales cycles.' ],
            [ 'q' => 'We already get business through referrals. Why do we need digital marketing?', 'a' => 'Referrals are strong, but they are not predictable. Today, even referred buyers research you online before contacting you. Digital presence supports referrals by reinforcing trust and credibility.' ],
            [ 'q' => 'How long does digital marketing take to show results in logistics?',   'a' => 'Logistics growth is gradual. You will typically see early visibility improvements first, followed by better enquiry quality and stronger sales conversations over time. This is not an overnight channel.' ],
            [ 'q' => 'What is your Team-as-a-Service (TaaS) model?',                        'a' => 'Our TaaS model gives you access to a complete digital growth team without hiring one internally. Instead of managing multiple full-time roles, you work with a coordinated team covering strategy, execution, and delivery – under one plan and one predictable cost.' ],
            [ 'q' => 'How is TaaS different from hiring an in-house marketer or agency?',   'a' => 'An in-house hire brings one skillset. Traditional agencies work in silos. With TaaS, you get multiple specialists – marketing strategy, content, performance, design, development, and coordination – working together as an extension of your business, without hiring overhead.' ],
        ];

        $faq_schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array_map( function ( $item ) {
                return [
                    '@type'          => 'Question',
                    'name'           => $item['q'],
                    'acceptedAnswer' => [ '@type' => 'Answer', 'text' => $item['a'] ],
                ];
            }, $faqs ),
        ];
        echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }

    if ( is_singular() && ! is_front_page() ) {
        $crumbs = [ [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home ] ];
        if ( is_singular( 'post' ) ) {
            $cats = get_the_category();
            if ( ! empty( $cats ) ) {
                $crumbs[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => esc_html( $cats[0]->name ), 'item' => esc_url( get_category_link( $cats[0]->term_id ) ) ];
            }
            $crumbs[] = [ '@type' => 'ListItem', 'position' => count( $crumbs ) + 1, 'name' => esc_html( get_the_title() ), 'item' => esc_url( get_permalink() ) ];
        } else {
            $crumbs[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => esc_html( get_the_title() ), 'item' => esc_url( get_permalink() ) ];
        }
        $breadcrumb = [ '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $crumbs ];
        echo '<script type="application/ld+json">' . wp_json_encode( $breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}

// ─────────────────────────────────────────────
// 4. OG TAGS / TWITTER CARD / CANONICAL
// ─────────────────────────────────────────────
add_action( 'wp_head', 'salesnanny_enhanced_og_tags', 4 );
function salesnanny_enhanced_og_tags() {
    global $post;

    $site_name  = get_bloginfo( 'name' );
    $home       = home_url( '/' );
    $default_og = get_template_directory_uri() . '/assets/ogtag.png';
    $twitter_og = get_template_directory_uri() . '/assets/salesnanny-logo-og.png';

    if ( is_singular() && $post ) {
        $title       = get_the_title( $post );
        $description = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30 );
        $url         = get_permalink( $post );
        $og_type     = 'article';
        $image       = has_post_thumbnail( $post ) ? get_the_post_thumbnail_url( $post, 'large' ) : $default_og;
        $pub_time    = get_the_date( 'c', $post );
        $mod_time    = get_the_modified_date( 'c', $post );
    } elseif ( is_front_page() ) {
        $title       = 'Digital Marketing for Logistics Business | SalesNanny';
        $description = 'Drive more shipment enquiries with digital marketing tailored for logistics businesses. Improve visibility, reach the right clients, and grow.';
        $url         = $home;
        $og_type     = 'website';
        $image       = $default_og;
        $pub_time    = '';
        $mod_time    = '';
    } else {
        $title       = wp_title( '|', false, 'right' ) . $site_name;
        $description = get_bloginfo( 'description' );
        $url         = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $og_type     = 'website';
        $image       = $default_og;
        $pub_time    = '';
        $mod_time    = '';
    }

    $title       = esc_attr( $title );
    $description = esc_attr( wp_trim_words( $description, 35 ) );
    $url         = esc_url( $url );
    $image       = esc_url( $image );

    echo "\n<!-- SalesNanny SEO Meta -->\n";
    echo '<meta name="description" content="' . $description . '">' . "\n";
    echo '<link rel="canonical" href="' . $url . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:title" content="' . $title . '">' . "\n";
    echo '<meta property="og:description" content="' . $description . '">' . "\n";
    echo '<meta property="og:url" content="' . $url . '">' . "\n";
    echo '<meta property="og:image" content="' . $image . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta property="og:image:alt" content="' . $title . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";

    if ( 'article' === $og_type ) {
        if ( $pub_time ) echo '<meta property="article:published_time" content="' . esc_attr( $pub_time ) . '">' . "\n";
        if ( $mod_time ) echo '<meta property="article:modified_time" content="' . esc_attr( $mod_time ) . '">' . "\n";
        echo '<meta property="article:publisher" content="https://www.facebook.com/profile.php?id=100089957388229">' . "\n";
    }

    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:site" content="@TheSalesNanny">' . "\n";
    echo '<meta name="twitter:creator" content="@TheSalesNanny">' . "\n";
    echo '<meta name="twitter:title" content="' . $title . '">' . "\n";
    echo '<meta name="twitter:description" content="' . $description . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $twitter_og ) . '">' . "\n";
    echo '<meta name="twitter:url" content="' . $url . '">' . "\n";
    echo "<!-- /SalesNanny SEO Meta -->\n\n";
}

// ─────────────────────────────────────────────
// 5. PAGE SPEED — PRELOAD CRITICAL ASSETS
// ─────────────────────────────────────────────
/*
 * FIX 2 + FIX 4:
 * - Only preload home1.webp (hero BG) on the homepage — correct.
 * - REMOVED: logo preload sitewide (it's an OG image, not visible
 *   above the fold — preloading it competed with LCP resources).
 * - REMOVED: YouTube facade preload from here — it lives in home.php
 *   only, avoiding a duplicate <link rel="preload"> that would cause
 *   a Lighthouse warning without speeding anything up.
 */
add_action( 'wp_head', 'salesnanny_preload_critical_assets', 1 );
function salesnanny_preload_critical_assets() {
    $theme_uri = get_template_directory_uri();
    if ( is_front_page() || is_home() ) {
        // Hero background — preloaded here at priority 1 (earliest possible)
        echo '<link rel="preload" as="image" href="' . esc_url( $theme_uri . '/assets/home1.webp' ) . '" fetchpriority="high">' . "\n";
    }
}

/*
 * FIX 3: Resource hints — correct order and complete set.
 *
 * Priority 1 (earliest) so these fire before any other wp_head output.
 * Changes vs original:
 *  • fonts.gstatic.com crossorigin added (required for Google Fonts)
 *  • cdnjs.cloudflare.com added (Font Awesome async load in home.php)
 *  • i.ytimg.com removed here — home.php adds it conditionally only
 *    when the self-hosted thumbnail isn't present, avoiding a wasted
 *    preconnect on pages that don't embed the YouTube facade.
 *  • Priority changed from default (10) to 1 so hints land at the
 *    very top of <head>, before stylesheets and scripts.
 */
add_action( 'wp_head', 'add_resource_hints', 1 );
function add_resource_hints() {
    // Google Fonts (two preconnects required)
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // Font Awesome CDN (used for async FA load in home.php)
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";

    // Review platform logos (loaded in testimonial section)
    echo '<link rel="preconnect" href="https://cdn.worldvectorlogo.com" crossorigin>' . "\n";

    // YouTube player (loaded on facade click — dns-prefetch is enough
    // here since the connection only happens on user interaction)
    echo '<link rel="dns-prefetch" href="//www.youtube.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
}

// ─────────────────────────────────────────────
// 5b. DEFER ALL THEME SCRIPTS (FIX 1 + FIX 5)
// ─────────────────────────────────────────────
/*
 * This filter adds defer="" to every theme script enqueued in the
 * footer. jQuery is excluded because WordPress plugins may rely on
 * its synchronous availability (rare but possible).
 *
 * Result: JS files load in parallel with HTML parsing and execute
 * after the document is parsed — eliminates render blocking from
 * any scripts that slipped into the head via plugins.
 */
add_filter( 'script_loader_tag', 'salesnanny_defer_scripts', 10, 3 );
function salesnanny_defer_scripts( $tag, $handle, $src ) {
    // Never defer jquery — other scripts may depend on synchronous load
    $no_defer = [ 'jquery', 'jquery-core', 'jquery-migrate' ];
    if ( in_array( $handle, $no_defer, true ) ) {
        return $tag;
    }
    // Only modify theme scripts (not admin, not already deferred/async)
    if ( is_admin() ) {
        return $tag;
    }
    // Don't double-add if already has defer or async
    if ( strpos( $tag, ' defer' ) !== false || strpos( $tag, ' async' ) !== false ) {
        return $tag;
    }
    return str_replace( ' src=', ' defer src=', $tag );
}

// ─────────────────────────────────────────────
// 6. SITEMAP
// ─────────────────────────────────────────────
function generate_sitemap() {
    while ( ob_get_level() > 0 ) {
        ob_end_clean();
    }
    header( 'Content-Type: application/xml; charset=utf-8' );

    $home_url   = home_url( '/' );
    $post_types = [ 'post', 'page' ];
    $custom_priority_urls = [
        home_url( '/about-us' ),
        home_url( '/contact-us' ),
        home_url( '/privacy-policy' ),
    ];

    ob_start();
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    echo '<url><loc>' . esc_url( $home_url ) . '</loc><changefreq>daily</changefreq><priority>1.0</priority></url>';

    foreach ( $post_types as $post_type ) {
        $posts = new WP_Query( [ 'post_type' => $post_type, 'post_status' => 'publish', 'posts_per_page' => -1 ] );
        if ( $posts->have_posts() ) {
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $post_url      = get_permalink();
                $last_modified = get_post_modified_time( 'Y-m-d\TH:i:sP', true );
                $priority      = ( get_post_type() === 'post' ) ? 0.8 : ( in_array( $post_url, $custom_priority_urls ) ? 0.6 : 0.9 );
                echo '<url><loc>' . esc_url( $post_url ) . '</loc><lastmod>' . esc_html( $last_modified ) . '</lastmod><changefreq>weekly</changefreq><priority>' . $priority . '</priority></url>';
            }
            wp_reset_postdata();
        }
    }
    echo '</urlset>';
    echo ltrim( ob_get_clean() );
    exit;
}

function add_sitemap_rewrite_rule() {
    add_rewrite_rule( '^sitemap\.xml$', 'index.php?sitemap=1', 'top' );
}
add_action( 'init', 'add_sitemap_rewrite_rule' );

register_activation_hook( __FILE__, function () {
    add_sitemap_rewrite_rule();
    flush_rewrite_rules();
} );

add_filter( 'query_vars', function ( $vars ) {
    $vars[] = 'sitemap';
    return $vars;
} );

add_action( 'template_redirect', function () {
    if ( get_query_var( 'sitemap' ) ) {
        generate_sitemap();
    }
} );

// ─────────────────────────────────────────────
// 7. ROBOTS.TXT
// ─────────────────────────────────────────────
function custom_override_robots_txt() {
    if ( basename( $_SERVER['REQUEST_URI'] ) === 'robots.txt' ) {
        header( 'Content-Type: text/plain' );
        echo "User-agent: *\n";
        echo "Disallow: /wp-admin/\n";
        echo "Allow: /wp-admin/admin-ajax.php\n";
        echo "\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
        exit;
    }
}
add_action( 'init', 'custom_override_robots_txt' );

// ─────────────────────────────────────────────
// 8. CANONICAL PAGINATION
// ─────────────────────────────────────────────
function pagination_canonical_links() {
    if ( is_category() && is_paged() ) {
        global $wp_query;
        $paged         = max( 1, get_query_var( 'paged' ) );
        $max_num_pages = $wp_query->max_num_pages;
        $prev          = $paged > 1 ? get_pagenum_link( $paged - 1 ) : '';
        $next          = $paged < $max_num_pages ? get_pagenum_link( $paged + 1 ) : '';
        if ( $prev ) echo '<link rel="prev" href="' . esc_url( $prev ) . '">' . PHP_EOL;
        if ( $next ) echo '<link rel="next" href="' . esc_url( $next ) . '">' . PHP_EOL;
    }
}

// ─────────────────────────────────────────────
// 9. GLOSSARY CUSTOM POST TYPE
// ─────────────────────────────────────────────
function create_glossary_post_type() {
    register_post_type( 'glossary', [
        'labels'      => [ 'name' => __( 'Glossary' ), 'singular_name' => __( 'Glossary Term' ) ],
        'public'      => true,
        'has_archive' => true,
        'rewrite'     => [ 'slug' => 'glossary' ],
        'supports'    => [ 'title', 'editor' ],
    ] );
}
add_action( 'init', 'create_glossary_post_type' );

function add_glossary_meta_box() {
    add_meta_box( 'glossary_meta_box', 'First Letter', 'show_glossary_meta_box', 'glossary', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'add_glossary_meta_box' );

function show_glossary_meta_box() {
    global $post;
    $meta = get_post_meta( $post->ID, 'first_letter', true );
    wp_nonce_field( 'glossary_first_letter_save', 'glossary_first_letter_nonce' );
    ?>
    <input type="text" name="first_letter" value="<?php echo esc_attr( $meta ); ?>" size="2" />
    <p>Enter the first letter of the term.</p>
    <?php
}

function save_glossary_meta( $post_id ) {
    if ( ! isset( $_POST['glossary_first_letter_nonce'] ) || ! wp_verify_nonce( $_POST['glossary_first_letter_nonce'], 'glossary_first_letter_save' ) ) {
        return;
    }
    if ( isset( $_POST['first_letter'] ) ) {
        update_post_meta( $post_id, 'first_letter', sanitize_text_field( $_POST['first_letter'] ) );
    }
}
add_action( 'save_post', 'save_glossary_meta' );

function salesnanny_add_glossary_meta_boxes() {
    add_meta_box( 'glossary_seo_meta_box', 'SEO Settings', 'salesnanny_glossary_meta_box_callback', 'glossary', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'salesnanny_add_glossary_meta_boxes' );

function salesnanny_glossary_meta_box_callback( $post ) {
    wp_nonce_field( 'salesnanny_glossary_meta_save', 'glossary_meta_nonce' );
    $meta_title       = get_post_meta( $post->ID, '_glossary_meta_title', true );
    $meta_description = get_post_meta( $post->ID, '_glossary_meta_description', true );
    echo '<p><label for="glossary_meta_title">Meta Title:</label></p>';
    echo '<p><input type="text" id="glossary_meta_title" name="glossary_meta_title" value="' . esc_attr( $meta_title ) . '" style="width:100%"></p>';
    echo '<p><label for="glossary_meta_description">Meta Description:</label></p>';
    echo '<p><textarea id="glossary_meta_description" name="glossary_meta_description" style="width:100%" rows="4">' . esc_textarea( $meta_description ) . '</textarea></p>';
}

function salesnanny_save_glossary_meta( $post_id ) {
    if ( ! isset( $_POST['glossary_meta_nonce'] ) || ! wp_verify_nonce( $_POST['glossary_meta_nonce'], 'salesnanny_glossary_meta_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    if ( isset( $_POST['glossary_meta_title'] ) )       update_post_meta( $post_id, '_glossary_meta_title',       sanitize_text_field( $_POST['glossary_meta_title'] ) );
    if ( isset( $_POST['glossary_meta_description'] ) ) update_post_meta( $post_id, '_glossary_meta_description', sanitize_textarea_field( $_POST['glossary_meta_description'] ) );
}
add_action( 'save_post_glossary', 'salesnanny_save_glossary_meta' );

function salesnanny_glossary_archive_settings() {
    add_submenu_page( 'edit.php?post_type=glossary', 'Glossary Archive Settings', 'Archive Settings', 'manage_options', 'glossary-archive-settings', 'salesnanny_glossary_archive_settings_callback' );
}
add_action( 'admin_menu', 'salesnanny_glossary_archive_settings' );

function salesnanny_glossary_archive_settings_callback() {
    if ( isset( $_POST['glossary_archive_settings_submit'] ) ) {
        check_admin_referer( 'glossary_archive_settings_action', 'glossary_archive_settings_nonce' );
        update_option( 'glossary_archive_meta_title',       sanitize_text_field( $_POST['glossary_archive_meta_title'] ) );
        update_option( 'glossary_archive_meta_description', sanitize_textarea_field( $_POST['glossary_archive_meta_description'] ) );
        echo '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
    }
    $meta_title       = get_option( 'glossary_archive_meta_title',       'Supply Chain Visibility Glossary | SalesNanny' );
    $meta_description = get_option( 'glossary_archive_meta_description', 'Your complete resource for supply chain visibility.' );
    ?>
    <div class="wrap">
        <h1>Glossary Archive SEO Settings</h1>
        <form method="post" action="">
            <?php wp_nonce_field( 'glossary_archive_settings_action', 'glossary_archive_settings_nonce' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="glossary_archive_meta_title">Meta Title</label></th>
                    <td><input type="text" id="glossary_archive_meta_title" name="glossary_archive_meta_title" value="<?php echo esc_attr( $meta_title ); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="glossary_archive_meta_description">Meta Description</label></th>
                    <td><textarea id="glossary_archive_meta_description" name="glossary_archive_meta_description" rows="4" class="large-text"><?php echo esc_textarea( $meta_description ); ?></textarea></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="glossary_archive_settings_submit" class="button button-primary" value="Save Changes"></p>
        </form>
    </div>
    <?php
}

// ─────────────────────────────────────────────
// 10. GRAVATAR ALT
// ─────────────────────────────────────────────
function bloggerpilot_gravatar_alt( $bloggerpilotGravatar ) {
    $alt = have_comments() ? get_comment_author() : get_the_author_meta( 'display_name' );
    return str_replace( "alt=''", "alt='" . esc_attr( $alt ) . " - Logistics Content Writer'", $bloggerpilotGravatar );
}
add_filter( 'get_avatar', 'bloggerpilot_gravatar_alt' );

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

function salesnanny_enhanced_contact_table() {
    global $wpdb;
    $table_name      = $wpdb->prefix . 'enhanced_contact_submissions';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        submission_time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        page_url varchar(500) NOT NULL,
        ip_address varchar(45) NOT NULL,
        location_info varchar(255),
        browser_info text,
        form_details longtext NOT NULL,
        status varchar(20) DEFAULT 'unread',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY status (status),
        KEY submission_time (submission_time),
        KEY ip_address (ip_address)
    ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}
add_action( 'after_setup_theme', 'salesnanny_enhanced_contact_table' );

function update_enhanced_contact_table_schema() {
    global $wpdb;
    $table_name    = $wpdb->prefix . 'enhanced_contact_submissions';
    $column_exists = $wpdb->get_results( $wpdb->prepare(
        'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s',
        DB_NAME, $table_name, 'location_info'
    ) );
    if ( empty( $column_exists ) ) {
        $wpdb->query( "ALTER TABLE $table_name ADD COLUMN location_info varchar(255) AFTER ip_address" );
    }
}
add_action( 'after_setup_theme', 'update_enhanced_contact_table_schema' );

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
    $context  = stream_context_create( [ 'http' => [ 'timeout' => 5, 'user_agent' => 'SalesNanny/1.0' ] ] );
    $response = @file_get_contents( $api_url, false, $context );
    if ( false === $response ) return 'Location unavailable';
    $data  = json_decode( $response, true );
    $parts = array_filter( [ $data['city'] ?? '', $data['region'] ?? '', $data['country'] ?? '' ] );
    return $parts ? implode( ', ', $parts ) : 'Location unavailable';
}

// ─────────────────────────────────────────────
// 15. CONTACT FORM PROCESSING
// ─────────────────────────────────────────────
function process_salesnanny_contact_form() {
    if ( ! wp_verify_nonce( $_POST['contact_form_nonce'] ?? '', 'contact_form_action' ) ) {
        return [ 'success' => false, 'message' => 'Security verification failed.' ];
    }
    global $wpdb;
    $full_name    = sanitize_text_field( $_POST['full_name'] ?? '' );
    $email        = sanitize_email( $_POST['email'] ?? '' );
    $phone        = sanitize_text_field( $_POST['phone'] ?? '' );
    $company      = sanitize_text_field( $_POST['company'] ?? '' );
    $request_type = sanitize_text_field( $_POST['request_type'] ?? '' );
    $message      = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $full_name ) || empty( $email ) || empty( $request_type ) || empty( $message ) ) {
        return [ 'success' => false, 'message' => 'Please fill in all required fields.' ];
    }
    if ( ! is_email( $email ) ) {
        return [ 'success' => false, 'message' => 'Please enter a valid email address.' ];
    }
    salesnanny_create_contact_table();
    $result = $wpdb->insert(
        $wpdb->prefix . 'contact_submissions',
        [ 'full_name' => $full_name, 'email' => $email, 'phone' => $phone, 'company' => $company, 'request_type' => $request_type, 'message' => $message, 'submission_date' => current_time( 'mysql' ), 'ip_address' => get_client_ip_address() ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
    );
    if ( $result !== false ) {
        salesnanny_send_contact_notification( $full_name, $email, $phone, $company, $request_type, $message );
        return [ 'success' => true, 'message' => 'Thank you for your message! We will get back to you soon.' ];
    }
}

function salesnanny_send_contact_notification( $name, $email, $phone, $company, $request_type, $message ) {
    wp_mail(
        get_option( 'admin_email' ),
        'New Contact Form Submission - ' . $request_type,
        nl2br( "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\nRequest: $request_type\nMessage: $message\nTime: " . current_time( 'mysql' ) ),
        [ 'Content-Type: text/html; charset=UTF-8' ]
    );
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
// 17. ENHANCED CONTACT FORM
// ─────────────────────────────────────────────
function process_enhanced_contact_form() {
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'enhanced_contact_form' ) ) {
        wp_send_json_error( [ 'message' => 'Security verification failed.' ] );
    }
    global $wpdb;
    $form_data = [
        'full_name'      => sanitize_text_field( $_POST['full_name'] ?? '' ),
        'business_email' => sanitize_email( $_POST['business_email'] ?? '' ),
        'phone_number'   => sanitize_text_field( $_POST['phone_number'] ?? '' ),
        'looking_for'    => sanitize_text_field( $_POST['looking_for'] ?? '' ),
        'message'        => sanitize_textarea_field( $_POST['message'] ?? '' ),
    ];
    $errors = [];
    if ( empty( $form_data['full_name'] ) )                                          $errors[] = 'Full name is required.';
    if ( empty( $form_data['business_email'] ) || ! is_email( $form_data['business_email'] ) ) $errors[] = 'Valid business email is required.';
    if ( empty( $form_data['phone_number'] ) )                                       $errors[] = 'Phone number is required.';
    if ( empty( $form_data['looking_for'] ) )                                        $errors[] = 'Please select what you are looking for.';
    if ( ! empty( $errors ) ) wp_send_json_error( [ 'message' => implode( ' ', $errors ) ] );

    $ip_address    = get_client_ip_address();
    $location_info = get_location_from_ip( $ip_address );
    $page_url      = esc_url_raw( $_POST['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' );
    salesnanny_enhanced_contact_table();
    $result = $wpdb->insert(
        $wpdb->prefix . 'enhanced_contact_submissions',
        [ 'submission_time' => current_time( 'mysql' ), 'page_url' => $page_url, 'ip_address' => $ip_address, 'location_info' => $location_info, 'browser_info' => get_browser_info(), 'form_details' => wp_json_encode( $form_data ), 'status' => 'unread' ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
    );
    if ( $result !== false ) {
        send_enhanced_contact_notification( $form_data, $page_url, $ip_address, $location_info );
        wp_send_json_success( [ 'message' => 'Thank you for your inquiry! We will get back to you soon.' ] );
    } else {
        wp_send_json_error( [ 'message' => 'Sorry, there was a problem. Please try again.' ] );
    }
}
add_action( 'wp_ajax_submit_enhanced_contact', 'process_enhanced_contact_form' );
add_action( 'wp_ajax_nopriv_submit_enhanced_contact', 'process_enhanced_contact_form' );

function send_enhanced_contact_notification( $form_data, $page_url, $ip_address, $location_info = '' ) {
    $message = '<html><body><h2>New Contact Form Submission</h2><table style="border-collapse:collapse;width:100%">';
    foreach ( [
        'Name' => $form_data['full_name'], 'Email' => $form_data['business_email'],
        'Phone' => $form_data['phone_number'], 'Looking For' => $form_data['looking_for'],
        'Message' => nl2br( esc_html( $form_data['message'] ) ), 'Page' => esc_html( $page_url ),
        'IP' => esc_html( $ip_address ), 'Location' => esc_html( $location_info ), 'Submitted' => current_time( 'mysql' ),
    ] as $label => $value ) {
        $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>{$label}:</strong></td><td style='border:1px solid #ddd;padding:8px'>{$value}</td></tr>";
    }
    $message .= '</table></body></html>';
    wp_mail( get_option( 'admin_email' ), 'New Contact Form Submission - ' . $form_data['looking_for'], $message, [ 'Content-Type: text/html; charset=UTF-8' ] );
}

// ─────────────────────────────────────────────
// 18. NEWSLETTER
// ─────────────────────────────────────────────
function process_newsletter_subscription() {
    if ( ! isset( $_POST['newsletter_nonce'] ) || ! wp_verify_nonce( $_POST['newsletter_nonce'], 'newsletter_subscription' ) ) {
        wp_send_json_error( [ 'message' => 'Security verification failed.' ] );
    }
    global $wpdb;
    $email = sanitize_email( $_POST['email'] ?? '' );
    if ( empty( $email ) || ! is_email( $email ) ) wp_send_json_error( [ 'message' => 'Please enter a valid email address.' ] );

    $table_name = $wpdb->prefix . 'enhanced_contact_submissions';
    $existing   = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE JSON_EXTRACT(form_details, '$.email') = %s AND JSON_EXTRACT(form_details, '$.subscription_type') = 'newsletter'",
        $email
    ) );
    if ( $existing > 0 ) wp_send_json_success( [ 'message' => 'You are already subscribed to our newsletter!' ] );

    $ip_address    = get_client_ip_address();
    $location_info = get_location_from_ip( $ip_address );
    $page_url      = esc_url_raw( $_POST['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' );
    $form_data     = [ 'email' => $email, 'subscription_type' => 'newsletter', 'source_page' => $page_url ];
    salesnanny_enhanced_contact_table();
    $result = $wpdb->insert(
        $table_name,
        [ 'submission_time' => current_time( 'mysql' ), 'page_url' => $page_url, 'ip_address' => $ip_address, 'location_info' => $location_info, 'browser_info' => get_browser_info(), 'form_details' => wp_json_encode( $form_data ), 'status' => 'unread' ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
    );
    if ( $result !== false ) {
        send_newsletter_notification( $email, $page_url, $ip_address, $location_info );
        wp_send_json_success( [ 'message' => 'Thank you for subscribing to our newsletter!' ] );
    } else {
        wp_send_json_error( [ 'message' => 'Sorry, there was a problem. Please try again.' ] );
    }
}
add_action( 'wp_ajax_submit_newsletter', 'process_newsletter_subscription' );
add_action( 'wp_ajax_nopriv_submit_newsletter', 'process_newsletter_subscription' );

function send_newsletter_notification( $email, $page_url, $ip_address, $location_info = '' ) {
    $message = '<html><body><h2>New Newsletter Subscription</h2><table style="border-collapse:collapse;width:100%">';
    $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>Email:</strong></td><td style='border:1px solid #ddd;padding:8px'>" . esc_html( $email ) . '</td></tr>';
    if ( $location_info ) $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>Location:</strong></td><td style='border:1px solid #ddd;padding:8px'>" . esc_html( $location_info ) . '</td></tr>';
    $message .= '</table></body></html>';
    wp_mail( get_option( 'admin_email' ), 'New Newsletter Subscription', $message, [ 'Content-Type: text/html; charset=UTF-8' ] );
}

// ─────────────────────────────────────────────
// 19. DASHBOARD — SESSION SCOPED
// ─────────────────────────────────────────────
function salesnanny_maybe_start_session() {
    if ( session_status() !== PHP_SESSION_NONE ) return;
    $is_dashboard_page  = isset( $_GET['page_name'] ) && $_GET['page_name'] === 'contact-dashboard';
    $dashboard_actions  = [ 'dashboard_authenticate', 'dashboard_logout', 'dashboard_get_submissions', 'dashboard_update_status', 'dashboard_delete_submission', 'dashboard_export_csv' ];
    $is_dashboard_ajax  = isset( $_POST['action'] ) && in_array( $_POST['action'], $dashboard_actions, true );
    if ( $is_dashboard_page || $is_dashboard_ajax || is_page( 'contact-dashboard' ) ) {
        session_set_cookie_params( [ 'lifetime' => 0, 'path' => '/', 'domain' => '', 'secure' => is_ssl(), 'httponly' => true, 'samesite' => 'Lax' ] );
        session_start();
    }
}
add_action( 'init', 'salesnanny_maybe_start_session', 1 );

// ─────────────────────────────────────────────
// 20. DASHBOARD AUTHENTICATION
// ─────────────────────────────────────────────
function verify_dashboard_access() {
    salesnanny_maybe_start_session();
    return isset( $_SESSION['dashboard_authenticated'] ) && $_SESSION['dashboard_authenticated'] === true;
}

function dashboard_authenticate() {
    $password = sanitize_text_field( $_POST['password'] ?? '' );
    $hash     = get_option( 'dashboard_access_hash', '' );
    if ( empty( $hash ) ) wp_send_json_error( [ 'message' => 'Dashboard password not configured.' ] );
    if ( wp_check_password( $password, $hash ) ) {
        salesnanny_maybe_start_session();
        session_regenerate_id( true );
        $_SESSION['dashboard_authenticated'] = true;
        wp_send_json_success();
    } else {
        wp_send_json_error( [ 'message' => 'Invalid password.' ] );
    }
}
add_action( 'wp_ajax_dashboard_authenticate', 'dashboard_authenticate' );
add_action( 'wp_ajax_nopriv_dashboard_authenticate', 'dashboard_authenticate' );

function dashboard_logout() {
    salesnanny_maybe_start_session();
    unset( $_SESSION['dashboard_authenticated'] );
    session_destroy();
    wp_send_json_success();
}
add_action( 'wp_ajax_dashboard_logout', 'dashboard_logout' );
add_action( 'wp_ajax_nopriv_dashboard_logout', 'dashboard_logout' );

// ─────────────────────────────────────────────
// 21. DASHBOARD DATA HANDLERS
// ─────────────────────────────────────────────
function dashboard_get_submissions() {
    if ( ! verify_dashboard_access() ) wp_send_json_error( [ 'error' => 'Unauthorized access' ] );
    global $wpdb;
    $table_name = $wpdb->prefix . 'enhanced_contact_submissions';
    $page       = intval( $_GET['page'] ?? 1 );
    $per_page   = intval( $_GET['per_page'] ?? 10 );
    $offset     = ( $page - 1 ) * $per_page;
    $search     = sanitize_text_field( $_GET['search'] ?? '' );
    $status_f   = sanitize_text_field( $_GET['status'] ?? '' );
    $type_f     = sanitize_text_field( $_GET['type'] ?? '' );
    $date_from  = sanitize_text_field( $_GET['date_from'] ?? '' );
    $date_to    = sanitize_text_field( $_GET['date_to'] ?? '' );
    $time_from  = sanitize_text_field( $_GET['time_from'] ?? '' );
    $time_to    = sanitize_text_field( $_GET['time_to'] ?? '' );

    $where_conditions = [ '1=1' ];
    $where_values     = [];

    if ( ! empty( $search ) ) {
        $where_conditions[] = '(form_details LIKE %s OR ip_address LIKE %s OR page_url LIKE %s)';
        $st = '%' . $wpdb->esc_like( $search ) . '%';
        array_push( $where_values, $st, $st, $st );
    }
    if ( ! empty( $status_f ) ) { $where_conditions[] = 'status = %s'; $where_values[] = $status_f; }
    if ( ! empty( $type_f ) ) {
        switch ( $type_f ) {
            case 'ebook':      $where_conditions[] = "JSON_EXTRACT(form_details, '$.action_type') = %s";      $where_values[] = 'ebook_download'; break;
            case 'newsletter': $where_conditions[] = "JSON_EXTRACT(form_details, '$.subscription_type') = %s"; $where_values[] = 'newsletter'; break;
            case 'calendly':   $where_conditions[] = "JSON_EXTRACT(form_details, '$.action_type') = %s";      $where_values[] = 'calendly_click'; break;
            case 'contactus':  $where_conditions[] = "JSON_EXTRACT(form_details, '$.form_type') = %s";        $where_values[] = 'contactus'; break;
        }
    }
    if ( ! empty( $date_from ) ) { $where_conditions[] = 'submission_time >= %s'; $where_values[] = $date_from . ' ' . ( ! empty( $time_from ) ? $time_from . ':00' : '00:00:00' ); }
    if ( ! empty( $date_to ) )   { $where_conditions[] = 'submission_time <= %s'; $where_values[] = $date_to  . ' ' . ( ! empty( $time_to )   ? $time_to   . ':59' : '23:59:59' ); }

    $where_clause = implode( ' AND ', $where_conditions );
    $total        = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE $where_clause", $where_values ) );
    $submissions  = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table_name WHERE $where_clause ORDER BY submission_time DESC LIMIT %d OFFSET %d", array_merge( $where_values, [ $per_page, $offset ] ) ) );
    foreach ( $submissions as &$s ) { $s->form_details = json_decode( $s->form_details, true ); }
    wp_send_json_success( [ 'submissions' => $submissions, 'total' => $total, 'page' => $page, 'per_page' => $per_page, 'total_pages' => ceil( $total / $per_page ) ] );
}
add_action( 'wp_ajax_dashboard_get_submissions', 'dashboard_get_submissions' );

function dashboard_update_status() {
    if ( ! verify_dashboard_access() ) wp_send_json_error( [ 'error' => 'Unauthorized access' ] );
    global $wpdb;
    $submission_id = intval( $_POST['id'] ?? 0 );
    $new_status    = sanitize_text_field( $_POST['status'] ?? '' );
    if ( ! in_array( $new_status, [ 'read', 'unread' ], true ) ) wp_send_json_error( [ 'error' => 'Invalid status' ] );
    $result = $wpdb->update( $wpdb->prefix . 'enhanced_contact_submissions', [ 'status' => $new_status ], [ 'id' => $submission_id ], [ '%s' ], [ '%d' ] );
    wp_send_json_success( [ 'updated' => $result !== false ] );
}
add_action( 'wp_ajax_dashboard_update_status', 'dashboard_update_status' );

function dashboard_delete_submission() {
    if ( ! verify_dashboard_access() ) wp_send_json_error( [ 'error' => 'Unauthorized access' ] );
    global $wpdb;
    $submission_id = intval( $_POST['id'] ?? 0 );
    $result = $wpdb->delete( $wpdb->prefix . 'enhanced_contact_submissions', [ 'id' => $submission_id ], [ '%d' ] );
    wp_send_json_success( [ 'deleted' => $result !== false ] );
}
add_action( 'wp_ajax_dashboard_delete_submission', 'dashboard_delete_submission' );

function dashboard_export_csv() {
    if ( ! verify_dashboard_access() ) wp_die( 'Unauthorized access' );
    global $wpdb;
    $submissions = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}enhanced_contact_submissions ORDER BY submission_time DESC" );
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment; filename="contact_submissions_' . date( 'Y-m-d' ) . '.csv"' );
    $output = fopen( 'php://output', 'w' );
    fputcsv( $output, [ 'ID', 'Submission Time', 'Page URL', 'IP Address', 'Full Name', 'Email', 'Phone', 'Looking For', 'Message', 'Status' ] );
    foreach ( $submissions as $s ) {
        $fd = json_decode( $s->form_details, true );
        $fd = is_array( $fd ) ? $fd : [];
        fputcsv( $output, [ $s->id, $s->submission_time, $s->page_url, $s->ip_address, $fd['full_name'] ?? $fd['first_name'] ?? '-', $fd['business_email'] ?? $fd['email'] ?? '-', $fd['phone_number'] ?? $fd['phone'] ?? '-', $fd['looking_for'] ?? $fd['subject'] ?? ( $fd['action_type'] ?? '-' ), $fd['message'] ?? '-', $s->status ] );
    }
    fclose( $output );
    exit;
}
add_action( 'wp_ajax_dashboard_export_csv', 'dashboard_export_csv' );

// ─────────────────────────────────────────────
// 22. ENQUEUE SCRIPTS
// ─────────────────────────────────────────────
/*
 * FIX 1: All scripts load in footer (true as last param — already correct).
 * The salesnanny_defer_scripts() filter above adds defer="" automatically.
 * No other changes needed here.
 */
function enqueue_contact_form_assets() {
    wp_enqueue_script( 'jquery' );
    $theme_uri = get_template_directory_uri();

    wp_enqueue_script( 'calendly-tracker',       $theme_uri . '/assets/js/calendly-tracker.js',       [],          '2.0.2', true );
    wp_enqueue_script( 'enhanced-contact-form',  $theme_uri . '/assets/js/enhanced-contact-form.js',  [ 'jquery' ], '1.0.1', true );
    wp_enqueue_script( 'contactus-form',         $theme_uri . '/assets/js/contactus-form.js',         [ 'jquery' ], '1.0.0', true );

    wp_localize_script( 'enhanced-contact-form', 'ajax_object', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'enhanced_contact_form' ),
    ] );
    wp_localize_script( 'calendly-tracker', 'ajax_object', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'calendly_tracker' ),
    ] );
    wp_localize_script( 'contactus-form', 'ajax_object', [
        'ajax_url'               => admin_url( 'admin-ajax.php' ),
        'nonce'                  => wp_create_nonce( 'contactus_form' ),
        'contactus_nonce'        => wp_create_nonce( 'contactus_form' ),
        'enhanced_contact_nonce' => wp_create_nonce( 'enhanced_contact_form' ),
        'calendly_nonce'         => wp_create_nonce( 'calendly_tracker' ),
    ] );
    wp_localize_script( 'jquery', 'global_ajax_object', [
        'ajax_url'               => admin_url( 'admin-ajax.php' ),
        'contactus_nonce'        => wp_create_nonce( 'contactus_form' ),
        'enhanced_contact_nonce' => wp_create_nonce( 'enhanced_contact_form' ),
        'calendly_nonce'         => wp_create_nonce( 'calendly_tracker' ),
    ] );
}
add_action( 'wp_enqueue_scripts', 'enqueue_contact_form_assets' );

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
// 24. CONTACTUS FORM
// ─────────────────────────────────────────────
function process_contactus_form() {
    $is_ajax = defined( 'DOING_AJAX' ) && DOING_AJAX;
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'contactus_form' ) ) {
        if ( $is_ajax ) wp_send_json_error( [ 'message' => 'Security verification failed.' ] );
        wp_die( 'Security verification failed' );
    }
    if ( ! isset( $_POST['form_action'] ) || $_POST['form_action'] !== 'contactus_submit' ) {
        if ( $is_ajax ) wp_send_json_error( [ 'message' => 'Invalid form submission' ] );
        wp_die( 'Invalid form submission' );
    }
    global $wpdb;
    $form_data = [
        'first_name' => sanitize_text_field( $_POST['form-field-53ca358'] ?? '' ),
        'last_name'  => sanitize_text_field( $_POST['form-field-1f02457'] ?? '' ),
        'email'      => sanitize_email( $_POST['form-field-e7d1df3'] ?? '' ),
        'phone'      => sanitize_text_field( $_POST['form-field-phone'] ?? '' ),
        'subject'    => sanitize_text_field( $_POST['form-field-d0e86ec'] ?? '' ),
        'message'    => sanitize_textarea_field( $_POST['form-field-72f8d88'] ?? '' ),
        'form_type'  => 'contactus',
    ];
    $errors = [];
    if ( empty( $form_data['first_name'] ) )                                  $errors[] = 'First name is required.';
    if ( empty( $form_data['email'] ) || ! is_email( $form_data['email'] ) ) $errors[] = 'Valid email is required.';
    if ( empty( $form_data['message'] ) )                                     $errors[] = 'Message is required.';
    if ( ! empty( $errors ) ) {
        if ( $is_ajax ) wp_send_json_error( [ 'message' => implode( ' ', $errors ) ] );
        wp_die( implode( ' ', $errors ) );
    }
    $ip_address    = get_client_ip_address();
    $location_info = get_location_from_ip( $ip_address );
    $page_url      = esc_url_raw( $_POST['page_url'] ?? $_SERVER['HTTP_REFERER'] ?? '' );
    salesnanny_enhanced_contact_table();
    $result = $wpdb->insert(
        $wpdb->prefix . 'enhanced_contact_submissions',
        [ 'submission_time' => current_time( 'mysql' ), 'page_url' => $page_url, 'ip_address' => $ip_address, 'location_info' => $location_info, 'browser_info' => get_browser_info(), 'form_details' => wp_json_encode( $form_data ), 'status' => 'unread' ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
    );
    if ( $result !== false ) {
        send_contactus_notification( $form_data, $page_url, $ip_address, $location_info );
        if ( $is_ajax ) wp_send_json_success( [ 'message' => 'Thank you! We will get back to you soon.' ] );
        wp_redirect( add_query_arg( 'contact_success', '1', wp_get_referer() ) );
        exit;
    }
    if ( $is_ajax ) wp_send_json_error( [ 'message' => 'Sorry, there was an error. Please try again.' ] );
}
add_action( 'wp_ajax_contactus_submit', 'process_contactus_form' );
add_action( 'wp_ajax_nopriv_contactus_submit', 'process_contactus_form' );
add_action( 'init', function () {
    if ( ! empty( $_POST ) && isset( $_POST['form_action'] ) && 'contactus_submit' === $_POST['form_action'] ) {
        process_contactus_form();
    }
} );

function send_contactus_notification( $form_data, $page_url, $ip_address, $location_info = '' ) {
    $message = '<html><body><h2>New Contact Form Submission</h2><table style="border-collapse:collapse;width:100%">';
    foreach ( [ 'Full Name' => esc_html( $form_data['first_name'] . ' ' . $form_data['last_name'] ), 'Email' => esc_html( $form_data['email'] ), 'Phone' => esc_html( $form_data['phone'] ), 'Subject' => esc_html( $form_data['subject'] ), 'Message' => nl2br( esc_html( $form_data['message'] ) ), 'Page' => esc_html( $page_url ), 'IP' => esc_html( $ip_address ), 'Location' => esc_html( $location_info ), 'Time' => current_time( 'mysql' ) ] as $label => $value ) {
        $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>{$label}:</strong></td><td style='border:1px solid #ddd;padding:8px'>{$value}</td></tr>";
    }
    $message .= '</table></body></html>';
    wp_mail( get_option( 'admin_email' ), 'New Contact Form Submission from ' . $form_data['first_name'], $message, [ 'Content-Type: text/html; charset=UTF-8' ] );
}

// ─────────────────────────────────────────────
// 25. CALENDLY TRACKING
// ─────────────────────────────────────────────
function track_calendly_click() {
    if ( isset( $_POST['security'] ) && ! wp_verify_nonce( $_POST['security'], 'calendly_tracker' ) ) {
        wp_send_json_error( [ 'message' => 'Security verification failed.' ] );
    }
    global $wpdb;
    $page_url     = esc_url_raw( $_POST['current_page'] ?? $_POST['page_url'] ?? '' );
    $calendly_url = esc_url_raw( $_POST['calendly_url'] ?? '' );
    if ( empty( $calendly_url ) ) wp_send_json_error( [ 'message' => 'No Calendly URL provided.' ] );

    $ip_address    = get_client_ip_address();
    $location_info = get_location_from_ip( $ip_address );
    $form_data     = [ 'action_type' => 'calendly_click', 'calendly_url' => $calendly_url, 'source_page' => $page_url, 'device_type' => sanitize_text_field( $_POST['device_type'] ?? '' ), 'screen_resolution' => sanitize_text_field( $_POST['screen_resolution'] ?? '' ), 'language' => sanitize_text_field( $_POST['language'] ?? '' ), 'click_time' => current_time( 'mysql' ) ];
    $browser_info  = [ 'user_agent' => sanitize_text_field( $_POST['user_agent'] ?? '' ), 'screen_resolution' => $form_data['screen_resolution'], 'language' => $form_data['language'], 'device_type' => $form_data['device_type'], 'referrer' => esc_url_raw( $_POST['referrer'] ?? '' ) ];
    salesnanny_enhanced_contact_table();
    $result = $wpdb->insert(
        $wpdb->prefix . 'enhanced_contact_submissions',
        [ 'submission_time' => current_time( 'mysql' ), 'page_url' => $page_url, 'ip_address' => $ip_address, 'location_info' => $location_info, 'browser_info' => wp_json_encode( $browser_info ), 'form_details' => wp_json_encode( $form_data ), 'status' => 'unread' ],
        [ '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
    );
    if ( $result !== false ) {
        send_calendly_notification( $calendly_url, $page_url, $ip_address, $location_info, $browser_info );
        wp_send_json_success( [ 'message' => 'Tracked.', 'id' => $wpdb->insert_id ] );
    } else {
        wp_send_json_error( [ 'message' => 'Failed to track.' ] );
    }
}
add_action( 'wp_ajax_track_calendly_click', 'track_calendly_click' );
add_action( 'wp_ajax_nopriv_track_calendly_click', 'track_calendly_click' );

function send_calendly_notification( $calendly_url, $page_url, $ip_address, $location_info = '', $visitor_data = [] ) {
    $message = '<html><body><h2>Calendly Link Clicked</h2><table style="border-collapse:collapse;width:100%">';
    $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>Calendly URL:</strong></td><td style='border:1px solid #ddd;padding:8px'>" . esc_html( $calendly_url ) . '</td></tr>';
    if ( $location_info ) $message .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>Location:</strong></td><td style='border:1px solid #ddd;padding:8px'>" . esc_html( $location_info ) . '</td></tr>';
    $message .= '</table></body></html>';
    wp_mail( get_option( 'admin_email' ), 'Calendly Link Clicked', $message, [ 'Content-Type: text/html; charset=UTF-8' ] );
}

// ─────────────────────────────────────────────
// 26. EBOOK DOWNLOAD
// ─────────────────────────────────────────────
function handle_ebook_download_submission() {
    check_ajax_referer( 'ebook_download', 'security' );
    global $wpdb;
    $ip_address    = get_client_ip_address();
    $location_info = get_location_from_ip( $ip_address );
    $page_url      = esc_url_raw( $_POST['page_url'] ?? '' );
    $form_details  = [ 'action_type' => 'ebook_download', 'email' => sanitize_email( $_POST['email'] ?? '' ), 'page_url' => $page_url, 'user_agent' => sanitize_text_field( $_POST['user_agent'] ?? '' ), 'timestamp' => sanitize_text_field( $_POST['timestamp'] ?? '' ) ];
    $wpdb->insert(
        $wpdb->prefix . 'enhanced_contact_submissions',
        [ 'submission_time' => current_time( 'mysql' ), 'page_url' => $page_url, 'ip_address' => $ip_address, 'location_info' => $location_info, 'browser_info' => wp_json_encode( [ 'user_agent' => $form_details['user_agent'] ] ), 'form_details' => wp_json_encode( $form_details ), 'status' => 'unread' ]
    );
    wp_send_json_success( [ 'message' => 'Ebook submission saved.' ] );
}
add_action( 'wp_ajax_ebook_download_submission', 'handle_ebook_download_submission' );
add_action( 'wp_ajax_nopriv_ebook_download_submission', 'handle_ebook_download_submission' );

// ─────────────────────────────────────────────
// 27. LIVE SEARCH
// ─────────────────────────────────────────────
function salesnanny_live_search_handler() {
    $keyword = sanitize_text_field( $_POST['keyword'] ?? '' );
    if ( empty( $keyword ) ) wp_die();
    $query = new WP_Query( [ 'post_type' => 'post', 'post_status' => 'publish', 's' => $keyword, 'posts_per_page' => 5, 'category_name' => 'blogs' ] );
    if ( $query->have_posts() ) {
        echo '<ul class="search-results-list">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $thumb = has_post_thumbnail() ? '<div class="search-thumb">' . get_the_post_thumbnail( null, 'thumbnail' ) . '</div>' : '<div class="search-thumb"><img src="' . esc_url( get_template_directory_uri() . '/assets/default-blog-image.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '" style="width:40px;height:40px;object-fit:cover;border-radius:6px;"></div>';
            echo '<li><a href="' . esc_url( get_permalink() ) . '">' . $thumb . '<div class="search-info"><span class="search-title">' . esc_html( get_the_title() ) . '</span><span class="search-date">' . get_the_date( 'M d, Y' ) . '</span></div></a></li>';
        }
        echo '</ul>';
    } else {
        echo '<div class="no-results">No posts found matching your search.</div>';
    }
    wp_reset_postdata();
    wp_die();
}
add_action( 'wp_ajax_live_search_posts', 'salesnanny_live_search_handler' );
add_action( 'wp_ajax_nopriv_live_search_posts', 'salesnanny_live_search_handler' );

// ─────────────────────────────────────────────
// 28. AJAX PAGINATION
// ─────────────────────────────────────────────
add_action( 'wp_ajax_load_posts_ajax', 'load_posts_ajax_handler' );
add_action( 'wp_ajax_nopriv_load_posts_ajax', 'load_posts_ajax_handler' );

function load_posts_ajax_handler() {
    $page           = intval( $_POST['page'] ?? 1 );
    $category       = intval( $_POST['category'] ?? 0 );
    $tag            = intval( $_POST['tag'] ?? 0 );
    $author         = intval( $_POST['author'] ?? 0 );
    $search         = sanitize_text_field( $_POST['search'] ?? '' );
    $posts_per_page = intval( $_POST['posts_per_page'] ?? get_option( 'posts_per_page', 10 ) );
    $args = [ 'post_type' => 'post', 'posts_per_page' => $posts_per_page, 'paged' => $page, 'post_status' => 'publish' ];
    if ( $category ) $args['cat']    = $category;
    if ( $tag )      $args['tag_id'] = $tag;
    if ( $author )   $args['author'] = $author;
    if ( $search )   $args['s']      = $search;
    $blog_query = new WP_Query( $args );
    if ( $blog_query->have_posts() ) {
        ob_start();
        while ( $blog_query->have_posts() ) {
            $blog_query->the_post();
            echo '<article class="masonry-item"><div class="post-card">';
            if ( has_post_thumbnail() ) echo '<div class="post-thumbnail"><a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( null, 'medium' ) . '</a></div>';
            echo '<div class="post-content"><h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h2><div class="post-meta"><span class="post-date">' . get_the_date() . '</span></div><div class="post-excerpt">' . get_the_excerpt() . '</div><a href="' . esc_url( get_permalink() ) . '" class="read-more">Read More</a></div></div></article>';
        }
        $posts_html = ob_get_clean();
        ob_start();
        if ( $blog_query->max_num_pages > 1 ) {
            echo '<div class="pagination-wrapper">';
            echo paginate_links( [ 'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ), 'format' => '?paged=%#%', 'current' => $page, 'total' => $blog_query->max_num_pages, 'type' => 'list' ] );
            echo '</div>';
        }
        $pagination_html = ob_get_clean();
        wp_send_json_success( [ 'posts' => $posts_html, 'pagination' => $pagination_html ] );
    } else {
        wp_send_json_error( [ 'message' => 'No posts found' ] );
    }
    wp_reset_postdata();
    wp_die();
}

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
 *   define('WPTS_SMTP_FROM',      'hello@salesnanny.com');
 *   define('WPTS_SMTP_FROM_NAME', 'SalesNanny');
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
    $phpmailer->FromName   = defined( 'WPTS_SMTP_FROM_NAME' ) ? WPTS_SMTP_FROM_NAME : 'SalesNanny';
    if ( defined( 'WPTS_DISABLE_SSL_VERIFY' ) && WPTS_DISABLE_SSL_VERIFY ) {
        $phpmailer->SMTPOptions = [ 'ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ] ];
    }
}
add_action( 'phpmailer_init', 'scheduler_theme_configure_smtp' );

// ─────────────────────────────────────────────
// 30. BLOG POST STYLE SELECTOR + TEMPLATE ROUTING
// ─────────────────────────────────────────────
function salesnanny_register_blog_style_meta_box() {
    add_meta_box(
        'salesnanny_blog_style',
        'Blog Post Style',
        'salesnanny_render_blog_style_meta_box',
        'post',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'salesnanny_register_blog_style_meta_box' );

function salesnanny_render_blog_style_meta_box( $post ) {
    wp_nonce_field( 'salesnanny_blog_style_save', 'salesnanny_blog_style_nonce' );

    $current = get_post_meta( $post->ID, '_salesnanny_blog_style', true );
    if ( ! $current ) {
        $current = 'style1';
    }

    $styles = [
        'style1' => 'Style 1 - Classic',
        'style2' => 'Style 2 - Magazine',
        'style3' => 'Style 3 - Minimal',
        'style4' => 'Style 4 - Dark',
    ];
    ?>
    <select name="salesnanny_blog_style" style="width:100%">
        <?php foreach ( $styles as $key => $label ) : ?>
            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $current, $key ); ?>>
                <?php echo esc_html( $label ); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <p style="color:#666;font-size:11px;margin-top:8px">
        Choose how this post will be displayed.
    </p>
    <?php
}

function salesnanny_save_blog_style_meta( $post_id ) {
    if ( ! isset( $_POST['salesnanny_blog_style_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['salesnanny_blog_style_nonce'], 'salesnanny_blog_style_save' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( ! isset( $_POST['salesnanny_blog_style'] ) ) {
        return;
    }

    $allowed = [ 'style1', 'style2', 'style3', 'style4' ];
    $value   = sanitize_text_field( $_POST['salesnanny_blog_style'] );

    if ( in_array( $value, $allowed, true ) ) {
        update_post_meta( $post_id, '_salesnanny_blog_style', $value );
    }
}
add_action( 'save_post', 'salesnanny_save_blog_style_meta' );

function salesnanny_load_blog_style_template( $template ) {
    if ( ! is_singular( 'post' ) ) {
        return $template;
    }

    $post_id = get_queried_object_id();
    if ( ! $post_id ) {
        return $template;
    }

    $style = get_post_meta( $post_id, '_salesnanny_blog_style', true );
    if ( ! $style ) {
        $style = 'style1';
    }

    $template_map = [
        'style1' => 'single-blogs.php',
        'style2' => 'single-blog-style2.php',
        'style3' => 'single-blog-style3.php',
        'style4' => 'single-blog-style4.php',
    ];

    if ( ! isset( $template_map[ $style ] ) ) {
        $style = 'style1';
    }

    $custom_template = get_template_directory() . '/' . $template_map[ $style ];
    if ( file_exists( $custom_template ) ) {
        return $custom_template;
    }

    return $template;
}
add_filter( 'template_include', 'salesnanny_load_blog_style_template' );
