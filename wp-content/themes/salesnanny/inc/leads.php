<?php
/**
 * Lead dashboard back end — contact form submissions.
 *
 * Storage
 *   {prefix}enhanced_contact_submissions  one row per submission (written by inc/contact.php).
 *                                         The raw form stays in form_details (JSON); name, email,
 *                                         company ... are copied into indexed columns for search,
 *                                         sorting and export. Pipeline fields (lead_status, starred,
 *                                         assigned_to, follow_up_at, trashed_at) live here too.
 *   {prefix}mh_lead_activity              notes and history (status / owner / follow-up changes,
 *                                         WhatsApp delivery — see inc/whatsapp.php).
 *
 * Access
 *   Only logged-in WordPress users with the `mh_manage_leads` capability: administrators, plus the
 *   "Lead Manager" role for sales staff who should not get full admin rights. Every AJAX endpoint
 *   checks that capability and the `mh_leads` nonce; there are no unauthenticated (nopriv) handlers.
 *
 * The dashboard itself is the page template contact-dashboard.php (/contact-dashboard/).
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const MH_LEADS_DB_VERSION = '3';
const MH_LEADS_CAP        = 'mh_manage_leads';

function mh_leads_table(): string {
	global $wpdb;
	return $wpdb->prefix . 'enhanced_contact_submissions';
}

function mh_leads_activity_table(): string {
	global $wpdb;
	return $wpdb->prefix . 'mh_lead_activity';
}

/** Dashboard URL, optionally opening one lead. */
function mh_leads_url( int $lead_id = 0 ): string {
	$url = home_url( '/contact-dashboard/' );
	return $lead_id ? add_query_arg( 'lead', $lead_id, $url ) : $url;
}

/** Pipeline stages, in order. */
function mh_lead_statuses(): array {
	return array(
		'new'       => 'New',
		'contacted' => 'Contacted',
		'qualified' => 'Qualified',
		'proposal'  => 'Proposal',
		'won'       => 'Won',
		'lost'      => 'Lost',
		'spam'      => 'Spam',
	);
}

/** Readable names for the kinds of submissions the table can hold (older site versions logged more than the contact form). */
function mh_lead_form_type_label( string $type ): string {
	$labels = array(
		'contactus'      => 'Contact form',
		'calendly_click' => 'Calendly click',
		'ebook_download' => 'eBook download',
		'newsletter'     => 'Newsletter sign-up',
		'pas_finder'     => 'PAS Migration Problem Finder',
	);
	return $labels[ $type ] ?? ( '' === $type ? 'Website form' : ucwords( str_replace( '_', ' ', $type ) ) );
}

/* -------------------------------------------------------------------------
 * Schema, migration, roles
 * ---------------------------------------------------------------------- */

function mh_leads_install(): void {
	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$charset = $wpdb->get_charset_collate();
	$leads   = mh_leads_table();
	$log     = mh_leads_activity_table();

	// dbDelta only adds what is missing: existing rows and columns are kept as they are.
	dbDelta(
		"CREATE TABLE $leads (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  submission_time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
  page_url varchar(500) NOT NULL,
  ip_address varchar(45) NOT NULL,
  location_info varchar(255),
  browser_info text,
  form_details longtext NOT NULL,
  status varchar(20) DEFAULT 'unread',
  form_type varchar(40) NOT NULL DEFAULT '',
  full_name varchar(120) NOT NULL DEFAULT '',
  email varchar(190) NOT NULL DEFAULT '',
  phone varchar(40) NOT NULL DEFAULT '',
  company varchar(190) NOT NULL DEFAULT '',
  service varchar(120) NOT NULL DEFAULT '',
  lead_status varchar(20) NOT NULL DEFAULT 'new',
  starred tinyint(1) NOT NULL DEFAULT 0,
  assigned_to bigint(20) unsigned NOT NULL DEFAULT 0,
  follow_up_at datetime NULL DEFAULT NULL,
  trashed_at datetime NULL DEFAULT NULL,
  whatsapp_status varchar(20) NOT NULL DEFAULT '',
  whatsapp_attempts tinyint(3) unsigned NOT NULL DEFAULT 0,
  whatsapp_message_id varchar(64) NOT NULL DEFAULT '',
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (id),
  KEY status (status),
  KEY submission_time (submission_time),
  KEY ip_address (ip_address),
  KEY lead_status (lead_status),
  KEY email (email),
  KEY trashed_at (trashed_at)
) $charset;"
	);

	dbDelta(
		"CREATE TABLE $log (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  lead_id mediumint(9) NOT NULL,
  user_id bigint(20) unsigned NOT NULL DEFAULT 0,
  type varchar(20) NOT NULL,
  content text NOT NULL,
  created_at datetime NOT NULL,
  PRIMARY KEY  (id),
  KEY lead_id (lead_id)
) $charset;"
	);

	// Copy name / email / ... out of the JSON of rows saved before these columns existed.
	$rows = $wpdb->get_results( "SELECT id, form_details FROM $leads WHERE form_type = ''" ); // phpcs:ignore WordPress.DB
	foreach ( $rows as $row ) {
		$details = json_decode( (string) $row->form_details, true );
		$wpdb->update( $leads, mh_lead_columns_from_details( is_array( $details ) ? $details : array() ), array( 'id' => $row->id ) );
	}

	// Capability for administrators + a dedicated role for sales staff.
	$admin = get_role( 'administrator' );
	if ( $admin && ! $admin->has_cap( MH_LEADS_CAP ) ) {
		$admin->add_cap( MH_LEADS_CAP );
	}
	if ( ! get_role( 'mh_lead_manager' ) ) {
		add_role( 'mh_lead_manager', 'Lead Manager', array( 'read' => true, MH_LEADS_CAP => true ) );
	}
}

/** Runs the migration once per schema version (a single autoloaded option read otherwise). */
function mh_leads_maybe_install(): void {
	if ( get_option( 'mh_leads_db_version' ) !== MH_LEADS_DB_VERSION ) {
		mh_leads_install();
		update_option( 'mh_leads_db_version', MH_LEADS_DB_VERSION );
	}
}
add_action( 'init', 'mh_leads_maybe_install', 5 );

/** Indexed columns derived from a submission's form fields (any form version). */
function mh_lead_columns_from_details( array $fd ): array {
	$name = trim( (string) ( $fd['full_name'] ?? '' ) );
	if ( '' === $name ) {
		$name = trim( ( $fd['first_name'] ?? '' ) . ' ' . ( $fd['last_name'] ?? '' ) );
	}
	$cut = static fn( $value, int $len ): string => mb_substr( trim( (string) $value ), 0, $len );
	return array(
		'form_type' => $cut( $fd['form_type'] ?? $fd['action_type'] ?? $fd['subscription_type'] ?? 'other', 40 ),
		'full_name' => $cut( $name, 120 ),
		'email'     => $cut( $fd['email'] ?? $fd['business_email'] ?? '', 190 ),
		'phone'     => $cut( $fd['phone'] ?? $fd['phone_number'] ?? '', 40 ),
		'company'   => $cut( $fd['company'] ?? '', 190 ),
		'service'   => $cut( $fd['subject'] ?? $fd['looking_for'] ?? '', 120 ),
	);
}

/* -------------------------------------------------------------------------
 * Formatting
 * ---------------------------------------------------------------------- */

/** Stored times are site-local (current_time('mysql')); send them as ISO 8601 with the site's offset. */
function mh_lead_iso( ?string $mysql ): ?string {
	if ( ! $mysql || '0000-00-00 00:00:00' === $mysql ) {
		return null;
	}
	try {
		return ( new DateTimeImmutable( $mysql, wp_timezone() ) )->format( DATE_ATOM );
	} catch ( Exception $e ) {
		return null;
	}
}

function mh_lead_user_name( int $user_id ): string {
	static $cache = array();
	if ( ! $user_id ) {
		return '';
	}
	if ( ! isset( $cache[ $user_id ] ) ) {
		$user              = get_userdata( $user_id );
		$cache[ $user_id ] = $user ? $user->display_name : 'Former user';
	}
	return $cache[ $user_id ];
}

/** "Chrome on Windows" from the stored browser_info JSON. */
function mh_lead_browser( ?string $browser_info ): string {
	$info = json_decode( (string) $browser_info, true );
	$ua   = is_array( $info ) ? (string) ( $info['user_agent'] ?? '' ) : '';
	if ( '' === $ua ) {
		return '';
	}
	$browsers = array( 'Edg/' => 'Edge', 'OPR/' => 'Opera', 'Firefox/' => 'Firefox', 'Chrome/' => 'Chrome', 'Safari/' => 'Safari' );
	$systems  = array( 'iPhone' => 'iPhone', 'iPad' => 'iPad', 'Android' => 'Android', 'Windows' => 'Windows', 'Mac OS X' => 'macOS', 'Linux' => 'Linux' );
	$browser  = 'Unknown browser';
	foreach ( $browsers as $needle => $label ) {
		if ( false !== strpos( $ua, $needle ) ) {
			$browser = $label;
			break;
		}
	}
	foreach ( $systems as $needle => $label ) {
		if ( false !== strpos( $ua, $needle ) ) {
			return $browser . ' on ' . $label;
		}
	}
	return $browser;
}

/** List-view shape of a lead. */
function mh_lead_row( object $r ): array {
	$type = (string) $r->form_type;
	return array(
		'id'         => (int) $r->id,
		'name'       => (string) $r->full_name,
		'email'      => (string) $r->email,
		'phone'      => (string) $r->phone,
		'company'    => (string) $r->company,
		'service'    => (string) $r->service,
		'formType'   => $type,
		'formLabel'  => mh_lead_form_type_label( $type ),
		'status'     => (string) $r->lead_status,
		'unread'     => 'unread' === $r->status,
		'starred'    => (bool) (int) $r->starred,
		'assignedTo' => (int) $r->assigned_to,
		'assignee'   => mh_lead_user_name( (int) $r->assigned_to ),
		'followUpAt' => mh_lead_iso( $r->follow_up_at ),
		'receivedAt' => mh_lead_iso( $r->submission_time ),
		'trashed'    => ! empty( $r->trashed_at ),
		'location'   => (string) $r->location_info,
		'pageUrl'    => (string) $r->page_url,
		'whatsapp'   => (string) ( $r->whatsapp_status ?? '' ),
	);
}

function mh_lead_activity( int $lead_id ): array {
	global $wpdb;
	$table = mh_leads_activity_table();
	$rows  = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $table WHERE lead_id = %d ORDER BY created_at DESC, id DESC", $lead_id ) ); // phpcs:ignore WordPress.DB
	return array_map( 'mh_lead_activity_item', $rows );
}

function mh_lead_activity_item( object $a ): array {
	return array(
		'id'      => (int) $a->id,
		'type'    => (string) $a->type,
		'content' => (string) $a->content,
		'author'  => mh_lead_user_name( (int) $a->user_id ),
		'at'      => mh_lead_iso( $a->created_at ),
	);
}

function mh_lead_log( int $lead_id, string $type, string $content ): array {
	global $wpdb;
	$row = array(
		'lead_id'    => $lead_id,
		'user_id'    => get_current_user_id(),
		'type'       => $type,
		'content'    => $content,
		'created_at' => current_time( 'mysql' ),
	);
	$wpdb->insert( mh_leads_activity_table(), $row, array( '%d', '%d', '%s', '%s', '%s' ) );
	$row['id'] = (int) $wpdb->insert_id;
	return mh_lead_activity_item( (object) $row );
}

/** Users who can work leads (for the "Assigned to" picker). */
function mh_lead_team(): array {
	$users = get_users( array( 'capability' => MH_LEADS_CAP, 'fields' => array( 'ID', 'display_name' ), 'orderby' => 'display_name' ) );
	return array_map( static fn( $u ) => array( 'id' => (int) $u->ID, 'name' => $u->display_name ), $users );
}

/* -------------------------------------------------------------------------
 * Query building
 * ---------------------------------------------------------------------- */

/** Sanitised list / export arguments from a request array. */
function mh_leads_args( array $src ): array {
	$get   = static fn( string $key ): string => isset( $src[ $key ] ) ? sanitize_text_field( wp_unslash( $src[ $key ] ) ) : '';
	$date  = static fn( string $v ): string => preg_match( '/^\d{4}-\d{2}-\d{2}$/', $v ) ? $v : '';
	$views = array_merge( array( 'all', 'trash' ), array_keys( mh_lead_statuses() ) );
	$view  = $get( 'view' );
	$ids   = array_values( array_filter( array_map( 'absint', explode( ',', $get( 'ids' ) ) ) ) );

	return array(
		'view'      => in_array( $view, $views, true ) ? $view : 'all',
		'search'    => mb_substr( $get( 'search' ), 0, 100 ),
		'service'   => mb_substr( $get( 'service' ), 0, 120 ),
		'from'      => $date( $get( 'from' ) ),
		'to'        => $date( $get( 'to' ) ),
		'unread'    => '1' === $get( 'unread' ),
		'starred'   => '1' === $get( 'starred' ),
		'followups' => '1' === $get( 'followups' ),
		'ids'       => array_slice( $ids, 0, 1000 ),
	);
}

/**
 * WHERE clause + values for the given arguments.
 * $with_view = false leaves out the tab (used for the tab counts and for "export selected").
 */
function mh_leads_where( array $a, bool $with_view = true ): array {
	global $wpdb;
	$where  = array();
	$values = array();

	if ( $with_view ) {
		if ( 'trash' === $a['view'] ) {
			$where[] = 'trashed_at IS NOT NULL';
		} else {
			$where[] = 'trashed_at IS NULL';
			if ( 'all' === $a['view'] ) {
				$where[] = "lead_status <> 'spam'";
			} else {
				$where[]  = 'lead_status = %s';
				$values[] = $a['view'];
			}
		}
	}
	if ( $a['ids'] ) {
		$where[] = 'id IN (' . implode( ',', array_fill( 0, count( $a['ids'] ), '%d' ) ) . ')';
		array_push( $values, ...$a['ids'] );
	}
	if ( '' !== $a['search'] ) {
		$like    = '%' . $wpdb->esc_like( $a['search'] ) . '%';
		$where[] = '(full_name LIKE %s OR email LIKE %s OR company LIKE %s OR phone LIKE %s OR service LIKE %s OR form_details LIKE %s)';
		array_push( $values, $like, $like, $like, $like, $like, $like );
	}
	if ( '' !== $a['service'] ) {
		$where[]  = 'service = %s';
		$values[] = $a['service'];
	}
	if ( '' !== $a['from'] ) {
		$where[]  = 'submission_time >= %s';
		$values[] = $a['from'] . ' 00:00:00';
	}
	if ( '' !== $a['to'] ) {
		$where[]  = 'submission_time <= %s';
		$values[] = $a['to'] . ' 23:59:59';
	}
	if ( $a['unread'] ) {
		$where[] = "status = 'unread'";
	}
	if ( $a['starred'] ) {
		$where[] = 'starred = 1';
	}
	if ( $a['followups'] ) {
		$where[]  = "follow_up_at IS NOT NULL AND follow_up_at <= %s AND lead_status NOT IN ('won','lost','spam')";
		$values[] = current_time( 'Y-m-d' ) . ' 23:59:59';
	}

	return array( $where ? implode( ' AND ', $where ) : '1=1', $values );
}

/** $wpdb->prepare() only when there is something to bind (it warns otherwise). */
function mh_leads_sql( string $sql, array $values ): string {
	global $wpdb;
	return $values ? $wpdb->prepare( $sql, $values ) : $sql; // phpcs:ignore WordPress.DB
}

/* -------------------------------------------------------------------------
 * AJAX endpoints (logged-in, capability + nonce checked)
 * ---------------------------------------------------------------------- */

function mh_leads_guard(): void {
	if ( ! check_ajax_referer( 'mh_leads', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => 'Your session has expired. Please reload the page.' ), 403 );
	}
	if ( ! current_user_can( MH_LEADS_CAP ) ) {
		wp_send_json_error( array( 'message' => 'You do not have access to leads.' ), 403 );
	}
}

/** Paged list + tab counts. */
function mh_leads_ajax_list(): void {
	mh_leads_guard();
	global $wpdb;
	$table = mh_leads_table();
	$args  = mh_leads_args( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification -- checked in guard

	$sorts = array(
		'received' => 'submission_time',
		'name'     => 'full_name',
		'company'  => 'company',
		'service'  => 'service',
		'status'   => "FIELD(lead_status,'new','contacted','qualified','proposal','won','lost','spam')",
	);
	$sort     = sanitize_key( $_POST['sort'] ?? 'received' ); // phpcs:ignore WordPress.Security.NonceVerification
	$order    = 'asc' === sanitize_key( $_POST['order'] ?? '' ) ? 'ASC' : 'DESC'; // phpcs:ignore WordPress.Security.NonceVerification
	$order_by = ( $sorts[ $sort ] ?? $sorts['received'] ) . " $order, id DESC";
	$per_page = (int) ( $_POST['per_page'] ?? 25 ); // phpcs:ignore WordPress.Security.NonceVerification
	$per_page = in_array( $per_page, array( 10, 25, 50, 100 ), true ) ? $per_page : 25;
	$page     = max( 1, (int) ( $_POST['page'] ?? 1 ) ); // phpcs:ignore WordPress.Security.NonceVerification

	list( $where, $values ) = mh_leads_where( $args );
	$total = (int) $wpdb->get_var( mh_leads_sql( "SELECT COUNT(*) FROM $table WHERE $where", $values ) ); // phpcs:ignore WordPress.DB
	$pages = max( 1, (int) ceil( $total / $per_page ) );
	$page  = min( $page, $pages );
	$rows  = $wpdb->get_results( mh_leads_sql( "SELECT * FROM $table WHERE $where ORDER BY $order_by LIMIT %d OFFSET %d", array_merge( $values, array( $per_page, ( $page - 1 ) * $per_page ) ) ) ); // phpcs:ignore WordPress.DB

	// Tab counts follow the search / filters but not the tab itself.
	list( $cwhere, $cvalues ) = mh_leads_where( $args, false );
	$grouped = $wpdb->get_results( mh_leads_sql( "SELECT lead_status, (trashed_at IS NOT NULL) AS trashed, COUNT(*) AS c FROM $table WHERE $cwhere GROUP BY lead_status, trashed", $cvalues ) ); // phpcs:ignore WordPress.DB
	$counts  = array_fill_keys( array_merge( array( 'all' ), array_keys( mh_lead_statuses() ), array( 'trash' ) ), 0 );
	foreach ( $grouped as $g ) {
		if ( (int) $g->trashed ) {
			$counts['trash'] += (int) $g->c;
			continue;
		}
		if ( isset( $counts[ $g->lead_status ] ) ) {
			$counts[ $g->lead_status ] += (int) $g->c;
		}
		if ( 'spam' !== $g->lead_status ) {
			$counts['all'] += (int) $g->c;
		}
	}

	wp_send_json_success(
		array(
			'rows'    => array_map( 'mh_lead_row', $rows ),
			'total'   => $total,
			'page'    => $page,
			'pages'   => $pages,
			'perPage' => $per_page,
			'counts'  => $counts,
		)
	);
}
add_action( 'wp_ajax_mh_leads_list', 'mh_leads_ajax_list' );

/** Headline numbers, 30-day trend and top services (spam and trash excluded). */
function mh_leads_ajax_stats(): void {
	mh_leads_guard();
	global $wpdb;
	$table = mh_leads_table();
	$base  = "trashed_at IS NULL AND lead_status <> 'spam'";
	$today = current_time( 'Y-m-d' );
	$day   = static fn( int $offset ): string => gmdate( 'Y-m-d', strtotime( "$today $offset days" ) );
	$count = static fn( string $where, array $values = array() ): int => (int) $wpdb->get_var( mh_leads_sql( "SELECT COUNT(*) FROM $table WHERE $base AND $where", $values ) ); // phpcs:ignore WordPress.DB

	$daily = $wpdb->get_results( $wpdb->prepare( "SELECT DATE(submission_time) AS d, COUNT(*) AS c FROM $table WHERE $base AND submission_time >= %s GROUP BY d", $day( -29 ) . ' 00:00:00' ) ); // phpcs:ignore WordPress.DB
	$by_day = array();
	foreach ( $daily as $d ) {
		$by_day[ $d->d ] = (int) $d->c;
	}
	$series = array();
	for ( $i = -29; $i <= 0; $i++ ) {
		$date     = $day( $i );
		$series[] = array( 'date' => $date, 'count' => $by_day[ $date ] ?? 0 );
	}

	$services = $wpdb->get_results( "SELECT service, COUNT(*) AS c FROM $table WHERE $base AND service <> '' GROUP BY service ORDER BY c DESC, service ASC LIMIT 6" ); // phpcs:ignore WordPress.DB
	$latest   = $wpdb->get_row( "SELECT id, full_name FROM $table ORDER BY id DESC LIMIT 1" ); // phpcs:ignore WordPress.DB

	wp_send_json_success(
		array(
			'total'     => $count( '1=1' ),
			'unread'    => $count( "status = 'unread'" ),
			'last7'     => $count( 'submission_time >= %s', array( $day( -6 ) . ' 00:00:00' ) ),
			'prev7'     => $count( 'submission_time >= %s AND submission_time < %s', array( $day( -13 ) . ' 00:00:00', $day( -6 ) . ' 00:00:00' ) ),
			'today'     => $count( 'submission_time >= %s', array( $today . ' 00:00:00' ) ),
			'won'       => $count( "lead_status = 'won'" ),
			'lost'      => $count( "lead_status = 'lost'" ),
			'followups' => $count( "follow_up_at IS NOT NULL AND follow_up_at <= %s AND lead_status NOT IN ('won','lost')", array( $today . ' 23:59:59' ) ),
			'series'    => $series,
			'services'  => array_map( static fn( $s ) => array( 'name' => $s->service, 'count' => (int) $s->c ), $services ),
			'latest'    => $latest ? array( 'id' => (int) $latest->id, 'name' => (string) $latest->full_name ) : null,
		)
	);
}
add_action( 'wp_ajax_mh_leads_stats', 'mh_leads_ajax_stats' );

/** One lead with full details and activity. Opening an unread lead marks it read. */
function mh_leads_ajax_get(): void {
	mh_leads_guard();
	global $wpdb;
	$table = mh_leads_table();
	$id    = absint( $_POST['id'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification
	$row   = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $id ) ); // phpcs:ignore WordPress.DB
	if ( ! $row ) {
		wp_send_json_error( array( 'message' => 'This lead no longer exists.' ), 404 );
	}
	if ( 'unread' === $row->status ) {
		$wpdb->update( $table, array( 'status' => 'read' ), array( 'id' => $id ) );
		$row->status = 'read';
	}

	$fd    = json_decode( (string) $row->form_details, true );
	$fd    = is_array( $fd ) ? $fd : array();
	$known = array( 'first_name', 'last_name', 'full_name', 'email', 'business_email', 'phone', 'phone_number', 'company', 'subject', 'looking_for', 'message', 'form_type' );
	$extra = array();
	foreach ( $fd as $key => $value ) {
		if ( ! in_array( $key, $known, true ) && is_scalar( $value ) && '' !== (string) $value ) {
			$extra[] = array( 'label' => ucwords( str_replace( '_', ' ', (string) $key ) ), 'value' => (string) $value );
		}
	}

	$lead = mh_lead_row( $row ) + array(
		'firstName'     => (string) ( $fd['first_name'] ?? '' ),
		'lastName'      => (string) ( $fd['last_name'] ?? '' ),
		'message'       => (string) ( $fd['message'] ?? '' ),
		'ip'            => (string) $row->ip_address,
		'browser'       => mh_lead_browser( $row->browser_info ),
		'followUpLocal' => $row->follow_up_at ? substr( str_replace( ' ', 'T', $row->follow_up_at ), 0, 16 ) : '',
		'extra'         => $extra,
		'activity'      => mh_lead_activity( $id ),
	);
	wp_send_json_success( array( 'lead' => $lead ) );
}
add_action( 'wp_ajax_mh_leads_get', 'mh_leads_ajax_get' );

/**
 * Update one or many leads: lead_status, starred, unread, assigned_to, follow_up, trash, restore.
 * Status, owner, follow-up, trash and restore changes are written to the activity log.
 */
function mh_leads_ajax_update(): void {
	mh_leads_guard();
	global $wpdb;
	$table    = mh_leads_table();
	$args     = mh_leads_args( $_POST ); // phpcs:ignore WordPress.Security.NonceVerification
	$ids      = $args['ids'];
	$statuses = mh_lead_statuses();
	if ( ! $ids ) {
		wp_send_json_error( array( 'message' => 'No leads selected.' ), 422 );
	}
	$in      = implode( ',', array_fill( 0, count( $ids ), '%d' ) );
	$current = $wpdb->get_results( $wpdb->prepare( "SELECT id, lead_status, assigned_to, follow_up_at, trashed_at FROM $table WHERE id IN ($in)", $ids ) ); // phpcs:ignore WordPress.DB

	$set    = array();
	$values = array();
	$post   = static fn( string $key ): ?string => isset( $_POST[ $key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) : null; // phpcs:ignore WordPress.Security.NonceVerification

	$status = $post( 'lead_status' );
	if ( null !== $status ) {
		if ( ! isset( $statuses[ $status ] ) ) {
			wp_send_json_error( array( 'message' => 'Unknown status.' ), 422 );
		}
		$set[]    = 'lead_status = %s';
		$values[] = $status;
	}
	if ( null !== $post( 'starred' ) ) {
		$set[] = 'starred = ' . ( '1' === $post( 'starred' ) ? 1 : 0 );
	}
	if ( null !== $post( 'unread' ) ) {
		$set[] = "status = '" . ( '1' === $post( 'unread' ) ? 'unread' : 'read' ) . "'";
	}
	$assignee = $post( 'assigned_to' );
	if ( null !== $assignee ) {
		$assignee = absint( $assignee );
		if ( $assignee && ! user_can( $assignee, MH_LEADS_CAP ) ) {
			wp_send_json_error( array( 'message' => 'That person cannot be assigned leads.' ), 422 );
		}
		$set[]    = 'assigned_to = %d';
		$values[] = $assignee;
	}
	$follow = $post( 'follow_up' );
	if ( null !== $follow ) {
		if ( '' === $follow ) {
			$set[] = 'follow_up_at = NULL';
		} elseif ( preg_match( '/^(\d{4}-\d{2}-\d{2})(?:T(\d{2}:\d{2}))?$/', $follow, $m ) ) {
			$follow   = $m[1] . ' ' . ( $m[2] ?? '09:00' ) . ':00';
			$set[]    = 'follow_up_at = %s';
			$values[] = $follow;
		} else {
			wp_send_json_error( array( 'message' => 'Invalid follow-up date.' ), 422 );
		}
	}
	if ( '1' === $post( 'trash' ) ) {
		$set[]    = 'trashed_at = %s';
		$values[] = current_time( 'mysql' );
	} elseif ( '1' === $post( 'restore' ) ) {
		$set[] = 'trashed_at = NULL';
	}
	if ( ! $set ) {
		wp_send_json_error( array( 'message' => 'Nothing to update.' ), 422 );
	}

	$updated = $wpdb->query( $wpdb->prepare( 'UPDATE ' . $table . ' SET ' . implode( ', ', $set ) . " WHERE id IN ($in)", array_merge( $values, $ids ) ) ); // phpcs:ignore WordPress.DB
	if ( false === $updated ) {
		wp_send_json_error( array( 'message' => 'Could not save the change. Please try again.' ), 500 );
	}

	foreach ( $current as $lead ) {
		$id = (int) $lead->id;
		if ( null !== $status && $status !== $lead->lead_status ) {
			mh_lead_log( $id, 'status', sprintf( 'Status changed from %s to %s', $statuses[ $lead->lead_status ] ?? ucfirst( $lead->lead_status ), $statuses[ $status ] ) );
		}
		if ( null !== $assignee && (int) $lead->assigned_to !== $assignee ) {
			mh_lead_log( $id, 'assign', $assignee ? 'Assigned to ' . mh_lead_user_name( $assignee ) : 'Unassigned' );
		}
		if ( null !== $follow && (string) $lead->follow_up_at !== ( '' === $follow ? '' : $follow ) ) {
			mh_lead_log( $id, 'followup', '' === $follow ? 'Follow-up cleared' : 'Follow-up set for ' . wp_date( 'M j, Y g:i A', strtotime( $follow . ' ' . wp_timezone_string() ) ) );
		}
		if ( '1' === $post( 'trash' ) && empty( $lead->trashed_at ) ) {
			mh_lead_log( $id, 'trash', 'Moved to trash' );
		} elseif ( '1' === $post( 'restore' ) && ! empty( $lead->trashed_at ) ) {
			mh_lead_log( $id, 'restore', 'Restored from trash' );
		}
	}

	$response = array( 'updated' => count( $current ) );
	if ( 1 === count( $ids ) ) {
		$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $ids[0] ) ); // phpcs:ignore WordPress.DB
		if ( $row ) {
			$response['lead']     = mh_lead_row( $row ) + array( 'followUpLocal' => $row->follow_up_at ? substr( str_replace( ' ', 'T', $row->follow_up_at ), 0, 16 ) : '' );
			$response['activity'] = mh_lead_activity( (int) $ids[0] );
		}
	}
	wp_send_json_success( $response );
}
add_action( 'wp_ajax_mh_leads_update', 'mh_leads_ajax_update' );

/** Add an internal note to a lead. */
function mh_leads_ajax_note(): void {
	mh_leads_guard();
	global $wpdb;
	$id   = absint( $_POST['id'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification
	$note = mb_substr( trim( sanitize_textarea_field( wp_unslash( $_POST['note'] ?? '' ) ) ), 0, 2000 ); // phpcs:ignore WordPress.Security.NonceVerification
	if ( '' === $note ) {
		wp_send_json_error( array( 'message' => 'Write a note first.' ), 422 );
	}
	$exists = (int) $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(*) FROM ' . mh_leads_table() . ' WHERE id = %d', $id ) ); // phpcs:ignore WordPress.DB
	if ( ! $exists ) {
		wp_send_json_error( array( 'message' => 'This lead no longer exists.' ), 404 );
	}
	wp_send_json_success( array( 'item' => mh_lead_log( $id, 'note', $note ) ) );
}
add_action( 'wp_ajax_mh_leads_note', 'mh_leads_ajax_note' );

/** Permanently delete leads — only ones already in the trash. */
function mh_leads_ajax_delete(): void {
	mh_leads_guard();
	global $wpdb;
	$table = mh_leads_table();
	$ids   = mh_leads_args( $_POST )['ids']; // phpcs:ignore WordPress.Security.NonceVerification
	if ( ! $ids ) {
		wp_send_json_error( array( 'message' => 'No leads selected.' ), 422 );
	}
	$in      = implode( ',', array_fill( 0, count( $ids ), '%d' ) );
	$trashed = array_map( 'intval', $wpdb->get_col( $wpdb->prepare( "SELECT id FROM $table WHERE id IN ($in) AND trashed_at IS NOT NULL", $ids ) ) ); // phpcs:ignore WordPress.DB
	if ( $trashed ) {
		$tin = implode( ',', array_fill( 0, count( $trashed ), '%d' ) );
		$wpdb->query( $wpdb->prepare( "DELETE FROM $table WHERE id IN ($tin)", $trashed ) ); // phpcs:ignore WordPress.DB
		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . mh_leads_activity_table() . " WHERE lead_id IN ($tin)", $trashed ) ); // phpcs:ignore WordPress.DB
	}
	wp_send_json_success( array( 'deleted' => count( $trashed ) ) );
}
add_action( 'wp_ajax_mh_leads_delete', 'mh_leads_ajax_delete' );

/** Neutralise spreadsheet formulas (CSV injection) in exported cells. */
function mh_leads_csv_cell( $value ): string {
	$value = (string) $value;
	return ( '' !== $value && false !== strpos( "=+-@\t\r", $value[0] ) ) ? "'" . $value : $value;
}

/** CSV export of the current filters, or of the selected ids. GET request opened by the dashboard. */
function mh_leads_export(): void {
	if ( ! check_ajax_referer( 'mh_leads', 'nonce', false ) || ! current_user_can( MH_LEADS_CAP ) ) {
		wp_die( 'You do not have access to export leads.', 'Forbidden', array( 'response' => 403 ) );
	}
	global $wpdb;
	$table                  = mh_leads_table();
	$args                   = mh_leads_args( $_GET ); // phpcs:ignore WordPress.Security.NonceVerification
	list( $where, $values ) = mh_leads_where( $args, empty( $args['ids'] ) );
	$rows                   = $wpdb->get_results( mh_leads_sql( "SELECT * FROM $table WHERE $where ORDER BY submission_time DESC", $values ) ); // phpcs:ignore WordPress.DB
	$statuses               = mh_lead_statuses();

	nocache_headers();
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename="mahathi-leads-' . current_time( 'Y-m-d' ) . '.csv"' );
	$out = fopen( 'php://output', 'w' );
	fwrite( $out, "\xEF\xBB\xBF" ); // UTF-8 BOM so Excel shows names and symbols correctly.
	fputcsv( $out, array( 'ID', 'Received', 'Status', 'Name', 'Email', 'Phone', 'Company', 'Service', 'Message', 'Assigned to', 'Follow-up', 'Starred', 'Read', 'Source page', 'Location', 'IP address', 'Form' ), ',', '"', '' );
	foreach ( $rows as $r ) {
		$fd = json_decode( (string) $r->form_details, true );
		fputcsv(
			$out,
			array_map(
				'mh_leads_csv_cell',
				array(
					$r->id,
					$r->submission_time,
					$statuses[ $r->lead_status ] ?? $r->lead_status,
					$r->full_name,
					$r->email,
					$r->phone,
					$r->company,
					$r->service,
					is_array( $fd ) ? ( $fd['message'] ?? '' ) : '',
					mh_lead_user_name( (int) $r->assigned_to ),
					$r->follow_up_at,
					(int) $r->starred ? 'Yes' : 'No',
					'unread' === $r->status ? 'No' : 'Yes',
					$r->page_url,
					$r->location_info,
					$r->ip_address,
					mh_lead_form_type_label( (string) $r->form_type ),
				)
			),
			',',
			'"',
			''
		);
	}
	fclose( $out );
	exit;
}
add_action( 'wp_ajax_mh_leads_export', 'mh_leads_export' );

/* -------------------------------------------------------------------------
 * WordPress integration
 * ---------------------------------------------------------------------- */

/** "Leads" item (with unread badge) in wp-admin that opens the dashboard. */
add_action(
	'admin_menu',
	static function () {
		if ( ! current_user_can( MH_LEADS_CAP ) ) {
			return;
		}
		global $wpdb;
		$unread = (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . mh_leads_table() . " WHERE status = 'unread' AND trashed_at IS NULL AND lead_status <> 'spam'" ); // phpcs:ignore WordPress.DB
		$badge  = $unread ? ' <span class="awaiting-mod">' . number_format_i18n( $unread ) . '</span>' : '';
		add_menu_page( 'Leads', 'Leads' . $badge, MH_LEADS_CAP, 'mh-leads', '__return_null', 'dashicons-groups', 3 );
	}
);
add_action(
	'admin_init',
	static function () {
		if ( isset( $_GET['page'] ) && 'mh-leads' === $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_safe_redirect( mh_leads_url() );
			exit;
		}
	}
);

/** Lead Managers go straight to the dashboard after signing in (admins keep their usual redirect). */
add_filter(
	'login_redirect',
	static function ( $redirect, $requested, $user ) {
		if ( $user instanceof WP_User && $user->has_cap( MH_LEADS_CAP ) && ! $user->has_cap( 'edit_posts' ) && ! $requested ) {
			return mh_leads_url();
		}
		return $redirect;
	},
	10,
	3
);

/** Keep the dashboard page out of WordPress' own sitemap. */
add_filter(
	'wp_sitemaps_posts_query_args',
	static function ( $args, $post_type ) {
		if ( 'page' === $post_type ) {
			$page = get_page_by_path( 'contact-dashboard' );
			if ( $page ) {
				$args['post__not_in'] = array_merge( $args['post__not_in'] ?? array(), array( $page->ID ) );
			}
		}
		return $args;
	},
	10,
	2
);
