<?php
/**
 * Template Name: Gallery
 */
get_header(); ?>

    <div class="container">

        <main class="main-column">
            <?php
            // Show default page content.
            while (have_posts()) {
                the_post();
                the_content();
            }
            ?>

            <div class="gallery">
                <div class="row">
                    <?php
                    $image_width = 338;
                    $image_height = 238;
                    $args = array(
                        'post_type' => 'gallery'
                    );
                    $items = get_posts($args);
                    ?>
                    <?php
                    foreach ($items as $post) {
                        setup_postdata($post); ?>
                        <?php
                        $images = rwmb_meta('gallery', 'type=image&size=full');
                        $i = 0;
                        foreach ($images as $image) {
                            $image_url = aq_resize($image['full_url'], $image_width, $image_height, TRUE, TRUE, TRUE);

                            ++$i; ?>
                            <div class='col-xs-6 col-md-4 col-lg-3 item-<?php echo $i; ?>'>
                                <a href="<?php echo $image['full_url']; ?>" class="item"
                                   title="<?php echo $image['title']; ?>">
                                    <img src='<?php echo $image_url; ?>' width='<?php echo $image_width; ?>'
                                         height='<?php echo $image_height; ?>'
                                         alt='<?php echo $image['title']; ?>'/>
                                    <span class="zoom-icon"></span>
                                    <?php if ($image['caption']) { ?>
                                        <strong><?php echo $image['caption']; ?></strong>
                                    <?php } ?>
                                </a>
                            </div>
                            <?php
                        } ?>
                    <?php } ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

        </main>

    </div>

    </div>

<?php get_footer(); ?>