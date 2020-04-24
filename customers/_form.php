<div class="os-form-w">
	<form action="" 
				data-os-success-action="redirect" 
				data-os-redirect-to="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'index')); ?>" 
				data-os-action="<?php echo $customer->is_new_record() ? OsRouterHelper::build_route_name('customers', 'create') : OsRouterHelper::build_route_name('customers', 'update'); ?>">
	
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
        	<h3><?php _e('General Information', 'latepoint'); ?></h3>
	        <?php if(!$customer->is_new_record()){ ?>
		        <div class="os-form-sub-header-actions"><?php echo __('Customer ID:', 'latepoint').$customer->id; ?></div>
		      <?php } ?>
		    </div>
      </div>
      <div class="white-box-content">
				<div class="os-row">
				  <div class="os-col-lg-12">
				    <?php echo OsFormHelper::media_uploader_field('customer[avatar_image_id]', 0, __('Set Avatar', 'latepoint'), __('Remove Avatar', 'latepoint'), $customer->avatar_image_id); ?>
				  </div>
				</div>
				<div class="os-row">
					<div class="os-col-6">
				    <?php echo OsFormHelper::text_field('customer[first_name]', __('First Name', 'latepoint'), $customer->first_name); ?>
					</div>
					<div class="os-col-6">
				    <?php echo OsFormHelper::text_field('customer[last_name]', __('Last Name', 'latepoint'), $customer->last_name); ?>
					</div>
				</div>
				<div class="os-row">
					<div class="os-col-lg-6">
				    <?php echo OsFormHelper::text_field('customer[email]', __('Email Address', 'latepoint'), $customer->email); ?>
					</div>
					<div class="os-col-lg-6">
				    <?php echo OsFormHelper::text_field('customer[phone]', __('Phone Number', 'latepoint'), $customer->phone, array('class' => 'os-mask-phone')); ?>
					</div>
				</div>
				<div class="os-row">
				  <div class="os-col-lg-12">
				    <?php echo OsFormHelper::textarea_field('customer[notes]', __('Notes by Customer', 'latepoint'), $customer->notes); ?>
				  </div>
				</div>
				<div class="os-row">
				  <div class="os-col-lg-12">
				    <?php echo OsFormHelper::textarea_field('customer[admin_notes]', __('Notes by admins, only visible to admins', 'latepoint'), $customer->admin_notes); ?>
				  </div>
				</div>
			</div>
		</div>

		<?php if($custom_fields_for_customer){ ?>
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
        	<h3><?php _e('Custom Fields', 'latepoint'); ?></h3>
		    </div>
      </div>
      <div class="white-box-content">
			  <div class="os-row">
			    <?php foreach($custom_fields_for_customer as $custom_field){
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
			    } ?>
			  </div>
      </div>
    </div>
	  <?php } ?>
    <div class="os-form-buttons os-flex">
    <?php 
      if($customer->is_new_record()){
        echo OsFormHelper::button('submit', __('Save Customer', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
      }else{
        echo OsFormHelper::hidden_field('customer[id]', $customer->id);
        echo OsFormHelper::button('submit', __('Save Changes', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
        echo '<a href="#" class="latepoint-btn latepoint-btn-danger remove-customer-btn" style="margin-left: auto;" 
                data-os-prompt="'.__('Are you sure you want to delete this customer? It will remove all appointments and transactions associated with this customer.', 'latepoint').'" 
                data-os-redirect-to="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'index')).'" 
                data-os-params="'. OsUtilHelper::build_os_params(['id' => $customer->id]). '" 
                data-os-success-action="redirect" 
                data-os-action="'.OsRouterHelper::build_route_name('customers', 'destroy').'">'.__('Delete Customer', 'latepoint').'</a>';
      }
		?>
		</div>
  </form>
</div>
<?php if(!$customer->is_new_record()){ ?>
	<div class="customer-appointments">
		<div class="os-form-sub-header"><h3><?php _e('Appointments', 'latepoint'); ?></h3></div>
		<?php  
		if($customer->bookings){
			echo '<div class="customer-appointments-list">';
			foreach($customer->bookings as $booking){
				// $hide_customer_info = true;
				// $total_attendies_in_group = $booking->total_attendies;
				// include(LATEPOINT_VIEWS_ABSPATH.'dashboard/_booking_info_box_small.php');
				?>
				<div class="appointment-box-squared" <?php echo OsBookingHelper::quick_booking_btn_html($booking->id); ?>>
					<div class="appointment-main-info">
						<div class="appointment-color-elem" style="background-color: <?php echo $booking->service->bg_color; ?>"></div>
						<div class="appointment-service-name"><?php echo $booking->service->name; ?></div>
						<div class="appointment-date-w">
							<div class="appointment-date-i">
								<div class="appointment-date"><?php echo $booking->nice_start_date; ?></div>
								<div class="appointment-time"><?php echo implode('-', array($booking->nice_start_time, $booking->nice_end_time)); ?></div>
							</div>
				      <div class="avatar-w" style="background-image: url(<?php echo $booking->agent->get_avatar_url(); ?>);">
				      	<div class="agent-info-tooltip"><?php echo $booking->agent->full_name; ?></div>
				      </div>
						</div>
					</div>
				</div>
				<?php
			}
			echo '</div>';
		}else{ ?>
		  <div class="no-results-w">
		    <div class="icon-w"><i class="latepoint-icon latepoint-icon-book"></i></div>
		    <h2><?php _e('Customer does not have any bookings', 'latepoint'); ?></h2>
		    <a <?php echo OsBookingHelper::quick_booking_btn_html(false, array('customer_id'=> $customer->id)); ?> href="#" class="latepoint-btn">
		      <i class="latepoint-icon latepoint-icon-plus-square"></i>
		      <span><?php _e('Create Appointment', 'latepoint'); ?></span>
		    </a>
		  </div>
			<?php
		} ?>
	</div>
<?php } ?>