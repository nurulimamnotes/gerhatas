<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bits_1aps1');

/** MySQL database username */
define('DB_USER', 'bits_1aps1');

/** MySQL database password */
define('DB_PASSWORD', 'hermawan123');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6r!b$El)RkFEb%&5A#$XF$jqkhqbAhdJDaJOPS&xFmwBijV3X%zXAcbT&Eke&l69');
define('SECURE_AUTH_KEY',  '!VCxi%Aod9H6ngQBUPXsQLyo5EAU2nIVcLA)A^^Oh3K#yAY^hmej8RDlRIcXp4qQ');
define('LOGGED_IN_KEY',    'w1%^FHJoSiBM)McJw@SV4GD*#%2MI!Rq6iCRs^pVTXMv7ohwF4np4zoDVO5UeB&H');
define('NONCE_KEY',        'SEzmjz(s1db@hfJiuC9Co9mA11sKXUxDV4&5jyz!&csCa$AeD3B(P(rwlMRDMoFD');
define('AUTH_SALT',        'OJj%X)vztn!7!NugOiNdYVqSTHwM*yUG^oFYcFTdeP3X&Gm)tXik!8!q!)SyG9ai');
define('SECURE_AUTH_SALT', 'Olv!vm2B&@^AReYHJgKvAG)O3)FpsOe@l6Zo&38eh$1TcebHQei1ncR%%7&1M0nx');
define('LOGGED_IN_SALT',   '*O*5)!a7JwLXnHJz8)BggfPP*^aZ(G1ext6EM@C7DwKoLf8Ud2qWYa(i@tiFP^$Y');
define('NONCE_SALT',       'Ferenp9Sn7x@nk6LI!rH$)C5HIuS*O&v(&3hJPh7zBg00Bq%ESocMVNfr@bbp3by');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lmt_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );



?>
