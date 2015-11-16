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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         'bxJ]=TPZ8?K<jufBj*ja=SY)`yZYa@,0Lklw_bEF~Agn`#qkZGr%PB_G ^4z3+32');
define('SECURE_AUTH_KEY',  'fwcrcwrcqwtwectwcwcqwtcwctw');
define('LOGGED_IN_KEY',    '&9sFVDJ@<S1|K[O6a=1FlXb4WRYbp)@!` Cjy@%=mftq~&P(x>%u!tZ$(yr~?H^6');
define('NONCE_KEY',        'gz2cAYGF#r}RDBh&dD/)g;H:+Yx:Wyi!c9LTm5SJzk[n_N^fV;^Sdh(]9&::nWKT');
define('AUTH_SALT',        '!EN|6>BU2q6Fax=HS&DJ>Vhjb$W--myCdp3_tt{+*yB+(&^q::,cb;urF[utg2z&');
define('SECURE_AUTH_SALT', 'pu44p}MFK_hg=|qxLVbuDGAIydN3yG(zyN[MJ*{6our|jWDZ_E,LG)/c+JDtUX');
define('LOGGED_IN_SALT',   ']q&2irfX-.#jaESoL6oD1_*nyX&cgui/0c?yZh^g/7AYv%~2P+t,~+N7-4%+;xjU');
define('NONCE_SALT',       'o1Q~NgAClGZoQ5F=b*;.+xt{%qJ@9(l-F@v|l>`P{sm~|a3/A7iG9VpP6UL*.t}>');

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
define('FS_METHOD', 'direct');