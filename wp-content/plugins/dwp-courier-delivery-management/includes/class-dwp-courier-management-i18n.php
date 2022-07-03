<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wppathfinder.com/
 * @since      1.0.0
 *
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/includes
 * @author     Nira Rahman <zindexbd@gmail.com>
 */
class Dwp_Courier_Management_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dwp-courier-management',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
