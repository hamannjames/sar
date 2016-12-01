<?php

function add_async_attribute($tag, $handle) {
    if ( 'facebook' !== $handle )
        return $tag;
    return str_replace( ' src', ' async="async" src', $tag );
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

function fonts() {
    wp_enqueue_style('Fonts', '//fonts.googleapis.com/css?family=Poppins|Teko');
}

function styles() {
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css');
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/assets/css/owl.theme.css');
    wp_enqueue_style('owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('magnific-css', get_template_directory_uri() . '/assets/css/magnific.css');
    wp_enqueue_style('scrollbar', get_template_directory_uri() . '/assets/css/jquery.mCustomScrollbar.css');
}

function scripts() {
    wp_enqueue_script('font_awesome', 'https://use.fontawesome.com/a7cef692e0.js');
    if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
    function my_jquery_enqueue() {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js", false, null);
		wp_enqueue_script('jquery');
	}

    wp_enqueue_script('owl-min', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('magnific-js', get_template_directory_uri() . '/assets/js/magnific.js', array('jquery'), '', true);
    wp_enqueue_script('dom_ready', get_template_directory_uri() . '/assets/js/dom-ready.js', array('jquery'), '', true );
    wp_enqueue_script('facebook', get_template_directory_uri() . '/assets/js/facebook.js', '', '', true );
    wp_enqueue_script('scrollbar-js', get_template_directory_uri() . '/assets/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '', true );
}

add_action('wp_enqueue_scripts', 'fonts');
add_action('wp_enqueue_scripts', 'styles');
add_action('wp_enqueue_scripts', 'scripts');

?>
