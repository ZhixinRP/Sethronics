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
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		wp_enqueue_style('style', $this->plugin_url . 'assets/style.css', array(), rand(111, 9999), 'all');
		wp_enqueue_script('script', $this->plugin_url . 'assets/script.js', array(), rand(111, 9999), 'all');
		wp_enqueue_style('bs_style', $this->plugin_url . 'node_modules/bootstrap/dist/css/bootstrap.min.css', array(), rand(111, 9999), 'all');
		wp_enqueue_script('bs_script', $this->plugin_url . 'node_modules/bootstrap/dist/js/bootstrap.min.js', array(), rand(111, 9999), 'all');
		wp_enqueue_script('bootboxscript', $this->plugin_url . 'node_modules/bootbox/dist/bootstrap.min.js', array(), rand(111, 9999), 'all');
		// wp_enqueue_script('jquery');
	}
}
