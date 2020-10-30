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
define( 'DB_NAME', 'sb mak' );

/** MySQL database username */
define( 'DB_USER', 'ahmad' );

/** MySQL database password */
define( 'DB_PASSWORD', '03349071558' );

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
define( 'AUTH_KEY',         '~lF.<Do`Rm59~CYu{Ce^j#:68TQ;tt>gF1e&(#tTZ>-VE&uP*p1xh/ [I.-9xI0Q' );
define( 'SECURE_AUTH_KEY',  '/B{HYR/a{:o%pR1w^X$Oe@CH3fv51=O+Kmxu{E]P<;WQwxy8k&U@ t!j8=g-~.C&' );
define( 'LOGGED_IN_KEY',    ':xO{5HKbC(1i2sBfVxp*L=HZW7Rb[vO +y6B%^iE=.klrg(: J{><@2Wnx=_5Bd]' );
define( 'NONCE_KEY',        'Zfv~#.Cs`|MY/)DQ6CRs$}+JH<(oG%^=S$yA;2R>3vS3?bwkl=;}@%< Qzp~F+X?' );
define( 'AUTH_SALT',        'WS%lYV$+D]i&B#K9MP.Y45>4/GiWE.)paWGZ KZJ=VVbH6jNlp2l9qa+J,d9b27,' );
define( 'SECURE_AUTH_SALT', ') |i}>Q+K%hntpQ:Z*Mp@)%@8l/$3~e=uWo`6SM8W@xc|-Us:z1e9wK0,)&Jhu_4' );
define( 'LOGGED_IN_SALT',   'Ryj8D&(`ell2d35R1S0t8$UjJWp:#<a:<MiLX#8+4RY:YB1T;ap7`*`Q%P2K6nKA' );
define( 'NONCE_SALT',       'lw@I,?VHFtZHB D>^e4#zD{@;31N>oAX~/Yv[Rhrjh)OjCFn?KITG;u$#ln5;j88' );

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
