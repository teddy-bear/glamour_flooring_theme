<?php
/**
 * The template for displaying single pest.
 */
?>
<?php get_header(); ?>
<div class="container">

	<main class="main-column">

		<?php
		while ( have_posts() ) {
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-title">
					<h2><?php the_title(); ?></h2>
				</header>
				<section class="entry-content">
					<div class="content">
						<?php the_content(); ?>
					</div>
				</section>
			</article>

		<?php } ?>

	</main>

</div>

<?php get_footer(); ?>
