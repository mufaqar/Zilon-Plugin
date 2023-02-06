<?php 
/*
*
*	***** ZilonHub Integration *****
*
*	This file initializes all MOI Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('MOI_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('MOI_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('MOI_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('MOI_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
define('MOI_CORE_VIEWS',dirname( __FILE__ ).'/assets/views/');
define('MOI_API_END_POINT', 'https://dev-connect.azure-api.net');
define('MOI_END_POINT', 'https://dev-connect.azure-api.net');
/*
*
*  Register CSS
*
*/

function moi_enqueued_assets(){
	wp_enqueue_style('moi-core', MOI_CORE_CSS . 'moi-core.css',null,time(),'all');
	wp_enqueue_script('moi-core', MOI_CORE_JS . 'moi-core.js','jquery',time(),true);
	wp_localize_script('moi-core', 'moi_core_ajax', array( 
		'ajax_url'   => admin_url( 'admin-ajax.php' ),
		'ajax_nonce' => wp_create_nonce( 'moi_ajax_nonce' )
	));
};
add_action( 'admin_enqueue_scripts', 'moi_enqueued_assets' );
add_action( 'wp_enqueue_scripts', 'moi_enqueued_assets' );
//add_action( 'wp_enqueue_scripts', 'moi_enqueued_assets' );



/*
*
*  Includes
*
*/


// Load the helper
if ( file_exists( MOI_CORE_INC . 'moi-helper.php' ) ) {
	require_once MOI_CORE_INC . 'moi-helper.php';
}

// Load the Functions
if ( file_exists( MOI_CORE_INC . 'moi-core-functions.php' ) ) {
	require_once MOI_CORE_INC . 'moi-core-functions.php';
}     
// Load the ajax Request
if ( file_exists( MOI_CORE_INC . 'moi-ajax-request.php' ) ) {
	require_once MOI_CORE_INC . 'moi-ajax-request.php';
} 





