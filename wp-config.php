<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'phimvip' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.t8,zv@YlG+U4fw=pM`-KU7AfLgB^VRx(zQ&`*]S&v0=Rr]JZ14GP?qA9/=7 HZf' );
define( 'SECURE_AUTH_KEY',  'nBVUy>{C^v:*ihPx:] Z2r9CEn>:HVG*-`}qBf<p?6yD%8!8q+==hpq,UXYdF*69' );
define( 'LOGGED_IN_KEY',    'd,+EZ[T.TNXDNeypiR1FEO|D%5i{;9(5<5V ^%OBX;LJ}:UobNAwolSx?<qF*s#N' );
define( 'NONCE_KEY',        'G~EyQ@=krNSd{FjO8:{bVWq~)jYI)-VQDaX:+%rFiXF2T]zMmSWC)}ruoY5n.b[v' );
define( 'AUTH_SALT',        '5:5@% 7p_f~X^HKZxT}e6 0s]~yu40Rf06(Giz{=yVK_)LxfCy,&?:1~$UF8^:sq' );
define( 'SECURE_AUTH_SALT', '-kn^f$FIMU3XXW$*zF$CD1~A!@WK %LG:(YYMmp`RM]9yT>jxGn}LojHfD@b>7ob' );
define( 'LOGGED_IN_SALT',   ']J[37iN7f?Wu09#]E%+g]<HlI9R[E>;E+uU8P,@4Wd:>pq{AC_zwFeiZ8b_kR=gr' );
define( 'NONCE_SALT',       '-39V;a!f:@wXK~/7ZVi78^e:kywPWzj.h+`p,NA$.C+]iB1Sw1`Z4Q.{]G)m#K97' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
