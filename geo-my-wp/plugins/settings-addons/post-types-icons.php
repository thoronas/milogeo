<?php function wppl_map_icons_main_settings_addon($wppl_on, $wppl_options, $posts, $pages) { ?>
<tr>
	<td>
	<div class="wppl-settings">
		<p>
		<span>
			<span><?php _e('Post types map icons:', 'wppl'); ?></span>
			<span><a href="#" class="wppl-help-btn"><img src="<?php echo plugins_url('/geo-my-wp/images/help-btn.png'); ?>" width="25px" height="25px" style="float:left;" /></a></span>
		</span>
		<div class="clear"></div>
			<span class="wppl-help-message">
				<?php _e('Assign map icon to each post type. Using that you will be able to display results on the map based on your post types.', 'wppl'); ?>
			</span>
		</p>
	</div>	
	</td>
	<td>		
		<?php foreach ($posts as $post_icon) { 	?>
		
				<div style="float:left;width:500px;">
				<input type="button" class="wppl-edit-btn wppl-icons-list-button" style="float:left;padding:2px;width:15px;" value="+">
					<span class="wppl-icons-list-name"><?php echo get_post_type_object($post_icon)->labels->name; ?>
					<br />
					<div class="wppl-icons-list" style="display:none;">
						<?php $map_icons = glob(GMW_PATH . '/map-icons/main-icons/*.png');
							$display_icon = GMW_URL . '/map-icons/main-icons/';
							foreach ($map_icons as $map_icon) {
								echo '<span style="float:left;"><input type="radio" name="wppl_fields[post_types_icons]['.$post_icon.']" value="'.basename($map_icon).'"'; echo ($wppl_options['post_types_icons'][$post_icon] == basename($map_icon) ) ? "checked" : ""; echo ' />
								<img src="'.$display_icon.basename($map_icon).'" height="23px" width="22px"/></span>';
							} ?>
					</div>
				</div>	
		 
			<?php	}	?>
	</td>
</tr>
<?php } add_action('wppl_main_settings_page_main', 'wppl_map_icons_main_settings_addon', 1, 4); ?>