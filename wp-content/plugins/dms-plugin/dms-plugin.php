<?php

/**
 * @package DmsPlugin
 */
/*
Plugin Name: Delivery Management System
Description: This is a custom plugin made for Sethtronics
Version: 1.0.0
Author: Zhixin & Zikai
Author URI: https://zhixin.rf.gd
License: GPLv2 or later
Text Domain: dms-plugin
*/

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('You are not allowed access!');
define('PLUGIN_URL', plugin_dir_url(__FILE__));

// Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_dms_plugin()
{
	Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_dms_plugin');

/**
 * The code that runs during plugin deactivation
 */
function deactivate_dms_plugin()
{
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_dms_plugin');

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('Inc\\Init')) {
	Inc\Init::register_services();
}
