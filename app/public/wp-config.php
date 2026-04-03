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
define( 'AUTH_KEY',          'f6~LR_)<@LNdYt(!=MW=7+w9>]Fg@z- rGrUlAq]]auqyi wUcL/}4TPB.aGqS~A' );
define( 'SECURE_AUTH_KEY',   '{a%3:aD:>cda#iI+UMLPo^S)tE%4m ~ -!pLz|x8Dy2}88*dl]!-81(6YTJ]v.]$' );
define( 'LOGGED_IN_KEY',     'F|O[^p58N`((-taX4N=.bprrm[[53Ay4~N7t*k[EydPFG+xP!Hk9D(XHpPjDj^Iz' );
define( 'NONCE_KEY',         '|37~C[{lCXVeHkJhDKx0.eB@ftaV;^-`[35yFAllIv;|1&W,aW_X<:]uJuumAJgg' );
define( 'AUTH_SALT',         '._|Ey-X^U3EERJU{z(ZZ<mliy[5rQ-<SWn61%=bv_ki!G6O@FzGOieQ2Bqhw>X#8' );
define( 'SECURE_AUTH_SALT',  '3.>g?^gZ]8TGzZ}T~-jjuTFw7YkEg,Z(mZw2V@;j>].oQC*jm=YUi{wf:@M`t-g/' );
define( 'LOGGED_IN_SALT',    'J@=*Q=-$%/+jYXiUtr}7W^.%#37cs}^{Y/Wv`eEIE$UwlvQx]7BcG4Hm(oI-s%_e' );
define( 'NONCE_SALT',        'Dz+/t(s:7E^ L(;A]9`ENMhP+saSJMbD)(6b@Br$!a-QAKvb8KOBMQ3(>Q^xLI~J' );
define( 'WP_CACHE_KEY_SALT', 'qDWV%]a(?+!M|2QegZIY]r2DEdOR]/P6!e+0 {Ss<i)<i)lE=&g%p+b@2R9!jjml' );


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
