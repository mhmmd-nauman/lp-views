<div class="grouped-bookings-main-info">
	<div class="avatar" style="background-image: url(<?php echo $booking->agent->get_avatar_url(); ?>)"></div>
	<div class="gb-info">
		<div class="gbi-sub"><?php echo $booking->nice_start_date; ?></div>
		<div class="gbi-main"><?php echo $booking->service->name; ?></div>
		<div class="gbi-high"><?php echo OsTimeHelper::minutes_to_hours_and_minutes($booking->start_time); ?> - <?php echo OsTimeHelper::minutes_to_hours_and_minutes($booking->end_time); ?></div>
	</div>
	<div class="gb-capacity">
		<div class="gbc-label"><?php echo __('Booked:', 'latepoint').' <span>'.sprintf(__('%d of %d', 'latepoint'), $total_attendies, $booking->service->capacity_max).'<span>'; ?></div>
		<div class="booked-percentage">
			<div class="booked-bar" style="width: <?php echo OsServiceHelper::get_percent_of_capacity_booked($booking->service, $total_attendies); ?>%;"></div>
		</div>
	</div>
</div>
<div class="group-bookings-list">
	<div class="gb-heading"><span><?php _e('Bookings', 'latepoint'); ?></span></div>
	<?php foreach($group_bookings as $group_booking){ ?>
		<div class="gb-booking" <?php echo OsBookingHelper::quick_booking_btn_html($group_booking->id); ?>>
			<div class="gbb-status"></div>
			<div class="gbb-avatar" style="background-image: url(<?php echo $group_booking->customer->get_avatar_url(); ?>)"></div>
			<div class="gbb-customer">
				<div class="gbb-name"><?php echo $group_booking->customer->full_name; ?></div>
				<div class="gbb-email"><?php echo $group_booking->customer->email; ?></div>
			</div>
			<div class="gbb-attendies">
				<div class="gb-value"><?php echo $group_booking->total_attendies; ?></div>
				<div class="gb-label"><?php _e('Attendies', 'latepoint'); ?></div>
			</div>
		</div>
	<?php } ?>
  <div class="os-add-box add-booking-to-group-box" <?php echo OsBookingHelper::quick_booking_btn_html(false, ['start_time'=> $group_booking->start_time, 
	  																																																					'end_time' => $group_booking->end_time, 
  																																																						'agent_id' => $group_booking->agent_id, 
	  																																																					'start_date' => $group_booking->start_date, 
	  																																																					'service_id' => $group_booking->service_id, 
	  																																																					'location_id' => $group_booking->location_id]); ?>>
    <div class="add-box-graphic-w"><div class="add-box-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div></div>
    <div class="add-box-label"><?php _e('Add Appointment', 'latepoint'); ?></div>
  </div>
</div>