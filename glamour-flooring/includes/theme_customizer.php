<?php
function theme_customize_register( $wp_customize ) {

	/**
	 * Add custom active callback.
	 * @link http://ottopress.com/2015/whats-new-with-the-customizer/
	 */
	function callback_sub_page() {
		return ! is_front_page();
	}

	// Create section.
	$wp_customize->add_section( 'custom_settings', array(
		'title'       => __( 'Custom settings' ),
		'description' => __( 'Add custom theme styles' ),
		'priority'    => 30,
	) );

	// Logo image.
	$wp_customize->add_setting( 'logo', array(
		'default' => get_stylesheet_directory_uri() . '/images/logo.png',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'    => 'Logo header',
		'section'  => 'custom_settings',
		'settings' => 'logo',
		'priority' => 1
	) ) );

	// Logo mobile.
	$wp_customize->add_setting( 'logo_mobile', array(
		//'default'   => get_stylesheet_directory_uri() . '/images/logo-footer.png',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_mobile', array(
		'label'    => 'Logo Mobile',
		'section'  => 'custom_settings',
		'settings' => 'logo_mobile',
		'priority' => 2
	) ) );

	// Custom link text.
	$wp_customize->add_setting( 'custom_link_text', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'custom_link_text', array(
		'label'           => 'Custom link text',
		'section'         => 'custom_settings',
		'type'            => 'text',
		'priority'        => 2.1,
		'active_callback' => function () {
			return ! is_front_page();
		}

	) );

	// Custom link page.
	$wp_customize->add_setting( 'custom_link_url', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'custom_link_url', array(
		'label'           => 'Link url',
		'section'         => 'custom_settings',
		//'type'            => 'dropdown-pages',
		'type'            => 'text',
		'priority'        => 2.2,
		'active_callback' => function () {
			return ! is_front_page();
		}
	) );

	// Logo small.
	/*$wp_customize->add_setting( 'logo_small', array(
		'transport' => 'postMessage',
		'default'   => get_stylesheet_directory_uri() . '/images/logo-small.png',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_small', array(
		'label'    => 'Logo small',
		'section'  => 'custom_settings',
		'settings' => 'logo_small',
		'priority' => 3
	) ) );*/

	// Phone (primary).
	$wp_customize->add_setting( 'phone', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'phone', array(
		'label'    => 'Phone number primary',
		'section'  => 'custom_settings',
		'type'     => 'text',
		'priority' => 4
	) );

	// Phone (secondary).
	/*$wp_customize->add_setting( 'phone_secondary', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'phone_secondary', array(
		'label'    => 'Phone number secondary',
		'section'  => 'custom_settings',
		'type'     => 'text',
		'priority' => 6
	) );*/

	// Fax.
	$wp_customize->add_setting( 'fax', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'fax', array(
		'label'    => 'Fax',
		'section'  => 'custom_settings',
		'type'     => 'text',
		'priority' => 7
	) );

	// Email.
	$wp_customize->add_setting( 'email', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'email', array(
		'label'    => 'Email address',
		'section'  => 'custom_settings',
		'type'     => 'text',
		'priority' => 8
	) );

	// Address.
	$wp_customize->add_setting( 'address', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'address', array(
		'label'    => 'Address',
		'section'  => 'custom_settings',
		'type'     => 'text',
		'priority' => 9
	) );

	// Copyright textarea.
	$wp_customize->add_setting( 'copyright', array(
		'default'   => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'copyright', array(
		'label'    => __( 'Copyright' ),
		'type'     => 'textarea',
		'section'  => 'custom_settings',
		'settings' => 'copyright',
		'priority' => 10
	) );

	/**
	 *  Header settings section.
	 */
	/*$wp_customize->add_section( 'header_settings', array(
		'title'           => __( 'Header settings' ),
		'description'     => __( 'customize header elements' ),
		'priority'        => 40,
		'active_callback' => 'callback_sub_page'
	) );*/

	// Site header background color.
	$wp_customize->add_setting( 'header_background_color', array(
		'default' => '',
		//'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'           => __( 'Header background color' ),
		'section'         => 'header_settings',
		'priority'        => 1,
		'active_callback' => 'callback_sub_page'
	) ) );

	// Site header background image.
	$wp_customize->add_setting( 'header_image', array(
		'default' => '',
		//'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_image', array(
		'label'           => 'Header background image',
		'section'         => 'header_settings',
		'type'            => 'image',
		'priority'        => 2,
		'active_callback' => 'callback_sub_page'
	) ) );

	// Site header background image width.
	$wp_customize->add_setting( 'header_image_width', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'header_image_width', array(
		'label'           => 'Header background image width',
		'section'         => 'header_settings',
		'type'            => 'number',
		'priority'        => 3,
		'active_callback' => 'callback_sub_page'
	) );

	// Site header background image height.
	$wp_customize->add_setting( 'header_image_height', array(
		'default' => '',
	) );
	$wp_customize->add_control( 'header_image_height', array(
		'label'           => 'Header background image height',
		'section'         => 'header_settings',
		'type'            => 'number',
		'priority'        => 4,
		'active_callback' => 'callback_sub_page'
	) );

	// Colorpicker setting.
	/*$wp_customize->add_setting( 'header_textcolor', array(
		'default'   => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'    => __( 'Header Color' ),
		'section'  => 'custom_settings',
		'settings' => 'header_textcolor',
		'priority' => 2
	) ) );*/


	// Colorpicker for links
	/*$wp_customize->add_setting( 'colorpicker', array(
		'default'   => '',
		'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'colorpicker', array(
		'label'   => __( 'Colorpicker', 'theme_textdomain' ),
		'section' => 'custom_settings',
	) ) );*/

	// Media (image) control.
	/*$wp_customize->add_setting( 'image_control', array(
		'default'   => '',
		//'transport' => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'image_control', array(
		'label'     => __( 'Featured Home Page Image', 'theme_textdomain' ),
		'section'   => 'custom_settings',
		//'mime_type' => 'image',
	) ) );*/

	// Range.
	/*$wp_customize->add_setting( 'range_control', array(
	'default'   => '',
	 'transport' => 'postMessage',
	) );
	$wp_customize->add_control( 'range_control', array(
		'type' => 'range',
		'section' => 'custom_settings',
		'label' => __( 'Range' ),
		'description' => __( 'This is the range control description.' ),
		'input_attrs' => array(
			'min' => 0,
			'max' => 10,
			'step' => 2,
		),
	) );*/

	/**
	 * Add settings to create various social media text areas.
	 */
	$wp_customize->add_section( 'my_social_settings', array(
		'title'       => __( 'Social Media Icons', 'text-domain' ),
		'description' => 'Paste url for social networks',
		'priority'    => 35,
	) );


	// Label before icons.
	$wp_customize->add_setting( 'social_icons_label', array(//'transport'         => 'postMessage'
	) );

	$wp_customize->add_control( 'social_icons_label', array(
		'label'    => __( "Label text before icons:", 'text-domain' ),
		'section'  => 'my_social_settings',
		'type'     => 'text',
		'priority' => 1,
	) );

	// Select links type.
	$wp_customize->add_setting( 'social_icons_type', array(//'transport'         => 'postMessage'
	) );

	$wp_customize->add_control( 'social_icons_type', array(
		'label'    => __( "View mode:", 'text-domain' ),
		'section'  => 'my_social_settings',
		'type'     => 'radio',
		'priority' => 2,
		'choices'  => array(
			'font'  => 'Font Awesome',
			'image' => 'Png image',
		),
	) );

	$social_sites = my_customizer_social_media_array();
	$priority     = 3;

	foreach ( $social_sites as $social_site ) {

		$wp_customize->add_setting( "$social_site", array(
			'sanitize_callback' => 'esc_url_raw',
			//'transport'         => 'postMessage'
		) );

		$wp_customize->add_control( $social_site, array(
			'label'    => __( "$social_site:", 'text-domain' ),
			'section'  => 'my_social_settings',
			'type'     => 'text',
			'priority' => $priority,
		) );

		$priority = $priority + 1;
	}


}

add_action( 'customize_register', 'theme_customize_register' );

/**
 * Apply custom styles.
 */
function mytheme_customize_css() {
	if ( get_theme_mod( 'header_textcolor' ) ) {
		?>
        <style type="text/css">
            .site-header {
                background: <?php echo "#". get_theme_mod('header_textcolor'); ?>;
            }
        </style>
		<?php
	}
	if ( get_theme_mod( 'colorpicker' ) ) {
		?>
        <style type="text/css">
            a {
                color: <?php echo get_theme_mod('colorpicker'); ?>;
            }
        </style>
		<?php
	}

}

add_action( 'wp_head', 'mytheme_customize_css' );

/**
 * Used by hook: 'customize_preview_init' -> call js file only in the admin panel.
 *
 * @see add_action('customize_preview_init',$func)
 */
function mytheme_customizer_live_preview() {
	wp_enqueue_script( 'mytheme-themecustomizer',      //Give the script an ID
		get_template_directory_uri() . '/js/theme-customizer.js',//Point to file
		array( 'jquery', 'customize-preview' ),  //Define dependencies
		'',            //Define a version (optional)
		true            //Put script in footer?
	);
}

add_action( 'customize_preview_init', 'mytheme_customizer_live_preview' );

/**
 * Define customizer constants to use globally.
 */
@define( 'phone', get_theme_mod( 'phone' ) );
@define( 'phone_secondary', get_theme_mod( 'phone_secondary' ) );
@define( 'fax', get_theme_mod( 'fax' ) );
@define( 'email', get_theme_mod( 'email' ) );
@define( 'address', get_theme_mod( 'address' ) );
@define( 'logo', get_theme_mod( 'logo', get_stylesheet_directory_uri() . '/images/logo.png' ) );
@define( 'logo_small', get_theme_mod( 'logo_small', get_stylesheet_directory_uri() . '/images/logo-small.png' ) );
@define( 'logo_mobile', get_theme_mod( 'logo_mobile' ) );
