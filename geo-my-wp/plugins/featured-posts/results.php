<div class="wppl-featured-posts-wrapper">
		<?php foreach ($featured_posts_within as $single_result) { ?>
	
			<?php $post = get_post($single_result->post_id); ?>
			
				<?php if (get_post_meta($post->ID,'_wppl_featured_post',true) ==1) { ?>
	
				<div class="wppl-featured-single-result row">
		
					<div class="twelve columns meta-info">
					
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    			
		    			<?php wppl_address(); ?>
		    			
						<?php if ($lat && $long) { ?><span class="radius-dis"><?php echo $single_result->distance . " " . $unit_a['name']; ?></span> <?php } ?>
		
		    									
						<ul>
		
							<?php if (function_exists('GetWtiLikePost')) { GetWtiLikePost(); }?>
		
							<li><span>Type: </span><?php echo forge_list_terms('care-type', "name", $post->ID ); ?></li>
		
							<li class="left"><span>Ages: </span><?php echo forge_list_terms('age-range', "name", $post->ID ); ?></li>
												
							<li class="right"><span>Capacity: </span><?php the_field('capacity'); ?></li>
		
		<!-- 
							<li><span>Daily Schedule: </span><?php echo forge_list_terms('daily-schedule', 'name'); ?></li> -->
		
		<!-- 					<li><span>Days available: </span><?php echo forge_list_terms('weekly-availability', 'name'); ?></li> -->
		
							<!-- <li><span>Capacity: </span><?php the_field('capacity'); ?></li> -->
		
							<!-- <li><span>Min. Days/Week: </span><?php echo forge_list_terms('weekly-availability', "name", $post->ID ); ?></li> -->
		
							<!-- <li><strong>Hours & Schedules</strong>
								<table class="six">
		
									<tr><td>Full Day: </td><td><?php if(get_field('full_day')){ the_field('full_day'); }else{ echo "Not Offered"; } ?></td></tr>
		
									<tr><td>Mornings: </td><td><?php if(get_field('mornings')){ the_field('mornings'); }else{ echo "Not Offered"; } ?></td></tr>
		
									<tr><td>Afternoons: </td><td><?php if(get_field('afternoons')){ the_field('afternoons'); }else{ echo "Not Offered"; } ?></td></tr>
		
								</table>
							
							</li> -->
		
		<!--
							<li>
								<span>Hours: </span>
								<table class="six">
		
									<tr><td>Full Day: </td><td><?php if(get_field('full_day')){ the_field('full_day'); }else{ echo "Not Offered"; } ?></td></tr>
		
									<tr><td>Mornings: </td><td><?php if(get_field('mornings')){ the_field('mornings'); }else{ echo "Not Offered"; } ?></td></tr>
		
									<tr><td>Afternoons: </td><td><?php if(get_field('afternoons')){ the_field('afternoons'); }else{ echo "Not Offered"; } ?></td></tr>
		
								</table>
							
							</li>
		-->
		
						</ul>
		
					</div>
		
		
					<div class="post_content twelve columns">
						
						<div class="left">
							<a href="<?php the_permalink(); ?>" >More Info</a>
						</div>
						
						<div class="right">
					
						<?php if ( is_user_logged_in() ) {   
			 		
			 				 if (function_exists('wpfp_link')) { wpfp_link(); } 
					
						}else{ ?>
					
							<span class="wpfp-span">
							<a rel="nofollow" title="Remove from favorites" href="<?php echo home_url(); ?>/login/?favorite=true" >Add to favorites</a></span>
					
						<?php } ?>
					
						</div>
					
					</div>

			
			    </div> <!--  single- wrapper -->
    	<?php
		    	}
    	 } ?>
    	
</div><!-- wppl featured posts wrapper -->
