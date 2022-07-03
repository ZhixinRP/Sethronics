<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Api;

//Dealing with Wordpress API (default methods of wordpress)
class SettingsApi
{
	public $admin_pages = array();

	public $admin_subpages = array();

	public $settings = array();

	public $sections = array();

	public $fields = array();

	public function register()
	{
		if (!empty($this->admin_pages) || !empty($this->admin_subpages)) {
			add_action('admin_menu', array($this, 'addAdminMenu'));
		}

		if (!empty($this->settings)) {
			add_action('admin_init', array($this, 'registerCustomFields'));
		}
	}

	public function addPages(array $pages)
	{
		$this->admin_pages = $pages;

		return $this;
	}

	public function withSubPage(string $title = null)
	{
		if (empty($this->admin_pages)) {
			return $this;
		}

		$admin_page = $this->admin_pages[0];

		$subpage = array(
			array(
				'parent_slug' => $admin_page['menu_slug'],
				'page_title' => $admin_page['page_title'],
				'menu_title' => ($title) ? $title : $admin_page['menu_title'],
				'capability' => $admin_page['capability'],
				'menu_slug' => $admin_page['menu_slug'],
				'callback' => $admin_page['callback']
			)
		);

		$this->admin_subpages = $subpage;

		return $this;
	}

	public function addSubPages(array $pages)
	{
		$this->admin_subpages = array_merge($this->admin_subpages, $pages);

		return $this;
	}

	public function addAdminMenu()
	{
		foreach ($this->admin_pages as $page) {
			// Adds a top-level menu page.
			$menu = add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
			add_action('load-' . $menu, "load_scripts");
		}

		foreach ($this->admin_subpages as $page) {
			// Adds a submenu page.
			$submenu = add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
			add_action('load-' . $submenu, "load_scripts");
		}
	}

	function load_scripts()
	{
		add_action('admin_enqueue_scripts', 'enqueue_bootstrap');
	}

	function enqueue_bootstrap()
	{
		wp_enqueue_style('bs_style', $this->plugin_url . 'node_modules/bootstrap/dist/css/bootstrap.min.css', array(), rand(111, 9999), 'all');
		wp_enqueue_script('bs_script', $this->plugin_url . 'node_modules/bootstrap/dist/js/bootstrap.min.js', array(), rand(111, 9999), 'all');
	}

	//setters methods
	public function setSettings(array $settings)
	{
		$this->settings = $settings;

		return $this;
	}

	// public function setSections(array $sections)
	// {
	// 	$this->sections = $sections;

	// 	return $this;
	// }

	// public function setFields(array $fields)
	// {
	// 	$this->fields = $fields;

	// 	return $this;
	// }

	public function registerCustomFields()
	{
		// register setting
		foreach ($this->settings as $setting) {
			//Registers a setting and its data.
			register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : ''));
		}

		// // add settings section
		// foreach ($this->sections as $section) {
		// 	// Adds a new section to a settings page.
		// 	add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ''), $section["page"]);
		// }

		// // add settings field
		// foreach ($this->fields as $field) {
		// 	// Adds a new field to a section of a settings page.
		// 	add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ''), $field["page"], $field["section"], (isset($field["args"]) ? $field["args"] : ''));
		// }
	}
}