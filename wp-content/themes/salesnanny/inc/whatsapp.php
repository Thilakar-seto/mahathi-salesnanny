<?php
/**
 * WhatsApp group notification for new contact form leads (Green API).
 *
 * Credentials are PHP constants from wp-config-secrets.php (git-ignored, loaded by wp-config.php):
 *   MH_WHATSAPP_INSTANCE_ID, MH_WHATSAPP_API_TOKEN, MH_WHATSAPP_GROUP_ID, optional MH_WHATSAPP_API_URL.
 * They are used server-side only — never printed to a page or sent to the browser. Green API puts the
 * token in the request URL, so every error message is scrubbed before it is stored or logged.
 *
 * Delivery never affects the form: the lead is saved first, the send has a short timeout, and any
 * failure is recorded on the lead (whatsapp_status + activity log) and retried by WP-Cron.
 * Without credentials the feature is simply off.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const MH_WHATSAPP_MAX_ATTEMPTS = 3;

/** Validated settings, or null when WhatsApp is not configured. Filterable (used by tests). */
function mh_whatsapp_config(): ?array {
	$config = null;
	if ( defined( 'MH_WHATSAPP_INSTANCE_ID' ) && defined( 'MH_WHATSAPP_API_TOKEN' ) && defined( 'MH_WHATSAPP_GROUP_ID' ) ) {
		$id    = preg_replace( '/\D/', '', (string) MH_WHATSAPP_INSTANCE_ID );
		$token = trim( (string) MH_WHATSAPP_API_TOKEN );
		$group = trim( (string) MH_WHATSAPP_GROUP_ID );
		if ( '' !== $id && '' !== $token && preg_match( '/^[\d-]+@g\.us$/', $group ) ) {
			$base   = defined( 'MH_WHATSAPP_API_URL' ) && MH_WHATSAPP_API_URL ? untrailingslashit( (string) MH_WHATSAPP_API_URL ) : 'https://' . substr( $id, 0, 4 ) . '.api.greenapi.com';
			$config = array( 'id' => $id, 'token' => $token, 'group' => $group, 'base' => $base );
		}
	}
	return apply_filters( 'mh_whatsapp_config', $config );
}

/** Remove credentials from any text that might be stored or logged. */
function mh_whatsapp_scrub( string $text ): string {
	$config = mh_whatsapp_config();
	if ( $config ) {
		$text = str_replace( array( $config['token'], 'waInstance' . $config['id'] ), array( '[token]', 'waInstance[id]' ), $text );
	}
	return mb_substr( wp_strip_all_tags( $text ), 0, 300 );
}

/**
 * Call a Green API method. Returns ['ok' => bool, 'data' => array, 'error' => string].
 */
function mh_whatsapp_request( string $method, ?array $body = null ): array {
	$config = mh_whatsapp_config();
	if ( ! $config ) {
		return array( 'ok' => false, 'data' => array(), 'error' => 'WhatsApp is not configured.' );
	}
	$url  = $config['base'] . '/waInstance' . $config['id'] . '/' . $method . '/' . $config['token'];
	$args = array(
		'method'  => null === $body ? 'GET' : 'POST',
		'timeout' => 8,
		'headers' => array( 'Content-Type' => 'application/json' ),
	);
	if ( null !== $body ) {
		$args['body'] = wp_json_encode( $body );
	}

	$response = wp_remote_request( $url, $args );
	if ( is_wp_error( $response ) ) {
		return array( 'ok' => false, 'data' => array(), 'error' => 'Could not reach WhatsApp service: ' . mh_whatsapp_scrub( $response->get_error_message() ) );
	}
	$code = (int) wp_remote_retrieve_response_code( $response );
	$raw  = (string) wp_remote_retrieve_body( $response );
	$data = json_decode( $raw, true );
	if ( $code < 200 || $code >= 300 ) {
		$reasons = array(
			401 => 'authentication failed — check the instance ID and API token',
			403 => 'access denied by the WhatsApp service',
			429 => 'too many requests — rate limited',
			466 => 'the WhatsApp plan quota has been reached',
		);
		$detail = $reasons[ $code ] ?? ( is_array( $data ) && ! empty( $data['message'] ) ? (string) $data['message'] : trim( $raw ) );
		return array( 'ok' => false, 'data' => is_array( $data ) ? $data : array(), 'error' => 'WhatsApp service returned HTTP ' . $code . ( '' !== $detail ? ': ' . mh_whatsapp_scrub( $detail ) : '' ) );
	}
	return array( 'ok' => true, 'data' => is_array( $data ) ? $data : array(), 'error' => '' );
}

/** Connection check: instance state ("authorized" when the WhatsApp account is linked). */
function mh_whatsapp_status(): array {
	$res = mh_whatsapp_request( 'getStateInstance' );
	return array( 'ok' => $res['ok'] && 'authorized' === ( $res['data']['stateInstance'] ?? '' ), 'state' => $res['data']['stateInstance'] ?? '', 'error' => $res['error'] );
}

/** The group message for a lead row. */
function mh_whatsapp_message( object $lead ): string {
	$fd      = json_decode( (string) $lead->form_details, true );
	$fd      = is_array( $fd ) ? $fd : array();
	$message = trim( (string) ( $fd['message'] ?? '' ) );
	if ( mb_strlen( $message ) > 1200 ) {
		$message = mb_substr( $message, 0, 1200 ) . '…';
	}
	$path = (string) wp_parse_url( (string) $lead->page_url, PHP_URL_PATH );
	$when = wp_date( 'M j, Y g:i A', strtotime( $lead->submission_time . ' ' . wp_timezone_string() ) );

	$lines = array( '*🆕 New website enquiry*', '' );
	foreach (
		array(
			'Name'    => $lead->full_name,
			'Email'   => $lead->email,
			'Phone'   => $lead->phone,
			'Company' => $lead->company,
			'Service' => $lead->service,
		) as $label => $value
	) {
		if ( '' !== trim( (string) $value ) ) {
			$lines[] = '*' . $label . ':* ' . trim( (string) $value );
		}
	}
	if ( '' !== $message ) {
		array_push( $lines, '', '*Message:*', $message );
	}
	$lines[] = '';
	if ( '' !== $path ) {
		$lines[] = '*Page:* ' . $path;
	}
	$lines[] = '*Received:* ' . $when;
	$lines[] = '';
	$lines[] = 'Open in Lead Dashboard: ' . mh_leads_url( (int) $lead->id );
	return implode( "\n", $lines );
}

/**
 * Send a lead to the WhatsApp group. Never throws; failures are recorded and retried.
 * Returns true when the message was accepted by the API.
 */
function mh_whatsapp_notify_lead( int $lead_id ): bool {
	try {
		$config = mh_whatsapp_config();
		if ( ! $config || ! $lead_id ) {
			return false;
		}
		global $wpdb;
		$table = mh_leads_table();
		$lead  = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE id = %d", $lead_id ) ); // phpcs:ignore WordPress.DB
		if ( ! $lead || 'sent' === $lead->whatsapp_status ) {
			return (bool) $lead;
		}

		$attempt = (int) $lead->whatsapp_attempts + 1;
		$res     = mh_whatsapp_request( 'sendMessage', array( 'chatId' => $config['group'], 'message' => mh_whatsapp_message( $lead ) ) );

		if ( $res['ok'] && ! empty( $res['data']['idMessage'] ) ) {
			$wpdb->update(
				$table,
				array( 'whatsapp_status' => 'sent', 'whatsapp_attempts' => $attempt, 'whatsapp_message_id' => mb_substr( (string) $res['data']['idMessage'], 0, 64 ) ),
				array( 'id' => $lead_id )
			);
			mh_lead_log( $lead_id, 'whatsapp', 'Sent to the WhatsApp group' );
			return true;
		}

		$error = $res['ok'] ? 'WhatsApp service did not confirm the message.' : $res['error'];
		$retry = $attempt < MH_WHATSAPP_MAX_ATTEMPTS;
		$wpdb->update( $table, array( 'whatsapp_status' => 'failed', 'whatsapp_attempts' => $attempt ), array( 'id' => $lead_id ) );
		if ( $retry ) {
			wp_schedule_single_event( time() + 5 * MINUTE_IN_SECONDS * $attempt, 'mh_whatsapp_retry', array( $lead_id ) );
		}
		mh_lead_log( $lead_id, 'whatsapp', sprintf( 'WhatsApp delivery failed (attempt %d of %d): %s%s', $attempt, MH_WHATSAPP_MAX_ATTEMPTS, $error, $retry ? ' — will retry automatically' : '' ) );
		error_log( sprintf( '[Mahathi WhatsApp] lead #%d attempt %d: %s', $lead_id, $attempt, $error ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions -- already scrubbed
		return false;
	} catch ( Throwable $e ) {
		error_log( '[Mahathi WhatsApp] lead #' . $lead_id . ': ' . mh_whatsapp_scrub( $e->getMessage() ) ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions
		return false;
	}
}
add_action( 'mh_whatsapp_retry', 'mh_whatsapp_notify_lead' );

/** Dashboard: re-send a lead to WhatsApp (e.g. after fixing credentials). */
function mh_leads_ajax_whatsapp(): void {
	mh_leads_guard();
	global $wpdb;
	$id = absint( $_POST['id'] ?? 0 ); // phpcs:ignore WordPress.Security.NonceVerification -- checked in guard
	if ( ! mh_whatsapp_config() ) {
		wp_send_json_error( array( 'message' => 'WhatsApp is not configured on this server.' ), 422 );
	}
	// A manual resend starts a fresh round of attempts.
	$wpdb->update( mh_leads_table(), array( 'whatsapp_status' => '', 'whatsapp_attempts' => 0 ), array( 'id' => $id ) );
	wp_clear_scheduled_hook( 'mh_whatsapp_retry', array( $id ) );
	$ok  = mh_whatsapp_notify_lead( $id );
	$row = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . mh_leads_table() . ' WHERE id = %d', $id ) ); // phpcs:ignore WordPress.DB
	if ( ! $row ) {
		wp_send_json_error( array( 'message' => 'This lead no longer exists.' ), 404 );
	}
	$data = array( 'lead' => mh_lead_row( $row ), 'activity' => mh_lead_activity( $id ) );
	if ( $ok ) {
		wp_send_json_success( $data );
	}
	wp_send_json_error( $data + array( 'message' => 'WhatsApp delivery failed — see the activity log for the reason.' ), 502 );
}
add_action( 'wp_ajax_mh_leads_whatsapp', 'mh_leads_ajax_whatsapp' );
