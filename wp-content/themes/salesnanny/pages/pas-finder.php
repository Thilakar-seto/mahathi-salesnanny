<?php
/**
 * <app-pas-finder> — PAS Migration Problem Finder (/pas-migration-problem-finder).
 *
 * The tool renders itself into #app (assets/js/pas-finder/app.js, with engine.js and
 * email-template.js). Submissions go to the admin-ajax endpoint in inc/pas-finder.php, which
 * stores the lead, notifies the team and e-mails the visitor their results.
 */
if (!defined('ABSPATH')) { exit; }
$mh_pas_api = add_query_arg(
    array(
        'action' => 'mh_pas_finder',
        'nonce'  => wp_create_nonce('mh_pas_finder'),
    ),
    admin_url('admin-ajax.php')
);
?>
<meta name="mh-api" content="<?= esc_url($mh_pas_api) ?>">
<main id="app" tabindex="-1"></main>
<div id="modalRoot"></div>
