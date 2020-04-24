<div>
	<label for=""><?php _e('Customer Login', 'latepoint'); ?></label>
	<select name="" id="">
		<option value=""><?php _e('Select Page', 'latepoint'); ?></option>
		<?php 
		foreach($pages as $page){ 
			echo '<option value="'.$page->ID.'">'.$page->post_title.'</option>';
		}
		?>
	</select>
</div>
<div>
	<label for=""><?php _e('Customer Profile', 'latepoint'); ?></label>
	<select name="" id="">
		<option value=""><?php _e('Select Page', 'latepoint'); ?></option>
		<?php 
		foreach($pages as $page){ 
			echo '<option value="'.$page->ID.'">'.$page->post_title.'</option>';
		}
		?>
	</select>
</div>