<?php
/*
 * File Name: config-meta-boxes.php
 *
 * Declaring meta boxes and initialization.
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 */


/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
//$prefix = 'theme_';


/**
 * Declare meta boxes
 */

global $meta_boxes;

// Custom css page class
$meta_boxes[] = array(
	'id'         => 'functional-meta-box',
	'title'      => __( 'Functional', 'framework' ),
	'post_types' => array( 'page' ),
	'context'    => 'side',
	'priority'   => 'low',
	'fields'     => array(
		array(
			'name' => __( 'Page class', 'framework' ),
			'id'   => "page-class",
			'desc' => __( 'Add custom css class to the body tag', 'framework' ),
			'type' => 'text'
		)
	)
);

// Custom fields for House plans post type.
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id'       => 'house-plans-fields-meta-box',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title'    => __( 'Additional fields' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages'    => array( 'house_plans', 'model_homes' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context'  => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// List of meta fields
	'fields'   => array(
		array(
			'name' => __( 'PresidaBedrooms' ),
			'id'   => "bedrooms",
			//'desc' => __('square feet'),
			'type' => 'text'
		),
		array(
			'name' => __( 'Bathrooms' ),
			'id'   => "bathrooms",
			//'desc' => __('add phone number'),
			'type' => 'text'
		),
		array(
			'name' => __( 'Approx SQFT' ),
			'id'   => "square_feet",
			'desc' => __( '' ),
			'type' => 'text'
		),
		array(
			'name' => __( 'Stories' ),
			'id'   => "stories",
			//'desc' => __('contact details'),
			'type' => 'text'
		),
		array(
			'name' => __( 'Width' ),
			'id'   => "width",
			//'desc' => __('contact details'),
			'type' => 'text'
		),
		array(
			'name' => __( 'Depth' ),
			'id'   => "depth",
			//'desc' => __('contact details'),
			'type' => 'text'
		),
		array(
			'name'             => __( 'Attach brochure' ),
			'id'               => "pdf_link",
			'desc'             => __( 'pdf format' ),
			'type'             => 'file_advanced',
			'mime_type'        => 'application/pdf',
			'max_file_uploads' => 1
		),
		array(
			'name'             => __( 'Floor Plans' ),
			'id'               => "floor_plans",
			'desc'             => __( 'add images' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 50
		),
		array(
			'name'             => __( 'Elevations' ),
			'id'               => "elevations",
			'desc'             => __( 'add images' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 50
		),
		array(
			'name'             => __( 'Gallery' ),
			'id'               => "house_plans_gallery",
			'desc'             => __( 'add photos' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 50
		),
	)
);

// Header section (header background + slogan).
$meta_boxes1[] = array(
	'id'         => 'header-background-meta-box',
	'title'      => __( 'Header section' ),
	'post_types' => array( 'page', 'news', 'services' ),
	'context'    => 'normal',
	'priority'   => 'high',
	'fields'     => array(
		array(
			'name' => __( 'Header text' ),
			'id'   => "header-text",
			//'desc' => __( 'Write text here' ),
			'type' => 'textarea'
		),
		array(
			'name'             => __( 'Header background', 'framework' ),
			'id'               => "header-background",
			'type'             => 'image_advanced',
			'desc'             => __( 'Image will be resized & cropped to 1600x240px' ),
			'max_file_uploads' => 1
		)
	)
);

// Video field (video post type).
$meta_boxes[] = array(
	'id'         => 'video-meta-box',
	'title'      => __( 'Video' ),
	'post_types' => array( 'video' ),
	'context'    => 'normal',
	'priority'   => 'low',
	// List of meta fields
	'fields'     => array(
		array(
			'name' => __( 'oEmbed(s)' ),
			'id'   => "oembed",
			'type' => 'oembed',
		)
	)
);

// Text field (testimonials post type).
$meta_boxes[] = array(
	'id'         => 'testimonials-meta-box',
	'title'      => __( 'Info' ),
	'post_types' => array( 'testimonials' ),
	'context'    => 'normal',
	'priority'   => 'high',
	'fields'     => array(
		/*array(
			'name' => __( 'Name' ),
			'id'   => "name",
			//'desc' => __( 'enter location' ),
			'type' => 'text'
		),*/
		array(
			'name' => __( 'Service' ),
			'id'   => "service",
			//'desc' => __( 'enter location' ),
			'type' => 'text'
		)
	)
);

// Text field (team post type).
$meta_boxes[] = array(
	'id'         => 'team-meta-box',
	'title'      => __( 'Info' ),
	'post_types' => array( 'team' ),
	'context'    => 'normal',
	'priority'   => 'high',
	'fields'     => array(
		array(
			'name' => __( 'Position' ),
			'id'   => "position",
			//'desc' => __( 'enter location' ),
			'type' => 'text'
		)
	)
);

// Title block on single services
$meta_boxes[] = array(
	'id'         => 'ss-title-box',
	'title'      => __( 'Title area' ),
	'post_types' => array( 'services' ),
	'context'    => 'normal',
	'priority'   => 'high',
	'fields'     => array(
		array(
			'name' => __( 'Title' ),
			'id'   => "ss-title",
			//'desc' => __( 'enter location' ),
			'type' => 'text'
		),
		array(
			'name' => __( 'On Image title' ),
			'id'   => "ss-image-title",
			//'desc' => __( 'enter location' ),
			'type' => 'text'
		),
		array(
			'name' => __( 'Content' ),
			'id'   => "ss-content",
			//'desc' => __( 'enter location' ),
			'type' => 'textarea'
		),

	)
);

// Link field (Logotypes post type).
$meta_boxes[] = array(
	'id'         => 'logo-meta-box',
	'title'      => __( 'Custom' ),
	'post_types' => array( 'network_logo' ),
	'context'    => 'normal',
	'priority'   => 'low',
	// List of meta fields
	'fields'     => array(
		array(
			'name' => __( 'Link', 'framework' ),
			'id'   => "link",
			'type' => 'text',
			//'type' => 'url',
		)
	)
);

// Gallery meta box.
$meta_boxes[] = array(
	'id'         => 'gallery-meta-box',
	'title'      => __( 'Gallery Images' ),
	'post_types' => array( 'portfolio' ),
	'context'    => 'normal',
	'priority'   => 'low',
	// List of meta fields
	'fields'     => array(
		array(
			'name'             => __( 'Upload Gallery Images', 'framework' ),
			'id'               => "gallery",
			//'desc'             => __( 'Images should have minimum width of 830px and minimum height of 323px, Bigger size images will be cropped automatically.', 'framework' ),
			'type'             => 'image_advanced',
			'max_file_uploads' => 100
		)
	)
);

// Tie Services to Pest post items.
$meta_boxes1[] = array(
	'id'         => 'pest-post-meta-box',
	'title'      => __( 'Custom' ),
	'post_types' => array( 'pest' ),
	'context'    => 'normal',
	'priority'   => 'low',
	// List of meta fields
	'fields'     => array(
		array(
			'name'        => __( 'Select Service' ),
			'id'          => "service",
			// Field type, either 'select' or 'select_advanced' (default)
			'type'        => 'post',
			'field_type'  => 'select_advanced',
			// Placeholder
			'placeholder' => __( 'Select an Item' ),
			// Query arguments (optional). No settings means get all published posts
			// @see https://codex.wordpress.org/Class_Reference/WP_Query
			'query_args'  => array(
				'post_type'      => 'services',
				'post_status'    => 'publish',
				'posts_per_page' => - 1,
			)
		)
	)
);

// Background image + parallax checkbox for text blocks.
$meta_boxes[] = array(
	'id'         => 'background-image-meta-box',
	'title'      => __( 'Media' ),
	'post_types' => array( 'text-blocks' ),
	'context'    => 'side',
	'priority'   => 'high',
	'fields'     => array(
		array(
			'name'             => __( 'Background image' ),
			'id'               => "background-image",
			'type'             => 'image_advanced',
			'max_file_uploads' => 1
		),
		array(
			'name' => __( 'Enable parallax' ),
			'id'   => "parallax",
			//'desc' => __( 'text block below breadcrumbs' ),
			'type' => 'checkbox',
		),
		array(
			'name' => __( 'Custom class' ),
			'id'   => "css_class",
			'type' => 'text',
		)
	)
);

// Custom fields for Vacancies post type.
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id'       => 'vacancies-fields-meta-box',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title'    => __( 'Additional fields' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages'    => array( 'vacancies' ),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context'  => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// List of meta fields
	'fields'   => array(
		array(
			'name' => __( 'Job location' ),
			'id'   => "job_location",
			'type' => 'text'
		),
		array(
			'name'        => 'Job type',
			'id'          => "job_type",
			'type'        => 'select',
			'options'     => array(
				'Temporary'    => 'Temporary',
				'Permanent'    => 'Permanent',
				'Temp to perm' => 'Temp to perm',
			),
			'placeholder' => 'please select',
		),
		array(
			'name'        => 'Job hours',
			'id'          => "job_hours",
			'type'        => 'select',
			'options'     => array(
				'Full Time' => 'Full Time',
				'Part time' => 'Part time',
			),
			'placeholder' => 'please select',
		),
		array(
			'name'        => 'Salary Range',
			'id'          => "salary_range",
			'type'        => 'select',
			'options'     => array(
				'20k - 35k'  => '20k - 35k',
				'35k - 50k'  => '35k - 50k',
				'50k - 65k'  => '50k - 65k',
				'65k - 80k'  => '65k - 80k',
				'80k - 95k'  => '80k - 95k',
				'95k - 110k' => '95k - 110k',
				'110k +'     => '110k +',
				'$8/hour'    => '$8/hour',
				'$9/hour'    => '$9/hour',
				'$10/hour'   => '$10/hour',
				'$11/hour'   => '$11/hour',
				'$12/hour'   => '$12/hour',
				'$13/hour'   => '$13/hour',
				'$14/hour'   => '$14/hour',
				'$15/hour'   => '$15/hour',
				'$16/hour'   => '$16/hour',
				'$17/hour'   => '$17/hour',
				'$18/hour'   => '$18/hour',
				'$19/hour'   => '$19/hour',
				'$20/hour'   => '$20/hour',
				'$21/hour'   => '$21/hour',
				'$22/hour'   => '$22/hour',
				'$23/hour'   => '$23/hour',
				'$24/hour'   => '$24/hour',
				'$25/hour'   => '$25/hour',
				'$25+/hour'  => '$25+/hour'
			),
			'placeholder' => 'please select',
		)
	)
);


/**
 * Register meta boxes
 *
 * @return void
 */
function theme_register_meta_boxes() {
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) ) {
		return;
	}

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'theme_register_meta_boxes' );
