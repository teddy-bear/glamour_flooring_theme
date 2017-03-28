<?php
/**
 * Home page template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 */

get_header(); ?>

<main class="main-column">
	<?php
	// Show default page content.
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	?>

</main>

<?php get_footer(); ?>
