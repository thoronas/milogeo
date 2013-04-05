<?php
////// show profile fields names and IDs /////////////	
function wppl_bp_admin_profile_fields_ids() {
	global $bp;
	global $field;

	if (bp_is_active ('xprofile')) : 
	if (function_exists ('bp_has_profile')) : 
		if (bp_has_profile ('hide_empty_fields=0')) :
		
			while (bp_profile_groups ()) : 
				bp_the_profile_group (); 
				
				while (bp_profile_fields ()) : 
					bp_the_profile_field(); ?>
					
					<?php if ( (bp_get_the_profile_field_type () == 'textbox') ) {  ?>	
						<div style="float: left;margin-right: 5px;background: #FEFEFE;padding: 1px 5px;border: 1px solid #DDD;">
							<label><?php bp_the_profile_field_name(); ?></label>
							-
							<label><?php bp_the_profile_field_id(); ?></label>
						</div>
					<?php } 
			endwhile;
			endwhile; ?>

	<?php endif;
	endif; 
	endif; 
	
}
?>