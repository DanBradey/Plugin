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
	* @since 1.2.0
	*/
	function damb_add_pages() {
		
		add_menu_page('#DefineAwesome MindBody Plugin', 'DA MindBody', 'manage_options', 'damb_settings', 'damb_settings_page');
	}

   /**
	* This function dispays data on admin the menu page, using a DASettingsPage Class
	* @since 1.2.0
	*/
	function damb_settings_page() {
		
		if( is_admin() ){
			$my_settings_page = new DASettingsPage();
		}
		else {
			echo "<h2>" . __( 'You must be an Admin to make changes to this page', 'menu-test' ) . "</h2>";
		}
	}
?>