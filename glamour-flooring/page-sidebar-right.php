<?php
/**
 * Template Name: Sidebar right
 *
 */

get_header(); ?>

<div class="container">
    <div class="row">

        <div class="col-md-8 col-lg-9">
            <main class="main-column">
				<?php
				// Show default page content.
				while ( have_posts() ) {
					the_post();
					the_content();
				}
				?>
            </main>
        </div>

        <div class="col-md-4 col-lg-3 no-padding-mobile">
            <div class="sidebar sidebar-right">
				<?php dynamic_sidebar( 'sidebar' ); ?>
            </div>
        </div>

    </div>
	<?php //echo show_text_block( 'request-quote', false ); ?>
</div>
<?php get_footer(); ?>
