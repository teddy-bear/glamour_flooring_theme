<?php

if ( ! function_exists( 'theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 */
	function theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on twentyfifteen, use a find and replace
		 * to change 'twentyfifteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 825, 510, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu' ),
			'social'  => __( 'Secondary Menu' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat'
		) );

	}
endif; // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );


/**
 * Declare post types
 *
 * Learn more: {@link http://codex.wordpress.org/Function_Reference/register_post_type}
 */

/* Portfolio */
add_action( 'init', 'post_type_house_portfolio' );
function post_type_house_portfolio() {
	$labels = array(
		'name'               => _x( 'Portfolio', 'post type general name', '' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', '' ),
		'menu_name'          => _x( 'Portfolio', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New Portfolio', '' ),
		'add_new_item'       => __( 'Add New Portfolio', '' ),
		'new_item'           => __( 'New Portfolio', '' ),
		'edit_item'          => __( 'Edit Portfolio', '' ),
		'view_item'          => __( 'View Portfolio', '' ),
		'all_items'          => __( 'All Portfolio', '' ),
		'search_items'       => __( 'Search Portfolio', '' ),
		'parent_item_colon'  => __( 'Parent Portfolio:', '' ),
		'not_found'          => __( 'No Portfolio found.', '' ),
		'not_found_in_trash' => __( 'No Portfolio found in Trash.', '' )
	);
	register_post_type( 'portfolio',
		array(
			'labels'        => $labels,
			'public'        => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-admin-multisite',
			'rewrite'       => array(//'slug' => 'portfolio',
			),
			'supports'      => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt'
			)
		)
	);
	$taxonomy_labels = array(
		'name'                       => _x( 'Portfolio categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Categories' ),
		'popular_items'              => __( 'Popular Categories' ),
		'all_items'                  => __( 'All Categories' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category' ),
		'update_item'                => __( 'Update Category' ),
		'add_new_item'               => __( 'Add New Category' ),
		'new_item_name'              => __( 'New Category Name' ),
		'separate_items_with_commas' => __( 'Separate categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories' ),
		'not_found'                  => __( 'No categories found.' ),
		'menu_name'                  => __( 'Portfolio Categories' ),
	);
	register_taxonomy(
		'portfolio_category',
		'portfolio',
		array(
			'hierarchical'      => false,
			'labels'            => $taxonomy_labels,
			'show_admin_column' => true
		)
	);
}

/* Services */
add_action( 'init', 'post_type_services' );
function post_type_services() {
	$labels = array(
		'name'               => _x( 'Services', 'post type general name', '' ),
		'singular_name'      => _x( 'Services', 'post type singular name', '' ),
		'menu_name'          => _x( 'Services', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Services', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New Service', '' ),
		'add_new_item'       => __( 'Add New Service', '' ),
		'new_item'           => __( 'New Service', '' ),
		'edit_item'          => __( 'Edit Service', '' ),
		'view_item'          => __( 'View Service', '' ),
		'all_items'          => __( 'All Services', '' ),
		'search_items'       => __( 'Search Service', '' ),
		'parent_item_colon'  => __( 'Parent Service:', '' ),
		'not_found'          => __( 'No Services found.', '' ),
		'not_found_in_trash' => __( 'No Services found in Trash.', '' )
	);
	register_post_type( 'services',
		array(
			'labels'        => $labels,
			'public'        => true,
			'menu_position' => 7,
			'menu_icon'     => 'dashicons-admin-tools',
			'rewrite'       => array(
				'slug' => 'services',
			),
			'supports'      => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt'
			)
		)
	);
	/*$taxonomy_labels = array(
		'name'                       => _x( 'Services categories', 'taxonomy general name' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Categories' ),
		'popular_items'              => __( 'Popular Categories' ),
		'all_items'                  => __( 'All Categories' ),
		'parent_item'                => NULL,
		'parent_item_colon'          => NULL,
		'edit_item'                  => __( 'Edit Category' ),
		'update_item'                => __( 'Update Category' ),
		'add_new_item'               => __( 'Add New Category' ),
		'new_item_name'              => __( 'New Category Name' ),
		'separate_items_with_commas' => __( 'Separate categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove categories' ),
		'choose_from_most_used'      => __( 'Choose from the most used categories' ),
		'not_found'                  => __( 'No categories found.' ),
		'menu_name'                  => __( 'Services Categories' ),
	);
	register_taxonomy(
		'services_category',
		'services',
		array(
			'hierarchical' => FALSE,
			'labels'       => $taxonomy_labels
		)
	);*/

}


/* Video */
add_action( 'init', 'post_type_video' );
function post_type_video() {
	$labels = array(
		'name'               => _x( 'Video', 'post type general name', '' ),
		'singular_name'      => _x( 'Video', 'post type singular name', '' ),
		'menu_name'          => _x( 'Video', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Video', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New item', '' ),
		'add_new_item'       => __( 'Add New item', '' ),
		'new_item'           => __( 'New item', '' ),
		'edit_item'          => __( 'Edit item', '' ),
		'view_item'          => __( 'View item', '' ),
		'all_items'          => __( 'All items', '' ),
		'search_items'       => __( 'Search Video', '' ),
		'parent_item_colon'  => __( 'Parent Video:', '' ),
		'not_found'          => __( 'No Video found.', '' ),
		'not_found_in_trash' => __( 'No Video found in Trash.', '' )
	);
	register_post_type( 'video',
		array(
			'labels'        => $labels,
			'public'        => true,
			'menu_position' => 7,
			'menu_icon'     => 'dashicons-format-video',
			'supports'      => array(
				'title',
				'editor',
				'thumbnail'
			)
		)
	);
}

/* News */
//add_action( 'init', 'post_type_news' );
function post_type_news() {
	$labels = array(
		'name'               => _x( 'News', 'post type general name', '' ),
		'singular_name'      => _x( 'News', 'post type singular name', '' ),
		'menu_name'          => _x( 'News', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New Item', '' ),
		'add_new_item'       => __( 'Add New Item', '' ),
		'new_item'           => __( 'New Item', '' ),
		'edit_item'          => __( 'Edit News', '' ),
		'view_item'          => __( 'View News', '' ),
		'all_items'          => __( 'All News', '' ),
		'search_items'       => __( 'Search News', '' ),
		'parent_item_colon'  => __( 'Parent News:', '' ),
		'not_found'          => __( 'No News found.', '' ),
		'not_found_in_trash' => __( 'No News found in Trash.', '' )
	);
	register_post_type( 'news',
		array(
			'labels'        => $labels,
			'public'        => true,
			'menu_position' => 8,
			'menu_icon'     => 'dashicons-format-status',
			//'publicly_queriable'  => FALSE,
			//'exclude_from_search' => TRUE,
			'supports'      => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			)
		)
	);
}

/* Team Members */
//add_action( 'init', 'post_type_team' );
function post_type_team() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name', '' ),
		'singular_name'      => _x( 'Team Members', 'post type singular name', '' ),
		'menu_name'          => _x( 'Team Members', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Team Members', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add Team Member', '' ),
		'add_new_item'       => __( 'Add Team Member', '' ),
		'new_item'           => __( 'Team Member', '' ),
		'edit_item'          => __( 'Edit Team Members', '' ),
		'view_item'          => __( 'View Team Members', '' ),
		'all_items'          => __( 'All Team Members', '' ),
		'search_items'       => __( 'Search Team Members', '' ),
		'parent_item_colon'  => __( 'Parent Team Members:', '' ),
		'not_found'          => __( 'No Team Members found.', '' ),
		'not_found_in_trash' => __( 'No Team Members found in Trash.', '' )
	);
	register_post_type( 'team',
		array(
			'labels'              => $labels,
			'public'              => true,
			'menu_position'       => 8,
			'menu_icon'           => 'dashicons-format-status',
			'publicly_queriable'  => false,
			'exclude_from_search' => true,
			'supports'            => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			)
		)
	);
}

/* Testimonials */
add_action( 'init', 'post_type_testimonials' );
function post_type_testimonials() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', '' ),
		'singular_name'      => _x( 'Testimonials', 'post type singular name', '' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Testimonials', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New Testimonial', '' ),
		'add_new_item'       => __( 'Add New Testimonial', '' ),
		'new_item'           => __( 'New Testimonial', '' ),
		'edit_item'          => __( 'Edit Testimonial', '' ),
		'view_item'          => __( 'View Testimonial', '' ),
		'all_items'          => __( 'All Testimonials', '' ),
		'search_items'       => __( 'Search Testimonial', '' ),
		'parent_item_colon'  => __( 'Parent Testimonial:', '' ),
		'not_found'          => __( 'No Testimonials found.', '' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash.', '' )
	);
	register_post_type( 'testimonials',
		array(
			'labels'              => $labels,
			'public'              => true,
			'menu_position'       => 9,
			'menu_icon'           => 'dashicons-megaphone',
			'publicly_queriable'  => false,
			'exclude_from_search' => true,
			'supports'            => array(
				'title',
				'editor',
				//'thumbnail'
			)
		)
	);
}

/* Network logotypes */
//add_action( 'init', 'post_type_network_logo' );
function post_type_network_logo() {
	$labels = array(
		'name'               => _x( 'Logotypes', 'post type general name' ),
		'singular_name'      => _x( 'Logo', 'post type singular name' ),
		'menu_name'          => _x( 'Logos', 'admin menu' ),
		'name_admin_bar'     => _x( 'Logo', 'add new on admin bar' ),
		'add_new'            => __( 'Add New item' ),
		'add_new_item'       => __( 'Add New item' ),
		'new_item'           => __( 'New item' ),
		'edit_item'          => __( 'Edit item' ),
		'view_item'          => __( 'View item' ),
		'all_items'          => __( 'All items' ),
		'search_items'       => __( 'Search items' ),
		'parent_item_colon'  => __( 'Parent Logos:' ),
		'not_found'          => __( 'No Logos found.' ),
		'not_found_in_trash' => __( 'No Logos found in Trash.' )
	);
	register_post_type( 'network_logo',
		array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => false,
			'menu_position'     => 8,
			'menu_icon'         => 'dashicons-images-alt2',
			'supports'          => array(
				'title',
				'thumbnail'
			)
		)
	);
}


/* Gallery */
//add_action( 'init', 'post_type_gallery' );
function post_type_gallery() {
	register_post_type( 'gallery',
		array(
			'label'           => __( 'Gallery' ),
			'public'          => true,
			'capability_type' => 'post',
			'menu_icon'       => 'dashicons-camera',
			'menu_position'   => 11,
			'supports'        => array(
				'title',
				'thumbnail'
				//'editor'
			)
		)
	);
}

/* Programs */
//add_action( 'init', 'post_type_programs' );
function post_type_programs() {
	$labels = array(
		'name'               => _x( 'Programs', 'post type general name', '' ),
		'singular_name'      => _x( 'Programs', 'post type singular name', '' ),
		'menu_name'          => _x( 'Programs', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Programs', 'add new on admin bar', '' ),
		'add_new'            => __( 'Add New Program', '' ),
		'add_new_item'       => __( 'Add New Program', '' ),
		'new_item'           => __( 'New Program', '' ),
		'edit_item'          => __( 'Edit Program', '' ),
		'view_item'          => __( 'View Program', '' ),
		'all_items'          => __( 'All Programs', '' ),
		'search_items'       => __( 'Search Program', '' ),
		'parent_item_colon'  => __( 'Parent Program:', '' ),
		'not_found'          => __( 'No Programs found.', '' ),
		'not_found_in_trash' => __( 'No Programs found in Trash.', '' )
	);
	register_post_type( 'programs',
		array(
			'labels'            => $labels,
			'public'            => true,
			//'publicly_queryable' => FALSE,
			'show_in_nav_menus' => false,
			'menu_position'     => 7,
			'menu_icon'         => 'dashicons-id-alt',
			'rewrite'           => array(
				'slug' => 'programs',
			),
			'supports'          => array(
				'title',
				'excerpt',
				'editor'
			)
		)
	);
}

// Taxonomies for programs.
//add_action( 'init', 'programs_taxonomies' );
function programs_taxonomies() {
	$taxonomies = array(
		array(
			'slug'        => 'program_destination',
			'single_name' => 'Destination',
			'plural_name' => 'Destinations',
			'post_type'   => 'programs',
		),
		array(
			'slug'        => 'program_term',
			'single_name' => 'Term',
			'plural_name' => 'Terms',
			'post_type'   => 'programs',
		),
		array(
			'slug'        => 'program_category',
			'single_name' => 'Category',
			'plural_name' => 'Categories',
			'post_type'   => 'programs',
			//'hierarchical' => FALSE,
		),
	);
	foreach ( $taxonomies as $taxonomy ) {
		$labels = array(
			'name'              => $taxonomy['plural_name'],
			'singular_name'     => $taxonomy['single_name'],
			'search_items'      => 'Search ' . $taxonomy['plural_name'],
			'all_items'         => 'All ' . $taxonomy['plural_name'],
			'parent_item'       => 'Parent ' . $taxonomy['single_name'],
			'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
			'edit_item'         => 'Edit ' . $taxonomy['single_name'],
			'update_item'       => 'Update ' . $taxonomy['single_name'],
			'add_new_item'      => 'Add New ' . $taxonomy['single_name'],
			'new_item_name'     => 'New ' . $taxonomy['single_name'] . ' Name',
			'menu_name'         => $taxonomy['plural_name']
		);

		$rewrite      = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array( 'slug' => $taxonomy['slug'] );
		$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : false;

		register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], array(
			'hierarchical'      => $hierarchical,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => $rewrite,
			'show_admin_column' => true,
		) );
	}

}
