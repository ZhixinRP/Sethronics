<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class DMS_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate()
	{
		global $wpdb;

		// If wp_dms_order table does not exists. Create new table.
		if ($wpdb->get_var("SHOW TABLES LIKE '" . $this->wp_dms_orders() . "'") != $this->wp_dms_orders()) {

			//DMS Orders table Creation On Plugin Activation
			$orders_table_create = "CREATE TABLE " . $this->wp_dms_orders() . " (
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

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($orders_table_create);
		}
	}

	//Dynamic Table Name with Prefix_
	public function wp_dms_orders()
	{
		global $wpdb;
		return $wpdb->prefix . "dms_orders";
	}
}
