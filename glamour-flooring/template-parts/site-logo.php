<?php
/**
 * The template for displaying primary site logo.
 */
?>

<div class="site-logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
		<img src="<?php echo logo; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"/>
	</a>
</div>