<?php

/**
 * Registers and enqueues the `wp-beirut-theme-customizer.js` file responsible
 * for handling the transport messages for the Wordpress Beirut Theme Customizer.
 *
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
function wp_beirut_customizer_live_preview() {
	
	wp_enqueue_script(
	    'wp_beirut_customizer-theme-customizer',
	    get_template_directory_uri() . '/js/wp-beirut-theme-customizer.js',
	    array( 'jquery', 'customize-preview' ),
	    '1.0.0',
	    true
	);
	
}
add_action( 'customize_preview_init', 'wp_beirut_customizer_live_preview' );

/**
 * Writes out the CSS as defined by the values in the Wordpress Beirtu Theme Customizer
 * to the `head` element of the header template.
 *
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
function wp_beirut_customizer_css() {
	?>
	<style type="text/css">
		a { 
			color: <?php echo get_theme_mod( 'wp_beirut_customizer_link_color' ); ?>
		}
		
		<?php if ( false === get_theme_mod( 'wp_beirut_customizer_display_header' ) ) { ?>
			#header {
				display: none;
			}
		<?php } ?>
		
		<?php if ( '' != get_theme_mod( 'wp_beirut_customizer_background_image' ) ) { ?>
			body {
				background-image: url( <?php echo get_theme_mod( 'wp_beirut_customizer_background_image' ) ?> );
			}
		<?php } ?>
		
	</style>
	<?php
}
add_action( 'wp_head', 'wp_beirut_customizer_css' );

/**
 * Defines all of the sections, settings, and controls for the various
 * options introduced into the Wordpress Beirut Theme Customizer
 *
 * @param   object    $wp_customizer    A reference to the Wordpress Beirut Theme Customizer
 * @package wp-beirut-customizer
 * @since   1.0.0
 */
function wp_beirut_customizer_register_theme_customizer( $wp_customizer ) {

	/* Display Options
	 *------------------------------------------*/

	// Sections, which are containers for the Controls,
	$wp_customizer->add_section(
		'wp_beirut_customizer_display_options',
		array(
			'title'    => 'Display Options',
			'priority' => 200
		)
	);
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_link_color',
		array(
			'default'    =>  '#000000',
	        'transport'  =>  'postMessage'
		)
	);
	
	/* 
	* Rather than using a text area to accept hexidecimal values, 
	* we replace the field by using the WordPress Color Picker 
	* which is provided to us out-of-the-box with WordPress.
	* This means that we're able to give our users a clearer, understandable way to select colors, 
	* and it exposes us to one of the advanced controls that WordPress offers theme developers when working with the WordPress Theme Customizer.
	*
	*/
    
    // Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		new WP_Customize_Color_Control(
			$wp_customizer,
			'wp_beirut_customizer_link_color',
			array(
				'label'    => 'Link Color',
				'section'  => 'wp_beirut_customizer_display_options',
				'settings' => 'wp_beirut_customizer_link_color'
			)
		)
	);
	
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_display_header',
		array(
			'default'    => 'true',
			'transport'  => 'postMessage'
		)
	);
	
	// Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		'wp_beirut_customizer_display_header',
		array(
			'section'    => 'wp_beirut_customizer_display_options',
			'label'      => 'Display Header?',
			'type'       => 'checkbox'
		)
	);
	
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_background_image',
		array(
			'default'    =>  '',
	        'transport'  =>  'postMessage'
		)
	);
	
	/*
	* The ability to add a background image to our theme. 
	*/
	// Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		new WP_Customize_Image_Control(
			$wp_customizer,
			'wp_beirut_customizer_background_image',
			array(
				'label'    => 'Background Image',
				'section'  => 'wp_beirut_customizer_display_options',
				'settings' => 'wp_beirut_customizer_background_image'
			)
		)
	);
	
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_demo_file',
		array(
			'default'    =>  '',
	        'transport'  =>  'postMessage'
		)
	);
	
	/*
	* The ability to Upload a file to our theme and display the file link on the front end. 
	*/
	// Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		new WP_Customize_Upload_Control(
			$wp_customizer,
			'wp_beirut_customizer_demo_file',
			array(
				'label'    => 'Sample File',
				'section'  => 'wp_beirut_customizer_display_options',
				'settings' => 'wp_beirut_customizer_demo_file'
			)
		)
	);
	
	/* Footer Options
	 *------------------------------------------*/
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_section(
		'wp_beirut_customizer_footer_options',
		array(
			'title'    => 'Footer Options',
			'priority' => 201
		)
	);
	
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_footer_message',
		array(
			'default'    => 'Copyright 2018 All Rights Reserved',
			'transport'  => 'postMessage'
		)
	);
	
	// Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		'wp_beirut_customizer_footer_message',
		array(
			'section'    => 'wp_beirut_customizer_footer_options',
			'label'      => 'Footer Content',
			'type'       => 'text'
		)
	);
	
	// Settings which are the actual values as set by the Controls.
	$wp_customizer->add_setting(
		'wp_beirut_customizer_display_footer_title',
		array(
			'default'    => 'always',
			'transport'  => 'postMessage'
		)
	);
	
	// Controls, which are UI elements that represent Settings.
	$wp_customizer->add_control(
		'wp_beirut_customizer_display_footer_title',
		array(
			'section'    => 'wp_beirut_customizer_footer_options',
			'label'      => 'Display Blog Title',
			'type'       => 'select',
			'choices'    => array(
			    'always'     => 'Always',
			    'never'      => 'Never'
			)
		)
	);

}

// hook the theme customizer to customize_register default method of wordpress
add_action( 'customize_register', 'wp_beirut_customizer_register_theme_customizer' );