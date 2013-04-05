<?php
//// Register near members widget ////
class wppl_near_members_widget extends WP_Widget {
	// Constructor //
		function wppl_near_members_widget() {
			$widget_ops = array( 'classname' => 'wppl_near_members_widget', 'description' => 'Displays near by members based on users location.' ); // Widget Settings
			$control_ops = array( 'id_base' => 'wppl_near_members_widget' ); // Widget Control Settings
			$this->WP_Widget( 'wppl_near_members_widget', 'GMW Near Members', $widget_ops, $control_ops ); // Create the widget
		}
	// Extract Args //
		function widget($args, $instance) {
			
			extract( $args );
			$near_post_type = array();
			$title 				= apply_filters('widget_title', $instance['title']); // the widget title
			$title_rand			= apply_filters('widget_title', $instance['title_rand']); // the widget title
			$near_radius 		= $instance['near_radius'];
			$posts_count 		= $instance['posts_count'];
			$near_units 		= $instance['near_units'];
			$near_sort 			= $instance['near_sort'];
			$near_image 		= $instance['near_image'];
			
			echo $before_widget;
			
			//if (!isset($_SESSION['wppl_members_widget']) || $_COOKIE['wppl_lat'] != $_SESSION['lat'] || $_COOKIE['wppl_long'] != $_SESSION['long'] ) $members_session_on = 0; else $members_session_on = 1;
			global $wpdb, $total_wp_users;
			$query_array = array();
			if( !isset($total_wp_users) ) $total_wp_users = $wpdb->get_col("SELECT $wpdb->users.ID FROM $wpdb->users");
			
			if ( isset($_COOKIE['wppl_lat']) && !empty($_COOKIE['wppl_lat']) ) {
				$query_array = array($near_units, urldecode($_COOKIE['wppl_lat']),urldecode($_COOKIE['wppl_long']),urldecode($_COOKIE['wppl_lat']));
				$query_array = array_merge($query_array, $total_wp_users, array($near_radius,$near_sort,$posts_count));
				
				$near_members = $wpdb->get_results(
									str_replace("'", "",$wpdb->prepare(
										"SELECT members.* , ROUND(%s * acos( cos( radians('%s') ) * cos( radians( members.lat ) ) * cos( radians( members.long ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( members.lat) ) ),1 )  AS distance
										FROM wppl_friends_locator  members
										WHERE members.member_id IN (".str_repeat("%d,", count($total_wp_users)-1) . "%d)		
										HAVING distance <= %d OR distance IS NULL ORDER BY %s LIMIT %d",$query_array
									))
								);        		
        		$exist = 1;
        		$title = $title;
        		
        	}
        	if ( !isset($_COOKIE['wppl_lat']) || empty($_COOKIE['wppl_lat']) || !isset($near_members) || empty($near_members)   ) {
        		$query_array = array_merge($total_wp_users, array($posts_count));
        		
				$near_members = $wpdb->get_results(
									$wpdb->prepare(
										"SELECT members.*
										FROM wppl_friends_locator  members
										WHERE members.member_id IN (".str_repeat("%d,", count($total_wp_users)-1) . "%d)		
										ORDER BY RAND() LIMIT %d ",$query_array
									)
								);
				$exist = 0;
				$title = $title_rand;      		
        	} 
        	
        	echo $before_title . $title . $after_title; 
			echo '<ul>';
			
			foreach ($near_members as $member) { ?>
				<li>
					<div class="wppl-near-member-single-member">
						<?php if($near_image) { ?>
							<div class="wppl-near-member-image-holder">
								<?php echo bp_core_fetch_avatar ( array( 'item_id' => $member->member_id, 'type' => 'full' ) ); ?>
							</div>
						<?php } ?>
						<div class="wppl-near-member-title-holder">
							<h3>
								<a href="<?php echo bp_core_get_user_domain( $member->member_id ); ?>"><?php echo bp_core_get_user_displayname( $member->member_id ); ?></a>
								<?php if($exist == 1) { ?>
									<span class="distance"><?php echo "(" . $member->distance; echo ($near_units == 3959) ? "Mi" : "Km";  ?>)</span></h3>
								<?php } else echo '</h3>'; ?>
						</div>
						<div class="wppl-near-member-address-holder">
							<span class="units"><?php echo $member->address; ?></span>
						</div>
					</div>
				</li>
			<?php } 
			echo '</ul>';
			
			echo $after_widget;
		}
	// Update Settings //
		function update($new_instance, $old_instance) {
		
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['title_rand'] 		= strip_tags($new_instance['title_rand']);
			$instance['near_radius'] 		= $new_instance['near_radius'];
			$instance['posts_count'] 		= $new_instance['posts_count'];
			$instance['near_units'] 		= $new_instance['near_units'];
			$instance['near_sort'] 			= $new_instance['near_sort'];
			$instance['near_image'] 		= $new_instance['near_image'];
			return $instance;
		}
	// Widget Control Panel //
		function form($instance) {
			$defaults = array( 'title' => 'Near Members', 'title_rand' => 'Random Members', 'near_radius' => 50, 'posts_count' => 5, 'near_units' => 3959 ,'near_sort' => "$distance", 'near_image' => 1);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
  			<p style="margin-bottom:10px; float:left;width:100%">
		    	<lable><?php _e( 'Title:', 'wppl' ); ?></lable>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" width="25" style="float: left;width: 100%;"/>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
		    	<lable><?php _e( 'Title if random (when near members not found):', 'wppl' ); ?></lable>
				<input type="text" name="<?php echo $this->get_field_name('title_rand'); ?>" value="<?php echo $instance['title_rand']; ?>" width="25" style="float: left;width: 100%;"/>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Number of members:', 'wppl'); ?></lable>
				<?php $pc = 0; ?>
				<select name="<?php echo $this->get_field_name('posts_count'); ?>" id="wppl-near-radius">
				<?php for ($i=1; $i< 11; $i++): 
					echo '<option value="'. $i .'"'; if ($i == $instance['posts_count']) :; echo 'selected="selected"' ; endif; echo '>'. $i . '</option>';
				endfor; ?>
				</select>
			</p>
			
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Radius:', 'wppl' ); ?></lable>	
				<input text name="<?php echo $this->get_field_name('near_radius'); ?>" size="3" value="<?php echo($instance['near_radius']) ? $instance['near_radius'] : '100'; ?>" />
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Units:', 'wppl' ); ?></lable>
				<select name="<?php echo $this->get_field_name('near_units'); ?>" id="wppl-near-units">
					<option value="3959" <?php if (3959 == $instance['near_units']) :; echo 'selected="selected"' ; endif; ?>>Miles</option>
					<option value="6371" <?php if (6371 == $instance['near_units']) :; echo 'selected="selected"' ; endif; ?>>Kilometers</option>
				</select>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Sort By:', 'wppl' ); ?></lable>
				<select name="<?php echo $this->get_field_name('near_sort'); ?>" id="wppl-near-sort">
					<option value="distance" <?php if ("distance" == $instance['near_sort']) :; echo 'selected="selected"' ; endif; ?>>Distance</option>
					<option value="RAND()" <?php if ("RAND()" == $instance['near_sort']) :; echo 'selected="selected"' ; endif; ?>>Random</option>
				</select>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php echo _e( 'Show Feature Image?', 'wppl' ); ?></lable>
				<input type="checkbox" value="1" name="<?php echo $this->get_field_name('near_image'); ?>" <?php if ($instance['near_image']) { echo 'checked="checked"' ;} ?>/>
			</p>
	<?php } 
	 }
add_action('widgets_init', create_function('', 'return register_widget("wppl_near_members_widget");'));

?>