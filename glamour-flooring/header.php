<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="author" content="GraphicsbyCindy.com">

    <!--Favicon set-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo favicon_path; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo favicon_path; ?>favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo favicon_path; ?>favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo favicon_path; ?>manifest.json">
    <link rel="mask-icon" href="<?php echo favicon_path; ?>safari-pinned-tab.svg">
    <link rel="shortcut icon" href="<?php echo favicon_path; ?>favicon.ico">
    <meta name="msapplication-config" content="<?php echo favicon_path; ?>browserconfig.xml">
    <?php if (is_singular( 'product' )) { 
        function add_meta_tags() { ?>
            <meta name="description" content="<?php product_attributes_row(); ?> - Low Price Hardwood Flooring and installation in Houston. Call the Hardwood Flooring Engineered Experts" />
        <?php } 
        
            add_action('wp_head', 'add_meta_tags');
            remove_action( 'wp_head', '_wp_render_title_tag', 1 );
            add_action( 'wp_head', '_wp_render_title_tag_single_product', 1 );
            function _wp_render_title_tag_single_product() { 
                ?>
                <title><?php product_attributes_row(); ?> - <?php get_custom_product_type_name(); ?></title>
           <?php }
    }?>
    


	<?php wp_head(); ?>

</head>

<?php $detect = new Mobile_Detect; ?>

<body <?php body_class(); ?>>

<?php if ( ! is_admin_bar_showing() ) { ?>
    <div class="site-preloader"></div>
<?php } ?>

<div class="site">

    <div class="site-all">

        <header class="site-header">

            <div class="row-mobile visible-xs">
                <?php
                if (!logo_mobile) {
                    get_template_part( 'template-parts/site-logo' );
                } else {
                    get_template_part('template-parts/site-logo-mobile');
                } ?>
                <!-- Mobile menu button -->
                <!--<a href="#menu_mobile" class="mobile-menu-icon"></a>-->
                <div class="icons-mobile">
					<?php if ( phone ) { ?>
                        <a href="tel:<?php echo phone; ?>"><i class="fa fa-phone"></i></a>
					<?php } ?>
                </div>
				<?php //get_template_part( 'template-parts/custom-link' ); ?>
            </div>

            <div class="row-top">
                <div class="container">
					<?php get_template_part( 'template-parts/site-logo' ); ?>

					<?php // Header blocks region. ?>
					<?php dynamic_sidebar( 'header-blocks' ); ?>

                </div>
            </div>

            <div class="row-menu">
                <div class="container">
                    <!--Primary menu-->
                    <div class="header-menu">
                        <nav id="menu_mobile" class="nav-primary">
							<?php wp_nav_menu( array(
								'container'   => 'ul',
								'menu_class'  => 'main-menu clearfix',
								'menu_id'     => 'primary',
								'menu'        => 'Primary',
								'link_before' => '<span>',
								'link_after'  => '</span>'
							) );
							?>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row-menu sticky">
                <div class="container">
                    <!--Primary menu-->
                    <div class="header-menu">
                        <nav id="menu_mobile" class="nav-primary">
							<?php wp_nav_menu( array(
								'container'   => 'ul',
								'menu_class'  => 'main-menu clearfix',
								'menu_id'     => 'primary',
								'menu'        => 'Primary',
								'link_before' => '<span>',
								'link_after'  => '</span>'
							) );
							?>
                        </nav>
                    </div>
                </div>
            </div>

        </header>

        <div id="content">
			<?php
			if ( ! is_front_page() ) {

				// Background image + slogan for the rest of the pages.

				// Get Meta box image value.
				$images = rwmb_meta( 'header-background', 'type=image' );
				if ( $detect->isMobile() && ! $detect->isTablet() ) {
					$images = false;
				}
				// Documentation https://metabox.io/docs/get-meta-value/#section-examples
				if ( $images ) {
					foreach ( $images as $image ) {
						// Resize featured image.
						//print_r( $image );
						$image_resized_src = aq_resize( $image['full_url'], 1600, 240, true, true, true );
						//echo "<img src='$image_resized_src' alt='{$image['alt']}' />";
					}
				}
				?>
                <div class="page-title-row <?php if ( ! $images ) {
					echo 'no-image';
				} ?>" <?php if ( $images ) {
					echo 'style="background-image:url(' . $image_resized_src . ');"';
				} ?>>

					<?php get_template_part( 'template-parts/page-title' ); ?>
                </div>
                <div class="breadcrumbs">
                    <div class="container">
						<?php if ( function_exists( 'bcn_display' ) ) {
							bcn_display();
						} ?>
                    </div>
                </div>
			<?php } else { ?>
                <div class="wrapper row-slider">
					<?php echo do_shortcode( '[slider]' ); ?>
                    <!--<div class="slider-arrow">
                        <a href="#content-start"></a>
                    </div>-->
                    <div class="featured-text-holder">
                        <div class="container">
                            <div class="inner">
								<?php echo show_text_block( 'featured-text', true ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="content-start"></div>
			<?php } ?>
            <div class="site-content">
