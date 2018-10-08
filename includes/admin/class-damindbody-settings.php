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
		 *
		 * @since 1.2.1
		 */
		private $options;

		/**
		 * Add the 'admin_menu' and 'admin_init' hooks, WP calls these to build the menu
		 * so we are hooking into that process here.
		 *
		 * @since 1.2.1
		 */
		public function __construct()
		{
			add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( $this, 'page_init' ) );
		}

		/**
		 * Adds the options page to the site, note it is registered as the 
		 * top level page, so we don't have an annoying subpages
		 *
		 * @since 1.2.1
		 */
		public function add_plugin_page()
		{
			add_options_page(
				'#DefineAwesome MindBody Plugin', 
				'DA MindBody', 
				'manage_options', 
				'damb_main_settings', 
				array( $this, 'damb_admin_page' )
			);
		}

		/**
		 * Our 'add_options_page' function will call this,
		 * this will build our admin page!
		 *
		 * @since 1.2.1
		 */
		public function damb_admin_page()
		{
			// Set class property
			$this->options = get_option( 'damb_settings' );
			
			?>
			<div class="wrap">
				<h1>MindBody Options</h1>
				<form method="post" action="options.php">
				<?php
					// These are our settings section callbacks!
					settings_fields( 'damb_settings_group' );
					do_settings_sections( 'damb_main_settings' );
					submit_button();
				?>
				</form>
			</div>
			<?php
		}

		/**
		 * Registering settings allows us to send settings to 'Options.php'
		 * which is where WP stores admin options for themes and plugins!
		 * 
		 * These must be registered, as WP must 'whtelist' any attempts to modify
		 * the options table in the DB.
		 *
		 * @since 1.2.1
		 */
		public function page_init()
		{        
			// Here we register a group of options 
			register_setting(
				'damb_settings_group', 					// Option group
				'damb_settings', 						// Option name
				array( $this, 'sanitize' ) 				// Sanitize
			);

			// A section of settings, within our options group
			add_settings_section(
				'damb_check_section', 					// ID
				null, 									// Title
				null, 									// Callback
				'damb_main_settings' 					// Page
			);  

			add_settings_field(
				'damb_disable_button', 					// ID
				'Disable Plugin?', 						// Title 
				array( $this, 'onoff_toggle_callback' ),// Callback
				'damb_main_settings', 					// Page
				'damb_check_section' 					// Section           
			);           
		}

		/**
		 * Sanitize fields on submit
		 *
		 * @param array $input Contains all settings fields as array keys
		 *
		 * @since 1.2.1
		 */
		public function sanitize( $input )
		{
			$new_input = array();

			//returns true if checkbox is checked
            if ( isset( $input ))
			{
				$new_input['damb_disable_button'] = 1; 
			}
			else
			{
				$new_input['damb_disable_button'] = 0; 
			}
			
			return $new_input;
		}

		/** 
		 * Here we will 'print' a setting option (a checkbox)
		 * The result will be registered against the value in the option group
		 *
		 * @since 1.2.1
		 */
		public function onoff_toggle_callback()
		{
			printf(
			
				'<input type="checkbox" id="damb_disable_button" name="damb_settings[damb_disable_button]" value="1"' . 
					checked( 1, $this->options['damb_disable_button'], false) . 
				'/>'
			);
		}
	}
	
	// We only want this to run if the user is an admin!
	if( is_admin() )
		$my_settings_page = new DASettingsPage();
	

?>