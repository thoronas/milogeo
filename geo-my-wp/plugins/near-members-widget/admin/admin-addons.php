<?php function wppl_nm_addon_page($wppl_on) { ?>
<tr <?php if ( !isset( $wppl_on['friends'] ) || $wppl_on['friends'] != 1 ) echo ' class="addon-not-exist"'; ?>>
	<td>
		<div class="wppl-settings">
			<p>
			<span>
				<span><span class="add-on-image"><img src="" /></span><?php echo _e('Near members Widget (Requier: Buddypress and Friends Locator add-on.) :', 'wppl'); ?></span>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Add a widget that will display number of members based on the users current location in the sidebar. The widget will look for the user current location if exist
				and will display results based on that. If user location is not exist or if no results found within the chosen distance then 
				random results will be displayed. ', 'wppl'); ?>
			</span>
			</p>
		</div>
	</td>
	<td>
		<p style="color:brown; font-size:12px;"><input name="wppl_plugins[near_members] " type="checkbox" value="1" <?php if ( isset( $wppl_on['near_members']) && $wppl_on['near_members'] == 1) echo ' checked="checked"'; ?>/></p>
	</td>
</tr>
<?php } add_action('wppl_addons_page_plugins', 'wppl_nm_addon_page', 3,1); ?>
