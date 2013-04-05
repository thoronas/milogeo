<?php
if( is_multisite() ) $wppl_af_options = get_site_option('wppl_site_options'); else $wppl_af_options = get_option('wppl_fields');
//// add users location from xprofile ////
function add_user_location_from_xprofile() {
	global $bp, $wpdb;
	if( is_multisite() ) $wppl_af_options = get_site_option('wppl_site_options'); else $wppl_af_options = get_option('wppl_fields');
	
	$user_id = $bp->loggedin_user->id;
	
	/* get address values from profile fields */
	if ( isset($wppl_af_options['xprofile_address']['address']) && !empty($wppl_af_options['xprofile_address']['address'] ) ) {
		$address = $address_apt = xprofile_get_field_data($wppl_af_options['xprofile_address']['address'], $user_id);
	} else {
		if ( isset($wppl_af_options['xprofile_address']['street'])  && !empty($wppl_af_options['xprofile_address']['street'] ) )   $street = xprofile_get_field_data($wppl_af_options['xprofile_address']['street'], $user_id);
		if ( isset($wppl_af_options['xprofile_address']['apt'])     && !empty($wppl_af_options['xprofile_address']['apt'] ) )      $apt = xprofile_get_field_data($wppl_af_options['xprofile_address']['apt'], $user_id);
		if ( isset($wppl_af_options['xprofile_address']['city'])    && !empty($wppl_af_options['xprofile_address']['city'] ) )     $city = xprofile_get_field_data($wppl_af_options['xprofile_address']['city'], $user_id);
		if ( isset($wppl_af_options['xprofile_address']['state'])   && !empty($wppl_af_options['xprofile_address']['state'] )  )   $state = xprofile_get_field_data($wppl_af_options['xprofile_address']['state'], $user_id);
		if ( isset($wppl_af_options['xprofile_address']['zipcode']) && !empty($wppl_af_options['xprofile_address']['zipcode'] )  ) $zipcode = xprofile_get_field_data($wppl_af_options['xprofile_address']['zipcode'], $user_id);
		if ( isset($wppl_af_options['xprofile_address']['country']) && !empty($wppl_af_options['xprofile_address']['country'] ) )  $country = xprofile_get_field_data($wppl_af_options['xprofile_address']['country'], $user_id);
		
		/* set the full address into "full address" profile fields */
		$address = $street . ' ' . $city . ' ' . $state . ' ' . $zipcode . ' ' . $country;
		$address_apt = $street . ' ' . $apt . ' ' . $city . ' ' . $state . ' ' . $zipcode . ' ' . $country;
		xprofile_set_field_data($wppl_af_options['xprofile_address']['address'], $user_id, $address); 
	}

	$returned_address = convertToCoords($address);
	
	if ( isset($returned_address['lat']) && !empty($returned_address['lat']) ) {
		
		$wpdb->replace('wppl_friends_locator', array( 
			'member_id'			=> $user_id,
			'street'			=> $returned_address['street'],
			'apt'				=> $apt,	
			'city' 				=> $returned_address['city'],
			'state' 			=> $returned_address['state_short'],
			'state_long' 		=> $returned_address['state_long'], 
			'zipcode'			=> $returned_address['zipcode'],
			'country' 			=> $returned_address['country_short'],
			'country_long'	 	=> $returned_address['country_long'],
			'address'			=> $address_apt,
			'formatted_address' => $returned_address['formatted_address'],
			'lat'				=> $returned_address['lat'],
			'long'				=> $returned_address['long'],
			'map_icon'			=> $_POST['map_icon']	
		));
	} 
}

if( isset( $wppl_af_options['xprofile_address']['useit'] ) && $wppl_af_options['xprofile_address']['useit'] == 1 ) add_action( 'xprofile_updated_profile', 'add_user_location_from_xprofile');

/* add the user's location with his first login after registration */
function add_location_first_login() {
	global $bp;
	if( is_multisite() ) $wppl_af_options = get_site_option('wppl_site_options'); else $wppl_af_options = get_option('wppl_fields');
	if ( is_user_logged_in() && !get_user_meta( $bp->loggedin_user->id, 'last_activity' ) && $wppl_af_options['xprofile_address']['useit'] ) add_user_location_from_xprofile();
}		
add_action('bp_init','add_location_first_login');

///// auto field up address into fields in registration form /////
function geo_fields_to_reg_form() {
	if( is_multisite() ) $wppl_af_options = get_site_option('wppl_site_options'); else $wppl_af_options = get_option('wppl_fields');	
	//wp_enqueue_script( 'wppl-maxmind');
	
	if ( isset($wppl_af_options['xprofile_address']['autocomplete']) && $wppl_af_options['xprofile_address']['autocomplete'] == 1 ) {
		wp_enqueue_script('wppl-ac');
		wp_enqueue_script( 'jquery-ui-autocomplete');
	}
	if ( isset($wppl_af_options['xprofile_address']['autofill']) && $wppl_af_options['xprofile_address']['autofill'] == 1 ) {
		wp_enqueue_script('wppl-rf');
	}
	
	wp_localize_script('wppl-rf', 'rFields', $wppl_af_options['xprofile_address']);
	wp_localize_script('wppl-ac', 'autoComp', '#field_' .$wppl_af_options['xprofile_address']['address']);

	echo '
		<div id="wppl-gf-map-holder" style="display:none">
			<div id="gf-map" style="height:210px;width:210px"></div>
		</div><!-- map holder -->';
}

if($wppl_af_options['xprofile_address']['useit']) { 
	add_filter('bp_before_registration_submit_buttons', 'geo_fields_to_reg_form');
	//add_filter('bp_after_profile_edit_content', 'geo_fields_to_reg_form');
}

/* display map icons in edit profile page */
function edit_profile_member_icon() { 
	global $bp, $wpdb;
	if( is_multisite() ) $wppl_af_options = get_site_option('wppl_site_options'); else $wppl_af_options = get_option('wppl_fields');
	$wppl_options = get_option('wppl_fields');
	
	if (bp_is_profile_edit() ) {
		$member_icon[0] = '_default';
	
		if( isset($wppl_options['per_member_icon']) && $wppl_options['per_member_icon'] == 1) {
			$member_icon = $wpdb->get_col( 
    					$wpdb->prepare("SELECT map_icon FROM wppl_friends_locator 
    					WHERE member_id = %s",
    					array($bp->loggedin_user->id)), 0 
    				); ?>
    				
 			<div class="edit-profile-icons-wrapper">
				<label>Choose your map's icon</label>
				<?php $map_icons = glob(GMW_FL_PATH . 'map-icons/*.png');
				$display_icon = GMW_FL_URL . 'map-icons/';
					foreach ($map_icons as $map_icon) {
						echo '<span style="float:left"><input type="radio" name="map_icon" value="'.basename($map_icon).'"'; echo ( $member_icon[0] == basename($map_icon) ) ? "checked" : ""; echo ' />
						<img src="'.$display_icon.basename($map_icon).'" height="40px" width="35px" /></span>';
					} ?>
			</div>
	<?php }
	}
}
if( isset( $wppl_af_options['xprofile_address']['useit'] ) && $wppl_af_options['xprofile_address']['useit'] == 1 ) {
add_action( 'bp_after_profile_field_content','edit_profile_member_icon' );
//add_filter('bp_before_registration_submit_buttons', 'edit_profile_member_icon');
}

?>