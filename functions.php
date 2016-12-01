<?php

// Includes
include_once('includes/scripts.php');
include_once('includes/cpt.php');

// Theme Support
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );

// Meta tags not included in yoast
function ravenna_add_meta_tags() {
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "<?php bloginfo( 'charset' ); ?>">
    <?php

    if (is_single()){
        global $post;
        $author = get_the_author_meta('user_nicename', $post->post_author);
        echo '<meta name="author" content="' . $author . '">';
    }
    else {
    ?>
    <meta name = "author" content = "Ravenna Interactive">
    <?php
    }
}

add_action('wp_head', 'ravenna_add_meta_tags', 1);

// Widget areas
function ravenna_widgets_init() {
	register_sidebar(array(
		'name'          => 'Blog Sidebar',
		'id'            => 'blog-sidebar',
		'description'   => 'Widget area for blogs.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => 'Page Sidebar',
		'id'            => 'page-sidebar',
		'description'   => 'Widget area for pages',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}

add_action( 'widgets_init', 'ravenna_widgets_init' );

// Options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme General Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
  		'page_title' 	=> 'Footer Settings',
  		'menu_title'	=> 'Footer Settings',
  		'parent_slug'	=> 'theme-general-settings',
  	));

    acf_add_options_sub_page(array(
  		'page_title' 	=> 'Unit Landing Page Settings',
  		'menu_title'	=> 'Unit Landing Page Settings',
  		'parent_slug'	=> 'theme-general-settings',
  	));

    acf_add_options_sub_page(array(
  		'page_title' 	=> 'Special Operations Landing Page',
  		'menu_title'	=> 'Special Operations Landing Page',
  		'parent_slug'	=> 'theme-general-settings',
  	));

    acf_add_options_sub_page(array(
  		'page_title' 	=> 'Blog Landing Page',
  		'menu_title'	=> 'Blog Landing Page',
  		'parent_slug'	=> 'theme-general-settings',
  	));
}

// Change excerpt lenth on archives

function custom_excerpt_length($length) {
    if (is_home() || is_archive() || is_date()) {
        return 200;
    }
    else {
        return 40;
    }
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

// Custom Login
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(http://sr.ravennainteractive.com/wp-content/uploads/2016/10/snohomish_county_volunteer_search_and_rescue.png);
            padding-bottom: 150px;
      			background-size: 200px;
      			width: 100%;
        }
        body.login div#login form#loginform p.submit input#wp-submit {
            border-radius: 0px;
            border: 0px;
            box-shadow: none;
            background:#719071;
            color: #fff;
            text-shadow: none;
        }
        body.login div#login form#loginform p.submit input#wp-submit:hover {
          background: #719071;
          color:#fff;
          text-shadow: none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Add pages to search
function wpshock_search_filter( $query ) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array('post','page') );
    }
    return $query;
}
add_filter('pre_get_posts','wpshock_search_filter');

// Add events to main loop
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array( 'post', 'events' ) );
  return $query;
}

/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );
