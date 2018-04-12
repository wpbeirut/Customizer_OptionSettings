<?php
/**
 * The footer template.
 * 
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
?>
		<div id="footer">
			<?php echo get_theme_mod( 'wp_beirut_customizer_footer_message' ); ?>
			&nbsp;
			<div id="footer-title">
				<?php if ( 'always' === get_theme_mod( 'wp_beirut_customizer_display_footer_title' ) ) { ?>
					<?php bloginfo( 'title' ) ?>
				<?php } ?>
			</div><!-- #footer-title -->
		</div><!-- #footer -->
		
	</div><!-- #page -->
	<?php wp_footer(); ?>
	</body>
</html>