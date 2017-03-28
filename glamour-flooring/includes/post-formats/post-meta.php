<?php
$post_meta = '';
//$post_meta = of_get_option( 'post_meta' );
?>
<?php if ( $post_meta == 'true' || $post_meta == '' ) { ?>
  <div class="post-meta">
    <time datetime="<?php the_time( 'm d,Y\TH:i' ); ?>">
      <?php the_time( 'D, m M Y H:i:s' ) ?>
    </time>
    <!--<span>in </span>-->
    <?php
    // Show categories
    /*
    $categories = get_the_category();
    if ( $categories ) {
      the_category( ', ' );
    }
    */
    ?>
    <div class="tags">
      <?php
      // Show tags
      $tags = get_the_tags();
      if ( $tags ) {
        the_tags( '<i class="fa-tags"></i>', ', ' );
      }
      ?>
    </div>
  </div>
<?php } ?>