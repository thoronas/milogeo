<?php function wppl_site_fl_admin_settings($wppl_site_options, $wppl_on) { ?>
<div>
	<table class="widefat">
		<thead>
			<th><h3><input type="button" class="wppl-edit-btn wppl-edit" value="<?php _e('+'); ?>"><?php echo _e('Buddypress - Members','wppl'); ?></h3></th>
			<th></th>
		</thead>
	</table>

	<div class="open-settings" style="float:left;display:none;width:100%">
		<table class="widefat fixed">
			<tbody>
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
						<span>
							<span><?php _e('Let members choose their map icon: ', 'wppl'); ?> </span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
							<span class="wppl-premium-message"></span>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('Checking this box will add a "Map icon" tab to the user "location" tab in his profile page. Use this when you want to let your members to choose their icon that will be displayed on the google map.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
						<input name="wppl_site_options[friends][per_member_icon] " type="checkbox" value="1" <?php if ($wppl_site_options['friends']['per_member_icon'] == 1) {echo "checked";}; ?>/>
						<?php echo _e('Yes','wppl'); ?>
						</p>
					</td>
				</tr>
				<?php if (!isset($wppl_site_options['friends']['my_location_tab']) || $wppl_site_options['friends']['my_location_tab'] != 1) { ?> 
				<tr>
					<td>
						<div class="wppl-settings">
							<p>
								<span>
									<span><?php echo _e('Addresss fields for "location" tab.','wppl'); ?></span>
									<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
									<span class="wppl-premium-message"></span>
								</span>
								<div class="clear"></div>
								<span class="wppl-help-message">
									<?php _e('Choose the address fields that you want to display in the "Location" tab for the logged in user.', 'wppl'); ?>
								</span>
							</p>
						</div>
					</td>
					<td class="wppl-premium-version-only">
						<p>
							<input type="checkbox"  value="street" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>"  <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('street' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Street </br>
							<input type="checkbox"  value="apt" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>"     <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('apt' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Apt </br>
							<input type="checkbox"  value="city" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>" 	 <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('city' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>City </br>
							<input type="checkbox"  value="state" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>"   <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('state' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>State </br>
							<input type="checkbox"  value="zipcode" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>" <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('zipcode' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Zipcode </br>
							<input type="checkbox"  value="country" name="<?php echo 'wppl_site_options[friends][location_tab_address_fields][]'; ?>" <?php if ( isset( $wppl_site_options['friends'][location_tab_address_fields]) && in_array('country' , $wppl_site_options['friends'][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Country </br>
						</p>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
						<span>
							<span><?php _e('Disable "Location" tab for logged in user: ', 'wppl'); ?></span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
							<span class="wppl-premium-message"></span>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('Checking this box will hide the "Location" tab for the logged in user. The "Location" tab
										give the user different ways to add his location: autolocate, by address, by latitude/longitude, Auotocomplete or drag and drop on the map.
										Check this checkbox if you do not want to use the "Location" tab and want to have it simple and use the "Xprofile fields integration" to let the user
										edit his location from the "Edit" profile page.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
							<input name="wppl_site_options[friends][my_location_tab]" type="checkbox" value="1" <?php if ( isset( $wppl_site_options['friends']['my_location_tab'] ) && $wppl_site_options['friends']['my_location_tab']== 1) echo ' checked="checked"'; ?>/>
						</p>
					</td>
				</tr>
				
				
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
							<span>
								<span><?php echo _e("Addresss in member's location widget and shortcode","wppl"); ?></span>
								<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
								<span class="wppl-premium-message"></span>
							</span>
							<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('Choose the address fields that you want to display in the "Member location" widget and shortcode.
								You can use if you do not want to display the full address of the members and keep it safe.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td class="wppl-premium-version-only">
						<p>
							<input type="checkbox"  value="street" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>"  <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('street' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Street </br>
							<input type="checkbox"  value="apt" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>"     <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('apt' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Apt </br>
							<input type="checkbox"  value="city" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>" 	 <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('city' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>City </br>
							<input type="checkbox"  value="state" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>"   <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('state' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>State </br>
							<input type="checkbox"  value="zipcode" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>" <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('zipcode' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Zipcode </br>
							<input type="checkbox"  value="country" name="<?php echo 'wppl_site_options[friends][single_location_address_fields][]'; ?>" <?php if ( isset( $wppl_site_options['friends'][single_location_address_fields]) && in_array('country' , $wppl_site_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Country </br>
						</p>
					</td>
				</tr>
					
				<tr>
					<td>
						<p><input name="Submit" class="wppl-save-btn" type="submit" value="<?php echo esc_attr_e('Save Changes'); ?>" /></p>
						<input type="hidden" name="wppl_admin_submit" value="wppl_submit" />
					</td>
					<td></td>
				</tr> 
			</tbody>
		</table>
	</div>
</div>
<?php  } add_action('wppl_site_main_settings_page', 'wppl_site_fl_admin_settings',1,2); ?>