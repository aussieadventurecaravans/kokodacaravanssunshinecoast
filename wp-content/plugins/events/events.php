<?php
/*
Plugin Name: Events
Description: create custom events
Version: 1.0.0
Author: Son Nguyen
*/


add_action('init', 'init_events_action');

function init_events_action ()
{
    if ( function_exists('register_post_type_events') )
    {
        register_post_type_events();
    }
}


//register post type events
function register_post_type_events() {
    register_post_type('events', array(
            'label' => __('Events', 'ADG'),
            'singular_label' => __("Events"),
            '_builtin' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'hierarchical' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'menu_icon' => 'dashicons-calendar',
            'rewrite' => array(
                'slug' => 'events',
                'with_front' => FALSE,
            ),
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'comments')
        )
    );
    register_taxonomy('events_category', 'events', array('hierarchical' => true, 'label' => __("categories"), 'singular_name' => __("events_category"), "rewrite" => true, "query_var" => true));
    register_taxonomy('events_tag', 'events', array('hierarchical' => false, 'label' => __("tags"), 'singular_name' => __("events_tag"), 'rewrite' => true, 'query_var' => true));
}