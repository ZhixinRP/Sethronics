<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * 
 */
class Enqueue extends BaseController
{
	public function register()
	{
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
	}

	function enqueue()
	{
		// enqueue all our scripts
		wp_enqueue_style('pluginstyle', $this->plugin_url . 'assets/style.css', array(), rand(111, 9999), 'all');
		wp_enqueue_script('pluginscript', $this->plugin_url . 'assets/script.js', array(), rand(111, 9999), 'all');
	}
}
