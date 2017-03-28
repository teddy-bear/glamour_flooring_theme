<?php
/**
 * The template for displaying single vacancy post type
 */
?>
<?php get_header(); ?>
  <div class="container">
    <div class="row">

      <div class="col-md-8">
        <?php
        while (have_posts()) {
        the_post(); ?>
        <main class="main-column">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php $terms_office = wp_get_post_terms(get_the_ID(), 'vacancy-office'); ?>
            <?php
            $salary_range = rwmb_meta('salary_range');
            $job_location = rwmb_meta('job_location');
            $job_type     = rwmb_meta('job_type');
            $job_hours    = rwmb_meta('job_hours');
            ?>
            <div class="entry-title">
              <h2><?php the_title(); ?></h2>
            </div>
            <div class="entry-content">

              <div class="custom-info">
                <?php if ($terms_office) { ?>
                  <div><strong>Office</strong><?php echo $terms_office[0]->name; ?></div>
                <?php } ?>

                <?php if ($job_location) { ?>
                  <div><strong>Job location</strong><?php echo rwmb_meta('job_location'); ?></div>
                <?php } ?>

                <?php if ($job_type) { ?>
                  <div><strong>Job type</strong><?php echo rwmb_meta('job_type'); ?></div>
                <?php } ?>


                <?php if ($salary_range) { ?>
                  <div><strong>Salary range</strong><?php echo rwmb_meta('salary_range'); ?></div>
                <?php } ?>
              </div>

              <div class="content">
                <strong>Job Description</strong>:
                <?php the_content(); ?>
              </div>
              <a
                href="<?php echo esc_url(home_url('/employers/?office=' . $terms_office[0]->name . '&vacancy_id=' . get_the_ID())) ?>"
                class="btn">
                <?php _e('Apply now'); ?>
              </a>
            </div>

            <a class="details" href="<?php echo esc_url(home_url('/looking-for-work')); ?>">Go Back to Job
              Listings</a>

          </article>
        </main>
      </div>
      <?php } ?>

      <div class="col-md-4">
        <div class="sidebar">
          <?php dynamic_sidebar('sidebar'); ?>
        </div>
      </div>

    </div>
  </div>
<?php get_footer(); ?>