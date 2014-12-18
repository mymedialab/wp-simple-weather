<?php

class mml_simple_weather_install
{
    protected static $options;

    public static function register($options)
    {
        register_activation_hook( __FILE__, array( 'mml_simple_weather_install', 'init' ) );
    }

    // WP requires this to be static. Because God Knows.
    public static function init()
    {
        foreach (self::$options as $option) {
            if (strpos($option, 'mml_weather_display_') === 0) {
                add_option($option, 'yes');
            }
        }
    }

    public static function uninstall()
    {
        foreach (self::$options as $option) {
            delete_option($option);
        }
    }
}
