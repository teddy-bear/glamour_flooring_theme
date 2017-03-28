<?php
/**
 * Get options from customizer.
 */

?>
<?php
// Get custom link from customizer.
if ( get_theme_mod( 'custom_link_text' ) ) {
	?>
    <a class="btn-large"
       href="<?php echo get_theme_mod( 'custom_link_url' ); ?>"><?php echo get_theme_mod( 'custom_link_text' ); ?></a>
	<?php
}
?>

