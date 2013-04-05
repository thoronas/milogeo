<?php
///// ADD FEATURED POST ADMIN BOX  //////
function wppl_add_feature_box() {
	$wppl_options = get_option('wppl_fields');	
    if ($wppl_options['address_fields'] && current_user_can('manage_options')) {
    	foreach($wppl_options['address_fields'] as $page) {
        	add_meta_box('wppl-feature-meta-box', 'WP Places Locator Feature Post', 'wppl_show_feature_box', $page, 'normal', 'high');
   		}
   	}  
}
add_action('admin_menu', 'wppl_add_feature_box');

function wppl_show_feature_box() {
   	global $wppl_feature_meta_box, $post;
    $wppl_options = get_option('wppl_fields');
  	echo 		'<table>';				
 	echo 			'<tr>';
 	echo 				'<th style="width:20%"><label for="wppl-feature-post">Featured Post: </label></th>';
    echo				'<td>';
    echo				'<input type="checkbox" name="_wppl_featured_post" id="_wppl_featured_post" value="1"'; echo(get_post_meta($post->ID,'_wppl_featured_post',true) == 1) ? "checked" : "" ; echo ' style="width:97%" />';
    echo				'</td>';
 	echo 			'</tr>';
	echo		'</table>';
}	
?>