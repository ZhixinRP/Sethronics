<?php
define('WP_CACHE', true);
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u865140542_QDYHZ');

/** Database username */
define('DB_USER', 'u865140542_ZQaRu');

/** Database password */
define('DB_PASSWORD', 'Z647VpSlUU');

/** Database hostname */
define('DB_HOST', 'mysql');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',          'Ll:MRU+/A09j(oB9A~lBGN~HME2 q-+yf/4$Y^h}!d2X0CYq +0@506|2~=gh=Ci');
define('SECURE_AUTH_KEY',   '?H8FPcf=!rO +Z{Xsi(D^H(Ct}Ao=w]Lb7?Ld}|i(w$ZyCUgP_wET<hKJ%9w1GF)');
define('LOGGED_IN_KEY',     '6rwP]BYq:h>}Kxjw9NWzAI&fA[JLibM:J;?ofW4ueN^~}eGSIa_# *O{%a8J9=8I');
define('NONCE_KEY',         'B%^m7NU/4cseZ[Tu@l:Z[Jywiim?k84}?}D_]$cCYTj$(ss_vn`ut(wU^@#|@V<:');
define('AUTH_SALT',         '@d[fuOj=7{jsi-@(6/J&}S_}P>eaU/kj4I5&*Rf: 1=|zyYS{6xeOc!U-7Z1qCu4');
define('SECURE_AUTH_SALT',  's7rChQ*lQn`9j@JVtY51+W(q%})Ue6f /DSZ-[7+i{b&!{B^/OO:% |4[bo~C1Hv');
define('LOGGED_IN_SALT',    ']P9W_Jk2ReGvS*]v80Y}Zv~m@^6&wFn2-e4>z3cBd(Ei)sxWxY]p$BJvjV9As6S)');
define('NONCE_SALT',        '&M0%IYcSUnoDrJ[C|[YkWR}I^]E%Sx?1.EBAi@RNo),6j6~nLNd(yp5D?J *=+ZI');
define('WP_CACHE_KEY_SALT', ',bQKbLCRz|h=JYMS;/8J-^kZa%6uR+,_Os(qc@-9F A5D-AfxzzERt#X>&F/xe`.');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);


/* Add any custom values between this line and the "stop editing" line. */



define('WP_AUTO_UPDATE_CORE', 'minor');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
