<?php
define('GMW_NL_URL', GMW_URL . '/plugins/near-locations-widget/');
define('GMW_NL_PATH', GMW_PATH . '/plugins/near-locations-widget/');

include_once GMW_NL_PATH . 'admin/admin-addons.php';

if ( !isset( $wppl_on['near_locations'] ) || $wppl_on['near_locations'] != 1 ) return;

include_once GMW_NL_PATH . 'near-locations-widget.php';
?>