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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'thrring1_cee');

/** MySQL database username */
define('DB_USER', 'thrring1_cee');

/** MySQL database password */
define('DB_PASSWORD', 'C1ABEFD7xk09f6v5qu2p4m8z3');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uRUw@RVWkoPi3AFifhi*4d(UD*DfHnSdsA*jWdvIC0qh*6o1U!L1G#9^jl@rs02x');
define('SECURE_AUTH_KEY',  'Q^(1w5NOfnmiMZ)k#kQ!qqngqQpKBZ*v8iEzN4avKKVQFsGHCe5GMofFv8kSZAW^');
define('LOGGED_IN_KEY',    '2YIE*0Osd2YAn5xAjuTJnKqzWBp3jLX00C@K*BL1u*2^ii0*4cz8G^*i%Ya@kWo#');
define('NONCE_KEY',        'h#l&*(xBCm#^iDxoBwJ0*%NX9A40hd(43Hzwl1#Ni*hWwT60XvdhG39)yjT@xED9');
define('AUTH_SALT',        'YEZRQYk*5No!CQ%jTqMx6i9R%jDIugP91tiGPJId*GfYNIZW84&!9XeIC@XGViw2');
define('SECURE_AUTH_SALT', 'd1zNd&fxZ#u!(HK&dc(wc5uw7VNVi7H&^4lXALKLV#GpmLh8us^7y(LiAhki3k9z');
define('LOGGED_IN_SALT',   'MG(Y61V&gLO6sQGL&!kh6#a9Y7Ujt!*kcPQZuyu5bBWO#ShP4VL(Gr4Z%EfoQANR');
define('NONCE_SALT',       '#zpx!8UNLj6N@XtuIu%O0iT&G%h7kSo!PjF8%1!9kk1a8#i^X50UYVl*EzgNYj9#');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'gb5f2KE2T5_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
