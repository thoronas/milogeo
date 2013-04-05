<?php function wppl_rf_addon_page($wppl_on) { ?>
<?php global $gmw_bp_comp; ?>
<tr <?php if ( !isset( $wppl_on['friends'] ) || $wppl_on['friends'] != 1 || !isset($gmw_bp_comp['xprofile']) || $gmw_bp_comp['xprofile'] != 1 ) echo ' class="addon-not-exist"'; ?>>
	<td>
	<div class="wppl-settings">
		<p>
		<span>
			<span><span class="add-on-image"><img src="" /></span><?php echo _e('Xprofile Fields Integration: (Requiers: <a href="'.$site_url.'">Buddypress</a>, Friends Locator add-on and "Extended Profiles" component.):','wppl'); ?></span>
			<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
		</span>
		<div class="clear"></div>
		<span class="wppl-help-message">
			<?php _e('Will integrate the users location with Buddypress Xprofile fields. Using this feature your Buddypress members will
			be able to add their location while registering. Moreover, they will be able to edit their location using the profile "Edit" page or from the "Locations" tab in the profile page.
			once modifying the location in the "location" tab it will also be modified in the Xprofile fields and vice versa. On a single Wordpress installation, Once checking this checkbox the settings will be added
			to the GEO my WP "settings" page and on a Network Wordpress installation the settings will show in the Network site admin.', "wppl"); ?>
		</span>
		</p>
	</div>
	</td>		
	<td>
		<p style="color:brown; font-size:12px;"><input name="wppl_plugins[xprofile] " type="checkbox" value="1" <?php if ( isset($wppl_on['xprofile']) && $wppl_on['xprofile'] == 1 ) echo ' checked="checked"'; ?>/></p>
	</td>
</tr>
<?php } add_action('wppl_addons_page_plugins', 'wppl_rf_addon_page', 4,1); ?>