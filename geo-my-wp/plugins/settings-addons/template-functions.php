<?php 
//// buddypress template functions ////
/////// ADDRESS ///////////
function wppl_bp_address($wppl, $single_user) {
	if ( !isset($wppl['member_address_fields']) || empty($wppl['member_address_fields']) ) return;
	$address = array();
	foreach ($wppl['member_address_fields'] as $field) {
		$address[] = $single_user->$field . ' ';
	}
	return implode(' ' , $address);
}

///////// PROFILE FIELDS //////////// 
function wppl_bp_user_profile_fields($wppl, $single_user, $total_results_fields) {
	if ( !isset($total_results_fields) || empty($total_results_fields) ) return;	
	echo '<div class="wppl-profile-fields-wrapper">';	
			foreach ($total_results_fields as $field_id) {		
				$field_data = new BP_XProfile_Field( $field_id );
				$field_value = xprofile_get_field_data($field_id, $single_user->member_id);
				
				if($field_data->type == 'datebox')  { $field_value = (date ("Y", time()) - $field_value) . ' Years old';  $field_data->name = 'Age';}
				
				echo '<div class="wppl-bp-field"><span>'.$field_data->name . ':</span> '; if($field_value) echo (is_array($field_value)) ? implode(', ' , $field_value) : $field_value; else echo 'N/A'; echo '</div>';		
			}
	echo '</div>';
}

function wppl_bp_directions($wppl, $single_user) {
	if ( !isset($wppl['get_directions']) || $wppl['get_directions'] != 1  || !isset($wppl['member_address_fields']) || empty($wppl['member_address_fields']) ) return;
	$directions_address = array();
	foreach ($wppl['member_address_fields'] as $field) {
		$directions_address[] = $single_user->$field;
	}		 	
	echo '<div class="bp-get-directions">'; 
	echo 	'<span><a href="http://maps.google.com/maps?f=d&hl=en&doflg=' . $wppl['units_array']['map_units'] . '&geocode=&saddr=' .$wppl['org_address'] . '&daddr=' . str_replace(" ", "+", implode(' ' , $directions_address)) . '&ie=UTF8&z=12" target="_blank">Get Directions</a></span>';
	echo '</div>';
}

//// post types template functions ////

//////// SINGLE MAPS ///////////
function wppl_single_map($wppl) {
	global $mc;
	if ( isset($wppl['single_map']) ) {
		echo '<div class="single-map" id="wppl-single-map-'.$mc.'" style="width:'.$wppl['single_map_width'].'px; height:'.$wppl['single_map_height'].'px"></div>';
		echo '<img class="map-loader" src="'.GMW_URL. '/images/map-loader.gif" style="position:absolute;top:45%;left:7%;"/>';
	}
}

/////// MARK FEATURED POSTS ////////
function wppl_featured_posts($wppl, $post) {
	if ( isset($wppl['featured_posts']) ) {
		echo '<style>span.wppl-featured-post { position: absolute;top: -10px;right: -40px;display: block;width: 100px;height: 100px;}.wppl-single-result {position:relative;}</style>';	
		if (get_post_meta($post->ID,'_wppl_featured_post',true) ==1 ) { 		 	
			echo '<span class="wppl-featured-post" style="background:url('.GMW_FP_URL .'images/'.$wppl['featured_posts_image'].') no-repeat"></span>';
		}
	}
}