<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class DMS_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $table_activator;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//Activator Method
		require_once DMS_PLUGIN_PATH . 'includes/class-dms-activator.php';
		$activator = new DMS_Activator();
		$this->table_activator = $activator;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/dms-admin.css', array(), rand(111, 9999), 'all');
		// wp_enqueue_style('bootstrap-css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), rand(111, 9999), 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_media();
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/dms-admin.js', array(), rand(111, 9999), 'all');
		// wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array(), rand(111, 9999), 'all');
	}

	//add custom menu
	public function my_admin_menu()
	{
		//ADMIN SECTION
		add_menu_page('DMS', 'DMS', 'manage_admin_dashboard', 'dms_plugin', array($this, 'dms_admin_page'), 'dashicons-car', 250);
		//Add Dashboard sub page replaces menu page
		add_submenu_page('dms_plugin', 'Dashboard', 'Dashboard', 'manage_admin_dashboard', 'dms_plugin', array($this, 'dms_admin_dashboard'));
		add_submenu_page('dms_plugin', 'DP Manager', 'DP Manager', 'manage_admin_dp', 'dms_admin_dp', array($this, 'dms_admin_dp'));
		add_submenu_page('dms_plugin', 'Order Manager', 'Order Manager', 'manage_admin_orders', 'dms_admin_orders', array($this, 'dms_admin_orders'));
		add_submenu_page('dms_plugin', 'Order Location', 'Order Location', 'manage_admin_locations', 'dms_admin_locations', array($this, 'dms_admin_locations'));

		//DELIVERY PERSONNEL SECTION
		add_menu_page('DMS', 'DMS', 'manage_dp_dashboard', 'dms_plugin_dp', array($this, 'dms_dp_page'), 'dashicons-car', 250);
		add_submenu_page('dms_plugin_dp', 'Dashboard', 'Dashboard', 'manage_dp_dashboard', 'dms_plugin_dp', array($this, 'dms_dp_dashboard'));
		add_submenu_page('dms_plugin_dp', 'Orders', 'Orders', 'manage_dp_orders', 'dms_dp_orders', array($this, 'dms_dp_orders'));

		if (current_user_can('administrator')) {
			remove_menu_page('dms_plugin_dp');
		}

		if (current_user_can('delivery_personnel')) {
			if (defined('IS_PROFILE_PAGE')) {
				wp_redirect(admin_url());
				exit;
			}
			remove_submenu_page('users.php', 'profile.php');
			remove_menu_page('profile.php');
		}
	}
	//callbacks
	public function dms_admin_page()
	{
		require_once 'partials/dms-admin-dashboard.php';
	}
	public function dms_admin_dashboard()
	{
		require_once 'partials/dms-admin-dashboard.php';
	}
	public function dms_admin_dp()
	{
		require_once 'partials/dms-admin-dp.php';
	}
	public function dms_admin_orders()
	{
		require_once 'partials/dms-admin-orders.php';
	}
	public function dms_admin_locations()
	{
		require_once 'partials/dms-admin-locations.php';
	}
	public function	dms_dp_page()
	{
		require_once 'partials/dms-dp-dashboard.php';
	}
	public function	dms_dp_dashboard()
	{
		require_once 'partials/dms-dp-dashboard.php';
	}
	public function	dms_dp_orders()
	{
		require_once 'partials/dms-dp-orders.php';
	}

	public function admin_ajax_request_handle_fn()
	{
		/**
		 * 
		 * Admin Ajax Request Operation Function.
		 * 
		 */
	}
}
