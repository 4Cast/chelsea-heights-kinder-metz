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
define('DB_NAME', 'chk_metz');

/** MySQL database username */
define('DB_USER', 'chris_metz');

/** MySQL database password */
define('DB_PASSWORD', 'broker');

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
define('AUTH_KEY',         'g6ESGo*/n3nw&/}`Sq~1yHC*-%zfZ]TUCp!k-kM+uNX.[d=`Le?3pbKcQZoX9q_5');
define('SECURE_AUTH_KEY',  'dT-@HQ:)+f$_<=8oB=k$>5qEp!yY=,$;yD4=TUAYrH=e}Gi&Nc+RC[=x[;l)u^(B');
define('LOGGED_IN_KEY',    'gK=a*{uD@:&s~f>*fuJl5z#a/Rw9O$`}>?#!qg:|xz;F`(6S.}:un&C6/u!,iRE1');
define('NONCE_KEY',        'x7&}l_06op=L-ZL%I?^G:Lya2vBjzem.92O)5 2AKX7N,t1GmXdqNE;X1grk)*/k');
define('AUTH_SALT',        'a-qLk:JgwjzN>PY|y$2Ik%;Jkl,s2&^O&,REk>E7>$=Wq0y%9&j{OT6k>*7;w8fb');
define('SECURE_AUTH_SALT', 'D|1}89/?|C{,7`WDq`f@Fi-mW<%Lbg>!Am|f7!hH.~Mi8a7g3GSf^Dk])yAAP[x!');
define('LOGGED_IN_SALT',   'VD<]!ql:zN0I@Y7VAw}8u_sT5wrbN^e8<[R$]pIMBkz}yslA[($6A%=uZ=% 49I4');
define('NONCE_SALT',       'NZbt_c/T49[-qET<)3&;bLMIbtvc),#F6^G!vCBvu(SWrP{<M;w<I~jZ{_j<+m6p');

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

define( 'WP_MEMORY_LIMIT', '32M' );