<?php function wppl_pt_shortcodes_help($wppl_on) { ?>
<div class="wppl-shortcodes-help">
	<table class="widefat">
		<thead>
			<th><h3><input type="button" class="wppl-edit-btn wppl-shortcodes-help-btn" value="<?php _e('+'); ?>"><?php echo _e('Single location\'s map (post types)','wppl'); ?></h3></th>
			<th></th>
		</thead>
	</table>
	<div class="open-settings" style="float:left;display:none;width:100%">
		<table class="widefat">
			<tbody>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Copy and paste this code into the content area of a post to display the map of that location :','wppl'); ?></p>
					</td>
					<td>
						<code>[wppl_single_location]</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('copy and paste this code into any single page template to display the map of a single location :','wppl'); ?></p>
					</td>
					<td>
						<code> &#60;?php echo do_shortcode(&#39;[wppl_single_location]&#39;); ?&#62;</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Map height in pixels','wppl'); ?></p>
					</td>
					<td>
						<code>map_height=" "</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Map width in pixels','wppl'); ?></p>
					</td>
					<td>
						<code>map_width=" "</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Map type:','wppl'); ?></p>
					</td>
					<td>
						<code>map_type="ROADMAP | SATELLITE | HYBRID | TERRAIN "</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Show additional information (phone, fax, email,awbsite)','wppl'); ?></p>
					</td>
					<td>
						<code>show_info="0|1 "</code>
					</td>
				</tr>
				<tr>
					<td>
						<p><?php echo esc_attr_e('Shortcode example:','wppl'); ?></p>
					</td>
					<td>
						<code> &#60;?php echo do_shortcode(&#39;[wppl_single_location map_height="250" map_width="250" map_type="ROADMAP" show_info="1"]&#39;); ?&#62; </code>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<?php } add_action('wppl_shortcodes_help_page','wppl_pt_shortcodes_help',1,1); ?>