<?php
/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */

function theme_widgets_init() {

// Sidebar default
	register_sidebar( array(
		'name'          => __( 'Sidebar' ),
		'id'            => 'sidebar',
		'description'   => __( 'shows on sidebar page layout' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );

// Sidebar news.
	/*register_sidebar(array(
		'name' => __('Sidebar news'),
		'id' => 'sidebar-news',
		'description' => __('shows on news single pages'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));*/

// Header blocks
// Location: header
	register_sidebar( array(
		'name'          => __( 'Header blocks' ),
		'id'            => 'header-blocks',
		'description'   => __( 'above header menu' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		/*'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',*/
	) );

// Footer blocks
// Location: footer
	register_sidebar( array(
		'name'          => 'Footer blocks',
		'id'            => 'footer-blocks',
		'description'   => __( 'Located in the footer' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>'
	) );

// Sidebar shop top
// Location: shop pages.
	register_sidebar( array(
		'name'          => __( 'Shop top widgets' ),
		'id'            => 'shop-top-widgets',
		'description'   => __( 'shows above the products on categories pages' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );

// Sidebar shop left
// Location: shop pages.
	register_sidebar( array(
		'name'          => __( 'Sidebar shop' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'shows in the left column on categories pages' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );


}

add_action( 'widgets_init', 'theme_widgets_init' );
