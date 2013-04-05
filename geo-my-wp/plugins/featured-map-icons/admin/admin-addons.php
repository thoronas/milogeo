<?php function wppl_mi_addon_page($wppl_on) { ?>
<tr <?php if ( !isset( $wppl_on['post_types'] ) || $wppl_on['post_types'] != 1 ) echo ' class="addon-not-exist"'; ?>>
	<td>
		<div class="wppl-settings">
			<p>
			<span>
				<span><span class="add-on-image"><img src="" /></span><?php echo _e('Per Post Map Icon :'); ?></span>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('This feature will add the map icons to the "new/update post" page. Using that you can let your members or yourself choose 
				the icon that will display their location on the map. That is instead of having all results using the same icon. ', 'wppl'); ?>
			</span>
			</p>
		</div>
	</td>
	<td>
		<p style="color:brown; font-size:12px;"><input name="wppl_plugins[map_icons] " type="checkbox" value="1" <?php if ( isset( $wppl_on['map_icons'] ) && $wppl_on['map_icons'] == 1 ) echo ' checked="checked"'; ?>/></p>
	</td>
</tr>
<?php } add_action('wppl_addons_page_plugins', 'wppl_mi_addon_page', 11,1); ?>
