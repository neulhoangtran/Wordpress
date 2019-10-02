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
define( 'DB_NAME', 'wp' );

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
define( 'AUTH_KEY',         '!:H</wV2m2?e.9~XF/AA=M$EsUjTR1N0$qXX>bJoo5#T<i-6;,<hn*Jt0V_!2 wJ' );
define( 'SECURE_AUTH_KEY',  'r7|WhF7Yk[/)o +%fcI:N`=ys]<9_!xVOg38nozU78O{%m%vj34$9KZ78nsDxTqI' );
define( 'LOGGED_IN_KEY',    '`AXYF<$+Dkt6+]5ZK#((~U841:!z|G![63&+,`24tkAw~g&~+3xA7cuL#rW0[EjX' );
define( 'NONCE_KEY',        '0FL1:nViBDf/q9<S^0Me?z+&PjmyI[tcD_*7oUclg6lvb/io]6w:.*v9&%g<kmd,' );
define( 'AUTH_SALT',        'uNN{}E_^v))Gp&fm_}:xFM,`MS8+i9lW5RcA`rhA D{p$t1MsM)Zg{)(}hFA|XfK' );
define( 'SECURE_AUTH_SALT', '_^Y^7eMIl&rM;uhi/RKz_Ofjj8%I]]BUup`Nk2iH?O8Cw7-.]_hOR=N;Bf{%0#xI' );
define( 'LOGGED_IN_SALT',   '2ICst+v6cBn>,2;`j`7at0vLHFsMn{izP~`;ZWno1*vT^n U7~MLw7AmAoeY-R#b' );
define( 'NONCE_SALT',       'gyA)Z3F,o$%#5SukX~=|?#C<PwJWI<6G@}SwR{h7YWkvv;m?i&R1XEPC1k}z[u@G' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
