<?php
/**
 * The template for displaying secondary site logo.
 */
?>

<div class="site-logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo( 'name' ); ?>">
		<?php
		if ( logo_secondary ) { ?>
			<img src="<?php echo logo_secondary; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"/>
			<?php
		} else { ?>
			<img src="<?php echo logo; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"/>
			<?php
		}
		?>
	</a>
</div>