<?php 
/*
 * Uses the 'admin_menu' hook to load 'wpbeirut_update_menu'.
 */
add_action( 'admin_menu', 'wpbeirut_update_menu' );


/*
 * Creates a sub-menu under Appearance.
 */
function wpbeirut_update_menu() {
    add_theme_page( 'Theme options', 'Theme options', 'manage_options', 'wpbeirut-theme-options', 'wpbeirut_theme_options' );
}


/*
 * Uses the 'admin_init' hook to load 'wpbeirut_init_settings'.
 */
add_action( 'admin_init', 'wpbeirut_init_settings' );



/*
 * Registers and adds settings, sections and fields.
 */
function wpbeirut_init_settings() {
    // Register a general setting.
    // The $option_group is the same as $option_name to prevent the "Error: options page not found." problem.
    register_setting( "wpbeirut_options", "wpbeirut_options", "wpbeirut_options_validate" );

    // Add sections.
    add_settings_section( "general-section", "General settings", "general_section_callback", "wpbeirut-theme-options" );

    // Add settings fields.
    add_settings_field( "wpbeirut-test-field-1", "Test field 1", "test_field_1_callback", "wpbeirut-theme-options", "general-section" );
}


/*
 * Callback function for add_settings_field.
 * Displays the HTML for the field.
 */
function test_field_1_callback() {
    $options = get_option( 'wpbeirut_options' ); ?>
	<input type='text' name='wpbeirut_options[wpbeirut-test-field-1]' value='<?php echo $options['wpbeirut-test-field-1']; ?>'>
<?php }


/*
 * Callback function for add_settings_section.
 * Displays the section HTML.
 */
function general_section_callback() {
    echo "This is a section description.";
}


/*
 * Callback function for add_theme_page.
 * Displays the theme options page.
 */
function wpbeirut_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    } ?>

    <div class="wrap">
        <h1>Theme options</h1>

        <form action="options.php" method="post">
            <?php
                settings_fields( "wpbeirut_options" );
                do_settings_sections( "wpbeirut-theme-options" );
                submit_button();
            ?>
        </form>
    </div>
<?php }


/*
 * Sanitizes the settings.
 */
function wpbeirut_options_validate( $input ) {
    $validated['wpbeirut-test-field-1'] = sanitize_text_field( $input['wpbeirut-test-field-1'] );

    return $validated;
}