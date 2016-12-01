<article id = "post-<?php the_ID(); ?>" title = "<?php the_title(); ?>" class = "page-section-wrapper article archive">
    <div class = "page-section article archive">
        <header class = "post-header">
            <h2 class = "post-title section-title"><a href = "<?php the_permalink(); ?>" title = "Go to post"><?php the_title(); ?></a></h2>
            <h3 class = "section-sub-title up"><?php
            if (get_post_type() == "events") {
                $date = get_field('event_date');
                echo $date;
            }
            else {
                the_date();
            } ?></h3>
        </header>

        <section class = "section-content archive">
            <?php
            if (has_post_thumbnail()) :
                $id = get_post_thumbnail_id();
                $url = wp_get_attachment_image_src($id,'full', true);
                $alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
            ?>

            <figure class = "post-thumbnail">
                <a href = "<?php the_permalink(); ?>">
                    <img src = "<?php echo $url[0]; ?>" alt = "<?php echo $alt; ?>">
                </a>
            </figure>

            <?php
            endif;

            the_excerpt();
            ?>

            <a class = "post-button" title = "Go to post" role = "button" href = "<?php the_permalink(); ?>">Read More</a>

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
</article>
