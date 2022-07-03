<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wppathfinder.com/
 * @since      1.0.0
 *
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dwp_Courier_Management
 * @subpackage Dwp_Courier_Management/includes
 * @author     Nira Rahman <zindexbd@gmail.com>
 */
class Dwp_Courier_Management_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() { 

		global $wpdb;

		// If merchant table is not created. Create new table.
		if($wpdb->get_var("SHOW TABLES LIKE '".$this->wp_dwp_merchant_registration()."'") != $this->wp_dwp_merchant_registration()){

			//Merchant Table Creation On Plugin Activation
			$merchant_table_create = "CREATE TABLE ".$this->wp_dwp_merchant_registration()." (
				`id` int(5) NOT NULL AUTO_INCREMENT,
				`mrcnt_name` varchar(40) DEFAULT NULL,
				`mrcnt_email` varchar(20) DEFAULT NULL,
				`mrcnt_phone` int(12) DEFAULT NULL,
				`business_address` varchar(40) DEFAULT NULL,
				`web_address` varchar(30) NOT NULL,
				`product_type` varchar(500) DEFAULT NULL,
				`product_weight` int(5) NOT NULL,
				`expected_deliveery` int(5) NOT NULL,
				`mrcnt_document` varchar(200) NOT NULL,
				`shop_image` varchar(200) NOT NULL,
				`status` int(11) NOT NULL DEFAULT 1,
				`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"; 

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');			
			dbDelta($merchant_table_create); 

		}

		// If Submit Delivery table is not created. Create new table.
		if($wpdb->get_var("SHOW TABLES LIKE '".$this->wp_dwp_delivery_request_submit()."'") != $this->wp_dwp_delivery_request_submit()){
			
			//Submit Delivery Table
			$submit_delivery_table = "CREATE TABLE " .$this->wp_dwp_delivery_request_submit(). " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`mrcnt_id` int(5) NOT NULL,
				`mrchnt_name` varchar(50) NOT NULL,
				`mrcnt_phn` int(13) NOT NULL,
				`mrcnt_addr` varchar(50) NOT NULL,
				`cstmr_name` varchar(50) NOT NULL,
				`cstmr_phone` int(13) NOT NULL,
				`cstmr_addr` varchar(50) NOT NULL,
				`pmnt_stus` int(1) NOT NULL DEFAULT 1,
				`amnt_collect` int(5) NOT NULL,
				`edd` date NOT NULL,
				`edt` time NOT NULL,
				PRIMARY KEY (`id`)
			  ) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($submit_delivery_table);
		}
	}

	//Dynamic Table Name with Prefix_
	public function wp_dwp_merchant_registration(){

		global $wpdb; 

		return $wpdb->prefix."dwp_merchant_registration";

	}

	//Dynamic Table Name with Prefix_
	public function wp_dwp_delivery_request_submit(){

		global $wpdb; 

		return $wpdb->prefix."dwp_delivery_request_submit";

	}

	

}
