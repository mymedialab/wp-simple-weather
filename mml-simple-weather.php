<?php
/*
Plugin Name: MML Simple Weather
Plugin URI: http://www.mymedialab.co.uk/opensource/wp-simple-weather/
Description: A simple plugin that enables you to add Yahoo Weather to add your site.
Version: 1.0.0
Author: Barry Rhodes
Author URI: http://www.mymedialab.co.uk/
License: GPLv2

This work is based on Beautiful Yahoo Weather 1.4.2 by Mohammad Pishdar. A plugin which *almost* did what I needed!
Original URI: http://www.wp-book.ir/
Original Author URI: http://www.wp-book.ir/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function mml_weather_setup() {

    $pluginRoot = __DIR__;
    $options = array(
        'mml_weather_city', 'mml_weather_woeid', 'mml_weather_unit', 'mml_weather_language', 'mml_weather_imageset',
        'mml_weather_cssfile', 'mml_weather_nocss', 'mml_weather_display_icon', 'mml_weather_display_temp',
        'mml_weather_display_wind_speed', 'mml_weather_display_wind_direction', 'mml_weather_display_sunrise',
        'mml_weather_display_sunset', 'mml_weather_display_humidity', 'mml_weather_display_visibility',
        'mml_weather_display_pressure', 'mml_weather_display_forecast', 'mml_weather_display_forecast_icon'
    );

    include $pluginRoot . '/src/api.php'; // Y U NO AUTOLOAD?
    include $pluginRoot . '/src/install.php'; // Y U NO AUTOLOAD?
    include $pluginRoot . '/src/shortcode.php'; // Y U NO AUTOLOAD?
    include $pluginRoot . '/src/widget.php'; // Y U NO AUTOLOAD?

    $Shortcode = new mml_simple_weather_shortcode($pluginRoot, $options);
    $Shortcode->register();

    $Install = new mml_simple_weather_install();
    $Install->register($options);

    // Yuck. The things we do for backcompat.
    add_action('widgets_init',
        create_function('', 'return register_widget("mml_simple_weather_widget");')
    );

    if( is_admin() ) {

        include $pluginRoot . '/src/admin.php';
        $Admin = new mml_simple_weather_admin($pluginRoot, $options);
        $Admin->register();

    }
}

// Not using namespaces because of the ubiquity of WordPress. Don't really *need* it, and using it excludes a bunch
// of (crappy!) older servers. By doing this I at least get scoped variables and them eejits can use the plugin
mml_weather_setup();
