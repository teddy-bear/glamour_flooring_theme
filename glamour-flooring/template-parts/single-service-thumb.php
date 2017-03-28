
<?php      // Resize featured image.
      $thumb   = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb, 'full' );
      $image   = aq_resize( $img_url, 609, 397, TRUE, TRUE, TRUE );
      $image_title = rwmb_meta( 'ss-image-title');

      ?>
      <figure class="featured-thumbnail">
        
          <?php if ( $image_title ) { ?>
             <div class="image-title"><?php echo $image_title; ?></div>
          <?php } ?>
          <img src="<?php echo $image ?>" alt="<?php the_title(); ?>"/>
      </figure>
