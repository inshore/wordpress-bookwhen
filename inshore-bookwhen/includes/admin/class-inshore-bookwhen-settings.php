<?php
/**
 * RP_Analytics_Settings
 *
 * @package RP_Analytics_Settings
 * @since 1.0.1
 */

if ( ! function_exists( 'add_filter' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}

class InShore_Bookwhen_Settings
{
    public function __construct()
    {
        add_action( 'admin_init', array( $this, 'inshore_bookwhen_settings_init') );
        add_action( 'admin_menu', array( $this, 'inshore_bookwhen_options_page' ) );
    }

    /**
     * Registers a new settings page under Settings.
     */
    public function inshore_bookwhen_options_page() {
        add_menu_page(
            'inShore Bookwhen PHP SDK',
            'Bookwhen',
            'manage_options',
            'bookwhen',
            array($this, 'inshore_bookwhen_options_page_html')
        );
    }
    
    public function inshore_bookwhen_settings_init() {
        // Register a new setting for "wporg" page.
        register_setting( 'bookwhen', 'bookwhen_options' );
        
        // Register a new section in the "wporg" page.
        add_settings_section(
            'inshore_bookwhen_api_key',
            __( 'Bookwhen API Key', 'bookwhen' ), 
            array($this, 'inshore_bookwhen_api_key_callback'),
            'bookwhen'
            );
        
        // Register a new field in the "wporg_section_developers" section, inside the "wporg" page.
        add_settings_field(
            'wporg_field_pill', // As of WP 4.6 this value is used only internally.
            // Use $args' label_for to populate the id inside the callback.
            __( 'Pill', 'bookwhen' ),
            'wporg_field_pill_cb',
            'wporg',
            'wporg_section_developers',
            array(
                'label_for'         => 'wporg_field_pill',
                'class'             => 'wporg_row',
                'wporg_custom_data' => 'custom',
            )
        );
    }
    
    
    /**
     * Developers section callback function.
     *
     * @param array $args  The settings array, defining title, id, callback.
     */
    function inshore_bookwhen_api_key_callback( $args ) {
        ?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
	<?php
}
    /**
     * Top level menu callback function
     */
    public function inshore_bookwhen_options_page_html() {
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        
        // add error/update messages
        
        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
        }
        
        // show error/update messages
        settings_errors( 'wporg_messages' );
        ?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wporg"
			settings_fields( 'wporg' );
			// output setting sections and their fields
			// (sections are registered for "wporg", each field is registered to a specific section)
			do_settings_sections( 'wporg' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}
}

new InShore_Bookwhen_Settings();
