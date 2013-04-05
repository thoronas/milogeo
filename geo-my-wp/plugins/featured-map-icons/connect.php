<?php
/*
Plugin Name: Featured map's icons add-on
Plugin URI: http://www.geomywp.com 
Description: Adds the ability to choose a map icon for each post..
Author: Eyal Fitoussi
Version: 2.0
Author URI: http://www.geomywp.com 

*/

define('GMW_MI_URL', GMW_URL . '/plugins/featured-map-icons/');
define('GMW_MI_PATH', GMW_PATH . '/plugins/featured-map-icons/');

include_once GMW_MI_PATH . 'admin/admin-addons.php';

if ( !isset( $wppl_on['map_icons'] ) || $wppl_on['map_icons'] != 1 ) return;

if ( is_admin() ) include_once GMW_MI_PATH . 'admin/featured-map-icons.php';
?>