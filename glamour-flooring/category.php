<?php
/**
 * The template for displaying posts from a category.
 */
?>
<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <main class="main-column">

                    <section class="page-description category-info">
                        <!--<h2><?php /*echo single_cat_title(); */ ?></h2>-->
                    </section>

                    <div class="posts-list">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								get_template_part( 'includes/post-formats/standard' );


							}
						} else { ?>

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
                </main>

				<?php get_template_part( 'includes/post-formats/post-nav' ); ?>

            </div>

            <div class="col-md-4 col-lg-3">
                <div class="sidebar sidebar-right">
					<?php dynamic_sidebar( 'sidebar' ); ?>
                </div>
            </div>

        </div>
    </div>

<?php get_footer(); ?>