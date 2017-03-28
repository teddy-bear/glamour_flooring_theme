<?php
/**
 * Template Name: Blog
 */
get_header(); ?>

	<div class="container">
		<div class="row">

			<div class="col-md-9">
				<main class="main-column">
					<?php
					// Get page content
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
						}
						the_content();
					}
					?>
					<div class="posts-list">
						<?php
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						query_posts( array( 'post_type' => 'post', 'posts_per_page' => 6, 'paged' => $paged ) );
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							get_template_part( 'includes/post-formats/standard' );
						endwhile;
						else:
							?>
							<div class="no-results">
								<?php echo '<p><strong>' . __( 'There has been an error.', 'theme' ) . '</strong></p>'; ?>
								<p>
									<?php _e( 'We apologize for any inconvenience, please', 'theme' ); ?>
									<a href="<?php bloginfo( 'url' ); ?>/"
									   title="<?php bloginfo( 'description' ); ?>"><?php _e( 'return to the home page', 'theme' ); ?></a>
									<?php _e( 'or use the search form below.', 'theme' ); ?>
								</p>
								<?php
								/* outputs the default search form */
								get_search_form();
								?>
							</div>

						<?php endif; ?>

					</div>

					<?php get_template_part( 'includes/post-formats/post-nav' ); ?>
				</main>
			</div>

            <div class="col-md-4 col-lg-3">
                <div class="sidebar sidebar-right">
					<?php dynamic_sidebar( 'sidebar' ); ?>
                </div>
            </div>

		</div>
	</div>
<?php get_footer(); ?>