<?php get_header(); $tags; $link;?>

<div class = "single blog group">
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
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class = "post-content blog">
            <h4 class = "go-to-blog single"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" title = "Go To Blog">Return to the blog</a></h4>
            <div class = "page-section-wrapper article blog" title = "<?php the_title(); ?>">
                <div class = "page-section article unit">
                    <header class = "post-header">
                        <h2 class = "post-title section-title"><?php the_title(); ?></h2>
                        <h3 class = "section-sub-title up"><?php
                        if (get_post_type() == "events") {
                            $date = get_field('event_date');
                            echo $date;
                        }
                        else {
                            the_date();
                        } ?></h3>
                    </header>

                    <section class = "section-content blog">
                        <?php
                        if (has_post_thumbnail()) :
                            $id = get_post_thumbnail_id();
                            $url = wp_get_attachment_image_src($id,'full', true);
                            $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
                        ?>

                        <figure class = "post-thumbnail">
                            <img src = "<?php echo $url[0]; ?>" alt = "<?php echo $alt; ?>">
                        </figure>

                        <?php
                        endif;

                        the_content();
                        ?>

                        <div class = "tags-container">
                            <?php
                            $tags = get_the_tags();
                            if ($tags) {
                                foreach ($tags as $tag) {
                                    $tag_link = get_tag_link( $tag->term_id );
                                    echo ('<a class = "tag" href = "' . $tag_link . '" title="' . $tag->name . '">' . $tag->name . '</a>');
                                }
                            }
                            ?>
                        </div>

        <?php endwhile; endif; ?>

                        <div class = "post-pagination">
                            <?php
                            echo ('<span class = "prev">');
                            previous_post_link('%link', 'Previous' );
                            echo ('</span>');
                            echo ('<span class = "next">');
                            next_post_link( '%link', 'Next' );
                            echo ('</span>');
                            ?>
                        </div>

                        <div class = "social-sharing">

                            <a
                                id="fb-share"
                                type="icon_link"
                                onClick="window.open(
                                    'http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>',
                                    'sharer',
                                    'toolbar=0,status=0,width=580,height=325');"
                                href="javascript: void(0)"
                            ><img src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/social-media-facebook.png"></a>

                            <a
                                id = "linkedin-share"
                                type = "icon_link"
                                onclick = "window.open(
                                    'https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>',
                                    'sharer',
                                    'toolbar=0,status=0,width=520,height=570');"
                                href = "javascript: void(0)"
                            ><img src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/social-media-linkedin.png"></a>

                            <a
                                id = "twitter-share"
                                type="icon_link"
                                onClick="window.open(
                                    'https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>',
                                    'sharer',
                                    'toolbar=0,status=0,width=580,height=325');"
                                href="javascript: void(0)"
                            ><img src = "http://sr.ravennainteractive.com/wp-content/uploads/2016/10/social-media-twitter.png"></a>

                        </div>

                    </section>
                </div>
            </div>
        </article>
    </div>
</div>

<?php get_footer(); ?>
