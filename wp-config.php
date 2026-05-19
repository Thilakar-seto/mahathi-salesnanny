<?php
/** The name of the database for WordPress */
define( 'DB_NAME', 'salesnanny' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'f>L:B5GluK(|M=LR&-s[VB)h`gWivs;|(zT}JEJh _$h}qpH]zwUD58>D#ke%$+9' );
define( 'SECURE_AUTH_KEY',  'E73N0]?r>}^S71|+sa:2LrSuO>^T%)5:0nc}kpv<OQ-5l#(u*RVZz`vSkID2}:jM' );
define( 'LOGGED_IN_KEY',    '(Om.Vh7)EN+^BU%^?8!Iq#wm5Oa`7?<. 8v,5NlIb^(a Nzq^(~M f`.)4tOdO=I' );
define( 'NONCE_KEY',        '<%e18Cv|Wd^IGA35W95+A^Pe8CiymJU<h?gTKslc[@%HTs/J=2[#:xy?:mv|O] }' );
define( 'AUTH_SALT',        '?:g.bcM.5(4+Dep0@<1D|F{%4T!`[M_EH;A*dsH%{1%|c5RbP[+;-9_` K4+ln]N' );
define( 'SECURE_AUTH_SALT', 'o3uk(CE0G*K%uR|5+Dq|qB8l]q1qt]HS%kuUC&?!0&tB 7_5=9;(`7Kk|IV y0gD' );
define( 'LOGGED_IN_SALT',   'r1[8yQoMhdwciNaWZ_V+pgO!p`u]f6Bh`h0E_k^qHcLbzcs5!qi05x!_zzNj(ZdE' );
define( 'NONCE_SALT',       '_-% Y7t6&sX^*4~D{5<R)J^($_cZb*t5Hl{$WMyW!.dM]JCp*5~wS jmr!,ao?+D' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * SECURITY: WordPress debugging mode - DISABLED for production
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
// Temporarily enabled for local debugging - log to file, don't display
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );           // writes wp-content/debug.log
define( 'WP_DEBUG_DISPLAY', false );      // don't show errors in the browser
@ini_set( 'display_errors', 0 );

/* Add any custom values between this line and the "stop editing" line. */

// --- WP Teams Scheduler SMTP configuration ---
define( 'WPTS_SMTP_HOST',       'smtp.gmail.com' );  // e.g. smtp.office365.com
define( 'WPTS_SMTP_PORT',       587 );                      // 587 for TLS, 465 for SSL
define( 'WPTS_SMTP_AUTH',       true );
define( 'WPTS_SMTP_USER',       'support@salesnanny.com' );
define( 'WPTS_SMTP_PASS',       'rdlk ujtl lqng smwa' );
define( 'WPTS_SMTP_SECURE',     'tls' );                    // 'tls' or 'ssl'
define( 'WPTS_SMTP_FROM',       'support@salesnanny.com' );
define( 'WPTS_SMTP_FROM_NAME',  'SalesNanny Team' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
