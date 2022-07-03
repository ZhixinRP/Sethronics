<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wppathfinder.com/
 * @since             1.0.0
 * @package           Dwp_Courier_Management
 *
 * @wordpress-plugin
 * Plugin Name:       DWP Courier & Delivery Management
 * Plugin URI:        https://dragwp.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nira Rahman
 * Author URI:        https://wppathfinder.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dwp-courier-delivery-management
 * Domain Path:       /languages
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
define( 'DWP_COURIER_MANAGEMENT_VERSION', '1.0.0' );
define( 'DWP_COURIER_MANAGEMENT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'DWP_COURIER_MANAGEMENT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dwp-courier-management-activator.php
 */
function activate_dwp_courier_management() {

	//Activator Method
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dwp-courier-management-activator.php';
	$activator = new Dwp_Courier_Management_Activator();
	$activator->activate();
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dwp-courier-management-deactivator.php
 */
function deactivate_dwp_courier_management() {
	//Including Activator Inside the Deactivator
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dwp-courier-management-activator.php';
	$activator = new Dwp_Courier_Management_Activator();

	// Deactivator Method
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dwp-courier-management-deactivator.php';
	$deactivator = new Dwp_Courier_Management_Deactivator();
	$deactivator->deactivate($activator);
}

register_activation_hook( __FILE__, 'activate_dwp_courier_management' );
register_deactivation_hook( __FILE__, 'deactivate_dwp_courier_management' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dwp-courier-management.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dwp_courier_management() {

	$plugin = new Dwp_Courier_Management();
	$plugin->run();

}
run_dwp_courier_management();
