<?php get_header(); ?>

	<div class="container">
		<main class="main-column">

			<div class="search-title">
				<h2><?php _e( 'Search for:', 'theme' ); ?> "<?php the_search_query(); ?>"</h2>
			</div>


			<div class="search-list">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-holder' ); ?>>

							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>

							<?php
							if ( has_post_thumbnail() ) {
								get_template_part( 'includes/post-formats/post-thumb' );
							}
							?>
							<div class="post-content">
								<div class="excerpt">
									<?php
									$content = get_the_content();
									$excerpt = get_the_excerpt();
									if ( has_excerpt() ) {
										echo trim_string_length( $excerpt, 75 );
									} else {
										if ( ! is_search() ) {
											echo trim_string_length( $content, 55 );
										} else {
											echo trim_string_length( $excerpt, 50 );
										}
									}
									?> ...
								</div>
								<span class="back_to_top"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Back to top</span>
							</div>
						</article>

					<?php }
				} else {
					?>
					<div class="no-results">
						<?php echo '<p><strong>' . __( 'There has been an error.', 'theme' ) . '</strong></p>'; ?>
						<p><?php _e( 'We apologize for any inconvenience, please', 'theme' ); ?> <a
								href="<?php echo esc_url( home_url() ); ?>/"
								title="<?php bloginfo( 'description' ); ?>"><?php _e( 'return to the home page', 'theme' ); ?></a> <?php _e( 'or use the search form below.', 'theme' ); ?>
						</p>
						<?php
						/* outputs the default search form */
						get_search_form();
						?>
					</div>
				<?php } ?>
			</div>
			<?php get_template_part( 'includes/post-formats/post-nav' ); ?>

		</main>
	</div>

<?php get_footer(); ?>