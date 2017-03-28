<?php
/**
 * Template Name: Videos
 */
get_header(); ?>

	<div class="container">

		<main class="main-column">
			<?php
			// Show default page content.
			while ( have_posts() ) {
				the_post();
				the_content();
			}
			?>

			<?php
			// Define custom query options.
			$args = array(
				'post_type' => 'video'
			);
			query_posts( $args );

			// Initialize custom query loop.
			if ( have_posts() ) { ?>

				<div class="videos-list row">
					<?php
					while ( have_posts() ) {
						the_post();
						?>
						<div class="item col-sm-6 match">
							<div class="video">
								<?php
								echo rwmb_meta( 'oembed', 'type=oembed' );
								?>
							</div>
							<div class="entry-title">
										<h4><?php the_title(); ?></h4>
									</div>
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
						</div>
					<?php } ?>
				</div>
			<?php }
			wp_reset_postdata();
			?>

		</main>

	</div>

	</div>

<?php get_footer(); ?>