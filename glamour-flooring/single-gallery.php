<?php
/**
 * The template for displaying single gallery.
 */
?>
<?php get_header(); ?>
<div class="container">

    <main class="main-column">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			the_content();
			// End the loop.
		endwhile;
		wp_reset_postdata();
		?>
        <div class="gallery">
            <div class="row">
				<?php
				$image_width  = 608;
				$image_height = 381;
				$args         = array(
					'post_type' => 'gallery'
				);
				$items        = get_posts( $args );
				?>
				<?php
				foreach ( $items as $post ) {
					setup_postdata( $post ); ?>
					<?php
					$images = rwmb_meta( 'gallery', 'type=image&size=full' );
					$i      = 0;
					foreach ( $images as $image ) {
						$image_url = aq_resize( $image['full_url'], $image_width, $image_height, true, true, true );

						++ $i;
						$caption = $image['description'];
						?>
                        <div class='col-xs-6 item-<?php echo $i; ?>'>
                            <a href="<?php echo $image['full_url']; ?>" class="item popup"
                               title="<?php echo $image['title']; ?>">
                                <img src='<?php echo $image_url; ?>' width='<?php echo $image_width; ?>'
                                     height='<?php echo $image_height; ?>'
                                     alt='<?php echo $image['title']; ?>'/>
                                <span class="zoom-icon"><i class="fa fa-search"></i></span>
								<?php
								if ( $caption ) {
									echo '<strong >' . $image['description'] . '</strong >';
								}
								?>
                            </a>
                        </div>
						<?php
					} ?>
				<?php } ?>
				<?php wp_reset_postdata(); ?>
            </div>
        </div>
		<?php echo show_text_block( 'request-quote', false ); ?>
    </main>

</div>

<?php get_footer(); ?>
