<?php

define('GMW_SA_URL', GMW_URL . '/plugins/settings-addons/');
define('GMW_SA_PATH', GMW_PATH . '/plugins/settings-addons/');

if ( is_admin() ) {
	include_once GMW_SA_PATH . 'admin/admin-shortcodes.php';
	include_once GMW_SA_PATH . 'admin/admin-settings.php';
	include_once GMW_SA_PATH . 'post-types-icons.php';
	include_once GMW_SA_PATH . 'admin/help-shortcodes.php';
	if ( is_multisite() ) include_once GMW_SA_PATH . 'admin/site-admin-settings.php';
} else {
	include_once GMW_SA_PATH . 'template-functions.php';
}