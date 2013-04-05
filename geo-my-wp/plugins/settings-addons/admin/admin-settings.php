<?php function wppl_fl_admin_settings($wppl_options, $wppl_on, $posts, $pages_s) { ?>		
	<?php if ( !is_multisite() ) { ?>
		<?php if (!isset($wppl_options['friends']['my_location_tab']) || $wppl_options['friends']['my_location_tab'] != 1) { ?> 
			<tr>
				<td>
				<div class="wppl-settings">
					<p>
					<span>
						<span><?php _e('Let members choose their map icon: ', 'wppl'); ?> </span>
						<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
						<span class="wppl-premium-message"></span>
						<?php echo (!$wppl_on['friends']) ? '<span class="wppl-turnon-message"> (Turn on "Friends Finder" feature in the Add-ons page in order to use this feature)</span>' : ''; ?>
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
					<input name="wppl_fields[friends][per_member_icon] " type="checkbox" value="1" <?php if ($wppl_options['friends']['per_member_icon'] == 1) {echo "checked";}; ?>/>
					<?php echo _e('Yes','wppl'); ?>
					</p>
				</td>
			</tr>
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
						<input type="checkbox"  value="street" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>"  <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('street' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Street </br>
						<input type="checkbox"  value="apt" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>"     <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('apt' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Apt </br>
						<input type="checkbox"  value="city" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>" 	 <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('city' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>City </br>
						<input type="checkbox"  value="state" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>"   <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('state' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>State </br>
						<input type="checkbox"  value="zipcode" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>" <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('zipcode' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Zipcode </br>
						<input type="checkbox"  value="country" name="<?php echo 'wppl_fields[friends][location_tab_address_fields][]'; ?>" <?php if ( isset( $wppl_options[friends][location_tab_address_fields]) && in_array('country' , $wppl_options[friends][location_tab_address_fields]) ) echo ' checked="checked"'; ?>>Country </br>
					</p>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<td>
			<div class="wppl-settings">
				<p>
				<span>
					<span><?php _e('Disable "Location" tab for logged in user: ', 'wppl'); ?> </span>
					<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
					<span class="wppl-premium-message"></span>
				</span>
				<div class="clear"></div>
					<span class="wppl-help-message">
						<?php _e('Checking this box will hide the "Location" tab for the logged in user. The "Location" tab
									give the user different ways to add his location: autolocate, by address, by latitude/longitude, Auotocomplete or drag and drop on the map.
									Check this checkbox if you do not want to use the "Location" tab and want to have it simple and use the "Xprofile fields integration" to let the user.  ', 'wppl'); ?>
					</span>
				</p>
			</div>
			</td>
			<td  class="wppl-premium-version-only">
				<p>
				<input name="wppl_fields[friends][my_location_tab]" type="checkbox" value="1" <?php if ($wppl_options[friends]['my_location_tab'] == 1) {echo "checked";}; ?>/>
				<?php echo _e('Yes','wppl'); ?>
				</p>
			</td>
		</tr>
		
		<tr>
			<td>
			<div class="wppl-settings">
				<p>
					<span>
						<label for="label-profile-fields-<?php echo $e_id; ?>"><?php echo _e("Addresss in member's location widget and shortcode","wppl"); ?></label>
						<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
						<span class="wppl-premium-message"></span>
					</span>
					<div class="clear"></div>
					<span class="wppl-help-message">
						<?php _e('Choose the address fields that you want to display.', 'wppl'); ?>
					</span>
				</p>
			</div>
			</td>
			<td class="wppl-premium-version-only">
				<p>
					<input type="checkbox"  value="street" name="wppl_fields[friends][single_location_address_fields][]"  <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('street' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Street </br>
					<input type="checkbox"  value="apt" name="wppl_fields[friends][single_location_address_fields][]"     <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('apt' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Apt </br>
					<input type="checkbox"  value="city" name="wppl_fields[friends][single_location_address_fields][]"    <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('city' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>City </br>
					<input type="checkbox"  value="state" name="wppl_fields[friends][single_location_address_fields][]"   <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('state' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>State </br>
					<input type="checkbox"  value="zipcode" name="wppl_fields[friends][single_location_address_fields][]" <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('zipcode' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Zipcode </br>
					<input type="checkbox"  value="country" name="wppl_fields[friends][single_location_address_fields][]" <?php if ( isset( $wppl_options['friends'][single_location_address_fields]) && in_array('country' , $wppl_options['friends'][single_location_address_fields]) ) echo ' checked="checked"'; ?>>Country </br>
				</p>
			</td>
		</tr>			
	<?php } ?>				
<?php } add_action('wppl_fl_settings_page', 'wppl_fl_admin_settings', 2,4); ?>