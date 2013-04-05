<?php function wppl_sf_pt_shortcodes_before_address_field($wppl_on, $wppl_options, $option, $e_id) { ?>
<tr style=" height:40px;" class="post-types-yes" >
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-keywords-title-<?php echo $e_id; ?>"><?php echo  _e("Keywords search field"); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Check this checkbox to have a search field for post title. Note that this feature is new and still under development. if you having issues
						please uncheck the checkbox and report for a bug.', 'wppl'); ?>
			</span>
		</p>
	</div>		
	
	</td>
	<td>
		<p>
			<input type="checkbox" value="1" name="<?php echo 'wppl_shortcode[' .$e_id .'][keywords_field]'; ?>" <?php echo (isset($option['keywords_field'])) ? " checked=checked " : ""; ?>>	
			<?php echo _e('Yes:','wppl'); ?>
		</p>
	</td>
</tr>

<?php } add_action('wppl_sf_shortcodes_before_address_field', 'wppl_sf_pt_shortcodes_before_address_field', 1, 4); ?>
<?php function wppl_sf_pt_shortcodes_map_icons ($wppl_on, $wppl_options, $option, $e_id) { ?>
					
<tr style=" height:40px;" class="post-types-yes groups-not friends-not">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-display-results-<?php echo $e_id; ?>"><?php _e('Global map icon:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Choose the global icon for google map. All results will use this icon to show its location on the map unless you check the "per post icon" checkbox below.
						the map icons can be found in "/wp-content/plugins/geo-my-wp/map-icons/main-icons/". you can easily remove or add your own icons to this folder. ', 'wppl'); ?>
			</span>
		</p>
	</div>	
	</td>
	<td class="wppl-premium-version-only">
		<p style="float:left;width:500px;">
		<?php $map_icons = glob(GMW_PATH . '/map-icons/main-icons/*.png');
			$display_icon = GMW_URL . '/map-icons/main-icons/';
			foreach ($map_icons as $map_icon) {
				echo '<span style="float:left;"><input type="radio" name="wppl_shortcode[' .$e_id .'][map_icon]" value="'.basename($map_icon).'"'; echo ($option['map_icon'] == basename($map_icon) ) ? "checked" : ""; echo ' />
				<img src="'.$display_icon.basename($map_icon).'" height="40px" width="35px"/></span>';
			} ?>
		</p>	
	</td>
</tr>

<tr style=" height:40px;" class="post-types-yes groups-not friends-not">
	<td>
		<div class="wppl-settings">
		<p>
			<span>
				<label for="label-per-post-icon-<?php echo $e_id; ?>"><?php echo _e('Map icons usage:', 'wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Here you can choose the map\'s icons that will be used. <br />
						Global - will use the same map icon you choose above (global map icon) to show all results.<br />
						Per Post - will use the icons chooses for each post type in the edit/post page.
						Per post type - will use the icons by the post type of each result. You can choose map\'s icon for each of your post type in the "General Settings" in the settings page. ', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
		<input type="radio" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_icon_usage]'; ?>" value="same" <?php if ( isset($option['map_icon_usage']) && $option['map_icon_usage'] == 'same' ) echo ' checked="checked"'; ?>>
		<?php echo _e('Global','wppl'); ?>
		<input type="radio" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_icon_usage]'; ?>" value="per_post" <?php if ( isset($option['map_icon_usage']) && $option['map_icon_usage'] == 'per_post' ) echo ' checked="checked"'; ?>>
		<?php echo _e('Per Post','wppl'); ?>
		<input type="radio" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_icon_usage]'; ?>" value="per_post_type" <?php if ( isset($option['map_icon_usage']) && $option['map_icon_usage'] == 'per_post_type' ) echo ' checked="checked"'; ?>>
		<?php echo _e('Per post type','wppl'); ?>
		</p>
	</td>
</tr>
			
<tr style=" height:40px;" class="post-types-not groups-not friends-yes">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-display-results-<?php echo $e_id; ?>"><?php _e('Global map icon:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Choose the global icon for google map. All results will use this icon to show its location on the map unless you check the "per post icon" checkbox below.
				the members map icons can be found in "/wp-content/plugins/geo-my-wp/plugins/wppl-friends-locator/map-icons/". you can easily remove or add your own icons to this folder. ', 'wppl'); ?>
			</span>
		</p>
	</div>	
	</td>
	<td class="wppl-premium-version-only">
		<p style="float:left;width:500px;">
		<?php $map_icons = glob(GMW_FL_PATH . 'map-icons/*.png');
			$display_friends_icon = GMW_FL_URL . 'map-icons/';
			foreach ($map_icons as $map_icon) {
				echo '<span style="float:left;"><input type="radio" name="wppl_shortcode[' .$e_id .'][friends_map_icon]" value="'.basename($map_icon).'"'; echo ($option['friends_map_icon'] == basename($map_icon) ) ? 'checked="checked"' : ""; echo ' />
				<img src="'.$display_friends_icon.basename($map_icon).'" height="40px" width="35px"/></span>';
			} ?>
		</p>	
	</td>
</tr>

<tr style=" height:40px;">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-display-results-<?php echo $e_id; ?>"><?php _e('"Your location" icon:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Choose the icon that will show the user location on the map. the "your location" icons can be found in "/wp-content/plugins/geo-my-wp/map-icons/your-location-icons/". you can easily remove or add your own icons to this folder. ', 'wppl'); ?>
			</span>
		</p>
	</div>	
	</td>
	<td class="wppl-premium-version-only">
		<p style="float:left;width:500px;">
		<?php $yl_icons = glob(GMW_PATH . '/map-icons/your-location-icons/*.png');
			$display_yl_icon  = GMW_URL . '/map-icons/your-location-icons/';
			foreach ($yl_icons as $yl_icon) {
				echo '<span style="float:left;"><input type="radio" name="wppl_shortcode[' .$e_id .'][your_location_icon]" value="'.basename($yl_icon).'"'; echo ($option['your_location_icon'] == basename($yl_icon) ) ? ' checked="checked"' : ''; echo ' />
				<img src="'.$display_yl_icon.basename($yl_icon).'" height="40px" width="35px"/></span>';
			} ?>
		</p>	
	</td>
</tr>

<?php if ( isset($wppl_on['friends']) && $wppl_on['friends'] == 1 ) { ?>
	<tr style="height:40px;" class="post-types-not groups-not friends-yes">
		<td>
		<div class="wppl-settings">
			<p>
				<span>
					<label for="label-per-post-icon-<?php echo $e_id; ?>"><?php echo _e("Per member map's icon:", "wppl"); ?></label>
					<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
					<span class="wppl-premium-message"></span>
					<?php echo ( !isset($wppl_options['per_member_icon']) || empty($wppl_options['per_member_icon']) ) ? '<span class="wppl-turnon-message">(Check the "Allow members to choose map icon" in the main settings page in order to use this feature.)</span>' : ''; ?>
				</span>
				<div class="clear"></div>
				<span class="wppl-help-message">
					<?php _e('Check this checkbox if you want each member to use its own google map icon. ', 'wppl'); ?>
				</span>
			</p>
		</div>
		</td>
		<td class="wppl-premium-version-only">
			<p>
				<input type="checkbox" name="<?php echo 'wppl_shortcode[' .$e_id .'][per_member_icon]'; ?>" <?php echo ( isset($option['per_member_icon']) ) ? " checked=checked " : ""; echo ' value="1" '; echo((!$wppl_on['friends']) ||  (!$wppl_options['per_member_icon']) ) ? "disabled" : ""; ?>>
				<?php echo _e('Yes','wppl'); ?>
			</p>
		</td>
	</tr>
<?php } ?>
					
<tr style=" height:40px;" class="post-types-yes groups-not friends-not">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-posts-scroller-<?php echo $e_id; ?>"><?php echo _e('Random Featured posts :','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('will display number of random featured posts below the map and above the list of results. This way you can mark certain posts as "featured posts" in the admin section and those posts would always be displayed on top. Choose the number of featured posts to display and the width and height of each to make it fit to your site.  ', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
		<input type="checkbox" name="<?php echo 'wppl_shortcode[' .$e_id .'][random_featured_posts]'; ?>" <?php echo (isset($option['random_featured_posts'])) ? "checked=checked" : ""; echo ' value="1" '; echo( !$wppl_on['featured_posts']) ? "disabled" : "";?>>
		<?php echo _e('Show','wppl'); ?>
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		<?php echo _e('Number of posts:','wppl'); ?>
		&nbsp;<input type="text" size="1" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="<?php echo 'wppl_shortcode[' .$e_id .'][random_featured_count]'; ?>" <?php echo ($option['random_featured_count']) ? 'value="' . $option['random_featured_count'] . '"' : 'value="3"'; echo( !$wppl_on['featured_posts'] ) ? "disabled" : "";?>>
		<?php echo _e('width:','wppl'); ?>
		&nbsp;<input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" size="1" name="<?php echo 'wppl_shortcode[' .$e_id .'][random_featured_width]'; ?>" <?php echo ($option['random_featured_width']) ? 'value="' . $option['random_featured_width'] . '"' : 'value="200"'; echo( !$wppl_on['featured_posts'] ) ? "disabled" : "";?>>px
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		<?php echo _e('height:','wppl'); ?>
		&nbsp;<input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" size="1" name="<?php echo 'wppl_shortcode[' .$e_id .'][random_featured_height]'; ?>" <?php echo ($option['random_featured_height']) ? 'value="' . $option['random_featured_height'] . '"' : 'value="200"'; echo( !$wppl_on['featured_posts'] ) ? "disabled" : "";?>>px
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		</p>
	</td>
</tr>
			
<tr style=" height:40px;" class="post-types-yes groups-not friends-not">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-show-thumb-<?php echo $e_id; ?>"><?php echo _e('Mark featured posts:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Use this feature to mark featured post within the results list. It will display the image that you choose on top of each featured post.
				the featured images can be found in "/wp-content/plugins/geo-my-wp/plugins/featured-posts/images/". you can easily remove or add your own images to this folder. ', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p style="float:left;width:500px;">
			<span style="float:left">
				<input type="checkbox" name="<?php echo 'wppl_shortcode[' .$e_id .'][featured_posts]'; ?>" <?php echo (isset($option['featured_posts'])) ? "checked=checked" : ""; echo ' value="1" '; echo( !$wppl_on['featured_posts'] ) ? "disabled" : ""; ?>>
				<?php echo _e('Yes','wppl'); ?>
				&nbsp;&nbsp;&#124;&nbsp;&nbsp;
				<?php echo _e('Image:','wppl'); ?> 
			</span>	
			<span style="float:left;">
				<?php $map_icons = glob(plugin_dir_path(dirname(__FILE__)) . 'plugins/featured-posts/images/*.png');
				$display_icon = plugins_url('/geo-my-wp/plugins/featured-posts/images/');
				foreach ($map_icons as $map_icon) {
					echo '<span style="float:left;"><input type="radio" name="wppl_shortcode[' .$e_id .'][featured_posts_image]" value="'.basename($map_icon).'"'; echo ($option['featured_posts_image'] == basename($map_icon) ) ? "checked" : ""; echo ' />
					<img src="'.$display_icon.basename($map_icon).'" height="40px" width="35px"/></span>';
				} ?>
			</span>
		</p>	
	</td>
</tr>

<tr style=" height:40px;">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-show-thumb-<?php echo $e_id; ?>"><?php echo _e('Google map controls:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('This featured let you add a single map to each result in the results page with marker shows the location and marker shows the user location. This could be used instead or in addition to the main map. ', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][zoom]'; ?>" <?php if ($option['map_controls']['zoom'] == true) echo 'checked="checked"'; ?>>Zoom</br>
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][pan]'; ?>" <?php if ($option['map_controls']['pan']  == true) echo 'checked="checked"'; ?>>Pan </br>
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][scale]'; ?>" <?php if ($option['map_controls']['scale']  == true) echo 'checked="checked"'; ?>>Scale </br>
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][map_type]'; ?>" <?php if ($option['map_controls']['map_type']  == true) echo 'checked="checked"'; ?>>Map Type</br>
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][street_view]'; ?>" <?php if ($option['map_controls']['street_view']  == true) echo 'checked="checked"'; ?>>Street View</br>
			<!-- <input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][rotate]'; ?>" <?php if ($option['map_controls']['rotate']  == true) echo  'checked="checked"'; ?>>Rotate</br> -->
			<input type="checkbox"  value="true" name="<?php echo 'wppl_shortcode[' .$e_id .'][map_controls][overview]'; ?>" <?php if ($option['map_controls']['overview']  == true) echo 'checked="checked"'; ?>>Overview</br>
		</p>
	</td>
</tr>
	
<tr style=" height:40px;" class="post-types-yes groups-not friends-not">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-show-thumb-<?php echo $e_id; ?>"><?php echo _e('Per result google map:','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('This featured let you add a single map to each result in the results page with marker shows the location and marker shows the user location. This could be used instead or in addition to the main map. ', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
		<input type="checkbox" value="1" name="<?php echo 'wppl_shortcode[' .$e_id .'][single_map]'; ?>" <?php echo (isset($option['single_map'])) ? "checked=checked" : ""; ?>>
		<?php echo _e('Yes','wppl'); ?>
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		<?php echo _e('Height:','wppl'); ?>
		&nbsp;<input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="<?php echo 'wppl_shortcode[' .$e_id .'][single_map_height]'; ?>" value="<?php echo $option['single_map_height']; ?>" size="2">px
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		<?php echo _e('Width:','wppl'); ?>
		&nbsp;<input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="<?php echo 'wppl_shortcode[' .$e_id .'][single_map_width]'; ?>" value="<?php echo $option['single_map_width']; ?>" size="2">px
		&nbsp;&nbsp;&#124;&nbsp;&nbsp;
		<?php echo _e('Map Type:','wppl'); ?>&nbsp;				
		<select name="<?php echo 'wppl_shortcode[' .$e_id .'][single_map_type]'; ?>">
			<option value="ROADMAP" <?php echo ($option['single_map_type'] == "ROADMAP" ) ?'selected="selected"' : ""; ?>>ROADMAP</option>
			<option value="SATELLITE" <?php echo ($option['single_map_type'] == "SATELLITE" ) ?'selected="selected"' : ""; ?>>SATELLITE</option>
			<option value="HYBRID" <?php echo ($option['single_map_type'] == "HYBRID" ) ?'selected="selected"' : ""; ?>>HYBRID</option>
			<option value="TERRAIN" <?php echo ($option['single_map_type'] == "TERRAIN" ) ?'selected="selected"' : ""; ?>>TERRAIN</option>
		</select>
		</p>
	</td>
</tr>

<tr style=" height:40px;" class="post-types-not groups-not friends-yes">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-profile-fields-<?php echo $e_id; ?>"><?php echo _e('Show Profile fields','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Choose the profile fields that you want to display in each of the results.', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
		<?php if ($wppl_on['friends'])  wppl_bp_admin_profile_fields($e_id, $option, 'results_profile_fields'); ?>	
		</p>
	</td>
</tr>
					
<tr style=" height:40px;" class="post-types-not groups-not friends-yes">
	<td>
	<div class="wppl-settings">
		<p>
			<span>
				<label for="label-profile-fields-<?php echo $e_id; ?>"><?php echo _e('Addresss Fields','wppl'); ?></label>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
				<span class="wppl-premium-message"></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Choose the address fields to display for each member in the results.', 'wppl'); ?>
			</span>
		</p>
	</div>
	</td>
	<td class="wppl-premium-version-only">
		<p>
			<input type="checkbox"  value="street" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('street' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>Street </br>
			<input type="checkbox"  value="apt" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('apt' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>Apt/Suit </br>
			<input type="checkbox"  value="city" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('city' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>City </br>
			<input type="checkbox"  value="state" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('state' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>State</br>
			<input type="checkbox"  value="zipcode" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('zipcode' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>Zipcode</br>
			<input type="checkbox"  value="country" name="<?php echo 'wppl_shortcode[' .$e_id .'][member_address_fields][]'; ?>" <?php if ($option['member_address_fields']) echo (in_array('country' , ($option['member_address_fields']))) ? "checked=checked" : " "; ?>>Country</br>
		</p>
	</td>
</tr>
<?php } add_action('wppl_sf_shortcodes_after_map', 'wppl_sf_pt_shortcodes_map_icons', 1, 4); ?>
