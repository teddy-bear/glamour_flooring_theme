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
        if (have_posts()) {
          $i = 0; ?>
          <div class="view-options">
            <div class="display-mode">
              <strong>Display</strong>
              <span class="block-view active"></span>
              <span class="list-view"></span>
            </div>
          </div>
          <div class="vacancies-blocks row">
            <?php
            while (have_posts()) {
              the_post();
              $i++;
              $job_location = rwmb_meta('job_location');
              ?>
              <div <?php post_class('item col-sm-4'); ?>>
                <div class="inner">
                  <div class="wrapper">
                    <div class="title">
                      <h4><?php the_title(); ?></h4>
                      <span class="job-location"><i class="fa fa-map-marker"
                                                    aria-hidden="true"></i> <?php echo $job_location; ?></span>
                    </div>
                    <div class="post-content">
                      <div
                        class="content"><?php echo trim_string_length(get_the_content(), 20); ?></div>
                    </div>
                  </div>
                  <div class="bottom-info">
                    <span class="job-location"><i class="fa fa-map-marker"
                                                  aria-hidden="true"></i> <?php echo $job_location; ?></span>
                    <span
                      class="id"><strong>ID:</strong> <?php the_ID(); ?></span>
                    <a href="<?php the_permalink(); ?>" class="btn"
                       title="<?php the_title(); ?>">read more</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php }
        else { ?>
          <?php _e('No vacancies available yet.'); ?>
        <?php } ?>

        <?php get_template_part('includes/post-formats/post-nav'); ?>

      </main>
    </div>

    <div class="col-sm-4">
      <div class="sidebar">
        <div class="office-details">
          <h4>Office Details</h4>
          <?php
          echo term_description(get_queried_object()->term_id, 'vacancy-office')
          ?>
        </div>
        <?php get_template_part('template-parts/offices-tree-short'); ?>
        <?php
        // todo: mb add categoires listing in the sidebar
        ?>
        <?php //dynamic_sidebar('sidebar-vacancies'); ?>
      </div>
    </div>

  </div>

</div>
<!-- .content-area -->

<?php get_footer(); ?>
