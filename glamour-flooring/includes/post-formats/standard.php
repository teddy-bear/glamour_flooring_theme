<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-holder' ); ?>>

	<?php get_template_part( 'includes/post-formats/post-thumb' ); ?>

    <div class="post-content">

        <header class="entry-header">
            <h5 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php _e( 'Permalink to:' ); ?> <?php the_title(); ?>">
					<?php the_title(); ?>
                </a>
            </h5>
			<?php get_template_part( 'includes/post-formats/post-meta' ); ?>
        </header>

        <div class="excerpt">
			<?php
			$content     = get_the_content();
			$excerpt     = get_the_excerpt();
			$words_limit = 30;
			if ( has_excerpt() ) {
				echo trim_string_length( $excerpt, $words_limit );
			} else {
				if ( ! is_search() ) {
					echo trim_string_length( $content, $words_limit );
				} else {
					echo trim_string_length( $excerpt, $words_limit );
				}
			}
			?>
        </div>
		<?php //get_template_part( 'template-parts/share-networks' ); ?>
        <a href="<?php the_permalink() ?>" class="more">
			<?php _e( 'read more' ); ?>
        </a>
    </div>
</article>