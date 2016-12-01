<?php get_header(); $label = get_field('horizontal_view_label');?>

<div class = "single unit group">
    <div class = "sidebar-wrapper col sm-3 xs-12">
        <aside class = "sidebar unit">
            <div class = "archive-header">
                <h1 class = "sidebar-title"><span class = "block">SCVSAR</span> <?php echo $label; ?> Unit</h1>
                <h3 class = "sidebar-sub-title">So that others may live</h3>
            </div>
            <?php
            if (have_rows('sections')) :
            ?>
            <ul class = "filters-list unit">
                <?php
                while(have_rows('sections')) : the_row();
                    $li = get_sub_field('section_title');
                    $link = preg_replace("/[^\w]+/", "-", $li);
                ?>
                <li><a href = "#<?php echo strtolower($link); ?>" title = "<?php echo $li; ?>"><?php echo $li; ?></a></li>
                <?php
                endwhile;
                ?>
            </ul>
            <?php
            endif;
            ?>
        </aside>
    </div>

    <div class = "article-wrapper col sm-9 xs-12">
        <article class = "post-content unit">
            <?php
            if (have_rows('sections')) :
                $count = 0;
                while (have_rows('sections')) : the_row();
                $count++;
                $title = get_sub_field('section_title');
                $anchor = preg_replace("/[^\w]+/", "-", $title);
                $sub = get_sub_field('section_subtitle');
                $content = get_sub_field('section_content');
            ?>
            <div class = "page-section-wrapper article unit" title = "<?php echo $title; ?>" id = "<?php echo strtolower($anchor); ?>">
                <div class = "page-section article unit">
                    <?php
                    if ($count == 1) {
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
                    }
                    ?>

                    <h2 class = "section-title"><?php echo $title; ?></h2>
                    <?php if ($sub) { ?><h3 class = "section-sub-title"><?php echo $sub; ?></h3><?php } ?>
                    <div class = "section-content unit">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <?php
            endwhile;
        endif;
            ?>
        </article>
    </div>
</div>

<?php get_footer(); ?>
