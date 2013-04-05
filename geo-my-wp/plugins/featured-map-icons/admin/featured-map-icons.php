<?php
function wppl_add_map_icons_box() {
	$wppl_options = get_option('wppl_fields');
    if ($wppl_options['address_fields'] && current_user_can('manage_options')) {
    	foreach($wppl_options['address_fields'] as $page) {
        	add_meta_box('wppl-map-icons-meta-box', 'WP Places Locator Map Icons', 'wppl_show_map_icons_box', $page, 'normal', 'high');
   		}
   	}  
}	
add_action('admin_menu', 'wppl_add_map_icons_box');

function wppl_show_map_icons_box() {
  	global $wppl_map_icons_meta_box, $post;
  
  	echo 		'<table>';				
 	echo 			'<tr>';
 	echo 				'<th style="width:20%;vertical-align: top;text-align: left;"><label for="wppl-map-icons-post">Map Icons: </label></th>';
    echo				'<td>';
    						$map_icons = glob( GMW_PATH . '/map-icons/main-icons/*.png');
							$display_icon = GMW_URL . '/map-icons/main-icons/';
							foreach ($map_icons as $map_icon) {
	echo 						'<input type="radio" name="_wppl_map_icon" value="'.basename($map_icon).'"'; echo(get_post_meta($post->ID,'_wppl_map_icon',true) == basename($map_icon)) ? "checked" : ""; echo ' /><img src="'.$display_icon.basename($map_icon).'" height="40px" width="35px"/>';
							}
    echo				'</td>';
 	echo 			'</tr>';
	echo		'</table>';
}
?>
