<?php
//// Register near locations widget ////
class wppl_near_location_widget extends WP_Widget {
	// Constructor //
		function wppl_near_location_widget() {
			$widget_ops = array( 'classname' => 'wppl_near_location_widget', 'description' => 'Displays near by locations based on users location in the sidebar' ); // Widget Settings
			$control_ops = array( 'id_base' => 'wppl_near_location_widget' ); // Widget Control Settings
			$this->WP_Widget( 'wppl_near_location_widget', 'GMW Near Locations', $widget_ops, $control_ops ); // Create the widget
		}
	// Extract Args //
		function widget($args, $instance) {
		global $wppl_on;
			
			$where = false;
			$posts_count = 5;
			
			extract( $args );
			$near_post_type 	= array();
			$title 				= apply_filters('widget_title', $instance['title']); // the widget title
			$title_rand			= apply_filters('widget_title', $instance['title_rand']); // the widget title
			$near_post_type 	= $instance['near_post_type'];
			$near_radius 		= $instance['near_radius'];
			$posts_count 		= $instance['posts_count'];
			$near_units 		= $instance['near_units'];
			$near_sort 			= $instance['near_sort'];
			$near_image 		= $instance['near_image'];
			$near_feature 		= $instance['near_feature'];
			
			echo $before_widget;
			
			global $wpdb;
			$query_array = array();
			
        	// first query to get all the posts with the chosen post type
        	$query = new WP_Query( array('post_type' => $near_post_type, 'post_status' => array('publish'), 'fields' => 'ids', 'posts_per_page'=> -1 ));
			
			if( !isset($query->posts) || empty($query->posts) ) { echo $after_widget; return; }
		
			// check if cookies of location exists exist.
			if ( isset($_COOKIE['wppl_lat']) && !empty($_COOKIE['wppl_lat']) ) {
				$query_array = array_merge(array($near_units),array(urldecode($_COOKIE['wppl_lat']),urldecode($_COOKIE['wppl_long']),urldecode($_COOKIE['wppl_lat'])), $query->posts, array($near_radius, $near_sort));
				// check if we have information exits in sessions. 
				//if(!$_SESSION[$widget_id]['locations'] || $_SESSION[$widget_id]['lat'] != $_COOKIE['wppl_lat'] || $_SESSION[$widget_id]['long'] != $_COOKIE['wppl_long']) $near_posts_session = 0; else $near_posts_session = 1;
				// check if this is feature posts widget
        		if( isset($near_feature) && $near_feature == 1 ) $where = "AND wposts.feature = 1";
    
				$near_locations = 
					$wpdb->get_results(
						str_replace("'", "",$wpdb->prepare(
							"SELECT wposts.post_id, wposts.lat, wposts.long, wposts.address, wposts.post_title , ROUND( %s * acos( cos( radians(%s) ) * cos( radians( wposts.lat ) ) * cos( radians( wposts.long ) - radians(%s) ) + sin( radians(%s) ) * sin( radians( wposts.lat) ) ),1 )  AS distance
							FROM " . $wpdb->prefix . "places_locator  wposts	
							WHERE 
							(1 = 1)
							{$where}
							AND wposts.post_id IN (".str_repeat("%d,", count($query->posts)-1) . "%d)	
							HAVING distance <= %d OR distance IS NULL ORDER BY %s", $query_array
						))
					);
        		$distance_exist = 1;
        		$title = $title;
        	}
        	// if no cookies exists we will randomize from all locations.
        	if ( !isset($_COOKIE['wppl_lat']) || empty($_COOKIE['wppl_long']) || !isset($near_locations) || empty($near_locations) ) {
        		
        		$near_locations = 
					$wpdb->get_results(
						$wpdb->prepare(
							"SELECT wposts.post_id, wposts.lat, wposts.long, wposts.address, wposts.post_title
							FROM " . $wpdb->prefix . "places_locator  wposts	
							WHERE 
							(1 = 1)
							{$where}
							AND wposts.post_id IN (".str_repeat("%d,", count($query->posts)-1) . "%d)	
							ORDER BY RAND()", $query->posts
						)
					);
					
				$distance_exist = 0;
				$title = $title_rand;		       		
        	}
			
			// widget title
			if ( isset($title) ) echo $before_title . $title . $after_title; 
			
			$cp = 0;
			// display results
			echo '<ul>';
			foreach ($near_locations as $location) {
				
				// count the posts we display to the limit
				if ($cp < $posts_count ) {
					$post = get_post($location->post_id); ?>
					<li class="near-single-location">
						
						<div class="near-title-holder">
							<h3>
								<a href="<?php echo get_permalink($post->ID); ?>"><?php echo $location->post_title; ?></a>
								<?php if($distance_exist) { ?>
									<span class="distance"><?php echo "(" . $location->distance; echo ($near_units == 3959) ? "Mi" : "Km";  ?>)</span></h3>
								<?php } else echo '</h3>'; ?>
						</div>
						<?php if($near_image) { ?>
							<div class="near-image-holder">
								<?php echo get_the_post_thumbnail($post->ID); ?>
							</div>
						<?php } ?>
						
						<div class="near-address-holder">
							<span class="units"><?php echo $location->address; ?></span>
						</div>
					
					</li>
				<?php 	$cp++; ?>
				<?php } ?>
			<?php } 	
			echo $after_widget;
		}

	// Update Settings //
		function update($new_instance, $old_instance) {
		
			$instance['title'] 				= strip_tags($new_instance['title']);
			$instance['title_rand'] 		= strip_tags($new_instance['title_rand']);
			$instance['near_post_type'] 	= $new_instance['near_post_type'];
			$instance['near_radius'] 		= $new_instance['near_radius'];
			$instance['posts_count'] 		= $new_instance['posts_count'];
			$instance['near_units'] 		= $new_instance['near_units'];
			$instance['near_sort'] 			= $new_instance['near_sort'];
			$instance['near_image'] 		= $new_instance['near_image'];
			$instance['near_feature'] 		= $new_instance['near_feature'];

			return $instance;
		}

	// Widget Control Panel //
		function form($instance) {
			global $wppl_on;
			$defaults = array( 'title' => 'Near Locations', 'title_rand' => 'Random Locations', 'near_radius' => 50, 'posts_count' => 5, 'near_units' => 3959 ,'near_sort' => "$distance", 'near_post_type' => array('post'), 'near_image' => 1, 'near_feature' => 0);
			$instance = wp_parse_args( (array) $instance, $defaults );
			global $wp_post_types;
			?>
  			<p style="margin-bottom:10px; float:left;width:100%">
		    	<lable><?php _e( 'Title:', 'wppl' ); ?></lable>
				<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" width="25" style="float: left;width: 100%;"/>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
		    	<lable><?php _e( 'Title if random (when near locations not found):', 'wppl' ); ?></lable>
				<input type="text" name="<?php echo $this->get_field_name('title_rand'); ?>" value="<?php echo $instance['title_rand']; ?>" width="25" style="float: left;width: 100%;"/>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Post type:', 'wppl' ); ?></lable><br />
						<?php foreach ($wp_post_types as $post_type) { 
							echo '<input type="checkbox" name="' . $this->get_field_name('near_post_type').'[]" value="'.$post_type->name .'"'; if ( in_array($post_type->name,$instance['near_post_type']) ) {echo 'checked="checked"';} echo '/>'. $post_type->label . '<br />';			
						} ?>
				</select>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php _e( 'Number of posts:', 'wppl'); ?></lable>
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
					<option value="wposts.post_title" <?php if ("wposts.post_title" == $instance['near_sort']) :; echo 'selected="selected"' ; endif; ?>>Title</option>
					<option value="RAND()" <?php if ("RAND()" == $instance['near_sort']) :; echo 'selected="selected"' ; endif; ?>>Random</option>
				</select>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php echo _e( 'Show Feature Image?', 'wppl' ); ?></lable>
				<input type="checkbox" value="1" name="<?php echo $this->get_field_name('near_image'); ?>" <?php if ("1" == $instance['near_image']) { echo 'checked="checked"' ;} ?>/>
			</p>
			<p style="margin-bottom:10px; float:left;width:100%">
				<lable><?php echo _e( 'Show featured posts only?', 'wppl' ); ?></lable>
				<input type="checkbox" value="1" name="<?php echo $this->get_field_name('near_feature'); ?>" <?php if ("1" == $instance['near_feature']) { echo 'checked="checked"' ;}  echo( !$wppl_on['featured_posts'] ) ? "disabled" : ""; ?>/> <?php echo( !$wppl_on['featured_posts'] ) ? _e(' (premium version only)','wppl') : ""; ?>
			</p>
	<?php } 
	 }
add_action('widgets_init', create_function('', 'return register_widget("wppl_near_location_widget");'));

?>