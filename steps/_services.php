<div class="step-services-w latepoint-step-content">
  <div class="latepoint-step-content-text-centered">
    <h4><?php _e('Select Service Duration', 'latepoint'); ?></h4>
    <div><?php _e('You need to select service duration, the price of your service will depend on duration.', 'latepoint'); ?></div>
  </div>
  <div class="select-total-attendies-w style-centered">
    <div class="select-total-attendies-label">
      <h4><?php _e('How Many People?', 'latepoint'); ?></h4>
      <div class="sta-sub-label"><?php _e('Maximum capacity is', 'latepoint'); ?> <span>1</span></div>
    </div>
    <div class="quantity-selector-w">
      <div class="quantity-selector quantity-selector-minus"><i class="latepoint-icon latepoint-icon-minus"></i></div>
      <input type="text" name="" class="quantity-selector-input" value="<?php echo $booking->total_attendies; ?>" placeholder="<?php _e('Qty', 'latepoint'); ?>">
      <div class="quantity-selector quantity-selector-plus"><i class="latepoint-icon latepoint-icon-plus"></i></div>
    </div>
  </div>
  <?php 
  if(OsSettingsHelper::steps_show_service_categories()){

    // Generate categorized services list
    OsBookingHelper::generate_services_and_categories_list(false, $show_service_categories_arr, $show_services_arr, $preselected_category);
  }else{
    OsBookingHelper::generate_services_list($services);
  } ?>
</div>