<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\DpCallbacks;
use Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class DeliveryPersonnelController extends BaseController
{
    public $settings;

    public $callbacks;

    public $dp_callbacks;

    public $subpages = array();

    public function register()
    {
        // if (!$this->activated('dp_manager')) return;

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->dp_callbacks = new DpCallbacks();

        $this->setSubpages();

        $this->setSettings();

        // $this->setSections();

        // $this->setFields();

        $this->settings->addSubPages($this->subpages)->register();
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'dms_plugin',
                'page_title' => 'DP Manager',
                'menu_title' => 'DP Manager',
                'capability' => 'manage_admin_dp',
                'menu_slug' => 'dms_dp',
                'callback' => array($this->callbacks, 'adminDP')
            )
        );
    }

    public function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'dms_plugin_dp_settings',
                'option_name' => 'dms_plugin_dp',
                'callback' => array($this->dp_callbacks, 'dpSanitize')
            )
        );

        $this->settings->setSettings($args);
    }

    // public function setSections()
    // {
    //     $args = array(
    //         array(
    //             'id' => 'dms_add_dp',
    //             'title' => 'Add Delivery Personnel',
    //             // 'callback' => array($this->dp_callbacks, 'dpSectionManager'),
    //             'page' => 'dms_dp'
    //         )
    //     );

    //     $this->settings->setSections($args);
    // }

    // public function setFields()
    // {
    //     $args = array(
    //         array(
    //             'id' => 'username',
    //             'title' => 'Username (required)',
    //             'callback' => array($this->dp_callbacks, 'textField'),
    //             'page' => 'dms_dp',
    //             'section' => 'dms_add_dp',
    //             'args' => array(
    //                 'option_name' => 'dms_plugin_dp',
    //                 'label_for' => 'username',
    //                 'placeholder' => 'eg. Liu Zhixin'
    //             )
    //         ),
    //         array(
    //             'id' => 'password',
    //             'title' => 'Passsword (required)',
    //             'callback' => array($this->dp_callbacks, 'textField'),
    //             'page' => 'dms_dp',
    //             'section' => 'dms_add_dp',
    //             'args' => array(
    //                 'option_name' => 'dms_plugin_dp',
    //                 'label_for' => 'phone_number',
    //                 'placeholder' => 'eg. 87654321'
    //             )
    //         ),
    //         array(
    //             'id' => 'phone_number',
    //             'title' => 'Phone Number:',
    //             'callback' => array($this->dp_callbacks, 'textField'),
    //             'page' => 'dms_dp',
    //             'section' => 'dms_add_dp',
    //             'args' => array(
    //                 'option_name' => 'dms_plugin_dp',
    //                 'label_for' => 'phone_number',
    //                 'placeholder' => 'eg. 87654321'
    //             )
    //         )
    //     );

    //     $this->settings->setFields($args);
    // }
}