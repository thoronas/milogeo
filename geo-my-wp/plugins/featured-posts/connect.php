<?php
define('GMW_FP_URL', GMW_URL . '/plugins/featured-posts/');
define('GMW_FP_PATH', GMW_PATH . '/plugins/featured-posts/');

include_once GMW_FP_PATH . 'admin/admin-addons.php';

if ( !isset( $wppl_on['featured_posts'] ) || $wppl_on['featured_posts'] != 1 ) return;

if (is_admin() &&  (in_array( basename($_SERVER['PHP_SELF']), array( 'post-new.php', 'post.php','page.php','page-new' ) ) ) )include_once GMW_FP_PATH . 'admin/featured-posts-admin.php';
?>