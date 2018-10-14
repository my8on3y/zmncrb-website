<?php 
/*
*
*	***** time-table *****
*
*	This file initializes all TT Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('TT_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('TT_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('TT_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('TT_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function tt_register_core_css(){
wp_enqueue_style('tt-core', TT_CORE_CSS . 'tt-core.css',null,time('s'),'all');
};
add_action( 'wp_enqueue_scripts', 'tt_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function tt_register_core_js(){
// Register Core Plugin JS	
wp_enqueue_script('tt-core', TT_CORE_JS . 'tt-core.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'tt_register_core_js' );    
/*
*
*  Includes
*
*/ 
// Load the Functions
if ( file_exists( TT_CORE_INC . 'tt-core-functions.php' ) ) {
	require_once TT_CORE_INC . 'tt-core-functions.php';
}     
// Load the ajax Request
if ( file_exists( TT_CORE_INC . 'tt-ajax-request.php' ) ) {
	require_once TT_CORE_INC . 'tt-ajax-request.php';
} 
// Load the Shortcodes
if ( file_exists( TT_CORE_INC . 'tt-shortcodes.php' ) ) {
	require_once TT_CORE_INC . 'tt-shortcodes.php';
}