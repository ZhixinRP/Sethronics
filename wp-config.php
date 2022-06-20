<?php
define( 'WP_CACHE', true );
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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sethtronics' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'U)aEFf:d:{@^5Bnr[XF+z:4AT;7uDQD[J%VdU!cZ^J<1O*C28Q.}!G0hW-~S$U$b' );
define( 'SECURE_AUTH_KEY',  '7mo&uOyDzV1B$VqXP.!hPB[K,(SL~/353Y)-.c}neb[<>,;p.*e[XUmTUZ|YX*|y' );
define( 'LOGGED_IN_KEY',    'JvnH$p 6l(2*/(Bbdh:nZ>Q$)kI>v1uKkWt+DLJR(URu#*;MDNgs6;[1Az-A>0b$' );
define( 'NONCE_KEY',        'aX+mJHo$k.Q5PU0,{]K<U8av``pc29AM!9rP4gdAj?UE|VD+EC~dL##MI1L#*>,,' );
define( 'AUTH_SALT',        'HgX[_s|P[~zVv1wIT(ZAia)vp<wiRm!.92Oc>n%:v3B|1MBm$2Mek0~ae8u*0R^:' );
define( 'SECURE_AUTH_SALT', 'zCzOJ^}EVqZRUx9OG7hli.FZyXr|!KNCWw#|^8EIr7]9c#[kiE;sSw:?h}{h9)-_' );
define( 'LOGGED_IN_SALT',   '`b*o]:&TNcBAH$)|_{3[(>GI8.gU0*@yckiK6.^MB-0nf[dcW(Qlji=b !h:HgWS' );
define( 'NONCE_SALT',       'NNp0GR{=AK?ckh0Y$xv&h;pNJC>L)QP7q%s9#;}35@lFC7$.ld/YYje#pA@gp:#=' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
