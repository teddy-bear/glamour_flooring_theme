<?php
/*
Plugin Name: Slider
Description: creates slider post type and output images via flexslider.js
Author: Teddy Bear
Author URI: http://www.wwf.org
Text Domain: slider
Version: 1.0
*/

/**
 * Define Slider constants
 */
define( 'SLIDER_BASE_URL', get_template_directory_uri() . '/includes/image-slider/' );
define( 'SLIDER_ASSETS_URL', trailingslashit( SLIDER_BASE_URL . 'assets' ) );

/**
 * Create slider post type.
 */
add_action( 'init', 'post_type_slider' );
function post_type_slider() {
	$labels = array(
		'name'               => _x( 'Slides', 'post type general name' ),
		'singular_name'      => _x( 'Slide', 'post type singular name' ),
		'menu_name'          => _x( 'Slides', 'admin menu' ),
		'name_admin_bar'     => _x( 'Slide', 'add new on admin bar' ),
		'add_new'            => __( 'Add New Slide', 'image-slider' ),
		'add_new_item'       => __( 'Add New Slide', 'image-slider' ),
		'new_item'           => __( 'New Slide', 'image-slider' ),
		'edit_item'          => __( 'Edit Slide', 'image-slider' ),
		'view_item'          => __( 'View Slide', 'image-slider' ),
		'all_items'          => __( 'All Slides', 'image-slider' ),
		'search_items'       => __( 'Search Items', 'image-slider' ),
		'parent_item_colon'  => __( 'Parent Slides:', 'image-slider' ),
		'not_found'          => __( 'No Slides found.', 'image-slider' ),
		'not_found_in_trash' => __( 'No Slides found in Trash.', 'image-slider' )
	);
	register_post_type( 'slider',
		array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'menu_icon'           => 'dashicons-images-alt2',
			'menu_position'       => 10,
			'supports'            => array(
				'title',
				'thumbnail',
				'editor',
			)
		)
	);
}

/**
 * Add image column in slider admin screen
 * @link https://code.tutsplus.com/articles/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
 */

// GET FEATURED IMAGE
function get_slider_featured_image( $post_ID ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id );

		return $post_thumbnail_img[0];
	}
}

// ADD NEW COLUMN
function slider_columns_head( $defaults ) {
	$defaults['slider_image'] = 'Slider image';

	return $defaults;
}

// SHOW THE FEATURED IMAGE
function slider_columns_content( $column_name, $post_ID ) {
	if ( $column_name == 'slider_image' ) {
		$post_featured_image = get_slider_featured_image( $post_ID );
		if ( $post_featured_image ) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	}
}

add_filter( 'manage_slider_posts_columns', 'slider_columns_head' );
add_action( 'manage_slider_posts_custom_column', 'slider_columns_content', 10, 2 );

/**
 * Slider settings
 * you may use online resource to generate settings quickly
 * @link http://wpsettingsapi.jeroensormani.com/
 */

add_action( 'admin_menu', 'slider_add_admin_menu' );
add_action( 'admin_init', 'slider_settings_init' );

function slider_add_admin_menu() {
	add_submenu_page( 'edit.php?post_type=slider', 'Slider settings', 'Slider settings', 'edit_posts', 'slider_settings', 'slider_options_page' );
	//add_submenu_page( 'tools.php', 'test_slider', 'test_slider', 'manage_options', 'test_slider', 'slider_options_page' );
}

function slider_settings_init() {

	register_setting( 'defaultSettings', 'slider_settings' );

	// Create section.
	add_settings_section( 'slider_defaults', __( 'Main settings', 'image-slider' ), 'slider_settings_section_callback', 'defaultSettings' );

	// Prev/next arrows.
	add_settings_field( 'arrows', __( 'Show the previous/next arrows', 'image-slider' ), 'arrows_render', 'defaultSettings', 'slider_defaults' );

	// Navigation dots.
	add_settings_field( 'navigation', __( 'Show navigation bullets', 'image-slider' ), 'navigation_render', 'defaultSettings', 'slider_defaults' );

	// Auto play.
	add_settings_field( 'autoplay', __( 'Enable auto play', 'image-slider' ), 'autoplay_render', 'defaultSettings', 'slider_defaults' );

	// Slide delay.
	add_settings_field( 'slide_delay', __( 'Slider interval (in seconds)', 'image-slider' ), 'slide_delay_render', 'defaultSettings', 'slider_defaults' );

	// Animation effect.
	add_settings_field( 'animation', __( 'Slide effect', 'image-slider' ), 'animation_render', 'defaultSettings', 'slider_defaults' );

	// Slide direction.
	add_settings_field( 'slide_direction', __( 'Slide direction', 'image-slider' ), 'slide_direction_render', 'defaultSettings', 'slider_defaults' );

}

// Arrows field.
function arrows_render() {
	$options = get_option( 'slider_settings' ); ?>
    <label><input type="radio" name="slider_settings[arrows]"
                  value="1" <?php checked( $options['arrows'], 1 ); ?>>Yes</label>
    <label><input type="radio"
                  name="slider_settings[arrows]" <?php checked( $options['arrows'], 0 ); ?>
                  value="0">No</label>
	<?php
}

// Navigation field.
function navigation_render() {
	$options = get_option( 'slider_settings' );
	?>
    <label><input type="radio"
                  name="slider_settings[navigation]" <?php checked( $options['navigation'], 0 ); ?>
                  value="0">Hidden</label>
    <label><input type="radio" name="slider_settings[navigation]"
                  value="1" <?php checked( $options['navigation'], 1 ); ?>>Dots</label>
	<?php

}

// Auto play.
function autoplay_render() {
	$options = get_option( 'slider_settings' ); ?>
    <input type='checkbox' name='slider_settings[autoplay]' <?php checked( $options['autoplay'], 1 ); ?> value='1'>
	<?php
}

// Slide delay.
function slide_delay_render() {

	$options = get_option( 'slider_settings' );
	?>
    <select name='slider_settings[slide_delay]'>
		<?php for ( $i = 0; $i < 9; $i ++ ) { ?>
			<?php $time = $i * 1000; ?>
            <option value='<?php echo $time; ?>' <?php selected( $options['slide_delay'], $time ); ?>><?php echo $i; ?></option>
		<?php } ?>
    </select>

	<?php

}

// Slide effect.
function animation_render() {

	$options = get_option( 'slider_settings' );
	?>
    <select name='slider_settings[animation]'>
        <option value='fade' <?php selected( $options['animation'], 'fade' ); ?> checked>fade</option>
        <option value='slide' <?php selected( $options['animation'], 'slide' ); ?>>slide</option>
    </select>

	<?php

}

// Slide direction.
function slide_direction_render() {

	$options = get_option( 'slider_settings' );
	?>
    <select name='slider_settings[slide_direction]'>
        <option value='horizontal' <?php selected( $options['slide_direction'], 'horizontal' ); ?> checked>horizontal
        </option>
        <option value='vertical' <?php selected( $options['slide_direction'], 'vertical' ); ?>>vertical</option>
    </select>

	<?php

}


function slider_textarea_field_2_render() {

	$options = get_option( 'slider_settings' );
	?>
    <textarea cols='40' rows='5' name='slider_settings[slider_textarea_field_2]'>
		<?php echo $options['slider_textarea_field_2']; ?>
 	</textarea>
	<?php

}


function slider_settings_section_callback() {

	echo __( 'default slider configuration', 'image-slider' );

}


function slider_options_page() {

	?>
    <form action='options.php' method='post'>

        <h2><?php __( 'Main settings', 'image-slider' ) ?></h2>

		<?php
		settings_fields( 'defaultSettings' );
		do_settings_sections( 'defaultSettings' );
		submit_button();
		?>

    </form>
	<?php

}

/**
 * Create shortcode.
 */
function slider_shortcode() {
	ob_start();
	include_once 'header-slider.php';

	return ob_get_clean();
}

add_shortcode( 'slider', 'slider_shortcode' );

/**
 * Add script.
 */
function slider_script() {
	wp_enqueue_script( 'flexslider', SLIDER_ASSETS_URL . 'js/jquery.flexslider-min.js', array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'slider_script' );