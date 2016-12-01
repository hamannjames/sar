<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<head>

    <?php wp_head(); ?>
    <script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=w4tk0nylpzua26e6qxaura';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>

</head>

<body <?php body_class(); ?> >
    <div id = "site-wrapper">
        <button id = "back-to-top" title = "Back to top"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
        <div id = "site-container">

            <?php
            if (is_post_type_archive('units')){
                $bannerImg = get_field('unit_banner_image', 'options');
                $bannerType = get_field('unit_banner_type', 'options');
            }
            elseif (is_single() || is_home() || is_archive() || is_date() || is_search()) {
                $bannerImg = get_field('blog_banner_image', 'options');
                $bannerType = get_field('blog_banner_type', 'options');
            }
            else {
                $bannerImg = get_field('banner_image');
                $bannerType = get_field('banner_type');
            }

            if ($bannerType == 'large') :
                if (is_post_type_archive('units')) {
                    $conImg = get_field('unit_content_image', 'options');
                    $bannerText = get_field('unit_banner_text');
                    $video = get_field('unit_video');
                }
                elseif (is_single() || is_home() || is_archive() || is_date() || is_search()) {
                    $conImg = get_field('blog_content_image', 'options');
                    $bannerText = get_field('blog_banner_text', 'options');
                    $video = get_field('blog_video');
                }
                else {
                    $conImg = get_field('content_image');
                    $bannerText = get_field('banner_text');
                    $video = get_field('video');
                }
            ?>
            <section class = "banner large" style = "background-image: url('<?php echo $bannerImg['url']; ?>');">
                <video autoplay loop>
                    <source src="<?php echo $video; ?>" type="video/mp4">
                </video>
                <div class = "banner-container">
                    <?php
                    if ($conImg) :
                    ?>
                    <figure class = "banner-content-image">
                        <img src = "<?php echo $conImg['url']; ?>" alt = "<?php echo $conImg['alt']; ?>">
                    </figure>
                    <?php
                    endif;
                    ?>
                    <h1 class = "banner-heading"><?php echo $bannerText; ?></h1>
                </div>
            </section>
            <?php
            else:
            ?>
            <section class = "banner small" style = "background-image: url('<?php echo $bannerImg['url']; ?>');">
            </section>
            <?php
            endif;
            ?>

            <header id = "site-header">
                <div id = "site-header-content">
                    <figure id = "logo-container">
                        <?php $logo = get_field('site_logo', 'options'); $home = home_url(); ?>
                        <a href = "<?php echo esc_url($home); ?>" title = "Go to homepage">
                            <img src = "<?php echo $logo['url']; ?>" alt = "<?php $logo['alt']; ?>" role = "logo"  id = "site-logo">
                        </a>
                    </figure>

                    <div id = "menu-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <nav id = "site-nav" role = "navigation">
                        <div id = "menu-container">
                            <?php

                             $menuArgs = array(
                                'menu' => 'Main Menu',
                                'menu_class' => 'menu',
                                'menu_id' => 'main-menu',
                                'container' => ''
                            );

                            wp_nav_menu( $menuArgs );

                            ?>
                        </div>
                    </nav>

                    <section id = "social-box">
                        <ul id = "social-menu">
                            <?php

                            if (have_rows('social_media_links', 'options')) :
                                while (have_rows('social_media_links', 'options')) : the_row();
                                $socialLink = get_sub_field('link', 'options');
                                $socialIcon = get_sub_field('icon', 'options');
                            ?>
                            <li class = "social-item">
                                <a href = "<?php echo $socialLink; ?>" title = "<?php echo $socialIcon['alt']; ?>" target = "_blank">
                                    <img src = "<?php echo $socialIcon['url']; ?>" alt = "<?php echo $socialIcon['alt']; ?>">
                                </a>
                            </li>

                            <?php
                                endwhile;
                            endif;
                            ?>
                        </ul>

                        <a id = "search-button" role = "button" title = "Search">
                            <?php $searchIcon = get_field('search_icon', 'options'); ?>
                            <img id = "search-green" src = "<?php echo $searchIcon['url']; ?>" alt = "<?php echo $searchIcon['alt']; ?>">
                            <img id = "search-white" src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/MagnifyingGlassWhite.png">
                        </a>

                        <a id = "donate-button" title = "Donate" href = "<?php the_field('donate_link', 'options'); ?>">Donate</a>

                    </section>

                    <form id = "searchform" role = "search" method = "get" action="http://sr.ravennainteractive.com/">
                        <input type = "text" id = "search-input" name = "s" placeholder = "Type Search...">
                        <input type = 'image' id = "search-submit" name = "search-submit" alt = "submit" src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/search-arrow.png">
                    </form>
                </div>
            </header>

            <main id = "site-content"  role = "main" class = "<?php

            if (is_page()) {
                echo 'page-wrapper';
            }
            elseif (is_single()) {
                echo 'post-wrapper';
            }
            elseif (is_archive() || (is_front_page() && is_home())) {
                echo 'post-excerpts-wrapper';
            }
            else {
                echo 'content-wrapper';
            }
            ?>">
