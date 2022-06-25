<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once("$this->plugin_path/templates/admin.php");
	}

	public function adminDP()
	{
		return require_once("$this->plugin_path/templates/dp.php");
	}

	public function adminOrders()
	{
		return require_once("$this->plugin_path/templates/orders.php");
	}

	public function dmsOptionsGroup($input)
	{
		return $input;
	}

	public function dmsAdminSection()
	{
		echo 'Check this beautiful section!';
	}

	public function dmsTextExample()
	{
		$value = esc_attr(get_option('text_example'));
		echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write Something Here!">';
	}

	public function dmsFirstName()
	{
		$value = esc_attr(get_option('first_name'));
		echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write your First Name">';
	}
}
