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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/internetservice/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'internetservice_wp' );

/** MySQL database username */
define( 'DB_USER', 'internetservice_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', '1YPgCPi49fpp' );

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
define( 'AUTH_KEY',         'v8c/mIRD=7R:Yyv #anxlpd56_$fWO~J,{/F**~I1`O1il_P_i5n2:;wzpS*S8|:' );
define( 'SECURE_AUTH_KEY',  '-QEV53pDJH%MuwDkdD=FDqFX79r-b?*&U>@6&!ZUi?|sIAT_cS#c|oyl 5a$:<i*' );
define( 'LOGGED_IN_KEY',    'Z9xrg{|K[CCcvu,ue#~Em*C^PNY!=m-Uvm$lY;7f|rhSM m[[A[Hm$lgbLlO4z^Z' );
define( 'NONCE_KEY',        'ZymzF@[Wohw68GgJ%M.5}L#l@w14*Z1#XrsYUrS|nSF@UlWl}x]RyD7RZ2 `(LDz' );
define( 'AUTH_SALT',        '1AP}aH>^z%PYWg=E}MjeekkHB:pry:1Caf`4_>p(k8>QK&N~+i5F8k6JmBu54m}c' );
define( 'SECURE_AUTH_SALT', 'cP<,pS,HiT6.a@pyS}jW2J;wbrQb!=wo^RFzMq4fovAEe4<Ni7.FY>y=aQg(/FDN' );
define( 'LOGGED_IN_SALT',   'g/2i>&/]RrVJ1/yvVVNZb77l#f0fy{0M5K(qHF0/g4eAFZN%;}6hj/hjD6bj) bv' );
define( 'NONCE_SALT',       '+9Oo*ih0$JM~:?x%8%FR;8^br!PX0y{wo[9-v5`w-$]mLdEVn{KG7aMuh<CPc^;Z' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';