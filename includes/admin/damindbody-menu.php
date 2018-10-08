<?php
   /**
	* Plugin Name: DefineAwesome MindBody
	*
	* @since 1.2.0
	*/
	defined( 'ABSPATH' ) || exit; // Prevent Direct Access

	// This hook will create our admin menu in the side-panel
	add_action('admin_menu', 'damb_add_pages');

   /**
	* Action function for the admin menu hook
	*
	* @since 1.2.0
	*/
	function damb_add_pages() {

		add_menu_page('#DefineAwesome MindBody Plugin', 'DA MindBody', 'manage_options', 'damb_main_settings', 'damb_settings_page' );
	}

   /**
	* This function dispays a message on the admin page if the user has accessed it illegally
	*
	* @since 1.2.0
	*/
	function damb_settings_page() {
		
		if(! is_admin() ){
			echo "<h2>" . __( 'You must be an Admin to make changes to this page', 'menu-test' ) . "</h2>";
		}
	}
?>