<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;

/**
 * 
 */
class Dashboard extends BaseController
{
	public $settings;

	public $callbacks;
	// public $callbacks_manager;

	public $pages = array();

	public $subpages = array();

	public function register()
	{
		//initiliase
		$this->settings = new SettingsApi();
		$this->callbacks = new AdminCallbacks();
		// $this->callbacks_manager = new ManagerCallbacks();

		$this->setPages();

		// $this->setSettings();
		// $this->setSections();
		// $this->setFields();

		//Method chaining
		$this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' => 'DMS Plugin',
				'menu_title' => 'DMS',
				'capability' => 'manage_admin_dashboard',
				'menu_slug' => 'dms_plugin',
				//grabs the scripts, html,php etc..
				'callback' => array($this->callbacks, 'adminDashboard'),
				'icon_url' => 'dashicons-car',
				'position' => 110
			)
		);
	}

	// public function setSettings()
	// {
	// 	$args = array(
	// 		array(
	// 			'option_group' => 'dms_plugin_settings',
	// 			'option_name' => 'text_example',
	// 			'callback' => array($this->callbacks, 'dmsOptionsGroup')
	// 		),
	// 		array(
	// 			'option_group' => 'dms_options_group',
	// 			'option_name' => 'first_name'
	// 		)
	// 		//ADD more custom fields 
	// 	);

	// 	$this->settings->setSettings($args);
	// }

	// public function setSections()
	// {
	// 	$args = array(
	// 		array(
	// 			'id' => 'dms_admin_index',
	// 			'title' => 'Settings',
	// 			'callback' => array($this->callbacks, 'dmsAdminSection'),
	// 			'page' => 'dms_plugin'
	// 		)
	// 	);

	// 	$this->settings->setSections($args);
	// }

	// public function setFields()
	// {
	// 	$args = array(
	// 		array(
	// 			'id' => 'text_example',
	// 			'title' => 'Text Example',
	// 			'callback' => array($this->callbacks, 'dmsTextExample'),
	// 			'page' => 'dms_plugin',
	// 			'section' => 'dms_admin_index',
	// 			'args' => array(
	// 				'label_for' => 'text_example',
	// 				'class' => 'example-class'
	// 			)
	// 		),
	// 		array(
	// 			'id' => 'first_name',
	// 			'title' => 'First Name',
	// 			'callback' => array($this->callbacks, 'dmsFirstName'),
	// 			'page' => 'dms_plugin',
	// 			'section' => 'dms_admin_index',
	// 			'args' => array(
	// 				'label_for' => 'first_name',
	// 				'class' => 'example-class'
	// 			)
	// 		)
	// 	);

	// 	$this->settings->setFields($args);
	// }
}
