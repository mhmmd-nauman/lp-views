<div class="step-verify-w latepoint-step-content">
  <div class="latepoint-step-content-text-left">
    <div><?php _e('Double check your booking information, you can go back to edit it or click submit button to confirm your booking.', 'latepoint'); ?></div>
  </div>
  <div class="confirmation-info-w">
  	<div class="confirmation-app-info">
		  <h5 class="confirmation-section-heading"><?php _e('Appointment Info', 'latepoint'); ?></h5>
		  <ul>
		  	<li><?php _e('Date:', 'latepoint'); ?> <strong><?php echo $booking->format_start_date_and_time( get_option( 'date_format' )); ?></strong></li>
		  	<li>
          <?php _e('Time:', 'latepoint'); ?> 
          <strong>
            <?php echo OsTimeHelper::minutes_to_hours_and_minutes($booking->start_time); ?>
            <?php if(OsSettingsHelper::get_settings_value('show_booking_end_time') == 'on') echo ' - '. OsTimeHelper::minutes_to_hours_and_minutes($booking->calculate_end_time()); ?>
          </strong>
        </li>
        <?php if(!empty($booking->location->full_address)){ ?>
          <li><?php _e('Location:', 'latepoint'); ?> <strong><?php echo $booking->location->full_address; ?></strong></li>
        <?php } ?>
        <?php if(!OsSettingsHelper::is_on('steps_hide_agent_info')){ ?>
    	  	<li><?php _e('Agent:', 'latepoint'); ?> <strong><?php echo $booking->get_agent_full_name(); ?></strong></li>
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
    <?php if(OsSettingsHelper::is_accepting_payments() && (($booking->full_amount_to_charge(false) > 0) || ($booking->deposit_amount_to_charge() > 0))){ ?>
    <div class="payment-summary-info">
      <h5 class="confirmation-section-heading"><?php _e('Payment Info', 'latepoint'); ?></h5>
      <div class="confirmation-info-w">
        <div class="confirmation-app-info">
          <ul>
            <li><?php _e('Payment Method:', 'latepoint'); ?> <strong><?php echo $booking->payment_method_nice_name; ?></strong></li>
            <?php if($booking->payment_method == LATEPOINT_PAYMENT_METHOD_LOCAL){
              echo '<li>'.__('Balance Due:', 'latepoint').'<strong>'.$booking->formatted_full_price().'</strong></li>';
            }else{
              if($booking->payment_portion == LATEPOINT_PAYMENT_PORTION_DEPOSIT){
                echo '<li>'.__('Deposit Now:', 'latepoint').'<strong>'.$booking->formatted_deposit_price().'</strong></li>';
                if($booking->full_amount_to_charge(false) > 0) echo '<li>'.__('Total Price:', 'latepoint').'<strong>'.$booking->formatted_full_price().'</strong></li>';
              }else{
                echo '<li>'.__('Charge Amount:', 'latepoint').'<strong>'.$booking->formatted_full_price().'</strong></li>';
              }
            } ?>
            <?php  ?>
          </ul>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>