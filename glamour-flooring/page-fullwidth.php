<?php
/**
 * Template Name: Fullwidth
 */
get_header(); ?>

    <main class="main-column">
        <div class="container">
            <?php
            // Show default page content.
            while (have_posts()) {
                the_post();
                the_content();
            }
            ?>
        </div>
    </main>

<?php get_footer(); ?>