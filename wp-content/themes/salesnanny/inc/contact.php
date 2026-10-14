<?php
/**
 * "Get in touch" popup / contact form back end.
 *
 * The popup (template-parts/contact-popup.php) posts to admin-ajax.php
 * (action=mahathi_contact). Submissions are stored in the
 * {prefix}enhanced_contact_submissions table (see inc/leads.php — they appear in
 * the lead dashboard at /contact-dashboard/), posted to the WhatsApp group (inc/whatsapp.php)
 * and e-mailed to the site administrator.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Services offered in the popup's select box. */
function mh_contact_services(): array {
	return mh_data( 'contact-popup' )['services'] ?? array();
}

function mh_contact_submit(): void {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'mh_contact' ) ) {
		wp_send_json_error( array( 'message' => 'Your session has expired. Please refresh the page and try again.' ), 403 );
	}

	// Honeypot: real visitors never fill this in.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => 'Thank you!' ) );
	}

	$ip  = get_client_ip_address();
	$key = 'mh_contact_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		wp_send_json_error( array( 'message' => 'Too many requests. Please try again later.' ), 429 );
	}

	$data = array(
		'first_name' => sanitize_text_field( wp_unslash( $_POST['firstName'] ?? '' ) ),
		'last_name'  => sanitize_text_field( wp_unslash( $_POST['lastName'] ?? '' ) ),
		'email'      => sanitize_email( wp_unslash( $_POST['email'] ?? '' ) ),
		'company'    => sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) ),
		'phone'      => sanitize_text_field( wp_unslash( $_POST['mobile'] ?? '' ) ),
		'subject'    => sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) ),
		'message'    => sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) ),
		'form_type'  => 'contactus',
	);

	$errors = array();
	if ( '' === $data['first_name'] || mb_strlen( $data['first_name'] ) > 50 ) {
		$errors[] = 'First name is required.';
	}
	if ( '' === $data['last_name'] || mb_strlen( $data['last_name'] ) > 50 ) {
		$errors[] = 'Last name is required.';
	}
	if ( '' === $data['email'] || ! is_email( $data['email'] ) ) {
		$errors[] = 'Please enter a valid email address.';
	}
	if ( '' === $data['company'] || mb_strlen( $data['company'] ) > 100 ) {
		$errors[] = 'Company / contact info is required.';
	}
	if ( '' === $data['phone'] ) {
		$errors[] = 'Mobile number is required.';
	}
	if ( '' === $data['subject'] || ! in_array( $data['subject'], mh_contact_services(), true ) ) {
		$errors[] = 'Please select a service.';
	}
	if ( '' === $data['message'] || mb_strlen( $data['message'] ) > 1000 ) {
		$errors[] = 'Message is required.';
	}
	if ( $errors ) {
		wp_send_json_error( array( 'message' => implode( ' ', $errors ) ), 422 );
	}

	global $wpdb;
	$page_url      = esc_url_raw( wp_unslash( $_POST['page_url'] ?? ( $_SERVER['HTTP_REFERER'] ?? '' ) ) );
	$location_info = get_location_from_ip( $ip );
	mh_leads_maybe_install();
	$saved = $wpdb->insert(
		mh_leads_table(),
		array(
			'submission_time' => current_time( 'mysql' ),
			'page_url'        => $page_url,
			'ip_address'      => $ip,
			'location_info'   => $location_info,
			'browser_info'    => get_browser_info(),
			'form_details'    => wp_json_encode( $data ),
			'status'          => 'unread',
			'lead_status'     => 'new',
		) + mh_lead_columns_from_details( $data )
	);
	if ( false === $saved ) {
		wp_send_json_error( array( 'message' => 'Unable to submit form. Please try again.' ), 500 );
	}
	$lead_id = (int) $wpdb->insert_id;
	set_transient( $key, $hit + 1, HOUR_IN_SECONDS );

	// The lead is already saved; WhatsApp failures are logged on it and retried, never shown to the visitor.
	mh_whatsapp_notify_lead( $lead_id );
	mh_contact_notify( $data, $page_url, $ip, $location_info, $lead_id );
	wp_send_json_success( array( 'message' => 'Thank you! Our team will contact you shortly.' ) );
}
add_action( 'wp_ajax_mahathi_contact', 'mh_contact_submit' );
add_action( 'wp_ajax_nopriv_mahathi_contact', 'mh_contact_submit' );

/** E-mail notification for a new submission. */
function mh_contact_notify( array $data, string $page_url, string $ip, string $location, int $lead_id = 0, string $heading = 'New Contact Form Submission' ): void {
	$rows = array(
		'Name'     => $data['first_name'] . ' ' . $data['last_name'],
		'Email'    => $data['email'],
		'Company'  => $data['company'],
		'Phone'    => $data['phone'],
		'Service'  => $data['subject'],
		'Message'  => $data['message'],
		'Page'     => $page_url,
		'IP'       => $ip,
		'Location' => $location,
		'Time'     => current_time( 'mysql' ),
	);
	$html = '<html><body><h2>' . esc_html( $heading ) . '</h2><table style="border-collapse:collapse;width:100%">';
	foreach ( $rows as $label => $value ) {
		$cell  = 'Message' === $label ? nl2br( esc_html( $value ) ) : esc_html( $value );
		$html .= "<tr><td style='border:1px solid #ddd;padding:8px'><strong>" . esc_html( $label ) . ":</strong></td><td style='border:1px solid #ddd;padding:8px'>{$cell}</td></tr>";
	}
	$html .= '</table>';
	if ( $lead_id ) {
		$html .= '<p style="margin-top:20px"><a href="' . esc_url( mh_leads_url( $lead_id ) ) . '" style="display:inline-block;background:#253830;color:#fff;padding:12px 22px;border-radius:8px;text-decoration:none;font-weight:600">Open in Lead Dashboard</a></p>';
	}
	$html .= '</body></html>';

	wp_mail(
		get_option( 'admin_email' ),
		$heading . ' from ' . $data['first_name'] . ' ' . $data['last_name'],
		$html,
		array( 'Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . $data['email'] )
	);
}
