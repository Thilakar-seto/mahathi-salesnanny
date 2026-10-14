<?php
/**
 * PAS Migration Problem Finder — server side (/pas-migration-problem-finder).
 *
 * The page (assets/js/pas-finder/*) posts the visitor's details and problem selections as JSON to
 * admin-ajax.php?action=mh_pas_finder. This endpoint:
 *   1. validates the request (nonce, rate limit, required fields, consent, known problem ids only),
 *   2. scores the selections with mh_pas_match() — a line-for-line port of MHEngine.match() so the
 *      e-mailed results always equal the on-screen results,
 *   3. stores the lead in the Lead Dashboard (form_type "pas_finder"), posts it to the WhatsApp
 *      group and e-mails the team, exactly like the contact form,
 *   4. e-mails the visitor their results (mh_pas_email() — a port of MHEmail.build()).
 * The results are always computed here from the selections; nothing the browser sends is
 * trusted as HTML or e-mail content.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Areas, impact weights and bands (generated from engine.js). */
function mh_pas_data(): array {
	static $data = null;
	if ( null === $data ) {
		$data = require __DIR__ . '/pas-finder-data.php';
	}
	return $data;
}

/** JavaScript Math.round() for the non-negative values used here. */
function mh_pas_round( float $x ): int {
	return (int) floor( $x + 0.5 );
}

/* -------------------------------------------------------------------------
 * Engine — port of MHEngine.match() (assets/js/pas-finder/engine.js)
 * ---------------------------------------------------------------------- */

function mh_pas_fit( int $s ): array {
	if ( $s >= 67 ) {
		return array( 'key' => 'strong', 'label' => 'High priority' );
	}
	if ( $s >= 34 ) {
		return array( 'key' => 'good', 'label' => 'Medium priority' );
	}
	if ( $s > 0 ) {
		return array( 'key' => 'partial', 'label' => 'Low priority' );
	}
	return array( 'key' => 'none', 'label' => 'Not selected' );
}

/** @param array $selections [ 'p1' => 'low'|'medium'|'high', ... ]; missing or invalid = not selected. */
function mh_pas_match( array $selections ): array {
	$d        = mh_pas_data();
	$impact   = $d['impact'];
	$bands    = $d['bands'];
	$problems = array();
	foreach ( $d['areas'] as $a ) {
		foreach ( $a['problems'] as $p ) {
			$problems[] = array( 'id' => $p['id'], 'area' => $a['id'], 'text' => $p['text'], 'regulatory' => ! empty( $a['regulatory'] ) );
		}
	}
	$max_area  = 2 * $impact['high']['w'];
	$max_total = count( $problems ) * $impact['high']['w'];
	$order     = array_column( $d['areas'], 'id' );

	$selected = 0;
	$total    = 0;
	$areas    = array();
	foreach ( $d['areas'] as $a ) {
		$pts  = 0;
		$hits = array();
		foreach ( $a['problems'] as $p ) {
			$lv = $selections[ $p['id'] ] ?? null;
			if ( ! is_string( $lv ) || ! isset( $impact[ $lv ] ) ) {
				continue;
			}
			$pts += $impact[ $lv ]['w'];
			$selected++;
			$hits[] = array( 'id' => $p['id'], 'text' => $p['text'], 'impact' => $lv, 'impactLabel' => $impact[ $lv ]['label'] );
		}
		$total  += $pts;
		$s       = mh_pas_round( $pts / $max_area * 100 );
		$areas[] = array(
			'id' => $a['id'], 'name' => $a['name'], 'sub' => $a['sub'], 'score' => $s, 'points' => $pts, 'fit' => mh_pas_fit( $s ), 'hits' => $hits,
			'cost' => $a['cost'], 'costUnit' => $a['costUnit'], 'costDriver' => $a['costDriver'], 'regulatory' => ! empty( $a['regulatory'] ),
			'approach' => $a['approach'], 'accelerators' => $a['accelerators'], 'outcomes' => $a['outcomes'],
		);
	}

	$ranked = $areas;
	usort(
		$ranked,
		static function ( $x, $y ) use ( $order ) {
			return ( $y['score'] - $x['score'] ) ?: ( count( $y['hits'] ) - count( $x['hits'] ) ) ?: ( array_search( $x['id'], $order, true ) - array_search( $y['id'], $order, true ) );
		}
	);
	foreach ( $ranked as $i => &$area ) {
		$area['rank'] = $i + 1;
	}
	unset( $area );

	$exposure = mh_pas_round( $total / $max_total * 100 );
	$by_key   = static function ( string $k ) use ( $bands ) {
		foreach ( $bands as $b ) {
			if ( $b['key'] === $k ) {
				return $b;
			}
		}
		return $bands[ count( $bands ) - 1 ];
	};
	$band = $bands[ count( $bands ) - 1 ];
	foreach ( $bands as $b ) {
		if ( $exposure >= $b['min'] ) {
			$band = $b;
			break;
		}
	}
	$rank     = static fn( array $b ): int => (int) array_search( $b['key'], array( 'low', 'moderate', 'high', 'critical' ), true );
	$reg_high = false;
	$any_high = false;
	$high_cnt = 0;
	foreach ( $problems as $p ) {
		if ( ( $selections[ $p['id'] ] ?? null ) === 'high' ) {
			$any_high = true;
			$high_cnt++;
			$reg_high = $reg_high || $p['regulatory'];
		}
	}
	$floor = null;
	if ( $reg_high && $rank( $band ) < $rank( $by_key( 'high' ) ) ) {
		$floor = 'regulatory';
		$band  = array_merge( $by_key( 'high' ), array( 'note' => 'A high-impact regulatory reporting problem can delay go-live on its own. Plan for it before the build starts.' ) );
	} elseif ( $any_high && $rank( $band ) < $rank( $by_key( 'moderate' ) ) ) {
		$floor = 'severe';
		$band  = array_merge( $by_key( 'moderate' ), array( 'note' => 'You have at least one high-impact problem. A focused fix for it will remove most of the risk.' ) );
	}
	$matched = array_values( array_filter( $ranked, static fn( $a ) => $a['score'] > 0 ) );

	return array(
		'version'       => $d['version'],
		'selected'      => $selected,
		'totalProblems' => count( $problems ),
		'exposure'      => $exposure,
		'band'          => $band,
		'floor'         => $floor,
		'floorNote'     => 'regulatory' === $floor ? 'Raised to High because you rated a regulatory reporting problem as high impact.' : ( 'severe' === $floor ? 'Raised to Moderate because you rated at least one problem as high impact.' : '' ),
		'areas'         => $areas,
		'ranked'        => $ranked,
		'matched'       => $matched,
		'top'           => array_slice( $matched, 0, 3 ),
		'highImpact'    => $high_cnt,
	);
}

/* -------------------------------------------------------------------------
 * Results e-mail — port of MHEmail.build() (assets/js/pas-finder/email-template.js)
 * ---------------------------------------------------------------------- */

function mh_pas_esc( $s ): string {
	return strtr( (string) $s, array( '&' => '&amp;', '<' => '&lt;', '>' => '&gt;', '"' => '&quot;', "'" => '&#39;' ) );
}

/** @param array $opts [ 'lead' => [...], 'result' => mh_pas_match(), 'ctaUrl', 'logoUrl', 'showCost' ] */
function mh_pas_email( array $opts ): array {
	$F       = "font-family:Poppins,'Segoe UI',Helvetica,Arial,sans-serif;";
	$C       = array( 'ink' => '#222222', 'ink2' => '#444444', 'ink3' => '#595959', 'title' => '#302D42', 'sage' => '#547852', 'sageTxt' => '#4F6149', 'sageBg' => '#EEF2EC', 'tint' => '#EEF2EC', 'line' => '#DEE2E6', 'bg' => '#F4F4F2' );
	$TAG     = array( 'high' => array( '#8F3E4F', '#F6EBED' ), 'medium' => array( '#3E4655', '#E5E5F0' ), 'low' => array( '#4F6149', '#EEF2EC' ), 'critical' => array( '#FFFFFF', '#8F3E4F' ), 'moderate' => array( '#3E4655', '#E5E5F0' ), 'strong' => array( '#8F3E4F', '#F6EBED' ), 'good' => array( '#3E4655', '#E5E5F0' ), 'partial' => array( '#4F6149', '#EEF2EC' ) );
	$BANDTAG = array( 'critical' => $TAG['critical'], 'high' => array( '#8F3E4F', '#F6EBED' ), 'moderate' => $TAG['moderate'], 'low' => $TAG['low'] );
	$esc     = 'mh_pas_esc';
	$tag     = static function ( $t, $key, $map = null ) use ( $F, $TAG ) {
		$c = ( $map ?? $TAG )[ $key ];
		return '<span style="' . $F . 'display:inline-block;padding:2px 10px;border-radius:12px;font-size:12px;font-weight:600;color:' . $c[0] . ';background:' . $c[1] . ';white-space:nowrap;">' . $t . '</span>';
	};
	$p = static fn( $t, $x = '' ) => '<p style="' . $F . 'font-size:14px;line-height:1.6;color:' . $C['ink2'] . ';margin:0 0 12px;' . $x . '">' . $t . '</p>';
	$h = static fn( $t ) => '<p style="' . $F . 'font-size:20px;font-weight:400;text-transform:uppercase;color:' . $C['title'] . ';margin:28px 0 12px;">' . $t . '</p>';

	$r         = $opts['result'];
	$lead      = $opts['lead'] ?? array();
	$cta       = ! empty( $opts['ctaUrl'] ) ? $opts['ctaUrl'] : 'https://mahathiinfotech.com/contact-us';
	$show_cost = ( $opts['showCost'] ?? true ) !== false;
	$top       = $r['matched'][0];

	$area_block = static function ( $a ) use ( $F, $C, $tag, $esc, $show_cost ) {
		$hits = '';
		foreach ( $a['hits'] as $x ) {
			$hits .= '<tr><td style="' . $F . 'font-size:13px;color:' . $C['ink'] . ';padding:3px 0;">' . $esc( $x['text'] ) . '</td><td align="right" style="padding:3px 0 3px 8px;">' . $tag( $x['impactLabel'], $x['impact'] ) . '</td></tr>';
		}
		$approach = '';
		foreach ( $a['approach'] as $x ) {
			$approach .= '<div style="' . $F . 'font-size:13px;line-height:1.5;color:' . $C['ink'] . ';margin:0 0 4px;">&bull;&nbsp; ' . $esc( $x ) . '</div>';
		}
		return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 14px;background:#FFFFFF;border:1px solid ' . $C['line'] . ';border-radius:12px;"><tr><td style="padding:16px 18px;">' .
			'<table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr>' .
			'<td width="44" valign="top"><div style="' . $F . 'width:36px;height:36px;line-height:36px;text-align:center;border-radius:0 30%;background:' . ( $a['rank'] <= 3 ? $C['sage'] : $C['sageBg'] ) . ';color:' . ( $a['rank'] <= 3 ? '#FFFFFF' : $C['sageTxt'] ) . ';font-weight:600;font-size:15px;">' . $a['rank'] . '</div></td>' .
			'<td valign="top"><div style="' . $F . 'font-size:16px;font-weight:600;color:' . $C['sageTxt'] . ';">' . $esc( $a['name'] ) . '</div><div style="' . $F . 'font-size:12px;color:' . $C['ink3'] . ';">' . $esc( $a['sub'] ) . '</div></td>' .
			'<td align="right" valign="top" style="white-space:nowrap;"><div style="' . $F . 'font-size:20px;font-weight:600;color:' . $C['title'] . ';">' . $a['score'] . '%</div>' . $tag( $a['fit']['label'], $a['fit']['key'] ) . '</td></tr></table>' .
			'<div style="' . $F . 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:' . $C['ink3'] . ';margin:14px 0 4px;">Problems you flagged</div>' .
			'<table role="presentation" width="100%" cellpadding="0" cellspacing="0">' . $hits . '</table>' .
			'<div style="' . $F . 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;color:' . $C['ink3'] . ';margin:14px 0 4px;">How Mahathi solves it</div>' .
			$approach .
			'<div style="' . $F . 'font-size:13px;color:' . $C['ink'] . ';margin-top:10px;"><b>Accelerators:</b> ' . $esc( implode( ', ', $a['accelerators'] ) ) . '</div>' .
			'<div style="' . $F . 'font-size:13px;color:' . $C['sageTxt'] . ';margin-top:6px;"><b>Results on Mahathi engagements:</b> ' . $esc( implode( '; ', $a['outcomes'] ) ) . '</div>' .
			( $show_cost ? '<div style="' . $F . 'font-size:12px;line-height:1.5;color:' . $C['ink3'] . ';margin-top:10px;background:' . $C['bg'] . ';padding:8px 10px;border-radius:6px;">Average engagement cost: <b style="color:' . $C['ink'] . ';">' . $esc( $a['cost'] ) . '</b><br>Why it is priced per ' . $esc( $a['costUnit'] ) . ': ' . $esc( $a['costDriver'] ) . '</div>' : '' ) .
			'</td></tr></table>';
	};

	$unflagged = array_map( static fn( $a ) => $a['name'], array_values( array_filter( $r['ranked'], static fn( $a ) => ! $a['score'] ) ) );

	$html = '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Your PAS Migration Problem Finder results</title></head>' .
		'<body style="margin:0;padding:0;background:' . $C['bg'] . ';">' .
		'<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:' . $C['bg'] . ';"><tr><td align="center" style="padding:24px 12px;">' .
		'<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background:#FFFFFF;">' .
		'<tr><td style="height:6px;line-height:6px;font-size:0;background:#76A379;">&nbsp;</td></tr>' .
		'<tr><td style="padding:18px 24px;border-bottom:1px solid ' . $C['line'] . ';">' . ( ! empty( $opts['logoUrl'] ) ? '<img src="' . $esc( $opts['logoUrl'] ) . '" width="130" alt="Mahathi Infotech" style="display:block;border:0;">' : '<span style="' . $F . 'font-size:18px;color:' . $C['sageTxt'] . ';">mahathi</span>' ) . '</td></tr>' .
		'<tr><td style="padding:24px 24px 8px;background:' . $C['tint'] . ';">' .
			'<div style="' . $F . 'font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:' . $C['sageTxt'] . ';">PAS Migration Problem Finder</div>' .
			'<div style="' . $F . 'font-size:22px;font-weight:400;text-transform:uppercase;color:' . $C['title'] . ';margin:6px 0 14px;line-height:1.3;">Your top risk area is ' . $esc( $top['name'] ) . '</div>' .
			'<table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 0 16px;"><tr>' .
				'<td style="background:#FFFFFF;border-radius:0 30%;padding:16px 26px;text-align:center;"><div style="' . $F . 'font-size:11px;text-transform:uppercase;letter-spacing:1px;color:' . $C['ink3'] . ';">Migration risk score</div><div style="' . $F . 'font-size:36px;font-weight:600;color:' . $C['title'] . ';line-height:1.1;">' . $r['exposure'] . '<span style="font-size:14px;font-weight:400;color:' . $C['ink3'] . ';">/100</span></div>' . $tag( $r['band']['label'], $r['band']['key'], $BANDTAG ) . '</td>' .
				'<td style="padding-left:18px;' . $F . 'font-size:13px;color:' . $C['ink2'] . ';line-height:1.8;">' . $r['selected'] . ' problems selected<br>' . $r['highImpact'] . ' rated high impact<br>' . count( $r['matched'] ) . ' of 7 areas affected</td>' .
			'</tr></table></td></tr>' .
		'<tr><td style="padding:20px 24px 8px;">' .
			$p( 'Hi ' . $esc( ! empty( $lead['firstName'] ) ? $lead['firstName'] : 'there' ) . ',' ) .
			$p( 'Thank you for using the PAS Migration Problem Finder. Based on the problems you selected, here is how the seven core migration areas rank for your team, and how Mahathi approaches each one.' ) .
			$p( $esc( $r['band']['note'] ) . ( $r['floorNote'] ? ' ' . $esc( $r['floorNote'] ) : '' ) ) .
			$h( 'Your areas, ranked' ) . implode( '', array_map( $area_block, $r['matched'] ) ) .
			( count( $r['ranked'] ) > count( $r['matched'] ) ? $p( 'Areas you did not flag: ' . $esc( implode( ', ', $unflagged ) ) . '.', 'font-size:13px;color:' . $C['ink3'] . ';' ) : '' ) .
			$h( 'Next step' ) .
			$p( 'Our PAS migration team can walk through these results with you in a 30-minute call and outline a practical plan for your top areas.' ) .
			'<table role="presentation" cellpadding="0" cellspacing="0" style="margin:4px 0 20px;"><tr><td style="background:' . $C['sage'] . ';border-radius:24px;"><a href="' . $esc( $cta ) . '" style="' . $F . 'display:inline-block;padding:12px 26px;font-size:14px;font-weight:600;color:#FFFFFF;text-decoration:none;">Book a 30-minute call</a></td></tr></table>' .
			$p( 'Regards,<br>PAS Migration Team, Mahathi Infotech' ) .
		'</td></tr>' .
		'<tr><td style="padding:16px 24px;border-top:1px solid ' . $C['line'] . ';' . $F . 'font-size:11px;line-height:1.6;color:' . $C['ink3'] . ';">' .
			'Mahathi Infotech LLC, 630 Freedom Business Center Dr, Floor 3, King of Prussia, PA 19406, USA. You received this email because you requested your results at mahathiinfotech.com. Scores are based only on the problems you selected. Outcomes are from past Mahathi engagements; results vary by program. Costs are Mahathi’s average engagement costs per unit, indicative only; final scope and price are set after discovery.' .
		'</td></tr></table></td></tr></table></body></html>';

	$blocks = array();
	foreach ( $r['matched'] as $a ) {
		$lines = array();
		foreach ( $a['hits'] as $x ) {
			$lines[] = '   - ' . $x['text'] . ' [' . $x['impactLabel'] . ']';
		}
		$blocks[] = $a['rank'] . '. ' . $a['name'] . ' - ' . $a['score'] . '% (' . $a['fit']['label'] . ")\n" .
			implode( "\n", $lines ) . "\n" .
			'   How Mahathi solves it: ' . implode( '; ', $a['approach'] ) . "\n" .
			'   Accelerators: ' . implode( ', ', $a['accelerators'] ) . "\n" .
			'   Results on Mahathi engagements: ' . implode( '; ', $a['outcomes'] ) .
			( $show_cost ? "\n   Average engagement cost: " . $a['cost'] . ' (priced per ' . $a['costUnit'] . ': ' . $a['costDriver'] . ')' : '' );
	}
	$text = 'Hi ' . ( ! empty( $lead['firstName'] ) ? $lead['firstName'] : 'there' ) . ",\n\n" .
		"Thank you for using the PAS Migration Problem Finder.\n\n" .
		'Migration risk score: ' . $r['exposure'] . '/100 (' . $r['band']['label'] . ")\n" . $r['band']['note'] . ( $r['floorNote'] ? ' ' . $r['floorNote'] : '' ) . "\n" .
		'Problems selected: ' . $r['selected'] . ' | High impact: ' . $r['highImpact'] . ' | Areas affected: ' . count( $r['matched'] ) . " of 7\n\n" .
		"Your areas, ranked:\n\n" . implode( "\n\n", $blocks ) . "\n\n" .
		'Book a 30-minute call: ' . $cta . "\n\nRegards,\nPAS Migration Team, Mahathi Infotech\n";

	return array( 'subject' => 'Your PAS migration results: top risk area is ' . $top['name'], 'html' => $html, 'text' => $text );
}

/* -------------------------------------------------------------------------
 * Submission endpoint
 * ---------------------------------------------------------------------- */

/** JSON error in the shape the tool reads ({ error }). */
function mh_pas_fail( string $message, int $status ): void {
	wp_send_json( array( 'error' => $message ), $status );
}

/** Plain-text summary of a result (dashboard message, WhatsApp and team e-mail). */
function mh_pas_summary( array $r ): string {
	$out = 'Migration risk score: ' . $r['exposure'] . '/100 (' . $r['band']['label'] . ")\n" .
		$r['selected'] . ( 1 === $r['selected'] ? ' problem' : ' problems' ) . ' selected · ' . $r['highImpact'] . ' high impact · ' . count( $r['matched'] ) . ( 1 === count( $r['matched'] ) ? ' area' : ' areas' ) . " of 7 affected\n";
	foreach ( $r['matched'] as $a ) {
		$out .= "\n" . $a['rank'] . '. ' . $a['name'] . ' — ' . $a['score'] . '% (' . $a['fit']['label'] . ')';
		foreach ( $a['hits'] as $x ) {
			$out .= "\n   • " . $x['text'] . ' [' . $x['impactLabel'] . ']';
		}
	}
	return $out;
}

function mh_pas_finder_submit(): void {
	if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'mh_pas_finder' ) ) {
		mh_pas_fail( 'Your session has expired. Please refresh the page.', 403 );
	}
	$ip  = get_client_ip_address();
	$key = 'mh_pas_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		mh_pas_fail( 'Too many requests. Please try again later.', 429 );
	}

	$raw  = (string) file_get_contents( 'php://input', false, null, 0, 20000 );
	$body = json_decode( $raw, true );
	if ( ! is_array( $body ) ) {
		mh_pas_fail( 'We could not read your request.', 400 );
	}
	$in   = is_array( $body['lead'] ?? null ) ? $body['lead'] : array();
	$text = static fn( string $k, int $max ): string => mb_substr( sanitize_text_field( (string) ( $in[ $k ] ?? '' ) ), 0, $max );
	$lead = array(
		'firstName' => $text( 'firstName', 50 ),
		'lastName'  => $text( 'lastName', 50 ),
		'email'     => sanitize_email( (string) ( $in['email'] ?? '' ) ),
		'company'   => $text( 'company', 120 ),
		'title'     => $text( 'title', 120 ),
		'orgType'   => $text( 'orgType', 40 ),
	);
	$org_types = array( 'Insurance carrier', 'MGA', 'TPA', 'Program administrator', 'Other' );
	if ( '' === $lead['firstName'] || '' === $lead['lastName'] || '' === $lead['company'] || '' === $lead['title'] ) {
		mh_pas_fail( 'Please complete all the required fields.', 422 );
	}
	if ( ! is_email( $lead['email'] ) ) {
		mh_pas_fail( 'Enter a valid email, for example name@company.com.', 422 );
	}
	if ( ! in_array( $lead['orgType'], $org_types, true ) ) {
		mh_pas_fail( 'Select your organization type.', 422 );
	}
	if ( true !== ( $body['consent'] ?? null ) ) {
		mh_pas_fail( 'Please tick the consent box so we can send your results.', 422 );
	}

	// Only known problem ids with a valid impact level are kept.
	$known      = array();
	foreach ( mh_pas_data()['areas'] as $a ) {
		foreach ( $a['problems'] as $p ) {
			$known[] = $p['id'];
		}
	}
	$selections = array();
	foreach ( (array) ( $body['selections'] ?? array() ) as $id => $level ) {
		if ( in_array( $id, $known, true ) && in_array( $level, array( 'low', 'medium', 'high' ), true ) ) {
			$selections[ $id ] = $level;
		}
	}
	if ( ! $selections ) {
		mh_pas_fail( 'Select at least one problem.', 422 );
	}

	$result   = mh_pas_match( $selections );
	$summary  = mh_pas_summary( $result );
	$page_url = esc_url_raw( (string) ( $body['page'] ?? ( $_SERVER['HTTP_REFERER'] ?? '' ) ) );
	$details  = array(
		'first_name'        => $lead['firstName'],
		'last_name'         => $lead['lastName'],
		'email'             => $lead['email'],
		'company'           => $lead['company'],
		'job_title'         => $lead['title'],
		'organization_type' => $lead['orgType'],
		'subject'           => 'PAS Migration Problem Finder',
		'message'           => $summary,
		'risk_score'        => $result['exposure'] . '/100 (' . $result['band']['label'] . ')',
		'top_risk_area'     => $result['matched'][0]['name'],
		'consent'           => 'Agreed to receive results and be contacted',
		'selections'        => $selections,
		'engine_version'    => $result['version'],
		'form_type'         => 'pas_finder',
	);
	foreach ( (array) ( $body['utm'] ?? array() ) as $k => $v ) {
		if ( preg_match( '/^utm_(source|medium|campaign|term|content)$/', (string) $k ) && is_scalar( $v ) ) {
			$details[ $k ] = mb_substr( sanitize_text_field( (string) $v ), 0, 100 );
		}
	}

	global $wpdb;
	mh_leads_maybe_install();
	$location = get_location_from_ip( $ip );
	$saved    = $wpdb->insert(
		mh_leads_table(),
		array(
			'submission_time' => current_time( 'mysql' ),
			'page_url'        => $page_url,
			'ip_address'      => $ip,
			'location_info'   => $location,
			'browser_info'    => get_browser_info(),
			'form_details'    => wp_json_encode( $details ),
			'status'          => 'unread',
			'lead_status'     => 'new',
		) + mh_lead_columns_from_details( $details )
	);
	if ( false === $saved ) {
		mh_pas_fail( 'We could not prepare your results.', 500 );
	}
	$lead_id = (int) $wpdb->insert_id;
	set_transient( $key, $hit + 1, HOUR_IN_SECONDS );

	// Team notifications, as for the contact form. Failures are recorded on the lead, never shown to the visitor.
	mh_whatsapp_notify_lead( $lead_id );
	mh_contact_notify(
		array( 'first_name' => $lead['firstName'], 'last_name' => $lead['lastName'], 'email' => $lead['email'], 'company' => $lead['company'], 'phone' => '', 'subject' => 'PAS Migration Problem Finder', 'message' => $summary ),
		$page_url,
		$ip,
		$location,
		$lead_id,
		'New PAS Migration Problem Finder lead'
	);

	// The visitor's results e-mail (HTML + plain-text alternative).
	$mail    = mh_pas_email( array( 'lead' => $lead, 'result' => $result, 'logoUrl' => mh_asset_src( 'images/mahathi_logo2.png' ), 'ctaUrl' => home_url( '/contact-us' ) ) );
	$alt     = static function ( $phpmailer ) use ( $mail ) {
		$phpmailer->AltBody = $mail['text'];
	};
	add_action( 'phpmailer_init', $alt );
	$sent = wp_mail( $lead['email'], $mail['subject'], $mail['html'], array( 'Content-Type: text/html; charset=UTF-8' ) );
	remove_action( 'phpmailer_init', $alt );
	mh_lead_log( $lead_id, 'email', $sent ? 'Results e-mailed to ' . $lead['email'] : 'Results e-mail could not be sent to ' . $lead['email'] );

	wp_send_json( array( 'ok' => true ) );
}
add_action( 'wp_ajax_mh_pas_finder', 'mh_pas_finder_submit' );
add_action( 'wp_ajax_nopriv_mh_pas_finder', 'mh_pas_finder_submit' );
