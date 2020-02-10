<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com
 * @since             1.0.0
 * @package           Upload_2_Search
 *
 * @wordpress-plugin
 * Plugin Name:       Upload 2 Search
 * Plugin URI:        https://github.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Raj Sumith
 * Author URI:        https://github.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       upload-2-search
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'UPLOAD_2_SEARCH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-upload-2-search-activator.php
 */
function activate_upload_2_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-upload-2-search-activator.php';
	Upload_2_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-upload-2-search-deactivator.php
 */
function deactivate_upload_2_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-upload-2-search-deactivator.php';
	Upload_2_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_upload_2_search' );
register_deactivation_hook( __FILE__, 'deactivate_upload_2_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-upload-2-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_upload_2_search() {

	$plugin = new Upload_2_Search();
	$plugin->run();

}
run_upload_2_search();
