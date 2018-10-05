<?php
	/*
	* Plugin Name: DefineAwesome MindBody
	* Description: The #DefineAwesome MindBody Solution for The Yoga Brief
	* Version: 1.2
	* Author: #DEFINE AWESOME;
	* Author URI: none
	*/

	if ( ! defined( 'ABSPATH' ) ) {
	exit; // Prevents anyone accessing this plugin directly!
	}

	// DAMB_PLUGIN, this constant is our FULL FILEPATH.
	if ( ! defined( 'DAMB_PLUGIN' ) ) {
		define( 'DAMB_PLUGIN', __FILE__ );
	}	
	
	// DAMB_PLUGIN_DIR, this is the directory where we will find our include files
	if ( ! defined( 'DAMB_PLUGIN_DIR' ) ) {
		define( 'DAMB_PLUGIN_DIR', untrailingslashit(dirname(DAMB_PLUGIN)));
	}
	
	// At this point, we will load our included files
	// TODO put this into it's own 'settings' file
	require_once DAMB_PLUGIN_DIR . '/includes/admin/damindbody-menu.php';
	require_once DAMB_PLUGIN_DIR . '/includes/admin/class-damindbody-settings.php';
	require_once DAMB_PLUGIN_DIR . '/includes/damindbody-table.php';
	require_once DAMB_PLUGIN_DIR . '/includes/damindbody-styles.php';
?>
	