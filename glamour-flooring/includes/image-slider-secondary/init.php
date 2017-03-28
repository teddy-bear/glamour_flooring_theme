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
define( 'SLIDER_BASE_URL', get_template_directory_uri() . '/includes/image-slider-secondary/' );
define( 'SLIDER_ASSETS_URL', trailingslashit( SLIDER_BASE_URL . 'assets' ) );

/**
 * Create slider post type.
 */
add_action( 'init', 'post_type_slider_content' );
function post_type_slider_content() {
	$labels = array(
		'name'               => _x( 'Content Slides', 'post type general name' ),
		'singular_name'      => _x( 'Content Slide', 'post type singular name' ),
		'menu_name'          => _x( 'Content Slides', 'admin menu' ),
		'name_admin_bar'     => _x( 'Content Slide', 'add new on admin bar' ),
		'add_new'            => __( 'Add New Content Slide', 'image-slider' ),
		'add_new_item'       => __( 'Add New Content Slide', 'image-slider' ),
		'new_item'           => __( 'New Content Slide', 'image-slider' ),
		'edit_item'          => __( 'Edit Content Slide', 'image-slider' ),
		'view_item'          => __( 'View Content Slide', 'image-slider' ),
		'all_items'          => __( 'All Content Slides', 'image-slider' ),
		'search_items'       => __( 'Search Items', 'image-slider' ),
		'parent_item_colon'  => __( 'Parent Content Slides:', 'image-slider' ),
		'not_found'          => __( 'No Content Slides found.', 'image-slider' ),
		'not_found_in_trash' => __( 'No Content Slides found in Trash.', 'image-slider' )
	);
	register_post_type( 'slider_content',
		array(
			'labels'          => $labels,
			'public'          => TRUE,
			'publicly_queryable'  => FALSE,
			'exclude_from_search' => TRUE,
			'capability_type' => 'post',
			'menu_icon'       => 'dashicons-images-alt',
			'menu_position'   => 11,
			'supports'        => array(
				'title',
				'thumbnail',
				//'editor',
			)
		)
	);
}

/**
 * Add image column in slider admin screen
 * @link https://code.tutsplus.com/articles/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
 */

// GET FEATURED IMAGE
function get_slider_featured_image2( $post_ID ) {
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	if ( $post_thumbnail_id ) {
		$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id );

		return $post_thumbnail_img[0];
	}
}

// ADD NEW COLUMN
function slider_columns_head2( $defaults ) {
	$defaults['slider_image2'] = 'Slider image';

	return $defaults;
}

// SHOW THE FEATURED IMAGE
function slider_columns_content2( $column_name, $post_ID ) {
	if ( $column_name == 'slider_image2' ) {
		$post_featured_image = get_slider_featured_image2( $post_ID );
		if ( $post_featured_image ) {
			echo '<img src="' . $post_featured_image . '" />';
		}
	}
}

add_filter( 'manage_slider_content_posts_columns', 'slider_columns_head2' );
add_action( 'manage_slider_content_posts_custom_column', 'slider_columns_content2', 11, 2 );

/**
 * Slider settings
 * you may use online resource to generate settings quickly
 * @link http://wpsettingsapi.jeroensormani.com/
 */

add_action( 'admin_menu', 'slider_add_admin_menu2' );
add_action( 'admin_init', 'slider_settings_init2' );

function slider_add_admin_menu2() {
	add_submenu_page( 'edit.php?post_type=slider_content', 'Slider settings', 'Slider settings', 'edit_posts', 'slider_content_settings', 'slider_options_page2' );
	//add_submenu_page( 'tools.php', 'test_slider', 'test_slider', 'manage_options', 'test_slider', 'slider_options_page2' );
}

function slider_settings_init2() {

	register_setting( 'defaultSettings2', 'slider_content_settings' );

	// Create section.
	add_settings_section( 'slider_defaults', __( 'Main settings', 'image-slider' ), 'slider_settings_section_callback2', 'defaultSettings2' );

	// Prev/next arrows.
	add_settings_field( 'arrows', __( 'Show the previous/next arrows', 'image-slider' ), 'arrows_render2', 'defaultSettings2', 'slider_defaults' );

	// Navigation dots.
	add_settings_field( 'navigation', __( 'Show navigation bullets', 'image-slider' ), 'navigation_render2', 'defaultSettings2', 'slider_defaults' );

	// Auto play.
	add_settings_field( 'autoplay', __( 'Enable auto play', 'image-slider' ), 'autoplay_render2', 'defaultSettings2', 'slider_defaults' );

	// Slide delay.
	add_settings_field( 'slide_delay', __( 'Slider interval (in seconds)', 'image-slider' ), 'slide_delay_render2', 'defaultSettings2', 'slider_defaults' );

	// Animation effect.
	add_settings_field( 'animation', __( 'Slide effect', 'image-slider' ), 'animation_render2', 'defaultSettings2', 'slider_defaults' );

	// Slide direction.
	add_settings_field( 'slide_direction', __( 'Slide direction', 'image-slider' ), 'slide_direction_render2', 'defaultSettings2', 'slider_defaults' );

}

// Arrows field.
function arrows_render2() {
	$options = get_option( 'slider_content_settings' ); ?>
	<label><input type="radio" name="slider_content_settings[arrows]"
	              value="1" <?php checked( $options['arrows'], 1 ); ?>>Yes</label>
	<label><input type="radio"
	              name="slider_content_settings[arrows]" <?php checked( $options['arrows'], 0 ); ?>
	              value="0">No</label>
	<?php
}

// Navigation field.
function navigation_render2() {
	$options = get_option( 'slider_content_settings' );
	?>
	<label><input type="radio"
	              name="slider_content_settings[navigation]" <?php checked( $options['navigation'], 0 ); ?>
	              value="0">Hidden</label>
	<label><input type="radio" name="slider_content_settings[navigation]"
	              value="1" <?php checked( $options['navigation'], 1 ); ?>>Dots</label>
	<?php

}

// Auto play.
function autoplay_render2() {
	$options = get_option( 'slider_content_settings' ); ?>
	<input type='checkbox' name='slider_content_settings[autoplay]' <?php checked( $options['autoplay'], 1 ); ?> value='1'>
	<?php
}

// Slide delay.
function slide_delay_render2() {

	$options = get_option( 'slider_content_settings' );
	?>
	<select name='slider_content_settings[slide_delay]'>
		<option value='1000' <?php selected( $options['slide_delay'], 1000 ); ?>>1</option>
		<option value='2000' <?php selected( $options['slide_delay'], 2000 ); ?>>2</option>
		<option value='3000' <?php selected( $options['slide_delay'], 3000 ); ?>>3</option>
		<option value='4000' <?php selected( $options['slide_delay'], 4000 ); ?>>4</option>
		<option value='5000' <?php selected( $options['slide_delay'], 5000 ); ?>>5</option>
		<option value='6000' <?php selected( $options['slide_delay'], 6000 ); ?>>6</option>
		<option value='7000' <?php selected( $options['slide_delay'], 7000 ); ?>>7</option>
		<option value='8000' <?php selected( $options['slide_delay'], 8000 ); ?>>8</option>
	</select>

	<?php

}

// Slide effect.
function animation_render2() {

	$options = get_option( 'slider_content_settings' );
	?>
	<select name='slider_content_settings[animation]'>
		<option value='fade' <?php selected( $options['animation'], 'fade' ); ?> checked>fade</option>
		<option value='slide' <?php selected( $options['animation'], 'slide' ); ?>>slide</option>
	</select>

	<?php

}

// Slide direction.
function slide_direction_render2() {

	$options = get_option( 'slider_content_settings' );
	?>
	<select name='slider_content_settings[slide_direction]'>
		<option value='horizontal' <?php selected( $options['slide_direction'], 'horizontal' ); ?> checked>horizontal
		</option>
		<option value='vertical' <?php selected( $options['slide_direction'], 'vertical' ); ?>>vertical</option>
	</select>

	<?php

}


function slider_settings_section_callback2() {

	echo __( 'default slider configuration', 'image-slider' );

}


function slider_options_page2() {

	?>
	<form action='options.php' method='post'>

		<h2><?php __( 'Main settings', 'image-slider' ) ?></h2>

		<?php
		settings_fields( 'defaultSettings2' );
		do_settings_sections( 'defaultSettings2' );
		submit_button();
		?>

	</form>
	<?php

}

/**
 * Create shortcode.
 */
function slider_shortcode2() {
	ob_start();
	include_once 'header-slider.php';

	return ob_get_clean();
}

add_shortcode( 'slider-content', 'slider_shortcode2' );
