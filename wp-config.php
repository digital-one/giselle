<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'giselle');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'R1F&h;{EOqgE~))21vR^`IY~8i:KfjN.5$0K*O|NL)hmp])[wNh|.2(B|[KV_!V7');
define('SECURE_AUTH_KEY',  'X@>H9wbGRmRoXobWD_57ptVFSoL?,P-~d^l0TkoE/<*+{dXChP2iek@nHf+&-k*y');
define('LOGGED_IN_KEY',    'Rl:+akk_ihVfpt`WTe=,XJoAB7:m4#K`-{!qFL;URU^2~H%l0[>C0$9tu#N<&-Ak');
define('NONCE_KEY',        '_/~_dN?W9?x8f`j09l;LS=q|y%_9}).E|uN)U+pSf/1q5Jkxj}OH&WjySnH7|Ur ');
define('AUTH_SALT',        '@Bc!JG*<%o8/j/c%h-D|U2@VShzXf_xUAfVqa1&.6>lZ{rHGD(}(&C{WG)<YMs8+');
define('SECURE_AUTH_SALT', 'D1xz*AC6j},Cx!/-yW.t5+y8IQf:a@b9x|H{I~<RFitl3^T_Y[R`}}4wzaYYw;,C');
define('LOGGED_IN_SALT',   'heg8!g&CkG6<IL|[/U5FN%5lhKl.$iu+]A[r~KLtFto93T<!Fic@YN8hpxBmWJ|Z');
define('NONCE_SALT',       '{G+eFX<iw`P-$Zk0<W/S1c^+WaoRLf%)d/r%+?(-c4Naj1508-U ]Wb~q8Zz-Fq`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
