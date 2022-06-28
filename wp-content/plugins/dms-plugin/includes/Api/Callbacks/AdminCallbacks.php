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
}
