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
				`order_id` int(5) NOT NULL,
				`customer_name` varchar(20) NOT NULL,
				`customer_phone` varchar(15) NOT NULL,
				`order_address` varchar(200) NOT NULL,
				`postal_code` varchar(6) NOT NULL,
				`delivery_personnel` varchar(20) DEFAULT NULL,
				`order_weight` float(5) DEFAULT NULL,
				`delivery_status` varchar(20) NOT NULL,
				`delivery_datetime` DATETIME DEFAULT NULL,
				`photo_evidence` varchar(200) DEFAULT NULL,
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
