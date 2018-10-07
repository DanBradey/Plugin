<?php
   /**
	* Plugin Name: DefineAwesome MindBody
	*
	* @since 1.2.0
	*/
	defined( 'ABSPATH' ) || exit; // Prevent Direct Access

	// Hook for adding stylesheet
	wp_enqueue_style( 'table', DAMB_PLUGIN . '/assets/table.css' );
?>