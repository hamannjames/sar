<?php get_header(); $widget = is_active_sidebar('page-sidebar'); $pageBuilder = get_field('use_page_builder'); ?>
<div class = "page-container">

    <?php

    if ($pageBuilder) :
        if (have_rows('section_builder')) :
            $count = 1;
            while (have_rows('section_builder')) : the_row();

            $columns = get_sub_field('columns');
            $secBGImg = get_sub_field('section_background_image');
            $secBGColor = get_sub_field('section_background_color');
            $conBGColor = get_sub_field('content_background_color');
            $conColor = get_sub_field('content_color');
            $secCallout = get_sub_field('section_callout');
            $addButton = get_sub_field('add_button');
            $preText = get_sub_field('pre_title_text');
            $noBottom = get_sub_field('remove_bottom_spacing');
            $divider = get_sub_field('divider');
            $noTop = get_sub_field('remove_top_spacing');
            $fullWidth = get_sub_field('full_width');

            if ($columns == 'one') {
                $conNarrow = get_sub_field('narrow_content');
            }
            // Next is the wrapper and container for each section
    ?>

    <div class = "page-section-wrapper" style = "<?php
    if ($secBGImg) {
        echo ' background-image: url(\'' . $secBGImg['url'] . '\');';
    }
    ?>">
        <section class = "page-section group <?php if ($conNarrow) { echo ' narrow'; } if ($noBottom) { echo ' no-bottom'; } if ($noTop) { echo 'no-top '; } if ($fullWidth) { echo 'full-width '; }?>" style = "<?php
        if ($secBGColor) {
            echo ' background-color: ' . $secBGColor . ';';
        }
        if ($conBGColor) {
            echo ' background-color: ' . $conBGColor . ';';
        }
        if ($conColor) {
            echo ' color: ' . $conColor . ';';
        }
        ?>">

        <?php
        if ($preText) :
        ?>
        <div class = "pre-title">
            <?php echo $preText; ?>
        </div>
        <?php
        endif;

        // Next are the types for each one column section
        if ($columns == 'one') :

            $title = get_sub_field('content_title');
            $titleColor = get_sub_field('title_color');
            $small = get_sub_field('small_title');
            $subTitle = get_sub_field('content_sub_title');
            $subColor = get_sub_field('sub_title_color');
            $type = get_sub_field('content_type');

            ?>
            <div class = "col ss-12">
                <?php
                if ($title) :
                    if ($count == 1) :
                ?>
                <h1 class = "section-title <?php if ($small) { echo ' small'; }; ?>" style = "<?php
                echo ('color: ' . $titleColor . ';'); ?>"><?php echo $title; ?></h1>
                <?php
                    else :
                ?>
                <h2 class = "section-title <?php if ($small) { echo ' small'; }; ?>" style = "<?php
                echo ('color: ' . $titleColor . ';'); ?>"><?php echo $title; ?></h2>
                <?php
                    endif;
                endif;

                if ($subTitle) :
                ?>
                <h3 class = "section-sub-title" style = "<?php echo ('color: ' . $subColor . ';'); if ($title) { echo (' margin-top: -1em;'); } ?>"><?php echo $subTitle; ?></h3>
                <?php
                endif;

                switch ($type) {
                    case 'text' : // Text Section

                    $text = get_sub_field('text');
                ?>

                <div class = "text-section">
                    <?php echo $text; ?>
                </div>

                <?php

                    break;

                    case 'icons' :

                    if (have_rows('icon_builder')) :
                        $labelColor = get_sub_field('label_color');
                    ?>
                    <div class = "icons-wrapper" style = "<?php echo 'color: ' . $labelColor . ';'; ?>">
                        <?php
                        while (have_rows('icon_builder')) : the_row();
                            $img = get_sub_field('icon_image');
                            $label = get_sub_field('icon_label');
                        ?>
                        <div class = "icon-container">
                            <figure class = "icon-box">
                                <img src = "<?php echo $img['url']; ?>" alt = "<?php echo $img['alt']; ?>">
                            </figure>
                            <h3 class = "icon-label"><?php echo $label; ?></h3>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    endif;

                    break;

                    case 'units' :

                    $unitLayout = get_sub_field('unit_layout');
                    $unitType = get_sub_field('unit_type');

                    if (is_page('volunteer')) {
                        $unitArgs = array(
                            'post_type' => $unitType,
                            'order' => 'ASC',
                            'orderby' => 'name',
                            'post__not_in' => array(229)
                        );
                    }
                    else {
                        $unitArgs = array(
                            'post_type' => $unitType,
                            'order' => 'ASC',
                            'orderby' => 'name'
                        );
                    }

                    $unitQuery = new WP_Query($unitArgs);

                    if ($unitQuery->have_posts()) :
                        if ($unitLayout == 'vertical') :
                    ?>

                    <div class = "unit-container">
                    <?php
                        while ($unitQuery->have_posts()) : $unitQuery->the_post();
                            $title = get_the_title();
                            $excerpt = get_the_excerpt();
                            $link;
                            $altLink = get_field('alternate_link');
                            if ($altLink) {
                                $link = $altLink;
                            }
                            else {
                                $link = get_permalink();
                            }
                    ?>
                        <div class = "unit-box">
                            <?php
                            if (has_post_thumbnail()) :
                                $id = get_post_thumbnail_id();
                                $url = wp_get_attachment_image_src($id,'full', true);
                                $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
                            ?>

                            <figure class = "unit-icon">
                                <a href = "<?php echo $link; ?>" title = "<?php echo $title; ?>">
                                    <img src = "<?php echo $url[0]; ?>" alt = "<?php echo $alt; ?>">
                                </a>
                            </figure>

                            <?php
                            endif;
                            ?>

                            <h3 class = "unit-title"><a href = "<?php echo $link; ?>" title = "<?php echo $title; ?>"><?php echo $title; ?></a></h3>

                            <p class = "unit-excerpt">
                                <?php echo $excerpt; ?>
                            </p>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                        elseif ($unitLayout == 'horizontal') :
                    ?>
                    <div class = "icons-wrapper">
                        <?php
                        while ($unitQuery->have_posts()) : $unitQuery->the_post();
                            $title = get_the_title();
                            $link;
                            $altLink = get_field('alternate_link');
                            if ($altLink) {
                                $link = $altLink;
                            }
                            else {
                                $link = get_permalink();
                            }
                            $postID = get_the_ID();
                            $label = get_field('horizontal_view_label', $postID);
                        ?>
                        <div class = "icon-container">
                            <?php
                            if (has_post_thumbnail()) :
                                $id = get_post_thumbnail_id();
                                $url = wp_get_attachment_image_src($id,'full', true);
                                $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
                            ?>
                            <figure class = "icon-box">
                                <a href = "<?php echo $link; ?>" title = "<?php echo $title; ?>">
                                    <img src = "<?php echo $url[0]; ?>" alt = "<?php echo $alt; ?>">
                                </a>
                            </figure>
                            <?php
                            endif;
                            ?>
                            <h3 class = "icon-label"><a href = "<?php echo $link; ?>" title = "<?php echo $title; ?>"><?php echo $label; ?></a></h3>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                        endif;
                    endif;
                    wp_reset_postdata();

                    break;

                    case 'gallery' :

                    if (have_rows('gallery_row_builder')) :
                        while (have_rows('gallery_row_builder')) : the_row();
                            if (have_rows('gallery_row')) :
                                $i = 0;
                                $count = get_sub_field('gallery_row');
                    ?>

                    <div class = "gallery-row group">
                            <?php
                                while(have_rows('gallery_row')) : the_row();
                                    $image = get_sub_field('gallery_image');
                            ?>
                            <div class = "gallery-item" style = "background-image: url('<?php echo $image['url']; ?>');">
                                <a class = "gallery-link" title = "<?php echo $image['alt']; ?>" href = "<?php echo $image['url']; ?>">
                                    
                                </a>
                            </div>
                            <?php
                                $i++;
                                if ($i % 3 == 0 && $i < $count) {
                                    echo ('</div><div class = "gallery-row group">');
                                }
                                endwhile;
                            ?>
                    </div>
                    <?php
                            endif;
                        endwhile;
                    endif;

                    break;

                    case 'stories' :

                    $args = array(
                        'post_type' => 'story',
                        'posts_per_page' => 5
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                    <div class = "story-container half owl-carousel">
                    <?php
                        while ($query->have_posts()) : $query->the_post();
                            $title = get_the_title();
                            $content = get_the_content();
                            $link = get_permalink();
                        ?>
                        <div class = "story-content">
                            <div class = "story-item item">
                                <h3 class = "story-author"><?php echo $title; ?></h3>
                                <p class = "story-text">
                                    <?php the_excerpt(); ?>
                                </p>
                                <a class = "post-item-button" title = "<?php echo $title; ?>" href = "<?php echo $link; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                    endif;

                    break;

                    case 'contact' :

                    $text = get_sub_field('text');
                    $form = get_sub_field('contact_form');

                    if ($text) :
                    ?>
                    <div class = "text-section">
                        <?php echo $text; ?>
                    </div>
                    <?php
                    endif;

                    echo $form;

                    break;

                    case 'events' :

                    $text = get_sub_field('events_text');

                    $args = array(
                        'post_type' => 'events',
                        'posts_per_page' => 3
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                    <div class = "group">
                    <?php
                        while($query->have_posts()) : $query->the_post();
                            $date = get_field('event_date');
                            $excerpt = get_the_excerpt();
                            $link = get_permalink();
                        ?>
                        <div class = "col md-4 sm-12">
                            <article class = "event-excerpt">
                                <header class = "event-meta">
                                    <h3 class = "event-title"><a href = "<?php echo $link; ?>" title = "<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    <h3 class = "event-date"><?php echo $date; ?></h3>
                                </header>

                                <div class = "event-text">
                                    <?php echo $excerpt; ?>
                                </div>

                                <a class = "event-link" title = "<?php the_title(); ?>" href = "<?php echo $link; ?>">Learn More</a>
                            </article>
                        </div>
                        <?php
                        endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>
                    <?php
                    if ($text) {
                        echo ('<section class = "event-callout">' . $text . '</section>');
                    }

                    endif;

                    break;

                    default :

                    echo ('Pick a type.');
                }
                ?>
            </div>
        <?php
        else :
            $fcTitle = get_sub_field('fc_title');
            $fcTitleColor = get_sub_field('fc_title_color');
            $fcSmall = get_sub_field('fc_title_small');
            $fcSubTitle = get_sub_field('fc_sub_title');
            $fcSubColor = get_sub_field('fc_sub_title_color');
            $fcType = get_sub_field('fc_content_type');
            $scTitle = get_sub_field('sc_title');
            $scTitleColor = get_sub_field('sc_title_color');
            $scSmall = get_sub_field('sc_title_small');
            $scSubTitle = get_sub_field('sc_sub_title');
            $scSubColor = get_sub_field('sc_sub_title_color');
            $scType = get_sub_field('sc_content_type');

            ?>
            <div class = "first-column col sm-6">
                <?php
                if ($fcTitle) :
                ?>
                <h2 class = "section-title <?php if ($fcSmall) { echo ' small'; }; ?>" style = "<?php
                echo ('color: ' . $fcTitleColor . ';'); ?>"><?php echo $fcTitle; ?></h2>
                <?php
                endif;

                if ($fcSubTitle) :
                ?>
                <h3 class = "section-sub-title" style = "<?php echo 'color: ' . $fcSubColor . ';'; ?>"><?php echo $fcSubTitle; ?></h3>
                <?php
                endif;

                switch ($fcType) {
                    case 'text' :

                    $fcText = get_sub_field('fc_text');
                    ?>

                    <p class = "text-section">
                        <?php echo $fcText; ?>
                    </p>

                    <?php

                    break;

                    case 'stories' :

                    $args = array(
                        'post_type' => 'story',
                        'posts_per_page' => 5
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                    <div class = "story-container half owl-carousel">
                    <?php
                        while ($query->have_posts()) : $query->the_post();
                            $title = get_the_title();
                            $content = get_the_content();
                            $link = get_permalink();
                        ?>
                        <div class = "story-content">
                            <div class = "story-item item">
                                <h3 class = "story-author"><?php echo $title; ?></h3>
                                <p class = "story-text">
                                    <?php the_excerpt(); ?>
                                </p>
                                <a class = "post-item-button" title = "<?php echo $title; ?>" href = "<?php echo $link; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    endif;
                    wp_reset_postdata();

                    break;

                    case 'blog' :

                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                    <div class = "post-container half owl-carousel">
                    <?php
                        while ($query->have_posts()) : $query->the_post();
                            $title = $post->the_title;
                            $link = the_permalink();
                        ?>
                        <div class = "post-item-content">
                            <div class = "post-item item">
                                <h3 class = "post-item-title"><?php echo $title; ?></h3>
                                <p class = "post-item-text">
                                    <?php the_excerpt(); ?>
                                </p>
                                <a class = "post-item-button" title = "<?php echo $title; ?>" href = "<?php echo $link; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    endif;
                    wp_reset_postdata();

                    break;

                    default :

                    echo 'Pick a type';
                }
                ?>
            </div>

            <div class = "second-column col sm-6">
                <?php
                if ($scTitle) :
                ?>
                <h2 class = "section-title <?php if ($scSmall) { echo ' small'; }; ?>" style = "<?php
                echo ('color: ' . $scTitleColor . ';'); ?>"><?php echo $scTitle; ?></h2>
                <?php
                endif;

                if ($scSubTitle) :
                ?>
                <h3 class = "section-sub-title" style = "<?php echo 'color: ' . $scSubColor . ';'; ?>"><?php echo $scSubTitle; ?></h3>
                <?php
                endif;

                switch ($scType) {
                    case 'text' :

                    $scText = get_sub_field('fc_text');
                    ?>

                    <p class = "text-section">
                        <?php echo $scText; ?>
                    </p>

                    <?php

                    break;

                    case 'button' :

                    $scButtonText = get_sub_field('sc_button_text');
                    $scButtonLink = get_sub_field('sc_button_link');
                    $scButtonPre = get_sub_field('sc_button_pre_text');

                    if ($scButtonPre) :
                    ?>

                    <div class = "button-wrapper">
                        <div class = "button-text">
                            <?php echo $scButtonPre; ?>
                        </div>

                        <?php
                        endif;
                        ?>

                        <a target = "_blank" href = "<?php echo $scButtonLink; ?>" role = "link" class = "button-section <?php if ($scButtonPre) { echo ' pre-text'; }?>">
                            <?php echo $scButtonText; ?>
                        </a>
                    </div>

                    <?php

                    break;

                    case 'blog' :

                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                    <div class = "post-container half owl-carousel">
                    <?php
                        while ($query->have_posts()) : $query->the_post();
                            $title = get_the_title();
                            $link = get_permalink();
                            $text = get_the_excerpt();
                        ?>
                        <div class = "post-item-content">
                            <div class = "post-item item">
                                <h3 class = "post-item-title"><?php echo $title; ?></h3>
                                <p class = "post-item-text">
                                    <?php echo $text; ?>
                                </p>
                                <a class = "post-item-button" title = "<?php echo $title; ?>" href = "<?php echo $link; ?>">Read More</a>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();

                    endif;

                    break;

                    default :

                    echo 'Choose a type.';
                }
                ?>
            </div>
        <?php
        endif;

        if ($addButton) :
            $buttonText = get_sub_field('button_text');
            $buttonLink = get_sub_field('button_link');
        ?>
        <div class = "callout-button-container">
            <a target = "_blank" class = "callout-button" title = "<?php echo $buttonText; ?>" href = "<?php echo $buttonLink; ?>"><?php echo $buttonText; ?></a>
        </div>
        <?php
        endif;

        if ($divider) {
            $color = get_sub_field('divider_color');
            echo ('<hr class = "section-divider" style = "border-top-color: ' . $color . '">');
        }

        ?>

        </section>

        <?php
        if ($secCallout) :
            $callType = get_sub_field('callout_type');

            if ($callType == 'signup') :
                $callText = get_sub_field('callout_text');
        ?>
        <section class = "page-section callout-section group" style = "<?php echo 'color: ' . $conColor . ';'; ?>">
            <hr class = "callout-hr">
            <div class = "col sm-6">
                <h3 class = "callout-text"><?php echo $callText; ?></h3>
            </div><!--
            --><div class = "col sm-6">
            <!-- Begin MailChimp Signup Form -->
            <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
            <style type="text/css">
                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                   #mc_embed_signup form {
                       padding: 0;
                   }
                   #mc_embed_signup input {
                       border: none;
                        /* -webkit-border-radius: 10px; */
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                   }
                   #mc-embedded-subscribe {
                       clear: both;
                        width: auto;
                        display: block;
                        margin: 0;
                        border-radius: 0 10px 10px 0 !important;
                   }
            </style>
            <div id="mc_embed_signup" class = "">
            <form action="//scvsar.us13.list-manage.com/subscribe/post?u=e42a2aa256ed8223958f26f9c&amp;id=8e3b94c6ce" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">

            <div class="signup-container">
                <input type = "email" class = "callout-signup" name = "EMAIL" placeholder = "ENTER EMAIL..." id="mce-EMAIL">
                <input type="image" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="callout-submit" src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/submit.png">
            </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e42a2aa256ed8223958f26f9c_8e3b94c6ce" tabindex="-1" value=""></div>
                </div>
            </form>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->
            </div>
        </section>

        <?php
            endif;
        endif;
        ?>

    </div>

    <?php
            endwhile;
        endif;
    elseif (have_posts()) : the_post();
    ?>
    <div class = "page-section-wrapper">
        <section class = "page-section group">
            <h1 class = "section-title"><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </p>
        </div>
    </div>
    <?php
    else :
    ?>

    <section class = "no-posts">
        <h2>There isn't any content...yet!</h2>
    </section>

    <?php
    endif;
    ?>

</div>

<?php
if ($widget) :
?>

<aside class = "sidebar" role="complementary">
    <?php dynamic_sidebar('page-sidebar'); ?>
</aside>

<?php
endif;
?>

<? get_footer(); ?>
