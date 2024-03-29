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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          ',%G|csdU4VsoQ*g9@ai3$4[Y{]mxW$6=KE<7x~c8Zyu:9Xld4}1y)<@/jUqgy<sR' );
define( 'SECURE_AUTH_KEY',   'CL]:.dve4:9X@/B{4u4%px2,;!ChvGA(/f3.g3xlx*uzgp$8j_bP}{gW<~$Ee1!j' );
define( 'LOGGED_IN_KEY',     '6cdB|<2Lxtc7U+ST14`i@z*;f@vtA3b)QE1:[NMbd8ID0tc..i0[+>+~3nIvHxb0' );
define( 'NONCE_KEY',         'Lwg*2K{vy66)fbwm4CB{nUeL+1WxT{2*5$^&u?RI4.ycRVJWwz*j3y3Ie{tK/m0U' );
define( 'AUTH_SALT',         'NZaf0%ecA&*8~}ooMHsy=DrU{W>sktwH$ZGZTfgNwX<+Z[QJ1v))_fiIBQB}2fV-' );
define( 'SECURE_AUTH_SALT',  '[(haNNh^j&*1yule={g{QpFjt5,tM{<DmZ{wR]N0Y1o:ZpaD]Wzwi-WML=irjY^+' );
define( 'LOGGED_IN_SALT',    '*WTg-QJJLcP;gc=XqK`V/K t .MwP0S;ie|(bf03~w}|hefQ!VB`?_[2`qoFA_OG' );
define( 'NONCE_SALT',        'bx|-.$)lXiei7/S&md4SCdv==he#h+KGM7ut]M^C:60](c/11Zd9LY6^)(u(S3;W' );
define( 'WP_CACHE_KEY_SALT', 'e:}Ww!,x:h#z:1H(!l#kHiX<d!CRbH5nNrUhmY12}qQg#oY:mumbO|2s.b39jC+i' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
