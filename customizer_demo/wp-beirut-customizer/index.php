<?php
/**
 * The main index template.
 * 
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
?>
<?php get_header(); ?>
	
	<div id="content" class="site-content">
		<p>
			This is the site content. <a href="#">This is an anchor</a> so that we can tell the Theme Customizer is working.
		</p>
				
		<div id="sample-file">
			<?php if ( '' != get_theme_mod( 'wp_beirut_customizer_demo_file' ) ) { ?>
				<?php echo get_theme_mod( 'wp_beirut_customizer_demo_file' ); ?>		
			<?php } else { ?>
				<p>There is no demo file.</p>
			<?php } ?>
		</div><!-- #sample-file -->
		
	</div><!-- #content -->
	
<?php get_footer(); ?>