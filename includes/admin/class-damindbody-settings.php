<?php
   /**
	* Plugin Name: DefineAwesome MindBody
	*
	* @since 1.2.0
	*/
	defined( 'ABSPATH' ) || exit; // Prevent Direct Access
   
   /**
	* Class DASettingsPage
	*
	* This Class will hold the page variables, layout and callbacks form
	* the DA MindBody Plugin setting page.
	*
	* @since 1.2.1
	*/
	class DASettingsPage
	{
		/**
		 * Holds the values to be used in the fields callbacks
		 */
		private $options;

		
		/**
		 * Start up
		 */
		public function __construct()
		{
			add_action( 'admin_menu', array( $this, 'settings_page' ) );
			add_action( 'admin_init', array( $this, 'setup_init' ) );
		}

		/**
		 * Add options page 
		 */
		public function settings_page()
		{
			// This page will be under "Settings"
			add_options_page(
				'#DefineAwesome MindBody Plugin', 
				'DA MindBody', 
				'manage_options', 
				'damb_main_settings', 
				array( $this, 'damb_admin_page' )
			);
		}

		/**
		 * Options page callback
		 */
		public function damb_admin_page()
		{
			?>
			<div class="wrap">
				<h1>MindBody Options</h1>
				<form method="post" action="options.php">
				<?php
					// This prints out all hidden setting fields
					settings_fields( 'damb_settings_group' );
					do_settings_sections( 'damb_main_settings' );
					submit_button();
				?>
				</form>
			</div>
			<?php
		}
	   /**
		 * Register and add settings
		 */
		public function setup_init()
		{ 	
			register_setting(
				'damb_settings_group', 		// Option group
				'damb_settings', 		// Option name
				array( $this, 'sanitize_checkbox' )
			);
			
			add_settings_section(
				'damb_check_section', 					// ID
				null, 									// Title
				null, 									// Callback
				'damb_main_settings' 					// Page
			);  

			add_settings_field(
				'damb_on_off_check', 					 // ID
				'Plugin Enabled?', 						 // Title 
				array( $this, 'onoff_toggle_callback' ), // Callback
				'damb_main_settings', 					 // Page
				'damb_check_section' 					 // Section           
			);      
			
		}
		
		    //checkbox sanitization function
        function sanitize_checkbox( $input ){
            //returns true if checkbox is checked
            return ( isset( $input['damb_on_off_check'] ) ? "checky-check" : "jjjj" );
        }
		
		
		/** 
		 * Get the settings option array and print one of its values
		 */
		public function onoff_toggle_callback()
		{
			$option = get_option( 'damb_on_off_check' );
			printf(
				'<input type="checkbox" id="damb_on_off_check" name="damb_settings[damb_on_off_check]" value="checky-check"' . 
					checked( "checky-check", $option, false) . 
				'/>'
			);	
		}
	}
	
new DASettingsPage();	
	
?>