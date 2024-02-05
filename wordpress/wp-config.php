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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '`A{irvx?.Q-+(;b(GC!8LI[&,H%+X&#~oF&(#/FXSUeW`seWj6W73o@No.F1Bt.;' );
define( 'SECURE_AUTH_KEY',  'D{^V;=_q,@?-04?])3lTiHM)d$C M,@#f9wXP>=h%FITSMCKVK:D2r^G 9{t{6-_' );
define( 'LOGGED_IN_KEY',    '6*fbhmPfo8A-f8k5(Ovr_y#R==L%-l+D={w-:&e/Q0+X&(Qsc.8b*xn=D7Fgj9Yb' );
define( 'NONCE_KEY',        'V4=I=U-Y0/6n9%N,AhZX^jmhaD82~h+.> @w}=]gQN0zrfK~(rp} +QTE<p6.A#c' );
define( 'AUTH_SALT',        'h:Lb54t 9#ocl(fsA&:O3*Va4bK4y>;~42 .w^5BoD&73H8`%q@u@axMap#O)M*s' );
define( 'SECURE_AUTH_SALT', '13ide.3l*/lp}-Fv;?Gqd~s90uySlbxk@CXC$R*HU<DT#mkWVb,S@NVVvZK}Fw2P' );
define( 'LOGGED_IN_SALT',   '`r+P2HRtre#8O*,0edWCWheTCqwO`D2<fE|V!#*PCH}/Z%G j3DNJM.^gECgLo,;' );
define( 'NONCE_SALT',       'rDr@%u!5dK||y+Z$$J=i8Ea$/dLpW7_0Xbc7maI^xFGO<5`x2B`{v^c)cYP#Zn|O' );

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
