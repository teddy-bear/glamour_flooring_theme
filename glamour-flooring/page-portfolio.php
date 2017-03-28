<?php
/**
 * Template Name: Portfolio
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
		$taxonomy = 'portfolio_category';
		$terms    = get_terms( $taxonomy );

		if ( $terms && ! is_wp_error( $terms ) ) {
			?>
            <ul class="portfolio-filter">
                <li>
                    <span class="active" data-category="all">All</span>
                </li>
				<?php foreach ( $terms as $term ) { ?>
                    <li>
                        <span data-category="<?php echo $term->slug; ?>"><?php echo $term->name; ?></span>
                    </li>
				<?php } ?>
            </ul>
		<?php } ?>
		<?php
		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => -1,
		);
		?>
		<?php $the_query = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) { ?>
            <div class="portfolio-blocks row">
				<?php while ( $the_query->have_posts() ) {
					$the_query->the_post();

					//$category = wp_get_post_terms( $the_query->post->ID, 'portfolio_category' );
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
					$thumb_width    = 400;
					$thumb_height   = 260;
					$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$url            = $attachment_url['0'];
					$image          = aq_resize( $url, $thumb_width, $thumb_height, true, true, true );
					?>
                    <div class="item col-sm-4 all <?php echo $term_names_list; ?>">
                        <div class="inner">
                            <a href="<?php the_permalink() ?>">
                                <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
                            </a>
                            <div class="post-content match">
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

    </main>

</div>

<?php get_footer(); ?>
