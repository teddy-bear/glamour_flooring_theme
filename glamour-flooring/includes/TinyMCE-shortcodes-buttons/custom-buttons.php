<?php
/**
 * Custom buttons
 * Inspired by https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
 * Official info at https://codex.wordpress.org/Plugin_API/Filter_Reference/mce_external_plugins
 *
 */
/*
Plugin Name: TinyMCE custom buttons
Author: Teddy Bear
Version: 2.0
Author URI: http://weblabmedia.eu/
Description: Enhance WYSISWYG editor with shortcodes buttons.
*/

add_action( 'admin_head', 'add_tiny_mce_buttons' );
add_action( 'admin_enqueue_scripts', 'add_tiny_mce_buttons_css' );

/**
 * Declaring a new TinyMCE button
 */
function add_tiny_mce_buttons() {
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// Select necessary post types.
	$args  = array( '_builtin' => false, 'public' => true );
	$types = get_post_types( $args, 'names' );
	array_push( $types, 'post' );

	// Form array in proper format.
	$post_types = array();
	foreach ( $types as $type ) {
		$obj          = new stdClass();
		$obj->text    = ucfirst( $type );
		$obj->value   = $type;
		$post_types[] = $obj;
	}
	//var_dump( $post_types );
	$post_types = json_encode( $post_types );

	echo "<script>var postTypes = " . $post_types . "</script>";

	// Get available layouts.
	//echo "<script>var contentLayout = " . $content_layouts . "</script>";

	/**
	 * restrict icon to certain post types if necessary
	 */
	/*global $typenow;
	if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
		return;
	}*/

	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( "mce_external_plugins", "add_tinymce_handlers" );
		add_filter( 'mce_buttons_3', 'register_tiny_mce_buttons' );
	}
}

// Enable formats select.
add_filter( 'mce_buttons_3', 'tiny_activate_styleselect' );
function tiny_activate_styleselect( $buttons ) {
	array_unshift( $buttons, /*'styleselect',*/
		'fontselect' );

	return $buttons;
}

// Populate formats list with own values.
function tiny_own_styles( $config ) {
	$temp_array              = array(
		array(
			'title'   => 'Info block',
			'block'   => 'div',
			'classes' => 'info-block'
		)
	);
	$config['style_formats'] = json_encode( $temp_array );

	return $config;
}

//add_filter( 'tiny_mce_before_init', 'tiny_own_styles' );

/**
 * Replace default fonts with those used by the theme
 * check theme\sass\_variables.scss for reference
 */
add_filter( 'tiny_mce_before_init', 'restrict_font_choices' );
function restrict_font_choices( $initArray ) {
	$initArray['font_formats'] =
		'Titillium Web=Titillium Web, sans-serif;' .
		'Oswald=Oswald, sans-serif;';

	return $initArray;
}

/**
 * Specify path to the script with plugin for TinyMCE
 *
 * @param array $plugin_array
 *
 * @return array
 */
function add_tinymce_handlers( $plugin_array ) {
	$path                           = get_template_directory_uri() . '/includes/TinyMCE-shortcodes-buttons/';
	$plugin_array['custom_buttons'] = $path . 'buttons.js';

	return $plugin_array;
}

/**
 * Add buttons to the editor.
 *
 * @param array $buttons
 *
 * @return array
 */
function register_tiny_mce_buttons( $buttons ) {
	array_push( $buttons, "grid_elements", "add_content", "boxes", "classes", "table", 'video', 'map', 'address', "mobile_detect", "phone", "email", "lorem_ipsum" );

	return $buttons;
}

/**
 * Add styles.
 */
function add_tiny_mce_buttons_css() {
	$path = get_template_directory_uri() . '/includes/TinyMCE-shortcodes-buttons/';
	wp_enqueue_style( 'tiny_mce_buttons_css', $path . 'style.css' );
}
