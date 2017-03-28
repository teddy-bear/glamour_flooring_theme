<?php
/**
 * The template for displaying services category items.
 */

get_header(); ?>

<div class="container">
	<main class="main-column">

		<?php
		if ( have_posts() ) { ?>

			<div class="services-list">
				<?php
				while ( have_posts() ) {
					the_post();

					// Get Category.
					//$category = wp_get_post_terms( $post->ID, 'service_category' );
					//$terms    = get_the_terms( get_the_ID(), 'service_category' );

					// Add image size.
					//add_image_size( 'project-image', 298, 224, TRUE );
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<!--<figure class="featured-thumbnail">
							<?php /*the_post_thumbnail( 'project-image' ); */ ?>
						</figure>-->
						<div class="wrap-info">
							<h3 class="title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							<section class="entry-content">
								<?php the_content(); ?>
							</section>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"
							   class="more"><?php _e( 'read more' ); ?>
							</a>
						</div>

					</article>
				<?php } ?>
			</div>
		<?php } ?>

		<?php get_template_part( 'includes/post-formats/post-nav' ); ?>

	</main>
</div>

<?php get_footer(); ?>
