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
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/pas9e305/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'pas9e305_passioninvestment');

/** MySQL database username */
define('DB_USER', 'pas9e305_user');

/** MySQL database password */
define('DB_PASSWORD', 'langtu123');

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

define('AUTH_KEY',         'RZJ6l~-~4`u9>9#8U&1IV*e|IQ/6_4^8R8eWhzTTWEtSQG-Z1)QdRl!M%*Z>NVbP');
define('SECURE_AUTH_KEY',  'IYs[:-t~^iI^WT6gil}9!l.VZJO}`>L5p{<%,k{9W(ON$p=M?xKhS86s<MJ|9;B9');
define('LOGGED_IN_KEY',    '@]:)=)nE}f%sJ}=YqnQ++H-.]j,K|(B.1yNu&jt_EEvD)Y1~GgR7ZB)R;f-AQE=f');
define('NONCE_KEY',        '>xW@,O5&o1y7lK|>W -1cA${V=+EH^m_chHJhCmIrkgP65CU,:A=8g~~v9L|x#bx');
define('AUTH_SALT',        '/6(f_zeNmMI&twSpCFV=1%Ek.J++^j|Ne5O(Wa0h+;izF*A-@-Kv>8:8=p@xTBc%');
define('SECURE_AUTH_SALT', 'ovdZp+6+v0(n9GbdB=RL@tztv vd <2gI)(e+ <FO[Jj8JrB;n@jGF=C0|X-y cb');
define('LOGGED_IN_SALT',   'Qh6@M5s,[{[gtUIdews_wroY4@y/5M,lX9Jn( +zUI>pk3pY!3d[=`LZvU_2ndeR');
define('NONCE_SALT',       'Nl9sB9[,jwuu0H_~G{8D@L|K!!&|Er1(q;F0;Se%c_<T$-l2gE7en[ ;N6:XcB+&');

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
