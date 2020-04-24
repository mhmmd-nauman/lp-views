<div class="os-row">
  <?php echo OsFormHelper::text_field('customer[first_name]', __('Your First Name', 'latepoint'), $customer->first_name, array('class' => 'required'), array('class' => 'os-col-6')); ?>
  <?php echo OsFormHelper::text_field('customer[last_name]', __('Your Last Name', 'latepoint'), $customer->last_name, array('class' => 'required'), array('class' => 'os-col-6')); ?>
  <?php echo OsFormHelper::text_field('customer[phone]', __('Your Phone Number', 'latepoint'), $customer->formatted_phone, array('class' => 'os-mask-phone'), array('class' => 'os-col-6 os-col-sm-12')); ?>
  <?php echo OsFormHelper::text_field('customer[email]', __('Your Email Address', 'latepoint'), $customer->email, array('class' => 'required'), array('class' => 'os-col-6 os-col-sm-12')); ?>
  <?php if(($customer->is_new_record() || $customer->is_guest) && OsSettingsHelper::is_on('steps_require_setting_password')){
		echo OsFormHelper::password_field('customer[password]', __('Password', 'latepoint'), '', array('class' => 'required'), array('class' => 'os-col-6'));
		echo OsFormHelper::password_field('customer[password_confirmation]', __('Confirm Password', 'latepoint'), '', array('class' => 'required'), array('class' => 'os-col-6'));
  } ?>
  <?php echo OsFormHelper::textarea_field('customer[notes]', __('Add Comments', 'latepoint'), $customer->notes, array(), array('class' => 'os-col-12')); ?>
  <?php 
	  if(isset($custom_fields_for_customer) && !empty($custom_fields_for_customer)){
	    foreach($custom_fields_for_customer as $custom_field){
	    	$required_class = ($custom_field['required'] == 'on') ? 'required' : '';
	    	switch ($custom_field['type']) {
	    		case 'text':
				    echo OsFormHelper::text_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], $customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
	    			break;
	    		case 'textarea':
				    echo OsFormHelper::textarea_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], $customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
	    			break;
	    		case 'select':
				    echo OsFormHelper::select_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], OsFormHelper::generate_select_options_from_custom_field($custom_field['options']), $customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
		    		break;
	        case 'checkbox':
	          echo OsFormHelper::checkbox_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], 'on', ($customer->get_meta_by_key($custom_field['id'], 'off') == 'on') , ['class' => $required_class], array('class' => $custom_field['width']));
	          break;
	    	}
	    } 
	  }?>
</div>