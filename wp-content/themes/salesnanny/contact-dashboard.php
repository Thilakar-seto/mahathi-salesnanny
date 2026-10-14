<?php
/*
Template Name: Contact Dashboard
*/

/**
 * Lead dashboard (/contact-dashboard/) — contact form submissions.
 *
 * Access is WordPress sign-in + the mh_manage_leads capability (inc/leads.php). Signed-out visitors
 * get a sign-in card; signed-in users without the capability get a "no access" message. The app
 * itself is rendered by assets/js/leads-dashboard.js from the AJAX endpoints in inc/leads.php.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

nocache_headers();
header( 'X-Robots-Tag: noindex, nofollow', true );

$mh_user      = wp_get_current_user();
$mh_can       = current_user_can( MH_LEADS_CAP );
$mh_dashboard = mh_leads_url();
$mh_css_ver   = mh_asset_ver( 'css/leads-dashboard.css' );
$mh_js_ver    = mh_asset_ver( 'js/leads-dashboard.js' );

if ( $mh_can ) {
	global $wpdb;
	$mh_services = array_values(
		array_unique(
			array_merge(
				mh_contact_services(),
				$wpdb->get_col( 'SELECT DISTINCT service FROM ' . mh_leads_table() . " WHERE service <> '' ORDER BY service" ) // phpcs:ignore WordPress.DB
			)
		)
	);
	$mh_config = array(
		'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'mh_leads' ),
		'statuses'  => mh_lead_statuses(),
		'services'  => $mh_services,
		'team'      => mh_lead_team(),
		'me'        => get_current_user_id(),
		'timezone'  => wp_timezone_string(),
		'whatsapp'  => null !== mh_whatsapp_config(), // on/off only — credentials never reach the browser
	);
}
$mh_initials = static function ( string $name ): string {
	$parts = preg_split( '/\s+/', trim( $name ) );
	return strtoupper( mb_substr( $parts[0] ?? '', 0, 1 ) . mb_substr( count( $parts ) > 1 ? end( $parts ) : '', 0, 1 ) );
};
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Lead Dashboard · Mahathi</title>
<link rel="icon" type="image/x-icon" href="<?= esc_url( mh_asset( 'favicon.ico' ) ) ?>">
<link rel="stylesheet" href="<?= esc_url( mh_asset( 'css/fonts.css' ) ) ?>">
<link rel="stylesheet" href="<?= esc_url( mh_asset( 'vendor/fontawesome/css/all.min.css' ) ) ?>">
<link rel="stylesheet" href="<?= esc_url( add_query_arg( 'ver', $mh_css_ver, mh_asset( 'css/leads-dashboard.css' ) ) ) ?>">
</head>
<body class="mhd">

<?php if ( ! $mh_can ) : ?>
<main class="mhd-gate">
  <div class="mhd-gate__card">
    <img class="mhd-gate__logo" src="<?= mh_asset_url( 'images/mahathi_logo2.png' ) ?>" alt="Mahathi Infotech" width="168" height="57">
    <?php if ( ! is_user_logged_in() ) : ?>
      <h1 class="mhd-gate__title">Lead Dashboard</h1>
      <p class="mhd-gate__text">Sign in with your Mahathi WordPress account to manage website enquiries.</p>
      <?php
      wp_login_form(
          array(
              'redirect'       => $mh_dashboard,
              'label_username' => 'Username or email',
              'label_log_in'   => 'Sign in',
              'remember'       => true,
          )
      );
      ?>
      <a class="mhd-gate__link" href="<?= esc_url( wp_lostpassword_url( $mh_dashboard ) ) ?>">Forgot your password?</a>
    <?php else : ?>
      <span class="mhd-gate__icon"><i class="fa-solid fa-lock" aria-hidden="true"></i></span>
      <h1 class="mhd-gate__title">No access yet</h1>
      <p class="mhd-gate__text">You're signed in as <strong><?= esc_html( $mh_user->display_name ) ?></strong>, but this account can't view leads. Ask an administrator to give you the <strong>Lead Manager</strong> role.</p>
      <a class="mhd-btn mhd-btn--primary" href="<?= esc_url( wp_logout_url( $mh_dashboard ) ) ?>">Sign in with another account</a>
    <?php endif; ?>
    <a class="mhd-gate__back" href="<?= esc_url( home_url( '/' ) ) ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>Back to website</a>
  </div>
</main>

<?php else : ?>
<div class="mhd-app">
  <header class="mhd-topbar">
    <a class="mhd-brand" href="<?= esc_url( $mh_dashboard ) ?>">
      <img src="<?= mh_asset_url( 'images/mahathi_logo2.png' ) ?>" alt="Mahathi Infotech" width="118" height="40">
      <span class="mhd-brand__sep" aria-hidden="true"></span>
      <span class="mhd-brand__title">Lead Dashboard</span>
    </a>
    <div class="mhd-topbar__right">
      <span class="mhd-live" title="New leads appear automatically (checked every minute)"><span class="mhd-live__dot" aria-hidden="true"></span>Live</span>
      <a class="mhd-btn mhd-btn--ghost mhd-hide-sm" href="<?= esc_url( home_url( '/' ) ) ?>" target="_blank" rel="noopener"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>View website</a>
      <div class="mhd-user">
        <button type="button" class="mhd-user__btn" aria-haspopup="true" aria-expanded="false" data-mhd-user>
          <span class="mhd-avatar mhd-avatar--sm"><?= esc_html( $mh_initials( $mh_user->display_name ) ) ?></span>
          <span class="mhd-user__name mhd-hide-sm"><?= esc_html( $mh_user->display_name ) ?></span>
          <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
        </button>
        <div class="mhd-menu" role="menu" hidden data-mhd-user-menu>
          <?php if ( current_user_can( 'manage_options' ) ) : ?>
            <a role="menuitem" href="<?= esc_url( admin_url() ) ?>"><i class="fa-solid fa-gauge" aria-hidden="true"></i>WordPress admin</a>
            <a role="menuitem" href="<?= esc_url( admin_url( 'users.php?role=mh_lead_manager' ) ) ?>"><i class="fa-solid fa-user-plus" aria-hidden="true"></i>Manage team access</a>
          <?php endif; ?>
          <a role="menuitem" href="<?= esc_url( wp_logout_url( $mh_dashboard ) ) ?>"><i class="fa-solid fa-right-from-bracket" aria-hidden="true"></i>Sign out</a>
        </div>
      </div>
    </div>
  </header>

  <main class="mhd-main">
    <div class="mhd-pagehead">
      <div>
        <h1>Leads</h1>
        <p>Every enquiry from the website's “Get in Touch” form, organised and ready to follow up.</p>
      </div>
      <div class="mhd-pagehead__actions">
        <button type="button" class="mhd-btn mhd-btn--ghost" data-mhd-refresh title="Refresh"><i class="fa-solid fa-rotate" aria-hidden="true"></i><span class="mhd-hide-sm">Refresh</span></button>
        <button type="button" class="mhd-btn mhd-btn--primary" data-mhd-export><i class="fa-solid fa-file-arrow-down" aria-hidden="true"></i>Export CSV</button>
      </div>
    </div>

    <section class="mhd-kpis" aria-label="Summary" data-mhd-kpis>
      <?php for ( $i = 0; $i < 5; $i++ ) : ?><div class="mhd-kpi mhd-skeleton"></div><?php endfor; ?>
    </section>

    <section class="mhd-insights">
      <div class="mhd-card mhd-trend">
        <div class="mhd-card__head">
          <div><h2>Leads over the last 30 days</h2><p data-mhd-trend-sub>&nbsp;</p></div>
        </div>
        <div class="mhd-trend__chart" data-mhd-trend></div>
      </div>
      <div class="mhd-card mhd-services">
        <div class="mhd-card__head"><div><h2>Most requested services</h2><p>Across all active leads</p></div></div>
        <ul class="mhd-services__list" data-mhd-services></ul>
      </div>
    </section>

    <section class="mhd-card mhd-leads" aria-label="Leads">
      <nav class="mhd-tabs" aria-label="Pipeline stage" data-mhd-tabs></nav>

      <div class="mhd-filters">
        <label class="mhd-search">
          <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
          <span class="mhd-sr">Search leads</span>
          <input type="search" placeholder="Search name, email, company, phone or message…" data-mhd-search autocomplete="off">
          <kbd class="mhd-hide-sm">/</kbd>
        </label>
        <select class="mhd-select" data-mhd-service aria-label="Service">
          <option value="">All services</option>
        </select>
        <select class="mhd-select" data-mhd-range aria-label="Date received">
          <option value="">Any time</option>
          <option value="today">Today</option>
          <option value="7">Last 7 days</option>
          <option value="30">Last 30 days</option>
          <option value="month">This month</option>
          <option value="custom">Custom range…</option>
        </select>
        <div class="mhd-daterange" data-mhd-custom hidden>
          <input type="date" class="mhd-select" data-mhd-from aria-label="From date">
          <span>to</span>
          <input type="date" class="mhd-select" data-mhd-to aria-label="To date">
        </div>
        <div class="mhd-chips" role="group" aria-label="Quick filters">
          <button type="button" class="mhd-chip" aria-pressed="false" data-mhd-chip="unread"><i class="fa-solid fa-circle" aria-hidden="true"></i>Unread</button>
          <button type="button" class="mhd-chip" aria-pressed="false" data-mhd-chip="starred"><i class="fa-solid fa-star" aria-hidden="true"></i>Starred</button>
          <button type="button" class="mhd-chip" aria-pressed="false" data-mhd-chip="followups"><i class="fa-solid fa-bell" aria-hidden="true"></i>Follow-ups due</button>
        </div>
        <button type="button" class="mhd-linkbtn" data-mhd-clear hidden>Clear filters</button>
      </div>

      <div class="mhd-bulk" data-mhd-bulk hidden>
        <strong data-mhd-bulk-count>0 selected</strong>
        <div class="mhd-bulk__actions" data-mhd-bulk-normal>
          <button type="button" class="mhd-btn mhd-btn--sm" data-mhd-bulk-action="read"><i class="fa-regular fa-envelope-open" aria-hidden="true"></i>Mark read</button>
          <button type="button" class="mhd-btn mhd-btn--sm" data-mhd-bulk-action="unread"><i class="fa-regular fa-envelope" aria-hidden="true"></i>Mark unread</button>
          <select class="mhd-select mhd-select--sm" data-mhd-bulk-status aria-label="Change status"><option value="">Change status…</option></select>
          <button type="button" class="mhd-btn mhd-btn--sm" data-mhd-bulk-action="export"><i class="fa-solid fa-file-arrow-down" aria-hidden="true"></i>Export</button>
          <button type="button" class="mhd-btn mhd-btn--sm mhd-btn--danger" data-mhd-bulk-action="trash"><i class="fa-regular fa-trash-can" aria-hidden="true"></i>Trash</button>
        </div>
        <div class="mhd-bulk__actions" data-mhd-bulk-trash hidden>
          <button type="button" class="mhd-btn mhd-btn--sm" data-mhd-bulk-action="restore"><i class="fa-solid fa-rotate-left" aria-hidden="true"></i>Restore</button>
          <button type="button" class="mhd-btn mhd-btn--sm mhd-btn--danger" data-mhd-bulk-action="delete"><i class="fa-solid fa-trash" aria-hidden="true"></i>Delete forever</button>
        </div>
        <button type="button" class="mhd-linkbtn" data-mhd-bulk-action="clear">Clear selection</button>
      </div>

      <div class="mhd-tablewrap">
        <table class="mhd-table">
          <thead>
            <tr>
              <th class="mhd-col-check"><input type="checkbox" class="mhd-check" data-mhd-check-all aria-label="Select all on this page"></th>
              <th class="mhd-col-star"><span class="mhd-sr">Starred</span></th>
              <th><button type="button" class="mhd-sort" data-mhd-sort="name">Lead<i aria-hidden="true"></i></button></th>
              <th class="mhd-col-company"><button type="button" class="mhd-sort" data-mhd-sort="company">Company<i aria-hidden="true"></i></button></th>
              <th class="mhd-col-service"><button type="button" class="mhd-sort" data-mhd-sort="service">Service<i aria-hidden="true"></i></button></th>
              <th><button type="button" class="mhd-sort" data-mhd-sort="status">Status<i aria-hidden="true"></i></button></th>
              <th class="mhd-col-owner">Owner</th>
              <th class="mhd-col-date"><button type="button" class="mhd-sort" data-mhd-sort="received">Received<i aria-hidden="true"></i></button></th>
            </tr>
          </thead>
          <tbody data-mhd-rows></tbody>
        </table>
        <div class="mhd-empty" data-mhd-empty hidden></div>
      </div>

      <footer class="mhd-pager">
        <span data-mhd-range-text></span>
        <div class="mhd-pager__right">
          <label class="mhd-pager__per">Rows
            <select class="mhd-select mhd-select--sm" data-mhd-per>
              <option>10</option><option selected>25</option><option>50</option><option>100</option>
            </select>
          </label>
          <button type="button" class="mhd-iconbtn" data-mhd-page="-1" aria-label="Previous page"><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
          <span class="mhd-pager__num" data-mhd-page-text></span>
          <button type="button" class="mhd-iconbtn" data-mhd-page="1" aria-label="Next page"><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
        </div>
      </footer>
    </section>

    <p class="mhd-hint mhd-hide-sm"><kbd>/</kbd> search · <kbd>J</kbd> <kbd>K</kbd> next / previous lead · <kbd>Esc</kbd> close</p>
  </main>

  <div class="mhd-scrim" data-mhd-scrim hidden></div>
  <aside class="mhd-drawer" data-mhd-drawer aria-hidden="true" aria-label="Lead details" tabindex="-1"></aside>
  <div class="mhd-toasts" aria-live="polite" data-mhd-toasts></div>
</div>
<script>window.MH_LEADS = <?= wp_json_encode( $mh_config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) ?>;</script>
<script src="<?= esc_url( add_query_arg( 'ver', $mh_js_ver, mh_asset( 'js/leads-dashboard.js' ) ) ) ?>" defer></script>
<?php endif; ?>
</body>
</html>
