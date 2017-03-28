<?php
/**
 * The template for displaying primary site logo on mobile
 */
?>

<div class="site-logo-mobile">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
		<img src="<?php echo logo_mobile; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"/>
	</a>
</div>