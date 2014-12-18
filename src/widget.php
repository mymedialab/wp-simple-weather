<?php

class mml_simple_weather_widget extends WP_Widget
{
    function __construct() {
        parent::__construct(
            'mml_simple_weather_widget', // Base ID
            __( 'Simple Weather Widget', 'text_domain' ), // Name
            array( 'description' => __( 'A Simple Weather Widget', 'text_domain' ), ) // Args
        );
    }

    public function form($instance)
    {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = $instance['title']; ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
        </p>

        <?php
    }

    public function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);

        echo isset($before_widget) ? $before_widget : '';

        if (isset($title) && !empty($title)) {
            echo isset($before_title) ? $before_title : '';
            echo $title;
            echo isset($after_title) ? $after_title : '';
        }

        echo do_shortcode('[mml-simple-weather]');

        echo isset($after_widget) ? $after_widget : '';
    }

    public function update($new_instance, $old_instance)
    {
        return array(
            'title' => strip_tags($new_instance['title'])
        );
    }
}
