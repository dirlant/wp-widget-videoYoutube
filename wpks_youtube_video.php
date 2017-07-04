<?php
require('wpks_service.php');

/*
* Plugin Name: KS Widget Video de Youtube
* Plugin URI: http://www.google.cl
* Description: Creación de Widget
* Version: 1.0
* Author URI: http://www.paginaswebks.com
* License: GPL2
*/

// registrando widget
add_action('widgets_init', 'wpks_widget_init');


function wpks_widget_init() {
    register_widget(wpks_Widget);
}

/**
 * widget class
 */
class wpks_Widget extends WP_Widget {
    function wpks_Widget() {
        $widget_options = array(
            'classname' => 'wpks_class', //CSS
            'description' => 'Mostrar un Video de Youtube desde Metadata'
        );
        
        $this->WP_Widget('wpks_id', 'Video YouTube', $widget_options);
    }
    
    /**
     * show widget form in Appearence / Widgets
     */
    function form($instance) {
        $defaults = array(
            'title' => 'Video Widget',
            'link' => 'https://www.youtube.com/watch?v=QHV9lnZuFaY'
            );
        $instance = wp_parse_args( (array) $instance, $defaults);
        
        $title = esc_attr($instance['title']);
        $link = esc_attr($instance['link']);
        
        echo 
        '
        <p>Nombre del widget</p>
        <input type="text" class="widefat" name="'.$this->get_field_name('title').'" value="'.$title.'" />
        <p>Enlace del Video</p>
        <input type="text" class="widefat" name="'.$this->get_field_name('link').'" value="'.$link.'" />
        ';
    }
    
    /**
     * save widget form
     */
    function update($new_instance, $old_instance) {        
        $instance = $old_instance;        
        $instance['title'] = strip_tags($new_instance['title']); 
        $instance['link'] = esc_url($new_instance['link']);        
        return $instance;
    }
    
    /**
     * show widget in post / page
     */
    function widget($args, $instance) {
        extract( $args );        
        $title = apply_filters('widget_title', $instance['title']);
        
        //show only if single post
        if(is_single()) {
            echo $before_widget;
            echo $before_title.$title.$after_title;
            
            //get post metadata
            //$varYoutube = esc_url(get_post_meta(get_the_ID(), 'varYoutube', true));

            //Mostrar el contenido del widget
            echo '<iframe width="100%" height="250" frameborder="0" allowfullscreen src="https://www.youtube.com/embed/'.wpks_videoFromYoutube($instance['link']).'"></iframe>';       
            
            echo $after_widget;
        }
    }
}

?>