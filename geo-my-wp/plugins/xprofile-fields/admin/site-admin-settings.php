<?php $gmw_bp_comp = get_option( 'bp-active-components' ); if ( !isset($gmw_bp_comp['xprofile']) ) return; ?>
<?php function wppl_site_rf_admin_settings($wppl_site_options, $wppl_on) { ?>
<div>
	<table class="widefat">
		<thead>
			<th><h3><input type="button" class="wppl-edit-btn wppl-edit" value="<?php _e('+'); ?>"><?php echo _e('Xprofile Fields','wppl'); ?></h3></th>
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
							<span><?php _e('Xprofile fields integration: ', 'wppl'); ?> </span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
							<span class="wppl-premium-message"></span>
							<?php echo (!$wppl_on['friends']) ? '<span class="wppl-turnon-message"> (Turn on "Friends Finder" feature in the Add-ons page in order to use this feature)</span>' : ''; ?>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('- To start using this feature Check the checkbox and save the page in order to see the settings.<br />
								- This feature is integration of Buddypress Xprofile fields and members location. Two ways you can use this feature: 
								1)Create one address field where users can add their location.<br />
								2)Create multiple profile fields (you do not have to create all of them): street, apt, city,state,zipcode,country.<br />
								Once creating the fields that you want to use you need to enter the field IDs into the input fields below ("profile fields" setting). You Must use Either
								one field for the Full Address OR the multiple field. Once the "Full Address" input field has value the other fields would not count.
								If you want to use the feature as multiple field you MUST leave the "Full Address" field empty.   
								When done so, on registration or on the "edit" profile page, once a member enter his address and save it the fields will be geocoded and saved in the database.<br />
								- Checking the "Autocomplete" Checkbox will add autocomplete results from google to the "Full Address" field when using it.<br />
								- Checking the "Goggle address aaaautofill" checkbox will get the user current location once visit this page 
								and will autofill the address fields (needs supported browser).
								 ', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
							<input name="wppl_site_options[xprofile_address][useit]" type="checkbox" size="5" value="1" <?php if ( isset($wppl_site_options[xprofile_address][useit]) && $wppl_site_options[xprofile_address][useit] == 1) echo ' checked="checked"'; ?>/>
						</p>
					</td>
				</tr>
				
				<?php if ( isset($wppl_site_options['xprofile_address']['useit']) && $wppl_site_options['xprofile_address']['useit'] == 1) { ?>
							
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
						<span>
							<span><?php _e('Profile fields: ', 'wppl'); ?> </span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('Enter the field IDs into the input fields.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
							<div style="float:left;color:#222;font-weight:bold;margin-right:10px;"><?php echo _e('Profile Fields - names and IDs:','wppl'); ?>&#32;&#32;</div>
							<?php if($wppl_on['friends']) wppl_bp_admin_profile_fields_ids(); ?>
							<div class="clear" style="margin-bottom:10px;"></div>
							<p style="margin-top:15px;float:left">
							<span style="font-weight:bold;"><?php echo _e('Use Multiple Address fields', 'wppl'); ?></span><br />
							<?php echo _e('Street:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][street]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][street]) ? $wppl_site_options[xprofile_address][street] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<?php echo _e('Apt/Suit:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][apt]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][apt]) ? $wppl_site_options[xprofile_address][apt] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<?php echo _e('City:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][city]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][city]) ? $wppl_site_options[xprofile_address][city] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<?php echo _e('State:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][state]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][state]) ? $wppl_site_options[xprofile_address][state] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<?php echo _e('Zipcode:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][zipcode]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][zipcode]) ? $wppl_site_options[xprofile_address][zipcode] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<?php echo _e('Country:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][country]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][country]) ? $wppl_site_options[xprofile_address][country] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/><br />
							<br /><span style="font-weight:bold;"><?php echo _e('Or a Single Full Address Field', 'wppl'); ?></span><br />
							<?php echo _e('Full Address:','wppl'); ?>&#32;<input name="wppl_site_options[xprofile_address][address]" type="text" size="5" value="<?php echo ($wppl_site_options[xprofile_address][address]) ? $wppl_site_options[xprofile_address][address] : " "; ?>" <?php echo( !$wppl_on['friends'] ) ? " disabled" : "";?>/>
						</p>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
						<span>
							<span><?php _e('Google address autocomplete: ', 'wppl'); ?> </span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('When using the "Full Address" field this feature will autocomplete results using google autocomplete once the user start typing an address.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
							<input name="wppl_site_options[xprofile_address][autocomplete]" type="checkbox" size="5" value="1" <?php if ( isset( $wppl_site_options[xprofile_address][autocomplete]) && $wppl_site_options[xprofile_address][autocomplete] == 1) echo ' checked="checked"'; ?>/>
						</p>
					</td>
				</tr>
				
				<tr>
					<td>
					<div class="wppl-settings">
						<p>
						<span>
							<span><?php _e('Google address autofill: ', 'wppl'); ?> </span>
							<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
						</span>
						<div class="clear"></div>
							<span class="wppl-help-message">
								<?php _e('The browser will try to get the user current location and if found it will autofill the address fields.', 'wppl'); ?>
							</span>
						</p>
					</div>
					</td>
					<td  class="wppl-premium-version-only">
						<p>
							<input name="wppl_site_options[xprofile_address][autofill]" type="checkbox" size="5" value="1" <?php if ( isset( $wppl_site_options[xprofile_address][autofill]) && $wppl_site_options[xprofile_address][autofill] == 1) echo ' checked="checked"'; ?>/>
						</p>
					</td>
				</tr>
			<?php } ?>
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
<?php } add_action('wppl_site_main_settings_page', 'wppl_site_rf_admin_settings',2,2); ?>