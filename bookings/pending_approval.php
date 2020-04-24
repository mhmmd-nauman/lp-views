<?php if($bookings){ ?>
  <div class="latepoints-list">
    <?php 
    foreach ($bookings as $booking): ?>
      <div class="appointment-box-large status-<?php echo $booking->status; ?>" data-booking-id="<?php echo $booking->id; ?>" <?php echo OsBookingHelper::quick_booking_btn_html($booking->id); ?>>
        <div class="appointment-info">
          <div class="appointment-color-elem" style="background-color: <?php echo $booking->service->bg_color; ?>"></div>
          <div class="appointment-service-name"><?php echo $booking->service->name; ?></div>
          <div class="appointment-time">
            <div class="at-date"><?php echo $booking->nice_start_date; ?></div>
            <div class="at-time"><?php echo implode(' - ', array($booking->nice_start_time, $booking->nice_end_time)); ?></div>
          </div>
          <div class="appointment-status-selector" data-booking-id="<?php echo $booking->id; ?>" data-route="<?php echo OsRouterHelper::build_route_name('bookings', 'change_status') ?>">
            <?php echo OsFormHelper::select_field('booking[status]', __('Status:', 'latepoint'), OsBookingHelper::get_statuses_list(), $booking->status, ['id' => 'booking_status_'.$booking->id]); ?>
          </div>
        </div>
        <div class="account-info-w">
          <div class="account-info-head">
            <div class="avatar-w" style="background-image: url(<?php echo $booking->agent->get_avatar_url(); ?>);"></div>
            <div class="account-name-w">
              <div class="account-info-label"><?php _e('Agent', 'latepoint'); ?></div>
              <div class="account-name"><?php echo $booking->agent->full_name; ?></div>
            </div>
          </div>
          <div class="account-info">
            <div class="account-property">
              <span class="label"><?php _e('Phone: ', 'latepoint'); ?></span>
              <span class="value"><?php echo $booking->agent->phone; ?></span>
            </div>
            <div class="account-property">
              <span class="label"><?php _e('Email: ', 'latepoint'); ?></span>
              <span class="value"><?php echo $booking->agent->email; ?></span>
            </div>
          </div>
        </div>
        <div class="account-info-w">
          <div class="account-info-head">
            <div class="avatar-w" style="background-image: url(<?php echo $booking->customer->get_avatar_url(); ?>);"></div>
            <div class="account-name-w">
              <div class="account-info-label"><?php _e('Customer', 'latepoint'); ?></div>
              <div class="account-name"><?php echo $booking->customer->full_name; ?></div>
            </div>
          </div>
          <div class="account-info">
            <div class="account-property">
              <span class="label"><?php _e('Phone: ', 'latepoint'); ?></span>
              <span class="value"><?php echo $booking->customer->formatted_phone; ?></span>
            </div>
            <div class="account-property">
              <span class="label"><?php _e('Email: ', 'latepoint'); ?></span>
              <span class="value"><?php echo $booking->customer->email; ?></span>
            </div>
          </div>
        </div>
        <div class="appointment-box-actions">
          <div class="aba-button-w aba-approve" data-status="<?php echo LATEPOINT_BOOKING_STATUS_APPROVED; ?>">
            <i class="latepoint-icon latepoint-icon-check"></i><span><?php _e('Approve', 'latepoint'); ?></span>
          </div>
          <div class="aba-button-w aba-reject" data-status="<?php echo LATEPOINT_BOOKING_STATUS_CANCELLED; ?>">
            <i class="latepoint-icon latepoint-icon-x"></i><span><?php _e('Reject', 'latepoint'); ?></span>
          </div>
        </div>
      </div>
    <?php
    endforeach; ?>
    
      <div class="os-pagination-w">
        <div class="pagination-info"><?php echo sprintf(__('Showing appointments %d to %d of %d total', 'latepoint'), $showing_from, $showing_to, $total_bookings); ?></div>
        <ul>
          <?php 
          for($i = 1; $i <= $total_pages; $i++){
            echo '<li>';
              if($current_page_number == $i){
                echo '<span>'.$i.'</span>';
              }else{
                echo '<a href="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('bookings', 'pending_approval'), array('page_number' => $i) ).'">'.$i.'</a>';
              }
            echo '</li>';
          } ?>
        </ul>
      </div>
  </div>
<?php }else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
    <h2><?php _e('No Pending Appointments Found', 'latepoint'); ?></h2>
    <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-btn"><?php _e('Create Appointment', 'latepoint'); ?></a>
  </div>
<?php } ?>