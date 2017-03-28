<?php
/**
 * The template for displaying single house plan post type
 */
?>
<?php get_header(); ?>
<?php while ( have_posts() ) :
	the_post(); ?>

    <div class="container">
        <main class="main-column">

            <div class="row">

                <div class="col-sm-7">
					<?php

					$bedrooms    = rwmb_meta( 'bedrooms' );
					$bathrooms   = rwmb_meta( 'bathrooms' );
					$square_feet = rwmb_meta( 'square_feet' );
					$stories     = rwmb_meta( 'stories' );
					$width       = rwmb_meta( 'width' );
					$depth       = rwmb_meta( 'depth' );
					$pdf_link    = rwmb_meta( 'pdf_link', 'type=file' );

					$image_large_width  = 718;
					$image_large_height = 480;

					$images = rwmb_meta( 'house_plans_gallery', 'type=image&size=full' );
					$i      = 0;
					?>
                    <div class="house-plans-gallery owl-carousel">
						<?php
						$i = 0;
						foreach ( $images as $image ) {
							$image_url = aq_resize( $image['full_url'], $image_large_width, $image_large_height, true );
							++ $i; ?>
                            <div class='item item-<?php echo $i; ?>'>
                                <img src='<?php echo $image_url; ?>' width='<?php echo $image_large_width; ?>'
                                     height='<?php echo $image_large_height; ?>'
                                     alt='<?php echo $image['title']; ?>'/>
                            </div>
							<?php
						} ?>
                    </div>
                    <div class="btn-group">
						<?php
						if ( ! empty( $pdf_link ) ) {
							foreach ( $pdf_link as $file ) {
								echo "<a href='{$file['url']}' title='{$file['title']}' class='btn green' target='_blank'>Download Brochure</a>";
							}
						}
						?>
                        <a href="<?php echo home_url( '/request-instant-quote/?house_plan=' . get_the_title() ); ?>"
                           class="btn"><?php _e( 'Request more information' ); ?></a>
                    </div>
                </div>

                <div class="col-sm-4 col-sm-push-1">
                    <div class="post-content">
						<?php if ( $bedrooms || $bathrooms || $square_feet || $stories ) { ?>
                            <h4>Specs</h4>
                            <div class="custom-info">
								<?php if ( $bedrooms ) { ?>
                                    <div><strong>PresidaBedrooms: </strong><?php echo $bedrooms; ?></div>
								<?php } ?>
								<?php if ( $bathrooms ) { ?>
                                    <div><strong>Bathrooms: </strong><?php echo $bathrooms; ?></div>
								<?php } ?>
								<?php if ( $square_feet ) { ?>
                                    <div><strong>Approx SQFT: </strong><?php echo $square_feet; ?></div>
								<?php } ?>
								<?php if ( $stories ) { ?>
                                    <div><strong>Stories: </strong><?php echo $stories; ?></div>
								<?php } ?>
                            </div>
						<?php } ?>
                        <div class="entry-content">
							<?php the_content(); ?>
                        </div>
						<?php if ( $width || $depth ) { ?>
                            <h4>Overall Home Dimensions</h4>
                            <div class="custom-info">
								<?php if ( $width ) { ?>
                                    <div><strong>Width: </strong><?php echo $width; ?></div>
								<?php } ?>
								<?php if ( $depth ) { ?>
                                    <div><strong>Depth: </strong><?php echo $depth; ?></div>
								<?php } ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>

			<?php
			// Floor plans image section.
			$images            = rwmb_meta( 'floor_plans', 'type=image&size=full' );
			$i                 = 0;
			$floor_plan_width  = 393;
			$floor_plan_height = 246;
			if ( $images ) {
				?>
                <div class="image-plans gallery-blocks" id="floor-plans">
                    <h4><?php _e( 'Floor plans' ); ?></h4>
                    <div class="images row wow fadeIn">
						<?php

						foreach ( $images as $image ) {
							$image_url = aq_resize( $image['full_url'], $floor_plan_width, $floor_plan_height, true, true, true );

							++ $i; ?>
                            <div class='col-sm-4 item item-<?php echo $i; ?>'>
                                <a href="<?php echo $image['full_url']; ?>" data-rel="gallery"
                                   title="<?php echo $image['title']; ?>">
                                    <img src='<?php echo $image_url; ?>' width='<?php echo $floor_plan_width; ?>'
                                         height='<?php echo $floor_plan_height; ?>'
                                         alt='<?php echo $image['title']; ?>'/>
                                </a>
                                <!--<strong><?php /*echo $image['title']; */ ?></strong>-->
                            </div>
						<?php } ?>
                    </div>
                </div>
			<?php } ?>

			<?php
			// Elevations image section.
			$images            = rwmb_meta( 'elevations', 'type=image&size=full' );
			$i                 = 0;
			$floor_plan_width  = 393;
			$floor_plan_height = 246;
			if ( $images ) {
				?>
                <div class="image-plans gallery-blocks" id="elevations-plans">
                    <h4><?php _e( 'Elevations' ); ?></h4>
                    <div class="images row wow fadeIn">

						<?php
						foreach ( $images as $image ) {
							$image_url = aq_resize( $image['full_url'], $floor_plan_width, $floor_plan_height, true, true, true );

							++ $i; ?>
                            <div class='col-sm-4 item item-<?php echo $i; ?>'>
                                <a href="<?php echo $image['full_url']; ?>" data-rel="gallery"
                                   title="<?php echo $image['title']; ?>">
                                    <img src='<?php echo $image_url; ?>' width='<?php echo $floor_plan_width; ?>'
                                         height='<?php echo $floor_plan_height; ?>'
                                         alt='<?php echo $image['title']; ?>'/>
                                </a>
                                <!--<strong><?php /*echo $image['title']; */ ?></strong>-->
                            </div>
						<?php } ?>
                    </div>
                </div>
			<?php } ?>

			<?php echo show_text_block( 'request-quote', false ); ?>
        </main>
    </div>


<?php endwhile; ?>

<?php get_footer(); ?>
