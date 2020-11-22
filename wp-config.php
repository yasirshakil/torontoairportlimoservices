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
define( 'DB_NAME', 'toronto' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Cp3]K/nWs@&r&6+3' );

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
define( 'AUTH_KEY',         'oS,]H=gcXJHm3K9jydN*18b==qzWfYf71TI<E,Z/?N3+XL+Ub&Dk;(O`*F)Wd-iO' );
define( 'SECURE_AUTH_KEY',  '_ {pDuE9iI9rI-IvQ5!nJi}M}K9<yXR_37QypxYQnzVaHYsM$j>C rj{/o2hLc3-' );
define( 'LOGGED_IN_KEY',    '56I:Ji.(G&9Bu5Vu2d$wn0VN51lZjvc6@BWPa9t=rD|C.z{ePMX3cLVzE$,CN-)c' );
define( 'NONCE_KEY',        'STSK_vV3<hgoeTq}bR]kVT%}.@R&h:Ll*[R9IyyV7sf9Y1(So=10Z0QV]q$qegJw' );
define( 'AUTH_SALT',        'qDk&|WaRQ`NfZ/$vn18c`;E.tCiiIC^EFnc}s+NcIie>U}g6o]3J]C^kH$OqZ8GT' );
define( 'SECURE_AUTH_SALT', 'K|##:J! J/NrH,K3  Q2}~B1NmF~LBBAyGaLB_y3]nF7,Ch:={e9UDB{6@&;J,AM' );
define( 'LOGGED_IN_SALT',   'cX^PZI eM2Jc6p*D<c2B-vR3I1}6eki4+j=d{zNTib[dBjEFbT?7&#g0GF*m@#c%' );
define( 'NONCE_SALT',       'g|FSSJyP: z6lbu-(Zj=Gw4NhKE+9=lUQ]B99(E:f9}Ju:ms.Y<~n!S*>[}lZlI[' );

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
