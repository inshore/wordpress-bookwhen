<?php 

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/inshore/wordpress-bookwhen/
 * @since             1.0.0
 * @package           inshore-bookwhen 
 *
 * @wordpress-plugin
 * Plugin Name:       inShore Wordpress Bookwhen
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       WordPress plugin built on the inshore/bookwhen PHP API SDK package
 * Version:           1.0.0
 * Author:            inShore Ltd
 * Author URI:        https://inshore.je/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inshore-bookwhen
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}

// Define the plugin file constant.
if (!defined('INSHORE_BOOKWHEN_FILE')) {
    define('INSHORE_BOOKWHEN_FILE', __FILE__);
}

// Include the main InShore Bookwhen class.
if (!class_exists('InShore_Bookwhen', false)) {
    include_once dirname(__FILE__) . '/includes/class-inshore-bookwhen.php';
}

function InShore_Bookwhen()
{
    return InShore_Bookwhen::instance();
}

InShore_Bookwhen();
