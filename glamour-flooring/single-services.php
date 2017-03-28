<?php
/**
 * The template for displaying single service.
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <main class="main-column">
                <div class="ss-title-block">
                    <div class="row">
                        <div class="col-lg-6">
							<?php get_template_part( 'template-parts/single-service-thumb' ); ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="ss-title">
								<?php
								$ss_title_block_h       = rwmb_meta( 'ss-title' );
								$ss_title_block_content = rwmb_meta( 'ss-content' );
								if ( $ss_title_block_h ) { ?>
                                    <h3><?php echo $ss_title_block_h; ?></h3>
								<?php }
								if ( $ss_title_block_content ) { ?>
                                    <p><?php echo $ss_title_block_content; ?></p>
								<?php } ?>

                                <a class="btn-large" href="#popup-form">Free In-Home Estimate</a>

                            </div>
                        </div>
                    </div>
                </div>
				<?php
				while ( have_posts() ) {
					the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <section class="entry-content">
                            <div class="content">
								<?php the_content(); ?>
                            </div>
                        </section>
                    </article>

				<?php } ?>
            </main>
        </div>
        <div class="col-md-4 col-lg-3 no-padding-mobile">
            <div class="sidebar sidebar-right">
				<?php dynamic_sidebar( 'sidebar' ); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
