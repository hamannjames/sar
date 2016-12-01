<?php

// Unit Post Type

add_action ('init', 'unit_register');

function unit_register() {

    $labels = array(
        'name' => _x('Units', 'post type general name'),
        'singular_name' => _x('Unit', 'post type singular name'),
        'add_new' => _x('Add Unit', 'add button'),
        'add_new_item' => __('Add New Unit'),
        'edit_item' => __('Edit Unit'),
        'new_item' => __('New Unit'),
        'view_item' => __('View Unit'),
        'search_item' => __('Search Units'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        'page-attributes'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => $supports
    );

    register_post_type('units', $args);

}

// Special Operations Post Type

add_action ('init', 'so_register');

function so_register() {

    $labels = array(
        'name' => _x('Special Operations', 'post type general name'),
        'singular_name' => _x('Operation', 'post type singular name'),
        'add_new' => _x('Add Operation', 'add button'),
        'add_new_item' => __('Add New Operation'),
        'edit_item' => __('Edit Operation'),
        'new_item' => __('New Operation'),
        'view_item' => __('View Operation'),
        'search_item' => __('Search Operations'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-shield',
        'supports' => $supports
    );

    register_post_type('special_operations', $args);

}

// Testimonies Post Type

add_action ('init', 'story_register');

function story_register() {

    $labels = array(
        'name' => _x('Stories', 'post type general name'),
        'singular_name' => _x('Story', 'post type singular name'),
        'add_new' => _x('Add Story', 'add button'),
        'add_new_item' => __('Add New Story'),
        'edit_item' => __('Edit Story'),
        'new_item' => __('New Story'),
        'view_item' => __('View Story'),
        'search_item' => __('Search Stories'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-id',
        'supports' => $supports
    );

    register_post_type('story', $args);

}

// Events

add_action ('init', 'event_register');

function event_register() {

    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Event', 'post type singular name'),
        'add_new' => _x('Add Event', 'add button'),
        'add_new_item' => __('Add New Event'),
        'edit_item' => __('Edit Event'),
        'new_item' => __('New Event'),
        'view_item' => __('View Event'),
        'search_item' => __('Search Events'),
        'not_found' => __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
    );

    $supports = array(
        'title',
        'editor',
        'thumbnail',
        'excerpt',
        'page-attributes'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'query_var' => true,
        'rewrite' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => $supports
    );

    register_post_type('events', $args);

}

?>
