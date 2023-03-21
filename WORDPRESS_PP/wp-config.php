<?php
// Begin AIOWPSEC Firewall
if (file_exists('/app/aios-bootstrap.php')) {
	include_once('/app/aios-bootstrap.php');
}
// End AIOWPSEC Firewall
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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
define( 'DB_HOST', 'database' );

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
define( 'AUTH_KEY',          '?ie8=}$/s1sBgIyh!+z*z826tO1Yaa@m$_X`Z|a@nOvuz;Q|<xcVEJ{`0a/II%(C' );
define( 'SECURE_AUTH_KEY',   'VdPi{%</)Ai{oZ%/#a%$l?]P*D=qT}oiyg<L74Rc1QSbtuP0y~sB.yTT/a~!u.^W' );
define( 'LOGGED_IN_KEY',     'GrmS<[9n(6s:A&.Q?6ig!o=jpU#A4Wj/B/TG3q,h1N0~pTjxmaAg@^n.i`o_!_>o' );
define( 'NONCE_KEY',         'Pp(I(05gA_1In(-0{w4T@Nvdt7f;H*bfK*<j6!e6{EgiIZQ@tswqw>Bqqah#mpzQ' );
define( 'AUTH_SALT',         '0[ec*:6&^=e!a}1}4?ryv}@WEy62(Lh5*r<+|Zoh{B<RUc`fPY-u,BY&nw/SPx <' );
define( 'SECURE_AUTH_SALT',  '7FTT<RRB;0_#3PFyJjWzB9[JM (.eD|BD@_r8dsKY*c*5|@&}|osR$d-XKZ6y;`6' );
define( 'LOGGED_IN_SALT',    '*mWwp*=`]KD:?e^~U(f3RP&QF!GRd[Q]`U<vF|35UkzBDb[quAGuExZfelB0~[BI' );
define( 'NONCE_SALT',        'xp]_ n% }N rz?f5Pp>x~,mT<OQK/`S-uXk+(y;=JFW:P*%v8,V`upds245;*i~`' );
define( 'WP_CACHE_KEY_SALT', '8Pu+|gyo-(n:tI6s%zRTZ@BuXf{5%^IYoQSo#,b}OV9kKgDN(]x;3_NUCMb4Zda%' );


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';