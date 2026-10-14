<?php
/**
 * Component logic shared by several templates (ported from the component classes):
 * label -> link mappings for the solution cards / sidebars and the mobile card
 * list of the "Select Industry" accordion.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Strip zero-width characters and surrounding spaces. */
function mh_label_clean( string $label ): string {
	return trim( preg_replace( '/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $label ) );
}

/** Build the target URL for a label: route + "#section" when a section id is known. */
function mh_label_link( string $route, ?string $section ): string {
	if ( null !== $section && false === strpos( $route, '#' ) ) {
		return mh_url( $route ) . '#' . $section;
	}
	return mh_url( $route );
}

/**
 * Home page "Our solutions" sidebar: link of a sidebar entry (null when unmapped).
 * Labels are normalised the same way as in the original component.
 */
function mh_our_solutions_link( string $label ): ?string {
	$data  = mh_data( 'dashboard-our-solutions' );
	$label = mh_label_clean( $label );
	$label = preg_replace( '/,\s*/', ', ', $label );
	$label = preg_replace( '/([a-z])([A-Z])/', '$1 $2', $label );
	$label = trim( preg_replace( '/\s+/', ' ', $label ) );
	$cta   = $data['labelToCtaMap'][ $label ] ?? null;
	$route = $data['labelToRouteMap'][ $label ] ?? null;
	return ( $cta && $route ) ? mh_label_link( $route, $cta ) : null;
}

/** Healthcare page: link of a solution label (sidebar entries and grid cards). */
function mh_healthcare_link( string $label ): ?string {
	$map   = mh_data( 'healthcare' )['healthcareLabelToRouteMap'] ?? array();
	$route = $map[ mh_label_clean( $label ) ] ?? null;
	return $route ? mh_url( $route ) : null;
}

/** "Select Industry" accordion: link of a mobile card. */
function mh_solution_grid_link( string $label ): ?string {
	$data  = mh_data( 'solution-grid' );
	$label = mh_label_clean( $label );
	$cta   = $data['labelToCtaMap'][ $label ] ?? null;
	$route = $data['labelToRouteMap'][ $label ] ?? null;
	if ( ! $route ) {
		return null;
	}
	return $cta ? mh_label_link( $route, $cta ) : mh_url( $route );
}

/**
 * Sidebar payload for a solution card: title + entries with their links.
 *
 * @param array    $card     card data (title, sidebarItems)
 * @param callable $resolver label => link|null
 */
function mh_sidebar_payload( array $card, callable $resolver ): array {
	$items = array();
	foreach ( mh_list( $card['sidebarItems'] ?? array() ) as $label ) {
		$items[] = array(
			'label' => $label,
			'href'  => $resolver( $label ),
		);
	}
	return array(
		'title' => $card['title'] ?? '',
		'items' => $items,
	);
}

/**
 * Cards shown in an open accordion: every "card" grid item paired with a
 * neighbouring (or the first unused) image, as in the original component.
 */
function mh_solution_grid_mobile_cards( array $grid_items ): array {
	$result = array();
	$used   = array();
	$count  = count( $grid_items );
	foreach ( $grid_items as $i => $item ) {
		if ( 'card' !== ( $item['type'] ?? '' ) ) {
			continue;
		}
		$image = null;
		if ( $i + 1 < $count && 'image' === $grid_items[ $i + 1 ]['type'] && ! isset( $used[ $i + 1 ] ) ) {
			$image          = $grid_items[ $i + 1 ]['image'];
			$used[ $i + 1 ] = true;
		} elseif ( $i - 1 >= 0 && 'image' === $grid_items[ $i - 1 ]['type'] && ! isset( $used[ $i - 1 ] ) ) {
			$image          = $grid_items[ $i - 1 ]['image'];
			$used[ $i - 1 ] = true;
		}
		if ( ! $image ) {
			foreach ( $grid_items as $j => $candidate ) {
				if ( 'image' === $candidate['type'] && ! isset( $used[ $j ] ) ) {
					$image      = $candidate['image'];
					$used[ $j ] = true;
					break;
				}
			}
		}
		$result[] = array(
			'label' => $item['label'],
			'image' => $image,
		);
	}
	return $result;
}

/** Selected tab from the ?tab= query parameter (falls back to 0). */
function mh_query_tab( int $count ): int {
	$tab = isset( $_GET['tab'] ) ? (int) $_GET['tab'] : 0; // phpcs:ignore WordPress.Security.NonceVerification
	return ( $tab >= 0 && $tab < $count ) ? $tab : 0;
}
