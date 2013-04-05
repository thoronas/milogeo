<?php
//// REGISTER SINGLE LOCATION WIDGET ////
class wppl_single_location_widget extends WP_Widget {
		function wppl_single_location_widget() {
			$widget_location_ops = array( 'classname' => 'wppl_single_location_widget', 'description' => 'Display single location map' ); // Widget Settings
			$control_location_ops = array( 'id_base' => 'wppl_single_location_widget' ); // Widget Control Settings
			$this->WP_Widget( 'wppl_single_location_widget', 'GMW Single Post', $widget_location_ops, $control_location_ops ); // Create the widget
		}
		
		function widget($args, $instance) {
		
			extract( $args );
			$title 			= $instance['title']; // the widget title
			$map_height 	= $instance['map_height'];
			$map_width 		= $instance['map_width'];
			$map_type		= $instance['map_type'];
			$show_info		= $instance['show_info'];
			$zoom_level		= $instance['zoom_level'];
			$post_id		= $instance['post_id'];
			
			if ( $post_id != 0 || is_single() ) {
				global $post;
				
				if( isset($post_id) ) $post = get_post($post_id);
			
				// check if location exists in the post
				$ca = get_post_meta($post->ID, '_wppl_address', true);
				
				if(empty($ca)) return;
				
				echo $before_widget;

				//echo $before_title . $post->post_title . '&#39;s Location' . $after_title;
				if (isset($title) && !empty($title) ) echo $before_title . $title . $after_title;

        		echo do_shortcode('[wppl_single_location map_width="'.$map_width.'" map_height="'.$map_height.'" show_info="'.$show_info.'" map_type="'.$map_type.'" zoom_level="'.$zoom_level.'" post_id="'.$post_id.'"]');
				echo '<div class="clear"></div>';
				echo $after_widget;
			}
		}

	// Update Settings //
		function update($new_instance, $old_instance) {
			$instance['title'] 		= strip_tags($new_instance['title']);
			$instance['map_height'] 	= $new_instance['map_height'];
			$instance['map_width']		= $new_instance['map_width'];
			$instance['map_type']		= $new_instance['map_type'];
			$instance['show_info']		= $new_instance['show_info'];
			$instance['zoom_level']		= $new_instance['zoom_level'];
			$instance['post_id']		= $new_instance['post_id'];
			return $instance;
		}

	// Widget Control Panel //
		function form($instance) {
			$defaults = array( 'title' => 'Location');
			$instance = wp_parse_args( (array) $instance, $defaults ); 
			?>
			<p style="margin-bottom:10px; float:left;">
		    	<lable style="width:100%;float:left;"><?php echo  esc_attr( __( 'Widget Title:' ) ); ?></label>
		    	<span style="float:left;width:100%;">
					<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" size="25" />
				</span>
			</p>
			<p style="margin-bottom:10px; float:left;">
		    	<lable style="width:100%;float:left;"><?php echo  esc_attr( __( 'Map Width:' ) ); ?></label>
		    	<span style="float:left;width:100%;">
					<input type="text" name="<?php echo $this->get_field_name('map_width'); ?>" value="<?php echo $instance['map_width']; ?>" size="5" />px
				</span>
			</p>
			<p style="margin-bottom:10px; float:left;">
		    	<lable style="width:100%;float:left;"><?php echo  esc_attr( __( 'Map Height:' ) ); ?></lable>
				<span style="float:left;width:100%;">
					<input type="text" name="<?php echo $this->get_field_name('map_height'); ?>" value="<?php echo $instance['map_height']; ?>" size="5" style="float: left;width:"/>px
				</span>
			</p>
			<div class="clear"></div>
			<p style="margin-bottom:10px; float:left;width:100%">
		    	<?php echo '<input type="checkbox" value="1" name="'. $this->get_field_name('show_info').'"'; echo ($instance["show_info"] == "1" ) ? "checked=checked" : ""; echo 'width="25" style="float: left;margin-right:10px;"/>'; ?>
		    	<lable><?php echo  esc_attr( __( 'Show Location Information.' ) ); ?></lable>
			</p>
			<p>
			<lable><?php echo esc_attr( __( 'Zoom Level:' ) ); ?></lable>
				<select name="<?php echo $this->get_field_name('zoom_level'); ?>" style="float: left;width: 100%;">
					<?php for($i=1; $i< 18; $i++): ?>
					<option value="<?php echo $i; ?> " <?php if ($instance['zoom_level'] == $i) echo "selected"; ?>><?php echo $i; ?></option>
					<?php endfor; ?> 
				</select>
			</p>
			<p>
			<lable><?php echo esc_attr( __( 'Map Type:' ) ); ?></lable>
				<select name="<?php echo $this->get_field_name('map_type'); ?>" style="float: left;width: 100%;">
					<?php echo '<option value="ROADMAP"'; echo ($instance['map_type'] == "ROADMAP" ) ?'selected="selected"' : ""; echo '>ROADMAP</options>'; ?>
					<?php echo '<option value="SATELLITE"'; echo ($instance['map_type'] == "SATELLITE" ) ?'selected="selected"' : ""; echo '>SATELLITE</options>'; ?>
					<?php echo '<option value="HYBRID"'; echo ($instance['map_type'] == "HYBRID" ) ?'selected="selected"' : ""; echo '>HYBRID</options>'; ?>
					<?php echo '<option value="TERRAIN"'; echo ($instance['map_type'] == "TERRAIN" ) ?'selected="selected"' : ""; echo '>TERRAIN</options>'; ?>
				</select>
			</p>
			<p style="margin-bottom:10px; float:left;">
		    	<lable style="width:100%;float:left;"><?php echo  esc_attr( __( 'Post ID:' ) ); ?></lable>
				<span style="float:left;width:100%;">
					<input type="text" name="<?php echo $this->get_field_name('post_id'); ?>" value="<?php echo $instance['post_id']; ?>" size="5" style="float: left;width:"/>
				</span>
			</p><br />
	<?php } 
}
add_action('widgets_init', create_function('', 'return register_widget("wppl_single_location_widget");'));


