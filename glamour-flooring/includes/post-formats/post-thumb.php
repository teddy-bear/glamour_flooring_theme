<?php if ( ! is_singular() ) { ?>

	<?php if ( has_post_thumbnail() ) {

		// Resize featured image.
		$thumb   = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb, 'full' );
		$image   = aq_resize( $img_url, 400, 260, true, true, true );

		?>
        <figure class="featured-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo $image ?>" alt="<?php the_title(); ?>"/>
            </a>
        </figure>
	<?php } ?>

<?php } else { ?>

	<?php if ( has_post_thumbnail() ) { ?>
        <figure class="featured-thumbnail"><?php the_post_thumbnail(); ?></figure>
	<?php } ?>

<?php } ?>

