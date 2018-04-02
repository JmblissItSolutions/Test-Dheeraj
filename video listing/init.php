<?php
/*
Plugin Name: 	Videos Listing
Plugin URI: 	http://jmbliss.com
description: 	Plugin to create listing of videos
Version: 		1.2
Author: 		Dheeraj Gour
Author URI: 	http://jmbliss.com
Text Domain:	video_listing
*/

// No Direct script Allowed
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
// Directory Paths
define( 'VL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'VL_DIR_PATH', plugin_dir_url( __FILE__ ) );


// Include classes file
require_once( VL_PLUGIN_PATH . 'classes/main_class.php' );

global $vlist;
$vlist = new VL_CLASS_Main();

// register_activation_hook( __FILE__ ,  array( 'VL_CLASS_Main' , 'activate') );
register_deactivation_hook( __FILE__, array( 'VL_CLASS_Main', 'deactivate' ) );
?>