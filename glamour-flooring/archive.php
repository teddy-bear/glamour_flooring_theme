<?php
/**
 * The template for displaying archive pages
 * default taxonomy page layout.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>
<div class="container">
    <div class="row">

        <div class="col-md-8 col-lg-9">
            <main class="main-column">
                <div class="posts-list">
					<?php //get_template_part( 'template-parts/page-title' ); ?>
					<?php

					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'includes/post-formats/standard' );
					endwhile;
					else:
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
