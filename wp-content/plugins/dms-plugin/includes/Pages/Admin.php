<?php 
/**
 * @package  DmsPlugin
 */
namespace Inc\Pages;

/**
* 
*/
class Admin
{
	public function register() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	public function add_admin_pages() {
		add_menu_page( 'dms', 'DMS', 'manage_options', 'dms_plugin', array( $this, 'admin_index' ), 'dashicons-car', 110 );
	}

	public function admin_index() {
		require_once PLUGIN_PATH . 'templates/admin.php';
	}
}