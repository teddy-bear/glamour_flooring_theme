<?php
/**
 House Plans
 */

get_header(); ?>

<div class="container">

    <main class="main-column">
		<?php
		// Show default page content.
		while ( have_posts() ) {
			the_post();
			the_content();
		}
		?>
		<?php
		// Categories tabs filtering.
		$taxonomy = 'house_plans_category';
		$terms    = get_terms( $taxonomy );

		if ( $terms && ! is_wp_error( $terms ) ) {
			?>
            <ul class="house-plans-filter">
				<?php foreach ( $terms as $term ) { ?>
                    <li>
                        <span data-category="<?php echo $term->slug; ?>"><?php echo $term->name; ?></span>
                    </li>
				<?php } ?>
                <li>
                    <span class="active" data-category="all">show all</span>
                </li>
            </ul>
		<?php } ?>
		<?php
		$args = array(
			'post_type'      => 'house_plans',
			'posts_per_page' => - 1
		);
		?>
		<?php $the_query = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) { ?>
            <div class="house-plans-blocks row">
				<?php while ( $the_query->have_posts() ) {
					$the_query->the_post();

					$bedrooms    = rwmb_meta( 'bedrooms' );
					$bathrooms   = rwmb_meta( 'bathrooms' );
					$square_feet = rwmb_meta( 'square_feet' );
					$stories     = rwmb_meta( 'stories' );

					//$category = wp_get_post_terms( $the_query->post->ID, 'house_plans_category' );
					// Get all taxonomies attached to the post.
					$terms      = get_the_terms( get_the_ID(), 'house_plans_category' );
					$term_names = array();
					if ( $terms ) {
						foreach ( $terms as $term ) {
							$term_names[] = $term->slug;
						}
					}

					$term_names_list = join( " ", $term_names );

					// Resize featured image.
					$thumb_width    = 286;
					$thumb_height   = 191;
					$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$url            = $attachment_url['0'];
					$image          = aq_resize( $url, $thumb_width, $thumb_height, true, true, true );
					?>
                    <div class="item col-sm-3 all <?php echo $term_names_list; ?>">
                        <div class="inner match">
                            <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
                            <div class="post-content">
								<?php the_title( '<h4>', '</h4>' ); ?>
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
                                <a href="<?php the_permalink(); ?>" class="btn green">
									<?php _e( 'View details' ); ?>
                                </a>
                                <a href="<?php echo home_url( '/request-instant-quote/?house_plan=' . get_the_title() ); ?>"
                                   class="btn"><?php _e( 'Request more information' ); ?></a>
                                </a>
                            </div>
                        </div>
                    </div>
				<?php } ?>
				<?php wp_reset_postdata(); ?>
            </div>
		<?php } ?>

    </main>

</div>

<?php get_footer(); ?>
