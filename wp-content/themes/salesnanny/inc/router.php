<?php
/**
 * Front controller for the Mahathi pages.
 *
 * Every public page of the site is described in inc/routes.php (path => page
 * template in /pages). The router resolves the request path against that table
 * early in the WordPress request, so the pages do not depend on WordPress
 * "Pages" existing in the database.
 *
 * Requests that are not part of the route table keep working as WordPress
 * normally would (admin, the contact dashboard, sitemap.xml, robots.txt, ...).
 * Anything else falls back to the home page, like the original application.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Route table: ['routes' => path => page, 'redirects' => path => path]. */
function mh_routes(): array {
	static $routes = null;
	if ( null === $routes ) {
		$routes = require get_template_directory() . '/inc/routes.php';
	}
	return $routes;
}

/** Path of the current request relative to the site root ("/", "/insurance"). */
function mh_request_path(): string {
	$uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/'; // phpcs:ignore
	$path = (string) wp_parse_url( $uri, PHP_URL_PATH );
	$base = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	if ( '' !== $base && '/' !== $base && 0 === strpos( $path, $base ) ) {
		$path = substr( $path, strlen( $base ) - 1 );
	}
	$path = '/' . trim( rawurldecode( $path ), '/' );
	return $path;
}

/** Page templates (from the theme) that WordPress itself is still allowed to render. */
function mh_wp_page_allowed( $post ): bool {
	if ( ! $post instanceof WP_Post ) {
		return false;
	}
	$template = get_page_template_slug( $post );
	if ( ! $template ) {
		return 'page' === $post->post_type && '' !== trim( $post->post_content );
	}
	// A page assigned to a template that no longer exists belongs to the replaced design.
	return file_exists( get_template_directory() . '/' . $template );
}

add_action(
	'template_redirect',
	static function () {
		if ( is_feed() || is_robots() || get_query_var( 'sitemap' ) || is_admin() || is_embed() ) {
			return;
		}
		$path   = mh_request_path();
		$config = mh_routes();

		if ( isset( $config['redirects'][ $path ] ) ) {
			wp_safe_redirect( mh_url( $config['redirects'][ $path ] ), 301 );
			exit;
		}

		if ( isset( $config['routes'][ $path ] ) ) {
			global $mh_route_path, $mh_route_page, $wp_query;
			$mh_route_path = $path;
			$mh_route_page = $config['routes'][ $path ];
			$wp_query->is_404  = false; // present this as a normal page whatever WordPress resolved
			$wp_query->is_home = ( '/' === $path );
			status_header( 200 );
			mh_render_page( $mh_route_page );
			exit;
		}

		// Content WordPress is still responsible for (contact dashboard, scheduler pages ...).
		if ( is_singular() && mh_wp_page_allowed( get_queried_object() ) ) {
			return;
		}

		// Unknown URL -> home page (the original single page app does the same).
		if ( '/' !== $path && ! is_search() ) {
			wp_safe_redirect( mh_url( '/' ), 302 );
			exit;
		}
	},
	1 // before WordPress' canonical / guessed-permalink redirects
);

/** Render a page: site chrome + the page template. */
function mh_render_page( string $page ): void {
	$tag = mh_routes()['tags'][ $page ] ?? 'app-' . $page;
	get_header();
	echo '<' . esc_attr( $tag ) . '>';
	mh_component( $page );
	echo '</' . esc_attr( $tag ) . '>';
	get_footer();
}

/** Routes whose pages are a "home" view (transparent header over the hero). */
function mh_header_class(): string {
	return '/' === mh_current_route() ? 'home' : 'inner';
}
