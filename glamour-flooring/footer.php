<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 */
?>

</div><!-- .site-content -->

<?php
// Block with tile background on all(:not-home) pages.
if ( ! is_front_page() ) { ?>
    <div class="black-line-footer">
        <div class="wow fadeIn">
            <?php echo do_shortcode( "[text-blocks id=70]" ); ?>
         </div>
          <?php  echo do_shortcode( "[text-blocks id=111]" ); ?>
    </div>
<?php } ?>

</div><!-- #content -->
<footer class="site-footer">

    <div class="row-footer-blocks">
        <div class="footer-blocks">
            <div class="container">
                <div class="row">
					<?php if ( ! dynamic_sidebar( 'Footer blocks' ) ) : endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row-copyright">
        <div class="container">
			<?php
			/**
			 * Output social icons values from customizer.
			 */
			my_social_media_icons();
			?>
            <div class="phone-number-holder">
				<?php echo do_shortcode( '[phone-number]' ); ?>
            </div>
            <div class="copyright">
				<?php echo get_theme_mod( 'copyright' ); ?>
            </div>
        </div>
    </div>

</footer><!-- .site-footer -->

<span id="back_to_top"><i class="fa fa-arrow-up"></i></span>

</div><!-- .site-all -->
</div><!-- .site -->
<div style="display: none">
    <div id="popup-form" class="site">
		<?php echo do_shortcode( '[contact-form-7 id="35" title="Contact form 1"]' ); ?>
    </div>
</div>


<?php wp_footer(); ?>

</body>
</html>
