<?php
/**
 Programs filtering
 * @link https://convertintowordpress.com/wordpress-multiple-taxonomy-filter-ajax/
 */

get_header(); ?>

<script>
  // This function will be called on click event.
  jQuery(document).ready(function () {

    //initialize all the variables to be used as an empty array.
    jQuery('.all_prod').html("");
    var destination = [];
    var terms = [];
    var style = [];
    var fit = [];
    var term_id = jQuery('#cat_id').text();

    //loop through all the separated filter's checked check boxes, take the taxonomy id and push it into empty array
    jQuery(".destination-filter input:checked").each(function () {
      var destination_id = jQuery(this).attr('name');
      destination.push(destination_id);
    });

    jQuery(".terms-filter input:checked").each(function () {
      var terms_id = jQuery(this).attr('name');
      terms.push(terms_id);
    });
    jQuery(".style_filter input:checked").each(function () {
      var style_id = jQuery(this).attr('name');
      style.push(style_id);
    });
    jQuery(".fit_filter input:checked").each(function () {
      var fit_id = jQuery(this).attr('name');
      fit.push(fit_id);
    });

    //collect all the data.
    var data = {
      'filter': 1,
      'term_id': term_id,
      'terms': terms,
      'destination': destination
    };
    //Ajax url
    var url = "http://localhost/african-students/programs/";

    jQuery.post(url, data, function (data) {
      //jQuery('.all_prod').append(data);
    });
  })
</script>

<div class="container">

  <main class="main-column">
    <?php
    // Show default page content.
    while (have_posts()) {
      the_post();
      the_content();
    }
    ?>

    <?php
    $program_destination  = array(
      'taxonomy' => 'program_destination',
    );
    $program_destinations = get_categories($program_destination);
    ?>
    <div class="destination-filter">
      <!--loop through the style and show it in a checkbox -->
      <?php foreach ($program_destinations as $item) { ?>
        <label>
          <input name="<?php echo $item->term_id; ?>" type="checkbox"><?php echo $item->cat_name; ?>
        </label>
      <?php } ?>
    </div>

    <?php
    $program_term  = array(
      'taxonomy' => 'program_term',
    );
    $program_terms = get_categories($program_term);
    ?>
    <div class="terms-filter">
      <!--loop through the style and show it in a checkbox -->
      <?php foreach ($program_terms as $item) { ?>
        <label>
          <input name="<?php echo $item->term_id; ?>" type="checkbox"><?php echo $item->cat_name; ?>
        </label>
      <?php } ?>
    </div>

    <?php if (isset($_POST['filter'])) { ?>
      <?php
      $destination    = array();
      $type     = array();
      $style    = array();
      $fit      = array();
      $cat_term = $_POST['term_id'];

      $destination_arg = array(
        'taxonomy'     => 'program_destination',
        'child_of'     => 0,
        'parent'       => 0,
        'orderby'      => 'name',
        'show_count'   => 0,
        'pad_counts'   => 0,
        'hierarchical' => 0,
        'title_li'     => '',
        'hide_empty'   => 0
      );
      $destinations    = get_categories($destination_arg);



      //if destination is empty then choose all the destinations
      if (count($_POST['destination']) == 0) {
        foreach ($destinations as $a) {
          array_push($destination, $a->term_id);
        }
      }
      if (count($_POST['destination']) != 0) {
        $destination = $_POST['destination'];
      }
      $filter_set = TRUE;
      ?>
      <!-- if filter set -->
      <?php if ($filter_set) { ?>

        <?php
        $args = array(
          'post_type' => 'programs',
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'program_destination',
              'field'    => 'term_id',
              'terms'    => $destination,
              'operator' => 'IN'
            ),
          )
        );
        ?>
        <?php $the_query = new WP_Query($args); ?>
        <?php if ($the_query->have_posts()) : ?>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="single_prod">
              <div class="single_prod_top row">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
              </div>
              <div class="single_prod_bot row">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </div>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <p><?php _e('Sorry, no products matched your criteria.'); ?></p>
        <?php endif; ?>
      <?php } ?>
    <?php } ?>
    <div class="all_prod">
      all_prod
    </div>
  </main>


</div>

<?php get_footer(); ?>
