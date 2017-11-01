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
define('DB_NAME', 'chk_wp');

/** MySQL database username */
define('DB_USER', 'chk_user');

/** MySQL database password */
define('DB_PASSWORD', 'habit-gunflint-cowmen');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '/s4x[qIXRd+nBE4HG*f{M8$ye[) $IlszwzlF!h@[Xx8}&<+R2E{j)-O=lN`w10_');
define('SECURE_AUTH_KEY',  'Wzp8!+,0b!a#-&>qdO^5GfL2llVxZ!jsvvu(2B#cCUYF)1<^_KFsAMC:8oG?nfu3');
define('LOGGED_IN_KEY',    'Jbb$]WK]f;[fh/~Oe?5jt&/RjS}](P^T7[vDVw2u90Vtg-j&]{H&%odQwF4^x-s}');
define('NONCE_KEY',        'h3I#;ciV -}w+A8rpQa]X*OFm,5I5n>{pfpMjXui5Zg3eVC-()|S<EKk3R~Lu#Jy');
define('AUTH_SALT',        'ANE%]JN;5jjLP<2^d2x@|ljM)Y1xqcr%A!#%t|NsGt)b{q&C^@-VrVdL,$qsX0a(');
define('SECURE_AUTH_SALT', 'EgYZqms1nn^$G(Qc#Hs8nN&,fPL?]hD=45BI5TBB)Zr^DRk%6UUUalUC(d~~h0O@');
define('LOGGED_IN_SALT',   'q(?xsb(bl,!`3JXErj+lqJE4]29@pKaM#`~miTJ,-Vu6e.I1*UY/h=e]FW+Q.WL)');
define('NONCE_SALT',       '~uzP%TS_=Vvt2*ksowq^|@[QlsN}J5= bso,c9n /:% i- /QaS/7s$$Zz4(|P&%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
