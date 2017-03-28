<?php
/**
 * Functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 */


/**
 * Define global constants
 */
@define( 'PARENT_DIR', get_template_directory() );
@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'favicon_path', PARENT_URL . '/images/favicons/' );

/**
 * Include Reusable text block plugin
 */
require_once PARENT_DIR . '/includes/reusable-text-blocks/text-blocks.php';

/**
 * Include TinyMCE shortcodes buttons widget
 */
require_once PARENT_DIR . '/includes/TinyMCE-shortcodes-buttons/custom-buttons.php';

/**
 * Declare post types
 */
require_once PARENT_DIR . '/includes/theme-init.php';

/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
require_once PARENT_DIR . '/includes/sidebar-init.php';

/**
 * Assign theme shortcodes
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
require_once PARENT_DIR . '/includes/shortcodes.php';


/**
 * Aqua Resizer for image cropping and resizing on the fly
 */
require_once PARENT_DIR . '/includes/aq_resizer.php';

/**
 * Tablet & mobile check library
 */
require_once PARENT_DIR . '/includes/Mobile_Detect.php';

/**
 * Plugin based on the PHP Mobile Detect class incorporates functions and shortcodes
 * to empower User Admins to have better control of when content is served on mobile
 */
require_once PARENT_DIR . '/includes/wp-mobile-detect/wp-mobile-detect.php';

/**
 * Custom theme functions
 *
 */
require_once PARENT_DIR . '/includes/theme-function.php';

/**
 * Enqueue scripts and styles.
 */
require_once PARENT_DIR . '/includes/theme-scripts.php';

/**
 * Enable shortcodes in sidebar
 */
add_filter( 'text_blocks_widget_html', 'do_shortcode' );

/**
 * Copyright notice.
 */
function coded_by() {
	$output = '<!-- coded with love by Teddy Bear -->';
	echo $output;
}

add_action( 'wp_footer', 'coded_by', 300 );

/*-----------------------------------------------------------------------------------*/
/*	Include Meta Box
/*-----------------------------------------------------------------------------------*/
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/includes/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/includes/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
require_once RWMB_DIR . 'config-meta-boxes.php';
//require_once PARENT_DIR . '/includes/mb-custom-taxonomy/mb-custom-taxonomy.php';

/**
 * Widget CSS Classes
 * Plugin URI: http://cleverness.org/plugins/widget-css-classes *
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 3.3
 *
 * gives you the ability to add custom classes to your WordPress widgets
 * *
 */
require_once PARENT_DIR . '/includes/widget-css-classes/widget-css-classes.php';

/**
 * Add custom theme options
 * @link http://www.paulund.co.uk/using-theme-customiser
 */
include_once PARENT_DIR . '/includes/theme_customizer.php';

/**
 * Add image slider for header.
 */
include_once PARENT_DIR . '/includes/image-slider/init.php';

/**
 * Add image slider for content.
 */
//include_once PARENT_DIR . '/includes/image-slider-secondary/init.php';

/**
 * WooCommerce functions.
 */
require_once PARENT_DIR . '/includes/woocommerce-functions.php';




