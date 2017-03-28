<?php if ( function_exists( 'pagination' ) ) : ?>
  <?php pagination( $additional_loop->max_num_pages ); ?>
<?php else :
  // Previous/next page navigation.
  the_posts_pagination( array(
    'prev_text'          => __( 'Previous' ),
    'next_text'          => __( 'Next' ),
    'screen_reader_text' => __( ' ' )
    //'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page' ) . ' </span>',
  ) );
endif;
