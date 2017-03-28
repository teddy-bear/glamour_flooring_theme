<?php
/**
 * The template for displaying single portfolio items.
 */
?>
<?php get_header(); ?>
<?php while ( have_posts() ) :
	the_post(); ?>

    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-8">
                <main class="main-column">
					<?php

					$image_large_width  = 926;
					$image_large_height = 617;

					$images = rwmb_meta( 'gallery', 'type=image&size=full' );
					$i      = 0;
					?>
                    <div class="portfolio-gallery owl-carousel">
						<?php
						$i = 0;
						foreach ( $images as $image ) {
							$image_url = aq_resize( $image['full_url'], $image_large_width, $image_large_height, true, true, true );
							++ $i; ?>
                            <div class='item item-<?php echo $i; ?>'>
                                <img src='<?php echo $image_url; ?>' width='<?php echo $image_large_width; ?>'
                                     height='<?php echo $image_large_height; ?>'
                                     alt='<?php echo $image['title']; ?>'/>
                            </div>
							<?php
						} ?>
                    </div>
                    <div class="post-content">
						<?php the_content(); ?>
                    </div>

                    <div class="posts-navigation">
						<?php previous_post_link( '%link', '<i class="fa fa-caret-left"></i> Previous Project' ); ?>
						<?php next_post_link( '%link', 'Next Project <i class="fa fa-caret-right"></i>' ); ?>
                    </div>

                </main>
            </div>

            <div class="col-md-4 col-lg-3">
                <div class="sidebar sidebar-right">
					<?php dynamic_sidebar( 'sidebar' ); ?>
                </div>
            </div>

        </div>
        <div class="related-portfolios">
            <h2><?php _e( 'Related projects' ); ?></h2>

			<?php
			$category = wp_get_post_terms( get_the_ID(), 'portfolio_category', array( "fields" => "names" ) );
			$name     = '';
			//var_dump( $category );
			foreach ( $category as $row ) {
				$name .= $row;
			}
			// echo $name;
			// todo: mb exclude current item.
			$args = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => 4,
				'tax_query'      => array(
					array(
						'taxonomy' => 'portfolio_category',
						'field'    => 'name',
						'terms'    => $name,
					),
				),
			);
			?>
			<?php $the_query = new WP_Query( $args ); ?>
			<?php if ( $the_query->have_posts() ) { ?>
                <div class="portfolio-blocks row">
					<?php while ( $the_query->have_posts() ) {
						$the_query->the_post();

						// Get all taxonomies attached to the post.
						$terms      = get_the_terms( get_the_ID(), 'portfolio_category' );
						$term_names = array();
						if ( $terms ) {
							foreach ( $terms as $term ) {
								$term_names[] = $term->slug;
							}
						}
						// Array to string.
						$term_names_list = join( " ", $term_names );

						// Resize featured image.
						$thumb_width    = 300;
						$thumb_height   = 200;
						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize( $url, $thumb_width, $thumb_height, true, true, true );
						?>
                        <div class="item col-sm-3 all <?php echo $term_names_list; ?>">
                            <div class="inner match">
                                <a href="<?php the_permalink() ?>">
                                    <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
                                </a>
                                <div class="post-content">
                                    <h5>
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <div class="category"><?php echo $term_names_list; ?></div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="view-photos">
                                    <i class="fa fa-camera" aria-hidden="true"></i> <?php _e( 'View Photos' ); ?>
                                </a>
                            </div>
                        </div>
					<?php } ?>
					<?php wp_reset_postdata(); ?>
                </div>
			<?php } ?>
        </div>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
