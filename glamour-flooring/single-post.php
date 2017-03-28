<?php
/**
 * The template for displaying all single posts and attachments
 */
?>
<?php get_header(); ?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <main class="main-column">
				<?php while ( have_posts() ) {
					the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-title">
                            <h4><?php the_title(); ?></h4>
                            <div class="custom-info">
								<?php //get_template_part( 'includes/post-formats/post-meta' ); ?>
								<?php //get_template_part( 'template-parts/share-networks' ); ?>
                            </div>
                        </header>
                        <section class="entry-content">
							<?php get_template_part( 'includes/post-formats/post-thumb' ); ?>
                            <div class="content">
								<?php the_content(); ?>
                            </div>
                        </section>

                    </article>
					<?php
					// Previous/next post navigation.
					?>
                    <div class="posts-navigation">
						<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> Previous post' ); ?>
						<?php next_post_link( '%link', 'Next post <i class="fa fa-angle-right"></i>' ); ?>
                    </div>


				<?php } ?>
            </main>
        </div>

        <div class="col-md-4">
            <div class="sidebar sidebar-right">
				<?php dynamic_sidebar( 'sidebar' ); ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
