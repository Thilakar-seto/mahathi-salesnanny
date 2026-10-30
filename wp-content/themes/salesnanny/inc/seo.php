<?php
/**
 * SEO: document title, meta description, canonical, Open Graph / Twitter tags
 * and JSON-LD structured data for every route.
 *
 * Values come from inc/data/seo.php (one entry per route) and follow the
 * original rules: "<title> | Mahathi", site defaults when a route has no entry.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const MH_SITE_NAME           = 'Mahathi';
const MH_DEFAULT_DESCRIPTION = 'Mahathi Infotech - Weaving dreams to reality';

/** SEO record of the current route (or empty array). */
function mh_seo(): array {
	static $all = null;
	if ( null === $all ) {
		$all = require get_template_directory() . '/inc/data/seo.php';
	}
	return $all[ mh_current_route() ] ?? array();
}

/**
 * JSON-LD (Service + FAQPage + BreadcrumbList) for a service page. The FAQ answers
 * are read from the page's own data file so the markup and the schema stay in step.
 */
function mh_service_schemas( string $name, string $service_type, string $path, string $parent_name, string $parent_path, string $crumb, string $data_key ): array {
	$base      = 'https://www.mahathiinfotech.com';
	$questions = array();
	foreach ( (array) ( mh_data( $data_key )['faqs'] ?? array() ) as $faq ) {
		$questions[] = array(
			'@type'          => 'Question',
			'name'           => $faq['question'] ?? '',
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => implode( ' ', (array) ( $faq['answerParas'] ?? array() ) ),
			),
		);
	}
	return array(
		array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => $name,
			'serviceType' => $service_type,
			'provider'    => array( '@type' => 'Organization', '@id' => $base . '/#organization', 'name' => 'Mahathi Infotech LLC' ),
			'areaServed'  => 'US',
			'url'         => $base . $path,
		),
		array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $questions,
		),
		array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => array(
				array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $base . '/' ),
				array( '@type' => 'ListItem', 'position' => 2, 'name' => $parent_name, 'item' => $base . $parent_path ),
				array( '@type' => 'ListItem', 'position' => 3, 'name' => $crumb, 'item' => $base . $path ),
			),
		),
	);
}

/** Final <title> following the SeoService rules. */
function mh_seo_title(): string {
	$seo   = mh_seo();
	$title = isset( $seo['title'] ) ? trim( (string) $seo['title'] ) : '';
	if ( '' === $title || MH_SITE_NAME === $title ) {
		return MH_SITE_NAME;
	}
	return ! empty( $seo['rawTitle'] ) ? $title : $title . ' | ' . MH_SITE_NAME;
}

add_filter(
	'pre_get_document_title',
	static function ( $title ) {
		return mh_is_route() ? mh_seo_title() : $title;
	}
);

/** True when the current request is one of the Mahathi routes. */
function mh_is_route(): bool {
	global $mh_route_path;
	return isset( $mh_route_path );
}

add_action(
	'wp_head',
	static function () {
		if ( ! mh_is_route() ) {
			return;
		}
		$seo         = mh_seo();
		$title       = mh_seo_title();
		$description = ! empty( $seo['description'] ) ? $seo['description'] : MH_DEFAULT_DESCRIPTION;
		$canonical   = untrailingslashit( home_url( mh_current_route() ) );
		$canonical   = '/' === mh_current_route() ? home_url( '/' ) : $canonical;
		$image       = ! empty( $seo['image'] ) ? mh_asset_url( $seo['image'] ) : mh_asset_url( 'images/mahathi_logo_White.png' );

		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
		echo '<meta property="og:type" content="website">' . "\n";
		echo '<meta property="og:image" content="' . $image . '">' . "\n"; // phpcs:ignore -- already escaped
		echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
		echo '<meta name="twitter:image" content="' . $image . '">' . "\n"; // phpcs:ignore

		// Structured data: the page's own schemas + the organisation (always present once schemas are added).
		$schemas = $seo['schemas'] ?? array();
		if ( $schemas ) {
			$schemas[] = array(
				'@context' => 'https://schema.org',
				'@type'    => 'Organization',
				'@id'      => 'https://www.mahathiinfotech.com/#organization',
				'name'     => 'Mahathi Infotech',
				'url'      => 'https://www.mahathiinfotech.com',
				'logo'     => array(
					'@type' => 'ImageObject',
					'url'   => 'https://www.mahathiinfotech.com/assets/images/mahathi_logo_White.png',
				),
				'sameAs'   => array( 'https://www.linkedin.com/company/mahathiinfo/' ),
			);
		}
		foreach ( $schemas as $schema ) {
			echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
		}
	},
	3
);

/* -------------------------------------------------------------------------
 * robots.txt & sitemap.xml
 * ---------------------------------------------------------------------- */

/** robots.txt: allow everything except the WordPress back end. */
function mh_robots_txt(): void {
	if ( 'robots.txt' !== basename( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '', PHP_URL_PATH ) ) ) { // phpcs:ignore
		return;
	}
	header( 'Content-Type: text/plain; charset=utf-8' );
	echo "User-agent: *\n";
	echo "Disallow: /wp-admin/\n";
	echo "Allow: /wp-admin/admin-ajax.php\n";
	echo "Allow: /\n\n";
	echo 'Sitemap: ' . esc_url_raw( home_url( '/sitemap.xml' ) ) . "\n";
	exit;
}
add_action( 'init', 'mh_robots_txt' );

/** Priority / change frequency rules (same as the original sitemap generator). */
function mh_sitemap_meta( string $route ): array {
	if ( '/' === $route ) {
		return array( 'priority' => '1.0', 'changefreq' => 'daily' );
	}
	if ( in_array( $route, array( '/healthcare', '/insurance', '/news', '/about-us', '/contact-us' ), true ) ) {
		return array( 'priority' => '0.9', 'changefreq' => 'weekly' );
	}
	if ( 0 === strpos( $route, '/healthcare/' ) || 0 === strpos( $route, '/insurance/' ) ) {
		return array( 'priority' => '0.8', 'changefreq' => 'weekly' );
	}
	return array( 'priority' => '0.7', 'changefreq' => 'monthly' );
}

function mh_sitemap(): void {
	while ( ob_get_level() > 0 ) {
		ob_end_clean();
	}
	header( 'Content-Type: application/xml; charset=utf-8' );
	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
	foreach ( array_keys( mh_routes()['routes'] ) as $route ) {
		$meta = mh_sitemap_meta( $route );
		$loc  = '/' === $route ? home_url( '/' ) : home_url( $route );
		echo '  <url><loc>' . esc_url( $loc ) . '</loc><changefreq>' . $meta['changefreq'] . '</changefreq><priority>' . $meta['priority'] . '</priority></url>' . "\n";
	}
	echo '</urlset>';
	exit;
}

add_action(
	'init',
	static function () {
		add_rewrite_rule( '^sitemap\.xml$', 'index.php?sitemap=1', 'top' );
	}
);
add_filter(
	'query_vars',
	static function ( $vars ) {
		$vars[] = 'sitemap';
		return $vars;
	}
);
add_action(
	'template_redirect',
	static function () {
		if ( get_query_var( 'sitemap' ) ) {
			mh_sitemap();
		}
	}
);
