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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'thrring1_cee' );

/** MySQL database username */
define( 'DB_USER', 'thrring1_cee' );

/** MySQL database password */
define( 'DB_PASSWORD', 'C1ABEFD7xk09f6v5qu2p4m8z3' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ke<@B;,*!/MR2>3eS&^-<lbT!mTlIfj1<0xJ@b3k/a:.W%::Z}-z8Dfo/-weG!SL');
define('SECURE_AUTH_KEY',  'D0dLx^D09YU*(u*LFOdUV`C@04X$NRIGKd?.@E+Ga8YG(%$v&dKScVXR*-q|`J~,');
define('LOGGED_IN_KEY',    ']>DfX+Pv^iu1M{Cne#vN!zblwK9G57P03&KT{Mweg=/EdDC{laSeWN)IAG7rHp+d');
define('NONCE_KEY',        '@=NY#:tgZpc A3+i--lDNr)l?H8n&pd:5wT$7G9-.{ya+INJrj6Tw)fi|<7gR4Cz');
define('AUTH_SALT',        '+`$7=/+=5B(bwBR1rHO)3DAb0=^.qGcxulUd]t9ev&P-DS+oPF?,EcYW`d4x)PIm');
define('SECURE_AUTH_SALT', ';I*QmV&. ;/QBVM6gdk<N)SK99^&X7kX%6#q|kO~3(!6#lW:-*DGMF[88^<+cVlv');
define('LOGGED_IN_SALT',   '7#=ai+`v+/^isY~oXS`bBNJM!|q&e+A?63yEx:`~|XZuNb}vCD.84<]o3^3-M1 M');
define('NONCE_SALT',       'QMt#_r)I2S3CTpAK{>5?_I>;O~wxx7];E;T>G;=Z>@&x%w;<i.3f;wa7Oa|@`aJl');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cee_';



define( 'AUTOSAVE_INTERVAL',    300  );
define( 'WP_POST_REVISIONS',    5    );
define( 'EMPTY_TRASH_DAYS',     7    );
define( 'WP_AUTO_UPDATE_CORE',  true );
define( 'WP_CRON_LOCK_TIMEOUT', 120  );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
