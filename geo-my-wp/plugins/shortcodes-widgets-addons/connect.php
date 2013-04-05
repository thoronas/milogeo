<?php
define('GMW_SW_URL', GMW_URL . '/plugins/shortcodes-widgets-addons/');
define('GMW_SW_PATH', GMW_PATH . '/plugins/shortcodes-widgets-addons/');

if ( isset( $wppl_on['post_types'] ) || $wppl_on['post_types'] == 1 ) include_once GMW_SW_PATH . 'post-types.php';

?>