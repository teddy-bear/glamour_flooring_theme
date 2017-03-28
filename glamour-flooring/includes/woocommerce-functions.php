<?php
/**
 * WooCommerce scripts below.
 */

/**
 * Declare WooCommerce support for the theme.
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/**
 * Remove all native Woocommerce styles.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Number of products to output per page.
 */
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 15;' ), 20 );


/**
 * Remove original breadcrumbs from product page
 * single-product.php
 */
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


/**
 * Remove Item link wrapper.
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/**
 * Replace default product title inside product loop with title & link.
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'custom_product_title', 10 );
function custom_product_title() {
	$output = '<h3 class="product_item_title"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
	echo $output;
}

/**
 * Remove add to cart button.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Single product page.
 * visual hooks https://businessbloomer.com/woocommerce-visual-hook-guide-single-product-page/
 */

/**
 * Remove product title.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

/**
 * Remove product description.
 */
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

/**
 * Remove product tabs.
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/**
 * Product description instead of tabs.
 */
function show_product_description() {
	echo '<div class="product-description">' . get_the_content() . '</div>';
}

add_action( 'woocommerce_after_single_product_summary', 'show_product_description', 10 );

/**
 * Change number of related products on product page
 * Set your own value for 'posts_per_page'
 * @link https://docs.woocommerce.com/document/change-number-of-related-products-output/
 */
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
function jk_related_products_args( $args ) {

	$args['posts_per_page'] = 5; // number of related products
	//$args['columns']        = 2; // arranged in 2 columns
	return $args;
}

/**
 * Reposition related products
 */
remove_filter( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_filter( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 10 );


/**
 * Show All Custom Product Attributes on product page.
 * https://isabelcastillo.com/woocommerce-product-attributes-functions
 */
function isa_woocommerce_all_pa() {

	global $product;
	$attributes = $product->get_attributes();

	if ( ! $attributes ) {
		return;
	}

	$out = '<div class="custom-attributes">';

	foreach ( $attributes as $attribute ) {


		// skip variations
		if ( $attribute['is_variation'] ) {
			continue;
		}


		if ( $attribute['is_taxonomy'] ) {

			$out .= '<div class="attr-row ' . $attribute['name'] . '">';

			$terms = wp_get_post_terms( $product->id, $attribute['name'], 'all' );

			// get the taxonomy
			$tax = $terms[0]->taxonomy;

			// get the tax object
			$tax_object = get_taxonomy( $tax );

			// get tax label
			if ( isset ( $tax_object->labels->name ) ) {
				$tax_label = $tax_object->labels->name;
			} elseif ( isset( $tax_object->label ) ) {
				$tax_label = $tax_object->label;
			}

			// Output.
			$out .= '<span class="label">' . $tax_label . '</span>: ';
			$out .= '<span class="attributes">';
			$i = 0;
			foreach ( $terms as $term ) {
				$i ++;
				if ( $i != 1 ) {
					$out .= ', ';
				}
				$out .= $term->name;
			}
			$out .= '</span>';

			$out .= '</div>';

		} else {

			$out .= '<li class="' . sanitize_title( $attribute['name'] ) . ' ' . sanitize_title( $attribute['value'] ) . '">';
			$out .= '<span class="attribute-label">' . $attribute['name'] . ': </span> ';
			$out .= '<span class="attribute-value">' . $attribute['value'] . '</span></li>';
		}
	}

	$out .= '</div>';

	echo $out;
}

add_action( 'woocommerce_after_shop_loop_item_title', 'isa_woocommerce_all_pa', 9 );

/**
 * Read more link for products loop.
 */
function show_product_read_more_link() {
	echo '<a class="more" href="' . get_permalink() . '">View Details</a>';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'show_product_read_more_link', 11 );

/**
 * Output WooCommerce content.
 *
 * This function is only used in the optional 'woocommerce.php' template.
 * which people can add to their themes to add basic woocommerce support.
 * without hooks or modifying core templates.
 * location: woocommerce\includes\wc-template-functions.php
 */
function woocommerce_content() {

	if ( is_singular( 'product' ) ) {

		while ( have_posts() ) {
			the_post(); ?>
            <div class="row">
                <div class="col-md-10 col-md-push-2 no-padding-mobile">
					<?php wc_get_template_part( 'content', 'single-product' ); ?>

                </div>
                <div class="col-md-2 col-md-pull-10 sidebar sidebar-shop">
					<?php dynamic_sidebar( 'sidebar-shop' ) ?>
                </div>
            </div>
			<?php
		}

	} else { ?>


		<?php if ( have_posts() ) { ?>

			<?php //if ( ! is_shop() ) { ?>

            <div class="row">
                <div class="col-md-10 col-md-push-2 no-padding-mobile">
					<?php //do_action( 'woocommerce_archive_description' ); ?>
					<?php
					// Get current term values.
					$term_slug = get_queried_object()->slug;
					$term_id   = get_queried_object()->term_id;
					?>
                    <div class="term-description">
						<?php echo $productCatMetaDesc = get_term_meta( $term_id, 'wh_meta_desc', true ); ?>
                    </div>
                    <div class="shop-widgets">
                        <div class="custom_product_type-widget">
                            <label for="custom_product_type">Select by type</label>
                            <div class="custom_product_type select-wrapper">
                                <select id="custom_product_type">
                                    <option value="">Select by type</option>
									<?php
									// Output all flooring child categories via select.
									$args  = array(
										'taxonomy' => 'product_cat',
										'parent'   => 275
									);
									$terms = get_terms( $args );
									foreach ( $terms as $term ) { ?>
                                        <option value="<?php echo home_url( '/product-category/' ) . $term->slug ?>" <?php if ( $term->slug == $term_slug ) {
											echo 'selected';
										} ?>>
											<?php echo $term->name; ?>
                                        </option>
									<?php } ?>
                                </select>
                            </div>
                        </div>
						<?php dynamic_sidebar( 'shop-top-widgets' ) ?>
						<?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    </div>
					<?php //} ?>

					<?php woocommerce_product_loop_start(); ?>

					<?php woocommerce_product_subcategories(); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

					<?php do_action( 'woocommerce_after_shop_loop' ); ?>

					<?php
					// Custom product type description.
					if ( term_description() ) { ?>
                        <div class="term-type-description">
							<?php echo term_description(); ?>
                        </div>
					<?php } ?>

					<?php //if ( ! is_shop() ) { ?>
                </div>
                <div class="col-md-2 col-md-pull-10 sidebar sidebar-shop">
					<?php get_template_part( 'includes/woo-categories' ); ?>
					<?php dynamic_sidebar( 'sidebar-shop' ) ?>
                </div>
            </div>
			<?php //} ?>

		<?php } elseif ( ! woocommerce_product_subcategories( array(
			'before' => woocommerce_product_loop_start( false ),
			'after'  => woocommerce_product_loop_end( false )
		) )
		) { ?>
			<?php wc_get_template( 'loop/no-products-found.php' ); ?>
		<?php }
	}
}

// Top Cart Widget.
if ( ! function_exists( 'top_cart' ) ) {
	function top_cart( $load_cart = false ) {
		global $woocommerce;
		?>

        <div class="shopping-container">

            <div class="shopping-cart-widget" id='basket'>
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart-summ"
                   data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </div>

            <div class="cart-popup-container">
                <div class="cart-popup">
                    <div class="widget woocommerce widget_shopping_cart">
						<?php
						if ( $load_cart ) {
							woocommerce_mini_cart();
						} else {
							echo '<div class="widget_shopping_cart_content"></div>';
						}
						?>
                    </div>
                </div>
            </div>

        </div>


		<?php
	}
}

if ( ! function_exists( 'cart_items' ) ) {
	function cart_items( $limit = 3 ) {
		global $woocommerce;
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			?>
            <div class="items-text"><?php _e( 'Recently added item(s)' ); ?></div>
            <ul class='order-list'>
				<?php
				$counter = 0;
				foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
					$counter ++;
					if ( $counter > $limit ) {
						continue;
					}
					$_product = $cart_item['data'];

					if ( ! apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						continue;
					}

					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( $_product->exists() && $cart_item['quantity'] > 0 ) {

						$product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

						$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );

						?>
                        <li>
							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" data-key="%s" class="close-order-li" title="%s"><i class="fa fa-times"></i>
</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), $cart_item_key, __( 'Remove this item' ) ), $cart_item_key );
							?>

                            <a class="thumbnail" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
								<?php echo $thumbnail; ?>
                            </a>

                            <div class="wrap-info">
                                <h4>
                                    <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
										<?php echo apply_filters( 'woocommerce_widget_cart_product_title', $_product->get_title(), $_product ) ?>
                                    </a>
                                </h4>

                                <div class="descr">
									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
                                    <span class="coast">
                      <?php echo $cart_item['quantity']; ?> x
                      <span class='medium-coast'><?php echo $product_price; ?></span>
                    </span>
                                </div>
                            </div>

                        </li>
						<?php
					}
				}
				?>
            </ul>

			<?php
		} else {
			echo '<div class="empty">' . __( 'No products in the cart.' ) . '</div>';
		}


		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
			?>
            <div class="totals wrapper">
                <div class="subtotal"><?php echo __( 'Cart Subtotal' ); ?></div>
                <div class="big-coast">
					<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
                </div>
            </div>
            <div class='bottom-btn'>
                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php echo __( 'View Cart' ); ?></a>
                <a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><?php echo __( 'Checkout' ); ?></a>
            </div>

			<?php

		}
	}
}

/**
 * Add social icons on the single product page
 * check content-single-product.php for hook info
 */
add_action( 'woocommerce_single_product_summary', 'single_product_social_icons', 41 );
function single_product_social_icons() {
	echo do_shortcode( '[share]' );
}

/**
 * Put category below title on single page.
 */
function wc_single_product_category() {

	$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
	/*echo "<pre>";
	var_dump( $product_cats );
	echo "</pre>";*/

	// use array_shift if you want to get only 1st category.

	if ( $product_cats && ! is_wp_error( $product_cats ) ) {
		echo '<div class="categories">';
		$i = 0;
		foreach ( $product_cats as $product_cat ) {
			$i ++;
			if ( $i != 1 ) {
				echo ', ';
			}
			echo $product_cat->name;
		}
		echo "</div>";
	}

}

add_action( 'woocommerce_single_product_summary', 'wc_single_product_category', 6 );

/**
 * Replace short description -> product attributes;
 * put above the  price.
 */
function wc_custom_attributes() {
	global $product;
	$product->list_attributes();
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'wc_custom_attributes', 9 );

/**
 * Rating above description.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );


/**
 * Display all the subcategories from a specific category
 * https://www.themelocation.com/how-to-display-all-the-subcategories-from-a-specific-category-in-woocommerce/
 * // todo: highlight current item.
 */
function woocommerce_subcats_from_parentcat_by_NAME( $parent_cat_NAME ) {
	$term_slug = get_queried_object()->term_id;
	//echo $term_slug;
	$IDbyNAME       = get_term_by( 'name', $parent_cat_NAME, 'product_cat' );
	$product_cat_ID = $IDbyNAME->term_id;
	$args           = array(
		'hierarchical'     => 1,
		'show_option_none' => '',
		'hide_empty'       => 1,
		'parent'           => $product_cat_ID,
		'taxonomy'         => 'product_cat'
	);
	$parent_link    = get_term_link( $IDbyNAME->slug, $IDbyNAME->taxonomy );
	$selected       = '';
	//echo $IDbyNAME->name;
	$subcats = get_categories( $args );
	echo '<select class="wooc_sclist">';
	echo '<option value="">Select by brand</option>';
	foreach ( $subcats as $sc ) {
		$link = get_term_link( $sc->slug, $sc->taxonomy );
		/*echo $sc->term_id;
		if ( $sc->slug == $term_slug ) {
			$selected = 'selected';
		}*/
		echo '<option value="' . $link . '"' . $selected . '>' . $sc->name . '</option>';
		/*$childIdByName = get_term_by( 'name', $sc->name, 'product_cat' );
		$parent_cat_ID = $childIdByName->term_id;
		$args1         = array(
			'hierarchical'     => 1,
			'show_option_none' => '',
			'hide_empty'       => 1,
			'parent'           => $parent_cat_ID,
			'taxonomy'         => 'product_cat'
		);
		$subcats1      = get_categories( $args1 );
		foreach ( $subcats1 as $sc1 ) {
			$link1 = get_term_link( $sc1->slug, $sc1->taxonomy );
			echo '<option value="' . $link1 . '">' . $sc1->name . '</option>';
		}*/
	}
	echo '</select>';
}

/**
 * Add taxoonomy term to body_class
 * https://gist.github.com/thegdshop/3197540
 * http://stackoverflow.com/questions/37257101/add-a-body-class-related-to-the-product-category-in-woocommerce
 */
function woo_custom_taxonomy_in_body_class( $classes ) {
	if ( is_singular( 'product' ) || is_tax( 'product_cat' ) ) {
		$custom_terms = get_the_terms( 0, 'product_cat' );
		if ( $custom_terms ) {
			foreach ( $custom_terms as $custom_term ) {
				$classes[] = 'product_cat_' . $custom_term->slug;
			}
		}
	}

	return $classes;
}

add_filter( 'body_class', 'woo_custom_taxonomy_in_body_class' );


/**
 * Add in text after price to All products
 * https://gist.github.com/jameskoster/6875202
 */
//add_filter( 'woocommerce_get_price_html', 'custom_price_message' );
function custom_price_message( $price ) {

	$sqft = '';
	if ( $price ) {
		$sqft = '/sqft';
	}
	$new_price = $price . ' <span class="price-text">' . __( $sqft ) . '</span>';

	return $new_price;
}

/**
 * This code shows pagination for WooCommerce shortcodes when it's embeded on single pages.
 * Include into functions.php.
 * http://support.jawtemplates.com/goodstore/web/?p=871
 */

/**
 * Custom pagination for WooCommerce instead the default woocommerce_pagination()
 * @uses plugin Prime Strategy Page Navi, but added is_singular() on #line16
 */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'kli_woocommerce_pagination', 10 );
function kli_woocommerce_pagination() {
	// Previous/next page navigation.
	get_template_part( 'includes/post-formats/post-nav' );

}


/**
 * This code shows product attributes value
 * https://stackoverflow.com/questions/13374883/woocommerce-getting-custom-attributes
 */
function product_attributes_row() {
	global $product;

	$formatted_attributes = array();

	$attributes = $product->get_attributes();

	foreach ( $attributes as $attr => $attr_deets ) {

		$attribute_label = wc_attribute_label( $attr );

		if ( isset( $attributes[ $attr ] ) || isset( $attributes[ 'pa_' . $attr ] ) ) {

			$attribute = isset( $attributes[ $attr ] ) ? $attributes[ $attr ] : $attributes[ 'pa_' . $attr ];

			if ( $attribute['is_taxonomy'] ) {

				$formatted_attributes[ $attribute_label ] = implode( ', ', wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) ) );

			} else {

				$formatted_attributes[ $attribute_label ] = $attribute['value'];
			}

		}
	}

	$atr_names_title = implode( ' - ', array(
		$formatted_attributes['Color Name'],
		$formatted_attributes['Series'],
		$formatted_attributes['Manufacture']
	) );

	echo $atr_names_title;
}


/**
 * This code shows product attributes value
 * http://wpsites.net/web-design/remove-woocommerce-single-thumbnail-images-from-product-details-page/
 */
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails_custom', 20 );
function woocommerce_show_product_thumbnails_custom() {
	global $post, $product, $woocommerce;

	$attachment_ids = $product->get_gallery_attachment_ids();

	if ( $attachment_ids ) {
		$loop    = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		?>
        <div class="thumbnails"><?php

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop === 0 || $loop % $columns === 0 ) {
					$classes[] = 'first';
				}

				if ( ( $loop + 1 ) % $columns === 0 ) {
					$classes[] = 'last';
				}

				$image_class = implode( ' ', $classes );
				$props       = wc_get_product_attachment_props( $attachment_id, $post );

				if ( ! $props['url'] ) {
					continue;
				}

				echo apply_filters(
					'woocommerce_single_product_image_thumbnail_html',
					sprintf(
						'<div class="item"><a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>',
						esc_url( $props['url'] ),
						esc_attr( $image_class ),
						esc_attr( $props['caption'] ),
						wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props )
					),
					$attachment_id,
					$post->ID,
					esc_attr( $image_class )
				);

				$loop ++;
			}

			?></div>
		<?php
	}

}

/**
 * Assign Product Type taxonomy products.
 */
add_action( 'init', 'custom_products_taxonomies' );
function custom_products_taxonomies() {
	$taxonomy_labels = array(
		'name'                       => _x( 'Product types', 'taxonomy general name' ),
		'singular_name'              => _x( 'Product type', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Product type' ),
		'popular_items'              => __( 'Popular Product type' ),
		'all_items'                  => __( 'All Product type' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Product type' ),
		'update_item'                => __( 'Update Product type' ),
		'add_new_item'               => __( 'Add New Product type' ),
		'new_item_name'              => __( 'New Product type Name' ),
		'separate_items_with_commas' => __( 'Separate product types with commas' ),
		'add_or_remove_items'        => __( 'Add or remove product types' ),
		'choose_from_most_used'      => __( 'Choose from the most used product types' ),
		'not_found'                  => __( 'No product types found.' ),
		'menu_name'                  => __( 'Product types' ),
	);
	register_taxonomy(
		'custom_product_type',
		'product',
		array(
			'hierarchical'      => false,
			'labels'            => $taxonomy_labels,
			'show_admin_column' => true,
			'rewrite'           => array(
				'slug'       => 'product-type', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
			),
		)
	);
}

/**
 * Output function for product type name.
 */
function get_custom_product_type_name() {
	$terms = get_terms( 'custom_product_type' );
	foreach ( $terms as $term ) {
		echo $term->name;
	}
}

/**
 * Custom field for Product category
 * https://stackoverflow.com/questions/23469841/adding-custom-field-to-product-category-in-woocommerce
 *
 */
// Product Cat Create page.
function wh_taxonomy_add_new_meta_field() {
	?>

    <div class="form-field">
        <label for="wh_meta_desc"><?php _e( 'Slogan', 'wh' ); ?></label>
        <textarea name="wh_meta_desc" id="wh_meta_desc"></textarea>
        <p class="description"><?php _e( 'Enter Slogan, <= 160 character', 'wh' ); ?></p>
    </div>
	<?php
}

// Product Cat Edit page.
function wh_taxonomy_edit_meta_field( $term ) {

	//getting term ID
	$term_id = $term->term_id;

	// retrieve the existing value(s) for this meta field.
	$wh_meta_desc = get_term_meta( $term_id, 'wh_meta_desc', true );
	?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_desc"><?php _e( 'Slogan', 'wh' ); ?></label></th>
        <td>
            <textarea name="wh_meta_desc"
                      id="wh_meta_desc"><?php echo esc_attr( $wh_meta_desc ) ? esc_attr( $wh_meta_desc ) : ''; ?></textarea>
            <p class="description"><?php _e( 'Enter Slogan', 'wh' ); ?></p>
        </td>
    </tr>
	<?php
}

add_action( 'product_cat_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1 );
add_action( 'product_cat_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1 );

// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta( $term_id ) {
	$wh_meta_desc = filter_input( INPUT_POST, 'wh_meta_desc' );
	update_term_meta( $term_id, 'wh_meta_desc', $wh_meta_desc );
	var_dump( $wh_meta_desc );
}

add_action( 'edited_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1 );
add_action( 'create_product_cat', 'wh_save_taxonomy_custom_meta', 10, 1 );
