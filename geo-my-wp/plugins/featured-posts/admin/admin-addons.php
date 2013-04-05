<?php function wppl_fp_addon_page($wppl_on) { ?>
<tr <?php if ( !isset( $wppl_on['post_types'] ) || $wppl_on['post_types'] != 1 ) echo ' class="addon-not-exist"'; ?>>
	<td>
		<div class="wppl-settings">
			<p>
			<span>
				<span><span class="add-on-image"><img src="" /></span><?php echo _e('Featured Posts (Requiers: Post Types add-on.):'); ?></span>
				<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
			</span>
			<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('This feature will add a "featured post" checkbox to the "new/update" post page. This checkbox will be available only through admin access.
				using that you will be able to mark certain posts (maybe from paid members) as featured post. Then when creating a search form
				you will also have two checkboxes available. One that will let you display random featured post on top of the search results. And another checkbox that will let you mark the featured posts within the results. ', 'wppl'); ?>
			</span>
			</p>
		</div>
	</td>
	<td>
		<p style="color:brown; font-size:12px;"><input name="wppl_plugins[featured_posts] " type="checkbox" value="1" <?php if ( isset( $wppl_on['featured_posts'] ) && $wppl_on['featured_posts'] == 1 ) echo ' checked="checked"'; ?>/></p>
	</td>
</tr>
<?php } add_action('wppl_addons_page_plugins', 'wppl_fp_addon_page', 10,1); ?>
