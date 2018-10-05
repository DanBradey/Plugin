<?php
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
			echo '1';
			add_action( 'build_menu', array( $this, 'damb_admin_page') );
			add_action( 'admin_init', array( $this, 'page_init' ) );
			
			do_action('admin_init');
			do_action('build_menu');
		}

		/**
		 * Add options page 
		 TODO Remove
		 */
		public function add_plugin_page()
		{
			// This page will be under "Settings"
			add_options_page(
				'Settings Admin', 
				'My Settings', 
				'manage_options', 
				'my-setting-admin', 
				array( $this, 'damb_admin_page' )
			);
		}

		/**
		 * Options page callback
		 */
		public function damb_admin_page()
		{
			echo '2';
			
			
			// Set class property
			$this->options = get_option( 'my_option_name' );
			?>
			<div class="wrap">
				<h1>MindBody Options </h1>
				<form method="post" action="options.php">
				<?php
					// This prints out all hidden setting fields
					settings_fields( 'my_option_group' );
					do_settings_sections( 'damb_settings' );
					submit_button();
				?>
				</form>
			</div>
			<?php
		}
	   /**
		 * Register and add settings
		 */
		public function page_init()
		{ 
echo '3';		
			register_setting(
				'my_option_group', 						// Option group
				'my_option_name', 						// Option name
				array( $this, 'sanitize' ) 				// Sanitize
			);

			add_settings_section(
				'damb_main_settings', 					// ID
				null, 									// Title
				null, 									// Callback
				'damb_settings' 						// Page
			);  

			add_settings_field(
				'damb_on_off_check', 					// ID
				'Plugin Enabled?', 						// Title 
				array( $this, 'id_number_callback' ), 	// Callback
				'damb_settings', 						// Page
				'damb_main_settings' 					// Section           
			);      
			
			add_settings_field(
				'dd_number', // ID
				'Test', // Title 
				array( $this, 'dd_number_callback' ), // Callback
				'damb_settings', // Page
				'damb_main_settings' // Section           
			);   
		}

		/**
		 * Sanitize each setting field as needed
		 *
		 * @param array $input Contains all settings fields as array keys
		 */
		public function sanitize( $input )
		{
			$new_input = array();
			if( isset( $input['test'] ) )
				$new_input['test'] = absint( $input['test'] );

			return $new_input;
		}

		/** 
		 * Get the settings option array and print one of its values
		 */
		public function id_number_callback()
		{
			printf(
				'<input type="checkbox" id="damb_on_off_check" name="my_option_name[damb_on_off_check]" value="1"' . checked( 1, $options['damb_on_off_check'], false ) . '/>'
			);		
		}
		
		
		public function dd_number_callback()
		{
			printf(
				'<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
				isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
			);		
		}
	}
?>