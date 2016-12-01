<?php get_header(); $widget = is_active_sidebar('blog-sidebar'); ?>

<div class = "page-container">

    <div class = "page-section-wrapper">
        <section class = "page-section group">
            <h1 class = "section-title">Search Results</h1>

        <?php
            if (have_posts()) :
        ?>
            <ul class = "search-results">
        <?php
                while (have_posts()) : the_post();
                    $link = get_permalink();
                    $title = get_the_title();
        ?>
                <li><h3><a class = "search-link" href = "<?php echo $link; ?>" title = "Go to Article"><?php echo $title; ?></a></h3></li>
            <?php
                endwhile;
            ?>
            </ul>
            <?php
            else :
        ?>

        <section class = "no-posts">
            <h3>Sorry, nothing matches those search terms. Please enter a new search term or navigate to another page using the main menu.</h3>
        </section>

        <?php
            endif;
        ?>

        </section>
    </div>

</div>

<?php get_footer(); ?>
