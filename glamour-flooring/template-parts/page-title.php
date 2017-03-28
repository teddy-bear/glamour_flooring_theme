<?php
/**
 * The template for displaying page title.
 */

?>
<div class="container">
    <div class="page-title">
        <h1 class="title">
			<?php
			// Get Slogan text.
			$header_text = rwmb_meta( 'header-text' );
			if ( $header_text ) {
				echo $header_text;
			} else if ( is_author() ) {

				_e( 'Recent Posts by', 'theme' ); ?><?php echo get_the_author();
			} elseif ( is_archive() ) {
				if ( is_day() ) :
					printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() );
				elseif ( is_month() ) : /* if the montly archive is loaded */
					printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date( 'F Y' ) );
				elseif ( is_year() ) : /* if the yearly archive is loaded */
					printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date( 'Y' ) );
				else : /* if anything else is loaded, ex. if the tags or categories template is missing this page will load */
					_e( '<span>' . single_cat_title( '', false ) . '</span>' );
				endif;


			} elseif ( is_404() ) {
				_e( 'Oops! That page can&rsquo;t be found.', 'theme' );
			} elseif ( is_singular( 'news' ) ) {
				_e( 'Storm news', 'theme' );
			} elseif ( is_search() ) {
				_e( 'Search results', 'theme' );
			} else {
				echo get_the_title();
			}
			?>
        </h1>
    </div>
	<?php
	if ( ! is_singular( 'services' ) && ! is_page_template( 'page-sidebar-right.php' ) ) {
		get_template_part( 'template-parts/custom-link' );
	}
	?>
</div>
