<?php get_header(); $widget = is_active_sidebar('blog-sidebar'); ?>

<div class = "archive blog group">

    <div class = "sidebar-wrapper col sm-3 xs-12">
        <aside class = "sidebar blog">
            <header class = "archive-header">
                <h1 class = "sidebar-title"><span class = "block">SCVSAR</span> <?php

                if ($title) {
                    echo $title;
                }
                else {
                    echo ('Blog');
                }

                ?></h1>
                <h3 class = "sidebar-sub-title">So that others may live</h3>
            </header>

            <span class = "sort-title">Sort By:</span>

            <ul class = "filters-list blog">
                <li class = "filter"><span role = "button" class = "title">Month</span><ul class = "archives-list"><?php wp_get_archives(); ?></ul></li>
                <li class = "filter"><span role = "button" class = "title">Subject</span><ul class = "tags-list"><?php
                    $tags = get_tags();
                    foreach ($tags as $tag) {
                        $tag_link = get_tag_link( $tag->term_id );
                        echo ('<li><a href = "' . $tag_link . '" title="' . $tag->name . '">' . $tag->name . '</a></li>');
                    }
                    ?></ul></li>
                <li class = "filter"><span role = "button" class = "title">Category</span><ul class = "categories-list"><?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        $category_link = get_tag_link( $category->term_id );
                        echo ('<li><a href = "' . $category_link . '" title="' . $category->name . '">' . $category->name . '</a></li>');
                    }
                    ?></ul></li>
            </ul>

        </aside>
    </div>

    <div class = "article-wrapper col sm-9 xs-12">
        <section class = "post-content archive">

        <?php
        if (is_tag()) {
            $title = single_cat_title('', false);
            echo ('<h1 class = "archive-title">Subject: ' . $title . '</h1>');
            echo ('<h4 class = "go-to-blog"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title = "Go To Blog">Return to the blog</a></h4>');
        }
        else if (is_date()) {
            $title = single_month_title('' . ' ', false);
            echo ('<h1 class = "archive-title">' . $title . '</h1>');
            echo ('<h4 class = "go-to-blog"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title = "Go To Blog">Return to the blog</a></h4>');
        }
        else if (is_archive()) {
            $title = single_cat_title('', false);
            echo ('<h1 class = "archive-title">Category: ' . $title . '</h1>');
            echo ('<h4 class = "go-to-blog"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '" title = "Go To Blog">Return to the blog</a></h4>');
        }

        if (have_posts()) :
            while (have_posts()) : the_post();

                get_template_part('template-parts/post-excerpt');

            endwhile;
        else :
        ?>

        <section class = "no-posts">
            <h2>Sorry, there were no posts found.</h2>
        </section>

        <?php
        endif;
        ?>

        </section>
    </div>

</div>

<?php
if ($widget) :
?>

<aside class = "sidebar" role="complementary">
    <?php dynamic_sidebar('blog-sidebar'); ?>
</aside>

<?php
endif;
?>

<?php get_footer(); ?>
