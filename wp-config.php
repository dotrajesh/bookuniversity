<?php
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookinguniversity' );

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
define( 'AUTH_KEY',         '^P2)mycv],PwIb92|/&2m$RzIox`?N]7+,&k4H=EG-T<9)_)FxlEwu!`#?,V@-k!' );
define( 'SECURE_AUTH_KEY',  '?h2G@6DvtS,}DvK7s:tmMwzvVO(`U.)+l+RI=1%u$++65-FJYyH*AN[_dNbrzk(@' );
define( 'LOGGED_IN_KEY',    'Ef; )[6hKI6,/};Az&xF h7>*U0,F M/$0PRM~sL@.P]f-LL)F?8Mwxo60XrAOb@' );
define( 'NONCE_KEY',        '9^murT`Rg1B+q*{VHsh`~$aDnxYpK+&}Wkv|+=A/D^3UV!K4J>7@q<4I_0U<<fKQ' );
define( 'AUTH_SALT',        '4i|p;xT@x)sV-)d[c!R|Y QUXa(L@;{$TqC5.<PXV@GE0TtwP28q`4;mb<)3O!L]' );
define( 'SECURE_AUTH_SALT', '0%mZ3GET-ZYTtTDP zVZYR&L<b4u>]PQ[H+#52>>S;(wcne;MLAb&9o#HpTj)aN+' );
define( 'LOGGED_IN_SALT',   'Onag.c,Z+I2#HD`4vgtqhm=.ZR43.~IxubNn#!IQ42=k!2>dhYEwU>}-KMg9C1^y' );
define( 'NONCE_SALT',       'jWv[warDq=RaM$e 6qw,+e[z2 BQHXuX41DEra B$L(JJNE836Yl<B;MprGxa5%3' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
