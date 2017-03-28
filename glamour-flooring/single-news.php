<?php
/**
 * Single news item.
 */
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-9">
            <main class="main-column">

                <?php
                while (have_posts()) {
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-title">
                            <h2><?php the_title(); ?></h2>
                            <div class="meta">
                                <?php echo '<span class="months">' . get_the_time('M') . '</span> <span class="day">' . get_the_time('d') . '</span>, <span class="year">' . get_the_time('Y') . '</span>'; ?>
                            </div>
                        </header>
                        <section class="entry-content">
                            <figure class="featured-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </figure>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </section>
                    </article>

                <?php } ?>

            </main>
        </div>
        <div class="col-sm-4 col-md-3">
            <div class="sidebar sidebar-news">
                <?php dynamic_sidebar('sidebar-news'); ?>
                <?php

                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
