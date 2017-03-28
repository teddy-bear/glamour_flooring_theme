<?php
/**
 * The template for header slider images.
 */

$args      = array(
  'post_type' => 'slider',
);
$the_query = new WP_Query($args);
add_image_size('header_slider', 1904, 560, TRUE);
if ($the_query->have_posts()) {
  $slider_id = 'header';
  ?>
  <div id="metaslider_<?php echo $slider_id; ?>" class="flexslider">
    <ul class="slides">
      <?php
      while ($the_query->have_posts()) {
        $the_query->the_post(); ?>
        <li>
          <?php

          the_post_thumbnail('header_slider');
          ?>
          <div class="caption-wrap">
            <div class="flex-caption">
              <?php the_content(); ?>
            </div>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>

  <?php
  /* Restore original Post Data */
  wp_reset_postdata(); ?>

  <?php
  /**
   * Get slider options.
   */
  $slider_options  = get_option('slider_settings');
  $arrows          = $slider_options['arrows'];
  $navigation      = $slider_options['navigation'];
  $autoplay        = ($slider_options['autoplay'] == 1 ? 1 : 0);
  $slide_delay     = $slider_options['slide_delay'];
  $animation       = $slider_options['animation'];
  $slide_direction = $slider_options['slide_direction'];
  ?>
  <?php
  /**
   * Slider config
   * @link https://github.com/woocommerce/FlexSlider/wiki/FlexSlider-Properties
   */
  ?>
  <script type="text/javascript">
    (
      function ($) {
        $(document).ready(function () {
          var slider = $('#metaslider_<?php echo $slider_id; ?>');
          slider.flexslider({
            slideshowSpeed: <?php echo $slide_delay;?>,
            animation: "<?php echo $animation;?>",
            controlNav: <?php echo $navigation;?>,
            directionNav: <?php echo $arrows;?>,
            direction: "<?php echo $slide_direction;?>",
            reverse: false,
            animationSpeed: 600,
            prevText: "",
            nextText: "",
            slideshow: <?php echo $autoplay;?>,
            //Callback: function(slider) - Fires when the slider loads the first slide
            start: function () {
              //console.log('start');
              slider.find('li.flex-active-slide').addClass('slide-loaded');
            },
            //Callback: function(slider) - Fires asynchronously with each slider animation
            before: function () {
              //console.log('before');
              slider.find('li').removeClass('slide-loaded active-slide');
            },
            //Callback: function(slider) - Fires after each slider animation completes
            after: function () {
              ///console.log('after');
              slider.find('li.flex-active-slide').addClass('active-slide');
            }
          });
        });
      }
    )(jQuery);
  </script>

<?php }

