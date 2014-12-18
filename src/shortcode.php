<?php

class mml_simple_weather_shortcode
{
    protected $options;
    protected $pluginRoot;

    public function __construct($pluginRoot, $options)
    {
        $this->pluginRoot = $pluginRoot;
        $this->options = $options;
    }

    public function register()
    {
        add_shortcode('mml-simple-weather', array($this, 'render'));
    }

    public function render()
    {
        // extract options into the template scope
        foreach ($this->options as $option) {
            $var = str_replace('mml_weather_', '', $option);
            ${$var} = get_option($option);
        }

        if (!isset($woeid) || !isset($unit)) {
            error_log("mml_simple_weather_shortcode could not find saved options to load feed.");
            return '';
        }

        $api = new mml_simple_weather_api();
        $feed = $api->getCityDetails($woeid, $unit);

        $allLanguages = include $this->pluginRoot . '/lang.php';
        if (!isset($language)) {
            $conditions = isset($allLanguages['conditions'][$language]) ? $allLanguages[$language] : array_shift($allLanguages['conditions']);
            $days = isset($allLanguages['days'][$language]) ? $allLanguages[$language] : array_shift($allLanguages['days']);
            $terms = isset($allLanguages['terms'][$language]) ? $allLanguages[$language] : array_shift($allLanguages['terms']);
        } else {
            error_log("mml_simple_weather_shortcode could not find saved language using default.");
            $conditions = array_shift($allLanguages['conditions']);
            $days = array_shift($allLanguages['days']);
            $terms = array_shift($allLanguages['terms']);
        }

        $wd = intval($feed['wind']['direction']);

        if ($wd >= 315 || $wd < 45) {
            $windDirection = $terms[3]; // 3=North
        } elseif ($wd >= 45 && $wd < 135) {
            $windDirection = $terms[4]; // 4=East
        } elseif ($wd >= 135 && $wd < 225) {
            $windDirection = $terms[5]; // 5=South
        } else {
            $windDirection = $terms[6]; //6=West
        }

        if (strpos($imageset, 'theme_') === 0) {
            $imageset = get_stylesheet_directory() . substr($imageset, 6) . '/';
        } else {
            $imageset = plugins_url("mml-simple-weather/imagesets/{$imageset}/");
        }

        // capture the template in a string and return
        ob_start();
        include $this->pluginRoot . '/templates/shortcode.php';
        return ob_get_clean();
    }
}
