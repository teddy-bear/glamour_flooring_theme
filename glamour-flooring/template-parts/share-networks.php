<?php
/**
 * The template for social links.
 */
?>

<!-- Share Links -->
<div class="share-networks clearfix">
  <span><?php _e( 'Share:' ); ?></span>
  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i
      class="fa fa-facebook"></i></a>
  <a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
  <a target="_blank"
     href="mailto:?subject=<?php the_title(); ?>&body=Hi,I want to share this page <?php the_permalink(); ?> with you."><i
      class="fa fa-envelope"></i></a>
</div>
<!-- End Share Links -->
