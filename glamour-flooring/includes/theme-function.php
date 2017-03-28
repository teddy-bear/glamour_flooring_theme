<?php

/**
 * Theme custom functions.
 */

/**
 * Cut string length to a specified words limit
 *
 * @param string $text
 * @param integer $limit
 *
 * @return string
 */
function trim_string_length( $text, $limit ) {
	$text = strip_tags( $text );
	if ( str_word_count( $text, 0 ) > $limit ) {
		$words = str_word_count( $text, 2 );
		$pos   = array_keys( $words );
		$text  = substr( $text, 0, $pos[ $limit ] );
	}

	return $text;
}


/**
 * Remove invalid tags
 *
 * @param string $str
 * @param array $tags
 *
 * @return string
 */
function remove_invalid_tags( $str, $tags ) {
	foreach ( $tags as $tag ) {
		$str = preg_replace( '#^<\/' . $tag . '>|<' . $tag . '>$#', '', trim( $str ) );
	}

	return $str;
}

/**
 * Remove Empty Paragraphs
 */
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );
function shortcode_empty_paragraph_fix( $content ) {
	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
	);

	$content = strtr( $content, $array );

	return $content;
}

/**
 * Custom Pagination
 * @link http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 */
function pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo "<div class='pagination-custom'>";
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a class='custom' href='" . get_pagenum_link( 1 ) . "'><i class='fa fa-angle-left'></i><i class='fa fa-angle-left'></i> First page</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a class='custom' href='" . get_pagenum_link( $paged - 1 ) . "'><i class='fa fa-angle-left'></i> Previous page</a>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo "<a class='custom' href='" . get_pagenum_link( $paged + 1 ) . "'>Next page <i class='fa fa-angle-right'></i></a>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a class='custom' href='" . get_pagenum_link( $pages ) . "'>Last page <i class='fa fa-angle-right'></i><i class='fa fa-angle-right'></i></a>";
		}
		echo "</div>\n";
	}
}

/**
 * Retrieve browser name and attach it to the custom body class.
 * updates html output by modifying $body_class variable defined in header.php
 */
function append_browser_name( &$body_class ) {
	$user_agent = $_SERVER["HTTP_USER_AGENT"];
	if ( strpos( $user_agent, "Presto" ) ) {
		$browser = "opera";
	} else if ( strpos( $user_agent, "Chrome" ) ) {
		$browser = "chrome";
	} else if ( strpos( $user_agent, "Safari" ) ) {
		$browser = "safari";
	} else if ( strpos( $user_agent, 'Firefox' ) ) {
		$browser = "firefox";
	} else if ( strpos( $user_agent, "MSIE" ) ) {
		$browser = "ie";
	} else {
		$browser = "other";
	}

	return $body_class .= ' ' . $browser;
}

/**
 * Add specific CSS body classes by filter
 * @link https://codex.wordpress.org/Function_Reference/body_class
 */
add_filter( 'body_class', 'custom_body_css' );
function custom_body_css( $classes ) {
	// add meta box value.
	$classes[] = rwmb_meta( 'page-class' );

	// front page check.
	if ( ! is_front_page() ) {
		$classes[] = 'not-home';
	}

	// touch device check.
	$detect = new Mobile_Detect;
	if ( ! $detect->isMobile() && ! $detect->isTablet() ) {
		$classes[] = 'non-touch';
	} else {
		$classes[] = ' touch';
	}

	// Sidebar check.
	// todo: make it work; it shows that sidebar is always on
	/*if ( is_active_sidebar( 'Sidebar' ) == TRUE ) {
		$classes[] = ' has-sidebar';
	} else {
		$classes[] = ' no-sidebar';
	}*/

	// Browser class.
	$classes[] = append_browser_name( $body_class );

	return $classes;
}

/**
 * Add support for Really Simple Captcha in Contact form 7 > v.4.3
 * @link http://contactform7.com/2015/09/17/contact-form-7-43/
 */
add_filter( 'wpcf7_use_really_simple_captcha', '__return_true' );

/**
 * Add support for shortcodes inside contact form 7
 * @link https://wordpress.org/support/topic/plugin-contact-form-7-include-custom-shortcodes-in-form
 */
function custom_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );

	return $form;
}

add_filter( 'wpcf7_form_elements', 'custom_wpcf7_form_elements' );

/**
 * Custom Admin Login Form
 * https://codex.wordpress.org/Customizing_the_Login_Form
 */
function custom_login_logo() { ?>
    <style type="text/css">
        body.login {
            background: #555;
            background: radial-gradient(ellipse at center, #555 0%, #000 100%);
        }

        #login h1 a, .login h1 a {
            background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png) no-repeat 50% 0 / contain;
            padding: 0;
            width: 320px;
            height: 80px;
        }

        #loginform {
            background: #6d0808;
            background: linear-gradient(-180deg, #820a0a, #520606);
        }

        #loginform label {
            color: #fff;
        }

        .login form .input,
        .login form input[type=checkbox],
        .login input[type=text] {
            background: #fff;
        }

        body.login #backtoblog a,
        body.login #nav a {
            color: #eee;
        }

        body.login #backtoblog a:hover,
        body.login #nav a:hover,
        body.login h1 a:hover {
            /*color: #1a5ca1;*/
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'custom_login_logo' );

function custom_login_logo_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_url_title() {
	return get_bloginfo( 'name' );
}

add_filter( 'login_headertitle', 'custom_login_logo_url_title' );

/**
 * Add callback for custom TinyMCE editor stylesheets.
 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
 */
add_editor_style( 'css/editor-style.css' );

// todo: add size here.
add_action( 'image_size_names_choose', 'add_image_sizes' );
function add_image_sizes( $sizes ) {
	add_image_size( 'small_preview', 120, 80 );

	return array_merge( $sizes, array(
		'small_preview' => __( 'Your Custom Size Name' ),
	) );
}

/**
 * Store the Social Media Site Names.
 */
function my_customizer_social_media_array() {

	$social_sites = array(
		'twitter',
		'facebook',
		'google-plus',
		'flickr',
		'pinterest',
		'youtube',
		'linkedin',
		'instagram',
	);

	return $social_sites;
}

/**
 * Takes user input from the customizer and outputs linked social media icons
 * https://www.competethemes.com/blog/social-icons-wordpress-menu-theme-customizer/
 */
function my_social_media_icons() {

	$social_sites = my_customizer_social_media_array();

	/* any inputs that aren't empty are stored in $active_sites array */
	foreach ( $social_sites as $social_site ) {
		if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
			$active_sites[] = $social_site;
		}
	}

	$label     = get_theme_mod( 'social_icons_label' );
	$view_mode = get_theme_mod( 'social_icons_type' );

	/* for each active social site, add it as a list item */
	if ( ! empty( $active_sites ) ) {
		echo "<div class='social-icons'>";
		if ( $label ) {
			echo '<div class="title">' . $label . '</div>';
		}
		foreach ( $active_sites as $active_site ) {
			/* setup the class */
			$class = 'fa fa-' . $active_site;
			//$class = 'fa fa-' . $active_site . '-square';
			?>
            <a class="<?php echo $active_site; ?>" target="_blank"
               href="<?php echo esc_url( get_theme_mod( $active_site ) ); ?>">
				<?php if ( $view_mode == 'image' ) { ?>
                    <img src="<?php echo get_stylesheet_directory_uri() . '/images/icon-' . $active_site . '.png'; ?>"
                         alt="<?php echo $active_site; ?>">
				<?php } else { ?>
                    <i class="<?php echo esc_attr( $class ); ?>"
                       title="<?php printf( __( '%s icon', 'text-domain' ), $active_site ); ?>"></i>
				<?php } ?>
            </a>
			<?php
		}
		echo "</div>";
	}
}
