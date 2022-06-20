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

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}
