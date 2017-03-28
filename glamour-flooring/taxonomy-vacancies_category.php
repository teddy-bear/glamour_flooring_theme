<?php
/**
 * The template for displaying vacancy category items.
 */

get_header(); ?>

<div class="container row-content">
  <div class="row">
    <div class="col-sm-8">
      <main class="main-column">

        <?php
        if ( have_posts() ) { ?>

          <div class="vacancies-list">
            <?php
            while ( have_posts() ) {
              the_post();

              // Get post meta boxes values.
              $post_meta_data = get_post_custom( $post->ID );
              // Location field
              $location = $post_meta_data['location'][0];

              // Get Category
              $category = wp_get_post_terms( $post->ID, 'vacancies_category' );
              ?>
              <div class="item">
                <h3>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>

                <div class="description">
                  <?php the_excerpt(); ?>
                </div>
                <div class="vacancy-info">
                  <?php if ( $location ) { ?>
                    <span class="location">
                    <i class="fa fa-map-marker"></i>
                      <?php echo $location; ?>
                  </span>
                  <?php } ?>

                  <?php if ( rwmb_meta( 'status' ) ) { ?>
                    <span class="status">
                    <i class="fa fa-globe"></i>
                      <?php echo rwmb_meta( 'status' ); ?>
                  </span>
                  <?php } ?>

                  <div class="btn-group">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="btn">
                      <?php _e( 'View details' ); ?>
                    </a>
                    <a href="apply-now/?title=<?php the_title(); ?>" class="btn">
                      <?php _e( 'Apply now' ); ?>
                    </a>
                  </div>
                </div>

              </div>
            <?php } ?>
          </div>
        <?php } else { ?>
          <?php _e( 'No vacancies available yet.' ); ?>
        <?php } ?>

        <?php get_template_part( 'includes/post-formats/post-nav' ); ?>

      </main>
    </div>

    <div class="col-sm-4">
      <div class="sidebar sidebar-right">
        <?php
        // todo: mb add categoires listing in the sidebar
        ?>
        <?php dynamic_sidebar( 'sidebar-right' ) ?>
      </div>
    </div>

  </div>

</div>
<!-- .content-area -->

<?php get_footer(); ?>
