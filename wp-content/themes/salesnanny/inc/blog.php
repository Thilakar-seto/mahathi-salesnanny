<?php
/**
 * Blog page (/blog) — articles and newsletter sign-up.
 *
 * The articles are written on Mahathi's blog (blog.mahathiinfotech.com, a WordPress site). This page lists
 * them inside our own site: it reads the blog's public REST API, caches the result, and keeps a backup copy
 * so the page still renders if the blog is slow or down. Each card links to the full article on the blog.
 *
 * Newsletter: the strip at the bottom stores the e-mail address as a lead in the Lead Dashboard
 * (form_type "newsletter", see inc/leads.php) and e-mails the team. It does not talk to the blog's own
 * subscriber list.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const MH_BLOG_ORIGIN = 'https://blog.mahathiinfotech.com';
const MH_BLOG_TTL    = 15 * MINUTE_IN_SECONDS;

/** Plain text from the blog's HTML: tags removed, entities decoded, whitespace collapsed. */
function mh_blog_text( $html ): string {
	return trim( preg_replace( '/\s+/u', ' ', html_entity_decode( wp_strip_all_tags( (string) $html ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) );
}

/** Only links that really are on the blog are kept (anything else falls back to the blog home). */
function mh_blog_safe_url( $url ): string {
	$url = esc_url_raw( (string) $url );
	return 0 === strpos( $url, MH_BLOG_ORIGIN . '/' ) ? $url : MH_BLOG_ORIGIN . '/';
}

/** GET a JSON endpoint from the blog; null on any failure. */
function mh_blog_get_json( string $path, array $query = array() ): ?array {
	$res = wp_remote_get( add_query_arg( $query, MH_BLOG_ORIGIN . $path ), array( 'timeout' => 8, 'headers' => array( 'Accept' => 'application/json' ) ) );
	if ( is_wp_error( $res ) || 200 !== (int) wp_remote_retrieve_response_code( $res ) ) {
		return null;
	}
	$data = json_decode( (string) wp_remote_retrieve_body( $res ), true );
	return is_array( $data ) ? $data : null;
}

/** Author photos, as set on the blog (the API only exposes Gravatar placeholders): [ name => image url ]. */
function mh_blog_avatars(): array {
	$res = wp_remote_get( MH_BLOG_ORIGIN . '/', array( 'timeout' => 8 ) );
	if ( is_wp_error( $res ) || 200 !== (int) wp_remote_retrieve_response_code( $res ) ) {
		return array();
	}
	$out = array();
	if ( preg_match_all( '/<img[^>]*class="meta-avatar"[^>]*>/i', (string) wp_remote_retrieve_body( $res ), $tags ) ) {
		foreach ( $tags[0] as $tag ) {
			if ( preg_match( '/\ssrc="([^"]+)"/i', $tag, $src ) && preg_match( '/\salt="([^"]*)"/i', $tag, $alt ) && 0 === strpos( $src[1], MH_BLOG_ORIGIN . '/' ) ) {
				$out[ mh_blog_text( $alt[1] ) ] = esc_url_raw( $src[1] );
			}
		}
	}
	return $out;
}

/** srcset from the blog's generated sizes (768px and up, widest 1600px), so large cards stay sharp. */
function mh_blog_srcset( array $sizes ): string {
	$byWidth = array();
	foreach ( $sizes as $s ) {
		$w   = (int) ( $s['width'] ?? 0 );
		$url = esc_url_raw( (string) ( $s['source_url'] ?? '' ) );
		if ( $w >= 700 && $w <= 1600 && 0 === strpos( $url, MH_BLOG_ORIGIN . '/' ) ) {
			$byWidth[ $w ] = $url;
		}
	}
	ksort( $byWidth );
	$parts = array();
	foreach ( $byWidth as $w => $url ) {
		$parts[] = $url . ' ' . $w . 'w';
	}
	return implode( ', ', $parts );
}

/** Fresh copy from the blog, reduced to what the page needs; null if the blog can't be read. */
function mh_blog_fetch(): ?array {
	$raw = mh_blog_get_json(
		'/wp-json/wp/v2/posts',
		array( 'per_page' => 100, '_embed' => 1, '_fields' => 'id,date,link,slug,title,excerpt,content,categories,_embedded,_links' )
	);
	if ( null === $raw ) {
		return null;
	}
	$cats    = mh_blog_get_json( '/wp-json/wp/v2/categories', array( 'per_page' => 100, 'hide_empty' => 'false', '_fields' => 'id,name,slug,count' ) ) ?? array();
	$avatars = mh_blog_avatars();

	$posts = array();
	foreach ( $raw as $p ) {
		$emb    = $p['_embedded'] ?? array();
		$author = ( $emb['author'][0]['name'] ?? '' );
		$media  = $emb['wp:featuredmedia'][0] ?? array();
		$sizes  = $media['media_details']['sizes'] ?? array();
		$pick   = $sizes['medium_large'] ?? ( $sizes['large'] ?? ( $sizes['full'] ?? null ) );
		$words  = str_word_count( mh_blog_text( $p['content']['rendered'] ?? '' ) );
		$excerpt = mh_blog_text( $p['excerpt']['rendered'] ?? '' );
		$excerpt = preg_replace( '/\s*\[(?:…|\.\.\.)\]\s*$/u', '…', $excerpt );

		$post_cats = array();
		foreach ( (array) ( $p['categories'] ?? array() ) as $cid ) {
			$post_cats[] = (int) $cid;
		}
		$posts[] = array(
			'id'       => (int) $p['id'],
			'url'      => mh_blog_safe_url( $p['link'] ?? '' ),
			'title'    => mh_blog_text( $p['title']['rendered'] ?? '' ),
			'excerpt'  => $excerpt,
			'date'     => substr( (string) ( $p['date'] ?? '' ), 0, 10 ),
			'cats'     => $post_cats,
			'readMin'  => max( 1, (int) ceil( $words / 200 ) ),
			'author'   => mh_blog_text( $author ),
			'avatar'   => $avatars[ mh_blog_text( $author ) ] ?? '',
			'image'    => $pick ? array(
				'src'    => esc_url_raw( (string) ( $pick['source_url'] ?? $media['source_url'] ?? '' ) ),
				'w'      => (int) ( $pick['width'] ?? 768 ),
				'h'      => (int) ( $pick['height'] ?? 432 ),
				'alt'    => mh_blog_text( $media['alt_text'] ?? '' ),
				'srcset' => mh_blog_srcset( $sizes ),
			) : null,
		);
	}
	usort( $posts, static fn( $a, $b ) => strcmp( $b['date'], $a['date'] ) ?: ( $b['id'] <=> $a['id'] ) );

	$topics = array();
	foreach ( $cats as $c ) {
		$topics[] = array( 'id' => (int) $c['id'], 'name' => mh_blog_text( $c['name'] ?? '' ), 'slug' => sanitize_key( $c['slug'] ?? '' ), 'count' => (int) ( $c['count'] ?? 0 ) );
	}
	return array( 'posts' => $posts, 'topics' => $topics, 'fetched' => time() );
}

/**
 * Articles for the page: cached for 15 minutes, with the last good copy as a fallback.
 * Returns [ 'posts' => [], 'topics' => [], 'live' => bool ]; 'live' is false when only a backup (or nothing) is available.
 */
function mh_blog_data(): array {
	$cached = get_transient( 'mh_blog_feed' );
	if ( is_array( $cached ) ) {
		return $cached + array( 'live' => true );
	}
	$backup = get_option( 'mh_blog_feed_backup' );
	$has    = is_array( $backup ) && ! empty( $backup['posts'] );

	// Stale-while-revalidate: show the saved copy straight away and refresh from the blog in the background,
	// so no visitor waits for the blog (a cold fetch takes ~3s). Skipped when WP-Cron is disabled.
	if ( $has && ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) ) {
		set_transient( 'mh_blog_feed', $backup, MINUTE_IN_SECONDS );
		if ( ! wp_next_scheduled( 'mh_blog_refresh' ) ) {
			wp_schedule_single_event( time(), 'mh_blog_refresh' );
		}
		return $backup + array( 'live' => true );
	}

	$fresh = mh_blog_fetch();
	if ( $fresh ) {
		set_transient( 'mh_blog_feed', $fresh, MH_BLOG_TTL );
		update_option( 'mh_blog_feed_backup', $fresh, false );
		return $fresh + array( 'live' => true );
	}
	if ( $has ) {
		set_transient( 'mh_blog_feed', $backup, 2 * MINUTE_IN_SECONDS ); // try the blog again shortly
		return $backup + array( 'live' => false );
	}
	return array( 'posts' => array(), 'topics' => array(), 'fetched' => 0, 'live' => false );
}

/** Background refresh (WP-Cron): replaces the cached copy with a fresh one when the blog answers. */
add_action(
	'mh_blog_refresh',
	static function () {
		$fresh = mh_blog_fetch();
		if ( $fresh ) {
			set_transient( 'mh_blog_feed', $fresh, MH_BLOG_TTL );
			update_option( 'mh_blog_feed_backup', $fresh, false );
		}
	}
);

/**
 * Topic chips under "All Topics", in display order: the fixed topics Mahathi wants shown (slug => label), then any
 * other blog category that has articles. Each chip carries the blog's category id (or 0 if that category doesn't exist
 * there yet) and how many of the listed articles are in it.
 */
function mh_blog_topics( array $feed ): array {
	$fixed = array(
		'guidewire'                => 'Guidewire',
		'socotra'                  => 'Socotra',
		'insurance-data-analytics' => 'Insurance Data & Analytics',
		'ai-in-insurance'          => 'AI in Insurance',
		'testing-qa'               => 'Testing & QA',
	);
	$bySlug = array();
	foreach ( $feed['topics'] as $t ) {
		$bySlug[ $t['slug'] ] = $t;
	}
	$used = array();
	foreach ( $feed['posts'] as $p ) {
		foreach ( $p['cats'] as $cid ) {
			$used[ $cid ] = ( $used[ $cid ] ?? 0 ) + 1;
		}
	}
	$out = array();
	foreach ( $fixed as $slug => $label ) {
		$id    = (int) ( $bySlug[ $slug ]['id'] ?? 0 );
		$out[] = array( 'key' => $slug, 'id' => $id, 'name' => $label, 'count' => $id ? (int) ( $used[ $id ] ?? 0 ) : 0 );
	}
	foreach ( $feed['topics'] as $t ) {
		if ( isset( $fixed[ $t['slug'] ] ) || in_array( $t['slug'], array( 'blog', 'uncategorized' ), true ) || empty( $used[ $t['id'] ] ) ) {
			continue;
		}
		$out[] = array( 'key' => $t['slug'], 'id' => $t['id'], 'name' => $t['name'], 'count' => (int) $used[ $t['id'] ] );
	}
	return $out;
}

/** Initials for an author without a photo. */
function mh_blog_initials( string $name ): string {
	$parts = preg_split( '/\s+/', trim( $name ) );
	return strtoupper( mb_substr( $parts[0] ?? '', 0, 1 ) . mb_substr( count( $parts ) > 1 ? end( $parts ) : '', 0, 1 ) );
}

/* -------------------------------------------------------------------------
 * Newsletter sign-up (admin-ajax: mh_blog_subscribe)
 * ---------------------------------------------------------------------- */

function mh_blog_subscribe(): void {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'mh_blog_subscribe' ) ) {
		wp_send_json_error( array( 'message' => 'Please refresh the page and try again.' ), 403 );
	}
	if ( ! empty( $_POST['website'] ) ) { // honeypot
		wp_send_json_success( array( 'message' => 'Subscribed' ) );
	}
	$ip  = get_client_ip_address();
	$key = 'mh_nl_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		wp_send_json_error( array( 'message' => 'Too many tries. Please try later.' ), 429 );
	}
	$email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	if ( '' === $email || ! is_email( $email ) || strlen( $email ) > 190 ) {
		wp_send_json_error( array( 'message' => 'Enter a valid email' ), 422 );
	}

	global $wpdb;
	mh_leads_maybe_install();
	$table = mh_leads_table();
	// Same address already subscribed (and not deleted): treat as success, don't add a duplicate lead.
	$exists = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table WHERE form_type = 'newsletter' AND email = %s AND trashed_at IS NULL", $email ) ); // phpcs:ignore WordPress.DB
	set_transient( $key, $hit + 1, HOUR_IN_SECONDS );
	if ( $exists ) {
		wp_send_json_success( array( 'message' => 'Subscribed' ) );
	}

	$details = array( 'email' => $email, 'subject' => 'Blog newsletter', 'message' => 'Subscribed to the blog newsletter.', 'form_type' => 'newsletter' );
	$page    = esc_url_raw( wp_unslash( $_POST['page_url'] ?? ( $_SERVER['HTTP_REFERER'] ?? '' ) ) );
	$saved   = $wpdb->insert(
		$table,
		array(
			'submission_time' => current_time( 'mysql' ),
			'page_url'        => $page,
			'ip_address'      => $ip,
			'location_info'   => get_location_from_ip( $ip ),
			'browser_info'    => get_browser_info(),
			'form_details'    => wp_json_encode( $details ),
			'status'          => 'unread',
			'lead_status'     => 'new',
		) + mh_lead_columns_from_details( $details )
	);
	if ( false === $saved ) {
		wp_send_json_error( array( 'message' => 'Please try again' ), 500 );
	}
	$lead_id = (int) $wpdb->insert_id;
	wp_mail(
		get_option( 'admin_email' ),
		'New blog newsletter sign-up',
		'<p><strong>' . esc_html( $email ) . '</strong> subscribed to the blog newsletter.</p><p><a href="' . esc_url( mh_leads_url( $lead_id ) ) . '">Open in Lead Dashboard</a></p>',
		array( 'Content-Type: text/html; charset=UTF-8' )
	);
	wp_send_json_success( array( 'message' => 'Subscribed' ) );
}
add_action( 'wp_ajax_mh_blog_subscribe', 'mh_blog_subscribe' );
add_action( 'wp_ajax_nopriv_mh_blog_subscribe', 'mh_blog_subscribe' );
