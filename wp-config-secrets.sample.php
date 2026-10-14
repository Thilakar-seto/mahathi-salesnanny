<?php
/**
 * Template for wp-config-secrets.php (the real file is git-ignored and loaded by wp-config.php).
 * Copy this file to wp-config-secrets.php on each server and fill in the values.
 */
defined( 'ABSPATH' ) || exit;

// WhatsApp group notifications for new contact form leads (Green API — https://green-api.com).
// Instance ID and API token: Green API console → your instance. Group ID: getChats, ends in "@g.us".
define( 'MH_WHATSAPP_INSTANCE_ID', '' );
define( 'MH_WHATSAPP_API_TOKEN',   '' );
define( 'MH_WHATSAPP_GROUP_ID',    '' );
// Optional: API host shown in the Green API console, if it differs from https://{first 4 digits of the ID}.api.greenapi.com
// define( 'MH_WHATSAPP_API_URL', 'https://7107.api.greenapi.com' );
