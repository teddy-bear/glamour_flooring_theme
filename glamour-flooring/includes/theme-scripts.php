<?php
/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {

	/**
	 * Script for device detection -> includes\mobile_Detect.php
	 * used to initialize scripts/styles on specific devices
	 */
	$detect = new Mobile_Detect;

	$scripts_path = get_template_directory_uri() . '/js/';
	$styles_path  = get_template_directory_uri() . '/css/';
    $styles_marged  = get_template_directory_uri() . '/src/';



    /* ++++++++++ Styles ++++++++++ */
/*
	// Bootstrap styles.
	// file contains only grid classes.
	wp_enqueue_style( 'bootstrap-grid', $styles_path . 'bootstrap-grid.css' );

	// Normalize css
	// @link https://necolas.github.io/normalize.css/
	// makes browsers render all elements more consistently and in line with modern standards.
	// It precisely targets only the styles that need normalizing.
	wp_enqueue_style( 'normalize', $styles_path . 'normalize.css' );

	// CSS Animations library.
	// @link https://daneden.github.io/animate.css/
	wp_enqueue_style( 'animate', $styles_path . 'animate.min.css' );

	//wp_enqueue_style( 'lightgallery', $styles_path . 'lightgallery.min.css' );

	/* Custom fonts */
	/*wp_enqueue_style( 'custom-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700,300|Open+Sans:300,400,400i,600,700|Material+Icons' );
	wp_enqueue_style( 'Font-Awesome', $styles_path . 'font-awesome.min.css' );

	// Remove contact form styles.
	wp_dequeue_style( array( 'contact-form-7' ) );

	/**
	 * Device dependant styles.
	 */
	if ( ! $detect->isMobile() ) {

	}

	// Mobile only styles here.
	if ( $detect->isMobile() ) {
	}

	// Mobile menu
	/*wp_enqueue_style( 'mmenu', $styles_path . 'jquery.mmenu.all.css' );

    // Theme stylesheet.
    wp_enqueue_style( 'main', $styles_path . 'main.css' );
    */

    // Theme stylesheet.
    wp_enqueue_style( 'libcss', $styles_marged . 'libs.min.css' );

	/* ++++++++++ Scripts ++++++++++ */

	// Concatenated and compressed js libs.
	// wp_enqueue_script('libs', $scripts_path . '/libs.min.js', array('jquery'), '', TRUE);

	// Dropdown menu for non mobile devices.
	wp_enqueue_script( 'superfish', $scripts_path . 'libs/superfish.min.js', array( 'jquery' ), '1.7.5', true );

	// Continuous scroll.
	wp_enqueue_script( 'jquery_ui_custom', $scripts_path . 'libs/jquery-ui-1.10.3.custom.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'mousewheel', $scripts_path . 'libs/jquery.mousewheel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'kinetic', $scripts_path . 'libs/jquery.kinetic.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'smoothdivscroll', $scripts_path . 'libs/jquery.smoothdivscroll-1.3-min.js', array( 'jquery' ), '', true );

	if ( is_front_page() ) {
		// Youtube api
		wp_enqueue_script( 'iframe_api', '//www.youtube.com/iframe_api', false, '', true );
	}


	// Pinned elements on page scroll.
	//wp_enqueue_script('pin', $scripts_path . 'libs/jquery.pin.min.js', array('jquery'), '', TRUE);

	// On scroll events.
	wp_enqueue_script( 'wow', $scripts_path . 'libs/wow.min.js', array( 'jquery' ), '', true );

	// Equal heights.
	wp_enqueue_script( 'matchHeight', $scripts_path . 'libs/jquery.matchHeight-min.js', array( 'jquery' ), '', true );

	// Modernizer.
	wp_enqueue_script( 'modernizr', $scripts_path . 'libs/modernizr-custom.js', array(), '', true );

	// Images popup gallery.
	//wp_enqueue_script( 'lightgallery', $scripts_path . 'libs/lightgallery.min.js', array( 'jquery' ), '', TRUE );
	//wp_enqueue_script( 'thumbnail', $scripts_path . 'libs/lg-thumbnail.min.js', array( 'jquery' ), '', TRUE );
	//wp_enqueue_script( 'fullscreen', $scripts_path . 'libs/lg-fullscreen.min.js', array( 'jquery' ), '', TRUE );

	//wp_enqueue_script( 'video', $scripts_path . 'libs/lg-video.min.js', array( 'jquery' ), '', TRUE );
	//wp_enqueue_script( 'autoplay', $scripts_path . 'libs/lg-autoplay.min.js', array( 'jquery' ), '', TRUE );
	//wp_enqueue_script( 'zoom', $scripts_path . 'libs/lg-zoom.min.js', array( 'jquery' ), '', TRUE );

	// Magnific popup.
	wp_enqueue_script( 'magnific-popup', $scripts_path . 'libs/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );

	// Adaptive carousel.
	wp_enqueue_script( 'owl_carousel', $scripts_path . 'libs/owl.carousel.min.js', array( 'jquery' ), '2', true );

	// Parallax effect for rows background.
	wp_enqueue_script( 'parallax', $scripts_path . 'libs/jquery.parallax.min.js', array( 'jquery' ), '', true );

	// Cookies.
	wp_enqueue_script( 'cookies', $scripts_path . 'libs/cookie.min.js', array( 'jquery' ), '', true );

	// Mobile menu.
	wp_enqueue_script( 'mmenu', $scripts_path . 'libs/jquery.mmenu.min.all.js', array( 'jquery' ), '4.7.4', true );

    // Mobile menu.
    wp_enqueue_script( 'slicknav', $scripts_path . 'libs/jquery.slicknav.min.js', array( 'jquery' ), '4.7.4', TRUE );


    if ( ! $detect->isMobile() && ! $detect->isTablet() ) {
		/**
		 * Desktop scripts here
		 */
		// Theme custom scripts.
		wp_enqueue_script( 'init_desktop', $scripts_path . 'init_desktop.js', array( 'jquery' ), '1.0', true );

	} else {
		/**
		 * Tablet & Mobile scripts.
		 */
		// Theme custom scripts.
		//wp_enqueue_script( 'init_touch', $scripts_path . 'init_touch.js', array( 'jquery' ), '1.0', TRUE );

	}
	/**
	 * Mobile only scripts (exclude tablets).
	 */
	if ( $detect->isMobile() && ! $detect->isTablet() ) {
		//wp_enqueue_script( 'init_mobile', $scripts_path . 'init_mobile.js', array( 'jquery' ), FALSE, TRUE );
	}

	/**
	 * Theme custom scripts for all devices.
	 */
	wp_enqueue_script( 'init', $scripts_path . 'init.js', array( 'jquery' ), '', true );

}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );