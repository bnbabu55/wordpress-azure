<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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

//Using environment variables for DB connection information

$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_") !== 0) {
        continue;
    }

    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $connectstr_dbname);

/** MySQL database username */
define('DB_USER', $connectstr_dbusername);

/** MySQL database password */
define('DB_PASSWORD', $connectstr_dbpassword);

/** MySQL hostname */
define('DB_HOST', $connectstr_dbhost);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



/** Enabling support for connecting external MYSQL over SSL*/
$mysql_sslconnect = (getenv('DB_SSL_CONNECTION')) ? getenv('DB_SSL_CONNECTION') : 'true';
if (strtolower($mysql_sslconnect) != 'false' && !is_numeric(strpos($connectstr_dbhost, "127.0.0.1")) && !is_numeric(strpos(strtolower($connectstr_dbhost), "localhost"))) {
    define('MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL);
}


/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6DlZ)@-w|)S(wBs%|kI=Rv ?_!-WY tqO@2,b:}x*@}nAo7|;M)WN:uL6k|-TN%^');
define('SECURE_AUTH_KEY',  'mIZV-oB-XQ#OKC!qu+p0-b|4&gdP#pdj<MD4Mc@G9Eody;S[2F9%n)&K5r1hw,|{');
define('LOGGED_IN_KEY',    '/EYE|Lrkv|[3_r-<9o(N4B,2Py7wtpvN1/[EQerU.s4/O8|iju~mwF-{ct|[|++]');
define('NONCE_KEY',        '`PsQhfvTTG`k%UF3-W0|ktC~/j0-j5r%P&+9/M&A(GpQ97#{n-B+v.8NY-tk0+cx');
define('AUTH_SALT',        'Uh<UzO1RhzlhrjGoG&gELuNl^5v-k4&+)#>*-DU#EOU$Pa.A7)x`tP1;ayyES]MQ');
define('SECURE_AUTH_SALT', 'uYMF#9V4`>0!JZqQMxF:1*nMj+<iviD6m}UFnr+HSFfWt]|jOi2c~Q#;`Y4_#T[h');
define('LOGGED_IN_SALT',   '-dwFZoJ3o`/W<!KGHsDqc]4yi9H/:orGu8@unavG3mAJwiil3>uCy+~%dr~[`0fI');
define('NONCE_SALT',       'n6}q#<6r<)d&ZC+YHsD;5D5|FHx:wMm|K/;5Y}8{#SywjYrq5>mn#%m^#afq.ZmS');




/* Security for Wordpress : 
you may wish to disable the plugin or theme editor to prevent overzealous users from being able to edit sensitive files and 
potentially crash the site. Disabling these also provides an additional layer of security if a hacker gains access to a 
well-privileged user account.
Note : If your plugin or theme you use with your app requires editing of the files , comment the line below for 'DISALLOW_FILE_EDIT'
*/
define('DISALLOW_FILE_EDIT', true);


/**#@-*/

/**
 * WordPress database table prefix.
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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */

//Relative URLs for swapping across app service deployment slots 
define('WP_HOME', 'http://' . filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING));
define('WP_SITEURL', 'http://' . filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING));
define('WP_CONTENT_URL', '/wp-content');
define('DOMAIN_CURRENT_SITE', filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING));


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
