<?php
/**
 * Get an array of tags assigned to current post
 * Reference : http://codex.wordpress.org/Function_Reference/wp_get_post_tags
 */
$tags = wp_get_post_tags( $post->ID );

if ( $tags ) {

  $tag_ids = array();

  foreach ( $tags as $individual_tag ) {
    $tag_ids[] = $individual_tag->term_id;
  }
  $args = array(
    'tag__in'             => $tag_ids,
    'post__not_in'        => array( $post->ID ),
    'showposts'           => 4, // these are the number of related posts we want to display
    'caller_get_posts'    => 1,
    'ignore_sticky_posts' => 1 // to exclude the sticky post
  );

  // WP_Query takes the same arguments as query_posts
  $related_query = new WP_Query( $args );

  if ( $related_query->have_posts() ) {
    ?>

    <?php
    $blog_related = FALSE;
    //$blog_related = of_get_option( 'blog_related' );
    ?>
    <?php if ( $blog_related ) { ?>
      <h3><?php echo of_get_option( 'blog_related' ); ?></h3>
    <?php } else { ?>
      <h3><?php _e( 'Related Posts', 'theme' ); ?></h3>
    <?php } ?>

    <div class="row">
      <ul class="related-posts">

        <?php
        while ( $related_query->have_posts() ) : $related_query->the_post();
          ?>
          <li class="col-sm-3">
            <?php if ( has_post_thumbnail() ) { ?>
              <?php
              $thumb   = get_post_thumbnail_id();
              $img_url = wp_get_attachment_url( $thumb, 'full' ); //get img URL
              $image   = aq_resize( $img_url, 195, 140, TRUE ); //resize & crop img
              ?>
              <figure class="featured-thumbnail">
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                  <img src="<?php echo $image ?>" alt="<?php the_title(); ?>"/>
                </a>
              </figure>
            <?php } ?>

            <h6 class="relatedPost"><a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h6>
          </li>
          <?php
        endwhile;
        ?>

      </ul>
    </div>

  <?php }
  /**
   * Reset the loop
   * http://codex.wordpress.org/Function_Reference/wp_reset_query
   */
  wp_reset_query();
}
?>