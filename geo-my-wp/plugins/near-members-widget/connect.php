<?php
define('GMW_NM_URL', GMW_URL . '/plugins/near-members-widget/');
define('GMW_NM_PATH', GMW_PATH . '/plugins/near-members-widget/');

include_once GMW_NM_PATH . 'admin/admin-addons.php';

if ( !isset( $wppl_on['near_members'] ) || $wppl_on['near_members'] != 1 ) return;

include_once GMW_NM_PATH . 'near-members-widget.php';
?>