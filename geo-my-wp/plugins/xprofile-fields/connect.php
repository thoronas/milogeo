<?php

define('GMW_RF_URL', GMW_URL . '/plugins/xprofile-fields/');
define('GMW_RF_PATH', GMW_PATH . '/plugins/xprofile-fields/');

if ( is_admin() && $blog_id == 1) include_once GMW_RF_PATH. 'admin/admin-addons.php';

if ( !isset( $wppl_on['xprofile'] ) || $wppl_on['xprofile'] != 1  ) return;

if ( is_admin() ) {
	include_once GMW_RF_PATH . 'admin/admin-functions.php';
	if (is_multisite() ) include_once GMW_RF_PATH . 'admin/site-admin-settings.php';
	else include_once GMW_RF_PATH . 'admin/admin-settings.php';
} else {
	include_once GMW_RF_PATH . 'functions.php';
}

function wppl_register_rf_scripts() {	
	wp_register_script( 'wppl-rf', GMW_RF_URL . 'js/rf.js',array(),false,true );
	wp_register_script( 'wppl-ac', GMW_RF_URL . 'js/autocomplete.js',array(),false,true );
}

add_action( 'wp_enqueue_scripts', 'wppl_register_rf_scripts' );
?>