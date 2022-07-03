<?php

/**
 * @package  DmsPlugin
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        if (get_option('dms_plugin')) {
            return;
        }

        $default = array();

        update_option('dms_plugin', $default);
    }
}