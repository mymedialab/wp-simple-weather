<?php

class mml_simple_weather_admin
{
    protected $pluginRoot;
    protected $settings;

    public function __construct($pluginRoot, $settings)
    {
        $this->pluginRoot = $pluginRoot;
        $this->settings = $settings;
    }

    public function register()
    {
        add_action( 'admin_init', array($this, 'registerSettings') );
        add_action( 'admin_menu', array($this, 'registerMenuPage') );
    }

    public function adminOptionsPage()
    {
        $errors = get_option( 'plugin_error' );

        if (isset($_GET['settings-updated'])) {
            // Clear database cache weather_feed in shortcode.php
            set_transient('mml_weather_feed', "", 0);

            $message = _e('Settings saved.');
        }

        $languages = $this->getLanguages();
        $selectedLanguage = get_option('mml_weather_language');

        $imagesets = $this->getImagesets();
        $selectedImageset = get_option('mml_weather_imageset');

        $displayOptions = $this->getDisplayOptions();

        include $this->pluginRoot . '/templates/admin_options.php';
    }

    public function registerSettings()
    {
        foreach ($this->settings as $setting) {
            register_setting('mml-weather-settings-group', $setting);
        }
    }

    public function registerMenuPage()
    {
        $page_title = 'Simple Weather Settings';
        $menu_title = 'Simple Weather Settings';
        $capability = 'manage_options';
        $menu_slug  = 'mml-simple-weather';
        $function   = array($this, 'adminOptionsPage');
        $icon_url   = 'dashicons-cloud';
        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url );
    }

    protected function getLanguages()
    {
        $lang = include $this->pluginRoot . '/lang.php';
        $languageNames = array();
        foreach ( $lang['conditions'] as $languageName => $ignoreDetails ) {
            $languageNames[$languageName] = ucwords(str_replace(array('_','-'), ' ', $languageName));
        }

        return $languageNames;
    }

    protected function getImagesets()
    {
        $all = array();
        $ours = scandir($this->pluginRoot . '/imagesets');
        foreach ($ours as $dir) {
            if ($dir !== '.' && $dir !== '..' && is_dir("{$this->pluginRoot}/imagesets/{$dir}")) {
                $all[$dir] = ucwords(str_replace(array('_','-'), ' ', $dir));
            }
        }

        $userDir = get_template_directory() . '/weather-images';
        if (is_dir($userDir)) {
            $custom = scandir($userDir);
            foreach ($custom as $dir) {
                if ($dir !== '.' && $dir !== '..' && is_dir($userDir . '/' . $dir)) {
                    $all['theme_' . $dir] = 'Theme set: ' . ucwords(str_replace(array('_','-'), ' ', $dir));
                }
            }
        }

        return $all;
    }

    protected function getDisplayOptions()
    {
        $options = array();
        foreach ($this->settings as $setting) {

            if (strpos($setting, 'mml_weather_display_') === 0) {
                $options[$setting] = ucwords(str_replace(array('-', '_'), ' ', substr($setting, 20)));
            }
        }

        return $options;
    }
}
