<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class OrdersController extends BaseController
{
    public $callbacks;

    public $subpages = array();

    public function register()
    {
        // if (!$this->activated('orders_manager')) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->setSubpages();

        $this->settings->addSubPages($this->subpages)->register();
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'dms_plugin',
                'page_title' => 'Orders',
                'menu_title' => 'Orders',
                'capability' => 'manage_admin_orders',
                'menu_slug' => 'dms_orders',
                'callback' => array($this->callbacks, 'adminOrders')
            )
        );
    }
}
