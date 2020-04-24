<div class="step-confirmation-w latepoint-step-content">
  <?php do_action('latepoint_step_confirmation_before', $booking); ?>
  <div class="confirmation-head-info">
    <?php do_action('latepoint_step_confirmation_head_info_before', $booking); ?>
    <div class="confirmation-number"><?php _e('Confirmation #', 'latepoint'); ?> <strong><?php echo $booking->id; ?></strong></div>
    <a href="<?php echo $booking->ical_download_link; ?>" class="ical-download-btn" target="_blank"><i class="latepoint-icon latepoint-icon-calendar"></i><span><?php _e('Add to Calendar', 'latepoint'); ?></span></a>
    <a href="<?php echo $booking->print_link; ?>" class="print-booking-btn" target="_blank"><i class="latepoint-icon latepoint-icon-printer"></i><span><?php _e('Print', 'latepoint'); ?></span></a>
    <?php do_action('latepoint_step_confirmation_head_info_after', $booking); ?><br>
    <p style="align-content: center;"><span style="color:red; text-align: center; margin: 25%; font-size: 18px;">Please Check Your Email </span></p>
    
  </div>
  <div class="confirmation-info-w">
  	<div class="confirmation-app-info">
		  <h5 class="confirmation-section-heading"><?php _e('Appointment Info', 'latepoint'); ?></h5>
		  <ul>
		  	<li><?php _e('Date:', 'latepoint'); ?> <strong><?php echo $booking->format_start_date_and_time(get_option('date_format'), false, OsTimeHelper::get_timezone_from_session()); ?></strong></li>
		  	<li>
          <?php _e('Time:', 'latepoint'); ?> 
          <strong>
            <?php echo OsTimeHelper::minutes_to_hours_and_minutes($booking->get_start_time_shifted_for_customer()); ?>
            <?php if(OsSettingsHelper::get_settings_value('show_booking_end_time') == 'on') echo ' - '. OsTimeHelper::minutes_to_hours_and_minutes($booking->get_end_time_shifted_for_customer()); ?>
          </strong>
        </li>
        <?php if(!empty($booking->location->full_address)){ ?>
          <li><?php _e('Location:', 'latepoint'); ?> <strong><?php echo $booking->location->full_address; ?></strong></li>
        <?php } ?>
        <?php if(!OsSettingsHelper::is_on('steps_hide_agent_info')){ ?>
  		  	<li><?php _e('Agent:', 'latepoint'); ?> <strong><?php echo $booking->agent->full_name; ?></strong></li>
        <?php } ?>
		  	<li><?php _e('Service:', 'latepoint'); ?> <strong><?php echo $booking->service->name; ?></strong></li>
        <?php do_action('latepoint_step_verify_appointment_info', $booking); ?>
		  </ul>
  	</div>
  	<div class="confirmation-customer-info">
		  <h5 class="confirmation-section-heading"><?php _e('Customer Info', 'latepoint'); ?></h5>
		  <ul>
		  	<li><?php _e('Name:', 'latepoint'); ?> <strong><?php echo $customer->full_name; ?></strong></li>
		  	<li><?php _e('Phone:', 'latepoint'); ?> <strong><?php echo $customer->formatted_phone; ?></strong></li>
		  	<li><?php _e('Email:', 'latepoint'); ?> <strong><?php echo $customer->email; ?></strong></li>
        <?php if($custom_fields_for_customer){
          foreach($custom_fields_for_customer as $custom_field){
            echo '<li>'.$custom_field['label'].': <strong>'.$customer->get_meta_by_key($custom_field['id'], __('n/a', 'latepoint')).'</strong></li>';
          }
        } ?>
		  </ul>
  	</div>
    <?php if(OsSettingsHelper::is_accepting_payments()){
      $amount_paid = $booking->get_total_amount_paid_from_transactions();
      if(($amount_paid > 0) || ($booking->price > 0)){ ?>
        <div class="payment-summary-info">
          <h5 class="confirmation-section-heading"><?php _e('Payment Info', 'latepoint'); ?></h5>
          <div class="confirmation-info-w">
            <div class="confirmation-app-info">
              <ul>
                <li><?php _e('Payment Method:', 'latepoint'); ?> <strong><?php echo $booking->payment_method_nice_name; ?></strong></li>
                <?php if($amount_paid < $booking->price){ ?>
                  <li><?php _e('Total Amount Due:', 'latepoint'); ?> <strong><?php echo OsMoneyHelper::format_price($booking->price); ?></strong></li>
                <?php } ?>
                <?php if($amount_paid > 0){ ?>
                  <li><?php _e('Amount Paid Now:', 'latepoint'); ?> <strong><?php echo OsMoneyHelper::format_price($amount_paid); ?></strong></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
    <?php 
    // Tracking code
    if(!empty(OsSettingsHelper::get_settings_value('confirmation_step_tracking_code', ''))){
      echo '<div style="display: none;">'.OsReplacerHelper::replace_tracking_vars(OsSettingsHelper::get_settings_value('confirmation_step_tracking_code'), $booking).'</div>';
    }
    ?>
    <?php if( (OsSettingsHelper::get_settings_value('steps_require_setting_password') == 'on')){ ?>
      <br>
    <p style="align-content: center;">
        <span style=" text-align: center;">
            <a href="<?php echo OsSettingsHelper::get_customer_dashboard_url(); ?>" class="latepoint-btn latepoint-btn-primary confirmation-cabinet-link" target="_blank"><?php _e('Open My Cabinet', 'latepoint'); ?></a>
        </span>
    </p>
   <?php } ?>
  </div>
  
</div>