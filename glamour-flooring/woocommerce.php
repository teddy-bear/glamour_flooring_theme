<?php
/**
 * The template for displaying WooCommerce pages.
 *
 */

get_header(); ?>
<div class="container">
	<main class="main-column">
		<?php woocommerce_content(); ?>
	</main>
</div>

<?php get_footer(); ?>
