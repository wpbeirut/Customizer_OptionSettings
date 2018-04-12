<?php 
/******************************************************************************
 * theme-options.php
 * 
 * Table of contents:
 * 
 * 1. DEFINITIONS
 * 2. HOOKS
 * 3. RENDER FUNCTIONS
 * 4. SANITIZE FUNCTIONS
 * 5. CUSTOM SCRIPTS
 * 6. OTHER FUNCTIONS
 *****************************************************************************/





/******************************************************************************
 * 1. DEFINITIONS
 *****************************************************************************/
/*
 * Section information.
 */
$wpbeirut_sections = [
    'section-theme-settings' => [
        'title' => 'Theme Settings',
        'desc'  => 'General theme settings.'
    ],
    'section-styling-settings' => [
        'title' => 'Styling Settings',
        'desc'  => 'Settings for editing colors, fonts and CSS.'
    ],
    'section-social-settings' => [
        'title' => 'Social Settings',
        'desc'  => 'Edit your social media profiles.'
    ]
];

/*
 * Field information.
 */
$wpbeirut_fields = [
    'wpbeirut-logo' => [
        'title'    => 'Default logo',
        'type'     => 'upload',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Set your default logo. Upload or choose an existing one.',
        'sanitize' => ''
    ],
    'wpbeirut-logo-alternate' => [
        'title'    => 'Alternate logo',
        'type'     => 'upload',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Set your alternate logo. This can be used for an inverted background for example. Upload or choose an existing one.',
        'sanitize' => ''
    ],
    'wpbeirut-google-analytics' => [
        'title'    => 'Google Analytics Tracking ID',
        'type'     => 'text',
        'section'  => 'section-theme-settings',
        'default'  => '',
        'desc'     => 'Only enter your tracking ID in the format: UA-XXXXX-X. For example: UA-12345-6.',
        'sanitize' => 'google-analytics'
    ],
    'wpbeirut-search-bar' => [
        'title'    => 'Search Bar',
        'type'     => 'checkbox',
        'label'    => 'Display search bar in the site header.',
        'section'  => 'section-theme-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'wpbeirut-color-scheme' => [
        'title'    => 'Color Scheme',
        'type'     => 'radio',
        'children' => ['Light', 'Dark'],
        'section'  => 'section-styling-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'wpbeirut-font-pair' => [
        'title'    => 'Font Pair',
        'type'     => 'select',
        'children' => ['Modern', 'Classic', 'Futuristic', 'Thin', 'Narrow'],
        'section'  => 'section-styling-settings',
        'default'  => 0,
        'desc'     => '',
        'sanitize' => ''
    ],
    'wpbeirut-custom-css' => [
        'title'    => 'Custom CSS',
        'type'     => 'textarea',
        'section'  => 'section-styling-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'default'
    ],
    'wpbeirut-social-twitter' => [
        'title'    => 'Twitter Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'wpbeirut-social-facebook' => [
        'title'    => 'Facebook Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ],
    'wpbeirut-social-googleplus' => [
        'title'    => 'Google+ Profile',
        'type'     => 'text',
        'section'  => 'section-social-settings',
        'default'  => '',
        'desc'     => '',
        'sanitize' => 'full'
    ]
];





/******************************************************************************
 * 2. HOOKS
 *****************************************************************************/
add_action( 'after_setup_theme', 'wpbeirut_init_option' );
add_action( 'admin_menu', 'wpbeirut_update_menu' );
add_action( 'admin_init', 'wpbeirut_init_settings' );
add_action( 'admin_enqueue_scripts', 'wpbeirut_options_custom_scripts' );





/******************************************************************************
 * 3. RENDER FUNCTIONS
 *****************************************************************************/
/*
 * Renders a section description.
 */
function wpbeirut_render_section( $args ) {
    global $wpbeirut_sections;

    echo "<p>" . $wpbeirut_sections[ $args['id'] ]['desc'] . "</p>";
    echo "<hr />";
}

/*
 * Renders a field.
 */
function wpbeirut_render_field( $id ) {
    global $wpbeirut_fields;

    $options = get_option( 'wpbeirut_options' );

    // If options are not set yet for that ID, grab the default value.
    $field_value = isset( $options[ $id ] ) ? $options[ $id ] : wpbeirut_get_field_default( $id );

    // Generate HTML markup based on field type.
    switch ( $wpbeirut_fields[ $id ]['type'] ) {
        case 'text': 
            echo "<input type='text' name='wpbeirut_options[" . $id . "]' value='" . $field_value . "' />";
            echo "<p class='description'>" . $wpbeirut_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'upload':
            $visibility_class = ( '' != $field_value ) ? "" : "hide";

            echo "<img src='" . $field_value . "' alt='Logo' class='wpbeirut-custom-thumbnail " . $visibility_class . "' id='" . $id . "-thumbnail' />";
            echo "<input type='hidden' name='wpbeirut_options[" . $id . "]' id='" . $id . "-upload-field' value='" . $field_value . "' />";
            echo "<input type='button' class='btn-upload-img button' value='Upload logo' data-field-id='" . $id . "' />";
            echo "<input type='button' class='btn-remove-img button " . $visibility_class . "' value='Remove logo' data-field-id='" . $id . "' id='" . $id . "-remove-button' />";
            echo "<p class='description'>" . $wpbeirut_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'textarea': 
            echo "<textarea name='wpbeirut_options[" . $id . "]' cols='40' rows='10'>" . $field_value . "</textarea>";
            echo "<p class='description'>" . $wpbeirut_fields[ $id ]['desc'] . "</p>";
            
            break;

        case 'checkbox':
            echo "<input type='checkbox' name='wpbeirut_options[" . $id . "]' id='" . $id . "' value='1' " . checked( $field_value, 1, false ) . " />";
            echo "<label for='" . $id . "'>" . $wpbeirut_fields[ $id ]['label'] . "</label>";

            break;

        case 'radio': 
            // Generate as many radio buttons as there are children.
            for ( $i = 0; $i < sizeof( $wpbeirut_fields[ $id ]['children'] ); $i++ ) {
                echo "<p>";
                echo "<input type='radio' name='wpbeirut_options[" . $id . "]' id='wpbeirut_options[" . $id . "]-" . $i . "' value='" . $i . "' " . checked( $field_value, $i, false ) . " />";
                echo "<label for='wpbeirut_options[" . $id . "]-" . $i . "'>" . $wpbeirut_fields[ $id ]['children'][ $i ] . "</label>";
                echo "</p>";
            }

            break;

        case 'select': 
            echo "<select name='wpbeirut_options[" . $id . "]'>";
            for ( $i = 0; $i < sizeof( $wpbeirut_fields[ $id ]['children'] ); $i++ ) {
                echo "<option value='" . $i . "' " . selected( $field_value, $i, false ) . ">";
                echo $wpbeirut_fields[ $id ]['children'][ $i ];
                echo "</option>";
            }
            echo "</select>";

            break;
    }
}

/*
 * Renders the theme options page.
 */
function wpbeirut_render_theme_options() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have sufficient permissions to access this page.' );
    } ?>

    <div class="wrap">
        <h1>Theme options</h1>

        <?php settings_errors(); ?>

        <form action="options.php" method="post">
            <?php
                settings_fields( "wpbeirut_options" );
                do_settings_sections( "wpbeirut-theme-options" );
                echo "<hr />";
                submit_button();
            ?>
        </form>
    </div>
<?php }





/******************************************************************************
 * 4. SANITIZE FUNCTIONS
 *****************************************************************************/
/*
 * Sanitizes the settings.
 */
function wpbeirut_options_validate( $input ) {
    // Define a blank array for the output.
    $output = [];

    // Do a general sanitization for every field.
    foreach ( $input as $key => $value ) {
        // Grab the sanitize option for this field.
        $field_sanitize = wpbeirut_get_field_sanitize( $key );

        switch ( $field_sanitize ) {
            case 'default':
                $output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
                break;
            
            case 'full':
                $output[ $key ] = esc_url_raw( strip_tags( stripslashes( $input[ $key ] ) ) );
                break;

            case 'google-analytics':
                $output[ $key ] = ( preg_match('/^UA-[0-9]+-[0-9]+$/', $input[ $key ] ) ) ? $input[ $key ] : '';
                break;

            default:
                $output[ $key ] = $input[ $key ];
                break;
        }
    }

    return $output;
}





/******************************************************************************
 * 5. CUSTOM SCRIPTS
 *****************************************************************************/
/*
 * Registers and loads custom JavaScript and CSS.
 */
function wpbeirut_options_custom_scripts() {
    // Get information about the current page.
    $screen = get_current_screen();

    // Register a custom script that depends on jQuery, Media Upload and Thickbox (available from the Core).
    wp_register_script( 'wpbeirut-custom-admin-scripts', get_template_directory_uri() .'/wpbeirut-theme-options/js/wpbeirut-custom-admin-styles.js', array( 'jquery' ) );

    // Register custom styles.
    wp_register_style( 'wpbeirut-custom-admin-styles', get_template_directory_uri() .'/wpbeirut-theme-options/css/wpbeirut-custom-admin-styles.css' );
    

    // Only load these scripts if we're on the theme options page.
    if ( 'appearance_page_wpbeirut-theme-options' == $screen->id ) {
        // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
        wp_enqueue_media();
        
        // Load our custom scripts.
        wp_enqueue_script( 'wpbeirut-custom-admin-scripts' );

        // Load our custom styles.
        wp_enqueue_style( 'wpbeirut-custom-admin-styles' );
    }    
}





/******************************************************************************
 * 6. OTHER FUNCTIONS
 *****************************************************************************/
/*
 * Returns the default value of a field.
 */
function wpbeirut_get_field_default( $id ) {
    global $wpbeirut_fields;

    return $wpbeirut_fields[ $id ]['default'];
}

/*
 * Checks if the options exists in the database.
 */
function wpbeirut_init_option() {
    $options = get_option( 'wpbeirut_options' );

    if ( false === $options ) {
        add_option( 'wpbeirut_options' );
    }
}

/*
 * Creates a sub-menu under Appearance.
 */
function wpbeirut_update_menu() {
    add_theme_page( 'Theme options', 'Theme options', 'manage_options', 'wpbeirut-theme-options', 'wpbeirut_render_theme_options' );
}

/*
 * Registers and adds settings, sections and fields.
 */
function wpbeirut_init_settings() {
    // Declare $wpbeirut_sections and $wpbeirut_fields as global.
    global $wpbeirut_fields, $wpbeirut_sections;

    // Register a general setting.
    // The $option_group is the same as $option_name to prevent the "Error: options page not found." problem.
    register_setting( "wpbeirut_options", "wpbeirut_options", "wpbeirut_options_validate" );

    // Add sections as defined in the $wpbeirut_sections array.
    foreach ($wpbeirut_sections as $section_id => $section_value) {
        add_settings_section( $section_id, $section_value['title'], "wpbeirut_render_section", "wpbeirut-theme-options" );
    }

    // Add fields as defined in the $wpbeirut_fields array.
    foreach ($wpbeirut_fields as $field_id => $field_value) {
        add_settings_field( $field_id, $field_value['title'], "wpbeirut_render_field", "wpbeirut-theme-options", $field_value['section'], $field_id );
    }
}

/*
 * Returns the sanitize value of a field.
 */
function wpbeirut_get_field_sanitize( $id ) {
    global $wpbeirut_fields;

    return $wpbeirut_fields[ $id ]['sanitize'];
}