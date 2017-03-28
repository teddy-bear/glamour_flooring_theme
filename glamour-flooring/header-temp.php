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

    <!--Favicon set-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo favicon_path; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo favicon_path; ?>favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo favicon_path; ?>favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo favicon_path; ?>manifest.json">
    <link rel="mask-icon" href="<?php echo favicon_path; ?>safari-pinned-tab.svg">
    <link rel="shortcut icon" href="<?php echo favicon_path; ?>favicon.ico">
    <meta name="msapplication-config" content="<?php echo favicon_path; ?>browserconfig.xml">

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
                <!-- Mobile menu button -->
                <a href="#menu_mobile" class="mobile-menu-icon"></a>
                <div class="icons-mobile">
					<?php if ( phone ) { ?>
                        <a href="tel:<?php echo phone; ?>"><i class="fa fa-phone-square"></i></a>
					<?php } ?>
					<?php if ( email ) { ?>
                        <a href="mailto:<?php echo email; ?>"><i class="fa fa-envelope-square"></i></a>
					<?php } ?>
                </div>
				<?php get_template_part( 'template-parts/custom-link' ); ?>
            </div>

            <div class="row-top">

				<?php //get_template_part( 'template-parts/site-logo' ); ?>
                <div class="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       title="<?php echo get_bloginfo( 'name' ); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/images/logo.svg'; ?>"
                             alt="<?php echo get_bloginfo( 'name' ); ?>"/>
                    </a>
                </div>

				<?php // Header blocks region. ?>
				<?php // dynamic_sidebar( 'header-blocks' ); ?>

				<?php
				/**
				 * Output social icons values from customizer.
				 */
				my_social_media_icons();
				?>

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

            <div class="row-slogan">
                <div class="container">
					<?php echo show_text_block( 'slogan' ); ?>
                </div>
            </div>

            <div class="row-menu sticky hidden">
                <div class="container">
                    <!--<div class="site-logo">
					<a href="<?php /*echo esc_url( home_url( '/' ) ); */ ?>" title="<?php /*echo get_bloginfo( 'name' ); */ ?>">
						<img src="<?php /*echo logo_small; */ ?>" alt="<?php /*echo get_bloginfo( 'name' ); */ ?>"/>
					</a>
				</div>-->

					<?php // get_template_part('template-parts/site-logo'); ?>

                    <!--Primary menu-->
                    <div class="header-menu">
                        <nav class="nav-primary">
							<?php wp_nav_menu( array(
								'container'   => 'ul',
								'menu_class'  => 'main-menu clearfix',
								//'menu_id'    => 'primary',
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

        <div id="content" style="background: red; border:none;">
			<?php
			if ( ! is_front_page() ) {

				// Background image + slogan for the rest of the pages.

				// Get Meta box image value.
				$images       = rwmb_meta( 'header-background', 'type=image' );
				$header_image = get_theme_mod( 'header_image' );
				$image_width  = get_theme_mod( 'header_image_width' );
				$image_height = get_theme_mod( 'header_image_height' );
				if ( $detect->isMobile() && ! $detect->isTablet() ) {
					$images = false;
				}
				// Documentation https://metabox.io/docs/get-meta-value/#section-examples
				if ( $images ) {
					foreach ( $images as $image ) {
						// Resize featured image.
						//print_r( $image );
						$image_resized_src = aq_resize( $image['full_url'], $image_width, $image_height, true, true, true );
						//echo "<img src='$image_resized_src' alt='{$image['alt']}' />";
					}
				} else {
					$image_resized_src = aq_resize( $header_image, $image_width, $image_height, true, true, true );
				}
				?>
                <div class="page-title-row <?php if ( ! $images ) {
					echo 'image-default';
				} ?>"
                     style="background-image: url("<?php echo $image_resized_src; ?>"); background-color: <?php echo get_theme_mod( 'header_background_color' ); ?>;">

					<?php get_template_part( 'template-parts/page-title' ); ?>
                </div>
			<?php } else {
				echo do_shortcode( '[slider]' );
			} ?>
            <div class="site-content">
