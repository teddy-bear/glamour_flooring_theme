<?php if ( is_tax( 'custom_product_type' ) ) { ?>
    <div class="widget_product_categories_custom">
        <h5 class="widget-title">Brands</h5>
		<?php
		// Current taxonomy term.
		$term_slug = get_queried_object()->slug;
		//echo $term_slug;
		// Get flooring product category id.
		$IDbyNAME       = get_term_by( 'name', 'flooring', 'product_cat' );
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
		echo '<ul class="product-categories">';
		foreach ( $subcats as $sc ) {
			$link = get_term_link( $sc->slug, $sc->taxonomy );
			// Check if we have products on 2nd level category items and active post type.
			$args_product = array(
				'post_type'      => 'product',
				'posts_per_page' => - 1,
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => $sc->slug,
					),
					array(
						'taxonomy' => 'custom_product_type',
						'field'    => 'slug',
						'terms'    => $term_slug,
					)
				),
			);
			$loop         = new WP_Query( $args_product );
			// Show category if it has products inside.
			if ( $loop->have_posts() ) {
				echo '<li><a href="' . $link . '">' . $sc->name . '</a>';
				while ( $loop->have_posts() ) {
					$loop->the_post();
					// products for this category.
					//echo '<div><em>' . get_the_title() . '</em></div>';
				}

				wp_reset_postdata();
				// Get child categories.
				$childIdByName = get_term_by( 'name', $sc->name, 'product_cat' );
				$parent_cat_ID = $childIdByName->term_id;
				$args1         = array(
					'hierarchical'     => 1,
					'show_option_none' => '',
					'hide_empty'       => 1,
					'parent'           => $parent_cat_ID,
					'taxonomy'         => 'product_cat'
				);
				$subcats1      = get_categories( $args1 );
				if ( $subcats1 ) {
					echo '<ul class="children">';
					foreach ( $subcats1 as $sc1 ) {
						$link1 = get_term_link( $sc1->slug, $sc1->taxonomy );
						// Check if we have products on 3rd level category items and active post type.
						$args_product1 = array(
							'post_type'      => 'product',
							'posts_per_page' => 100,
							'tax_query'      => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $sc1->slug,
								),
								array(
									'taxonomy' => 'custom_product_type',
									'field'    => 'slug',
									'terms'    => $term_slug,
								)
							),
						);
						$loop          = new WP_Query( $args_product1 );
						// Show category if it has products inside.
						if ( $loop->have_posts() ) {
							echo '<li><a href="' . $link1 . '">' . $sc1->name . '</a></li>';
						}
						wp_reset_postdata();
					}
					echo '</ul>';
				}
				echo '</li>';
			}
		}
		echo '</ul>';
		?>
    </div>
<?php } ?>