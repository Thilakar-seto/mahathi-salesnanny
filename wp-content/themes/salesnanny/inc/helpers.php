<?php
/**
 * Template runtime helpers.
 *
 * Small, dependency-free functions used by the converted component templates
 * (template-parts/*.php and pages/*.php). Everything is prefixed `mh_`.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Values & escaping
 * ---------------------------------------------------------------------- */

/** Scalar -> string, the way a template interpolation renders it. */
function mh_str( $value ): string {
	if ( null === $value ) {
		return '';
	}
	if ( is_bool( $value ) ) {
		return $value ? 'true' : 'false';
	}
	if ( is_array( $value ) ) {
		return implode( ',', array_map( 'mh_str', $value ) );
	}
	return (string) $value;
}

/** Escaped text node content. */
function mh_e( $value ): string {
	return esc_html( mh_str( $value ) );
}

/** Escaped attribute value. */
function mh_a( $value ): string {
	return esc_attr( mh_str( $value ) );
}

/** Always iterate over an array, even when the value is missing. */
function mh_list( $value ): array {
	return is_array( $value ) ? $value : array();
}

function mh_length( $value ): int {
	if ( is_array( $value ) ) {
		return count( $value );
	}
	return is_string( $value ) ? strlen( $value ) : 0;
}

function mh_isString( $value ): bool {
	return is_string( $value );
}

function mh_isArray( $value ): bool {
	return is_array( $value );
}

/** Build a class list from a string or a ['class' => bool] map. */
function mh_classes( $value ): string {
	if ( is_array( $value ) ) {
		$out = array();
		foreach ( $value as $class => $on ) {
			if ( $on ) {
				$out[] = $class;
			}
		}
		return implode( ' ', $out );
	}
	return mh_str( $value );
}

/** Dynamic part of a class attribute: " a b" (leading space) or "". */
function mh_cls( $value ): string {
	$classes = trim( mh_classes( $value ) );
	return '' === $classes ? '' : ' ' . esc_attr( $classes );
}

/** Build an inline style string from a ['prop' => 'value'] map. */
function mh_styles( $value ): string {
	if ( ! is_array( $value ) ) {
		return mh_str( $value );
	}
	$out = '';
	foreach ( $value as $prop => $val ) {
		if ( null !== $val && '' !== $val ) {
			$out .= $prop . ': ' . $val . '; ';
		}
	}
	return trim( $out );
}

/* -------------------------------------------------------------------------
 * URLs
 * ---------------------------------------------------------------------- */

/** Absolute URL of a site route, e.g. mh_url('/insurance'). */
function mh_url( string $route = '/' ): string {
	$route = '/' . ltrim( $route, '/' );
	return home_url( $route );
}

/** Add query parameters / fragment to an URL. */
function mh_url_q( string $url, $params = array(), $fragment = null ): string {
	if ( is_array( $params ) && $params ) {
		$url = add_query_arg( array_map( 'mh_str', $params ), $url );
	}
	if ( $fragment ) {
		$url .= '#' . ltrim( (string) $fragment, '#' );
	}
	return $url;
}

/** Resolve a dynamic router link (string or ['/path', 'child']) to a URL. */
function mh_link( $link ): string {
	if ( is_array( $link ) ) {
		$link = implode( '/', array_map( 'mh_str', $link ) );
	}
	return mh_url( (string) $link );
}

/** URI of a theme asset (path relative to /assets). */
function mh_asset( string $path ): string {
	$path = ltrim( str_replace( '\\', '/', $path ), '/' );
	$path = implode( '/', array_map( 'rawurlencode', explode( '/', $path ) ) );
	return get_template_directory_uri() . '/assets/' . $path;
}

/**
 * Escaped URL for an image/asset reference. Accepts the path styles found in
 * the content data: "assets/images/x.jpg", "../../../assets/images/x.jpg",
 * "/assets/images/x.jpg", "images/x.jpg" or a full http(s) URL.
 */
function mh_asset_url( $value ): string {
	return esc_url( mh_asset_src( $value ) );
}

/** Same as mh_asset_url() but not escaped (for building CSS url(...) values). */
function mh_asset_src( $value ): string {
	$value = mh_str( $value );
	if ( '' === $value ) {
		return '';
	}
	if ( preg_match( '#^(https?:)?//#i', $value ) || 0 === strpos( $value, 'data:' ) ) {
		return $value;
	}
	$value = str_replace( '\\', '/', $value );
	$value = preg_replace( '#^(\.\.?/)+#', '', $value );
	$value = preg_replace( '#^/?assets/#', '', $value );
	return mh_asset( $value );
}

/** Current route path ("/", "/insurance", ...). Set by the router. */
function mh_current_route(): string {
	global $mh_route_path;
	return isset( $mh_route_path ) ? $mh_route_path : mh_request_path();
}

/** routerLinkActive equivalent. */
function mh_active( string $route, bool $exact = false ): bool {
	$current = mh_current_route();
	$route   = '/' . trim( $route, '/' );
	if ( $exact ) {
		return $current === $route;
	}
	return '/' === $route ? '/' === $current : ( $current === $route || 0 === strpos( $current, $route . '/' ) );
}

/** Header: which top-level mega menu is highlighted (mirrors the original logic). */
function mh_isParentMenuActive( string $menu_id ): bool {
	$routes = array(
		'InsuranceMenu'       => array( 'modernworkerscompensiation', 'workerscompensiation', 'managedcareorganization', 'lifeandannuity', 'reinsurance' ),
		'HealthcareMenu'      => array( 'healthcare' ),
		'AIMenu'              => array( 'aienablement' ),
		'DigitalServicesMenu' => array( 'DigitalServices' ),
	);
	$current = strtolower( mh_current_route() );
	foreach ( $routes[ $menu_id ] ?? array() as $needle ) {
		if ( false !== strpos( $current, strtolower( $needle ) ) ) {
			return true;
		}
	}
	return false;
}

/* -------------------------------------------------------------------------
 * Components
 * ---------------------------------------------------------------------- */

/** Load the data array that belongs to a component (inc/data/<name>.php). */
function mh_data( string $name ): array {
	static $cache = array();
	if ( ! isset( $cache[ $name ] ) ) {
		$file           = get_template_directory() . '/inc/data/' . $name . '.php';
		$cache[ $name ] = is_readable( $file ) ? (array) include $file : array();
	}
	return $cache[ $name ];
}

/**
 * Render a component template. Component data (inc/data/<name>.php) and the
 * given inputs are exposed to the template as local variables.
 */
function mh_component( string $name, array $inputs = array() ): void {
	$dir  = file_exists( get_template_directory() . '/pages/' . $name . '.php' ) ? 'pages' : 'template-parts';
	$vars = array_merge( mh_data( $name ), $inputs );
	( static function ( string $__file, array $__vars ) {
		extract( $__vars, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract
		include $__file;
	} )( get_template_directory() . '/' . $dir . '/' . $name . '.php', $vars );
}

/** Component names whose stylesheet has been requested for this page. */
function mh_component_styles( ?string $add = null ): array {
	static $list = array();
	if ( null !== $add && ! in_array( $add, $list, true ) ) {
		$list[] = $add;
	}
	return $list;
}

/**
 * section2 feature list: titles that are rendered without the trailing colon.
 */
function mh_shouldHideColon( $title ): bool {
	$normalize = static function ( $text ): string {
		$text = preg_replace( '/[\x{200B}-\x{200D}\x{FEFF}]/u', '', (string) $text );
		return strtolower( trim( preg_replace( '/\s+/', ' ', $text ) ) );
	};
	static $hide = null;
	if ( null === $hide ) {
		$hide = array_map(
			$normalize,
			array(
				'daily and weekly regulatory feeds',
				'exception triage and root-cause analysis',
				'state bureau interactions and corrections',
				'audit responses and regulator inquiries',
			)
		);
	}
	return in_array( $normalize( $title ), $hide, true );
}
