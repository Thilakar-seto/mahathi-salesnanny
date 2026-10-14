<?php
/**
 * Theme setup: supports, head clean-up and stylesheet/script loading.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Theme supports
 * ---------------------------------------------------------------------- */
add_action(
	'after_setup_theme',
	static function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	}
);

/* -------------------------------------------------------------------------
 * Keep <head> lean: the markup relies on its own stylesheets only.
 * ---------------------------------------------------------------------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_robots', 1 );
remove_action( 'wp_head', 'wp_site_icon', 99 );

add_action(
	'wp_enqueue_scripts',
	static function () {
		foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'classic-theme-styles', 'global-styles', 'wc-blocks-style' ) as $handle ) {
			wp_dequeue_style( $handle );
		}
	},
	100
);
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

/* -------------------------------------------------------------------------
 * Assets
 * ---------------------------------------------------------------------- */

/** Version string used for cache busting (file modification time). */
function mh_asset_ver( string $relative ): string {
	$file = get_template_directory() . '/assets/' . $relative;
	return file_exists( $file ) ? (string) filemtime( $file ) : '1.0.0';
}

/** Component stylesheets needed by the current route (header & footer are always included). */
function mh_page_styles(): array {
	static $map = null;
	if ( null === $map ) {
		$map = require get_template_directory() . '/inc/styles.php';
	}
	$page = $map[ mh_current_route() ] ?? array();
	// The shared chrome renders on every page: its styles come first (same order as the original app).
	$chrome = array( 'header', 'footer', 'contact-popup' );
	return array_values( array_unique( array_merge( $chrome, $page ) ) );
}

add_action(
	'wp_enqueue_scripts',
	static function () {
		$uri = get_template_directory_uri() . '/assets/';

		// Global / legacy stylesheets, in the order the design expects.
		$global = array(
			'mh-legacy-inline'  => 'css/legacy-inline.css',
			'mh-base'           => 'css/base.css',
			'mh-styles'         => 'css/styles.css',
			'mh-header-new'     => 'css/page_header_new.css',
			'mh-banner'         => 'css/banner_carousel.css',
			'mh-ec-panel'       => 'css/ec_panel.css',
			'mh-footer-new'     => 'css/page_footer_new.css',
			'mh-four-s'         => 'css/four_s_panel.css',
			'mh-style1'         => 'css/style_1.css',
			'mh-hi-banner'      => 'css/hi_banner.css',
			'mh-global'         => 'css/app-global.css',
			'mh-fonts'          => 'css/fonts.css',
			'mh-fontawesome'    => 'vendor/fontawesome/css/all.min.css',
			'mh-app'            => 'css/mahathi.css',
		);
		$prev = array();
		foreach ( $global as $handle => $file ) {
			wp_enqueue_style( $handle, $uri . $file, $prev, mh_asset_ver( $file ) );
			$prev = array( $handle );
		}

		// Component stylesheets for this page.
		if ( function_exists( 'mh_current_route' ) && ! is_admin() ) {
			foreach ( mh_page_styles() as $name ) {
				$file = 'css/components/' . $name . '.css';
				if ( file_exists( get_template_directory() . '/assets/' . $file ) ) {
					wp_enqueue_style( 'mh-c-' . $name, $uri . $file, $prev, mh_asset_ver( $file ) );
					$prev = array( 'mh-c-' . $name );
				}
			}
		}

		// Scripts: same order as the original page (bundled libs, jQuery + slick, then the theme script).
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-core' );
		wp_deregister_script( 'jquery-migrate' );
		$defer = array( 'strategy' => 'defer', 'in_footer' => false );
		wp_register_script( 'mh-common', $uri . 'js/common.js', array(), mh_asset_ver( 'js/common.js' ), $defer );
		wp_register_script( 'mh-app-bundle', $uri . 'js/app.js', array( 'mh-common' ), mh_asset_ver( 'js/app.js' ), $defer );
		wp_register_script( 'jquery', $uri . 'vendor/jquery.min.js', array( 'mh-app-bundle' ), '3.7.1', $defer );
		wp_register_script( 'mh-slick', $uri . 'js/slick.min.js', array( 'jquery' ), mh_asset_ver( 'js/slick.min.js' ), $defer );
		wp_enqueue_script( 'mh-theme', $uri . 'js/mahathi.js', array( 'jquery', 'mh-slick' ), mh_asset_ver( 'js/mahathi.js' ), $defer );
		wp_localize_script(
			'mh-theme',
			'MahathiConfig',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'mh_contact' ),
				'homeUrl' => home_url( '/' ),
				'route'   => mh_current_route(),
			)
		);

		// PAS Migration Problem Finder: the tool's scripts (footer, after #app exists). It uses the site's own
		// Poppins (css/fonts.css: 400/600/700) — no extra font files.
		if ( '/pas-migration-problem-finder' === mh_current_route() ) {
			$footer = array( 'in_footer' => true );
			wp_register_script( 'mh-pas-engine', $uri . 'js/pas-finder/engine.js', array(), mh_asset_ver( 'js/pas-finder/engine.js' ), $footer );
			wp_register_script( 'mh-pas-email', $uri . 'js/pas-finder/email-template.js', array(), mh_asset_ver( 'js/pas-finder/email-template.js' ), $footer );
			wp_enqueue_script( 'mh-pas-app', $uri . 'js/pas-finder/app.js', array( 'mh-pas-engine', 'mh-pas-email' ), mh_asset_ver( 'js/pas-finder/app.js' ), $footer );
		}
	},
	5
);

/** Favicon, theme colour and (production only) analytics, as in the original page head. */
add_action(
	'wp_head',
	static function () {
		echo '<meta name="msapplication-TileColor" content="#da532c">' . "\n";
		echo '<meta name="theme-color" content="#F4F4F2">' . "\n";
		echo '<link rel="icon" type="image/x-icon" href="' . esc_url( mh_asset( 'favicon.ico' ) ) . '">' . "\n";

		$host = (string) wp_parse_url( home_url(), PHP_URL_HOST );
		if ( 'production' === wp_get_environment_type() && ! in_array( $host, array( 'localhost', '127.0.0.1' ), true ) ) {
			?>
<script>
(function (c, l, a, r, i, t, y) {
	c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
	t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
	y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
})(window, document, "clarity", "script", "vb0whro0na");
</script>
			<?php
		}
	},
	2
);
