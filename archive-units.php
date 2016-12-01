<?php get_header(); ?>
<?php
$unitsTitle = get_field('units_title', 'options');
$unitsSub = get_field('units_subtitle', 'options');
$soTitle = get_field('special_operations_title', 'options');
$soSub = get_field('special_operations_subtitle', 'options');
?>

<div class = "archive unit">
    <div class = "page-section-wrapper" title = "Content Section">
        <section class = "page-section group">
            <div class = "col ss-12">
                <h1 class = "section-title"><?php echo $unitsTitle; ?></h1>
                <h3 class = "section-sub-title" style = "margin-top:-1em;"><?php echo $unitsSub; ?></h3>
                <?php
                $args = array(
                    'post_type' => 'units',
                    'order' => 'ASC',
                    'orderby' => 'name',
                    'post_parent' => 0
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    ?>
                <div class = "icons-wrapper">
                    <?php
                    while ($query->have_posts()) : $query->the_post();
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
                ?>
            </div>
            <hr class = "section-divider">
        </section>

        <section class = "page-section group">
            <div class = "col ss-12">
                <h1 class = "section-title"><?php echo $soTitle; ?></h1>
                <h3 class = "section-sub-title" style = "margin-top:-1em;"><?php echo $soSub; ?></h3>
                <?php
                $args = array(
                    'post_type' => 'special_operations',
                    'order' => 'ASC',
                    'orderby' => 'name'
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    ?>
                <div class = "icons-wrapper">
                    <?php
                    while ($query->have_posts()) : $query->the_post();
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
                ?>
            </div>
        </section>
    </div>
</div>
<?php get_footer(); ?>
