<div class="customer-booking status-<?php echo $booking->status; ?>" data-id="<?php echo $booking->id; ?>">
	<h6 class="customer-booking-service-name"><?php echo $booking->service->name; ?></h6>
	<div class="customer-booking-service-color"></div>
	<div class="customer-booking-info">
		<div class="customer-booking-info-row">
			<span class="booking-info-label"><?php _e('Date', 'latepoint'); ?></span>
			<span class="booking-info-value"><?php echo $booking->format_start_date_and_time(get_option('date_format')); ?></span></div>
		<div class="customer-booking-info-row">
			<span class="booking-info-label"><?php _e('Time', 'latepoint'); ?></span>
			<span class="booking-info-value">
				<?php echo OsTimeHelper::minutes_to_hours_and_minutes($booking->get_start_time_shifted_for_customer()); ?>
				<?php if(OsSettingsHelper::get_settings_value('show_booking_end_time') == 'on') echo ' - '. OsTimeHelper::minutes_to_hours_and_minutes($booking->get_end_time_shifted_for_customer()); ?>
			</span>
		</div>
		<div class="customer-booking-info-row">
			<span class="booking-info-label"><?php _e('Agent', 'latepoint'); ?></span>
			<span class="booking-info-value"><?php echo $booking->agent->full_name; ?></span></div>
		<div class="customer-booking-info-row">
			<span class="booking-info-label"><?php _e('Status', 'latepoint'); ?></span>
			<span class="booking-info-value status-<?php echo $booking->status; ?>"><?php echo $booking->nice_status; ?></span>
                </div>
                <div class="customer-booking-info-row">
			<span class="booking-info-label"><?php _e('Live Call', 'latepoint'); ?></span>
                        <span class="booking-info-value status-<?php echo $booking->status; ?>">
                            <?php 
                            $class = "";
                            switch($booking->status){
                                case"payment_pending":
                                    $class="latepoint-btn";
                            
                            }?>
                            <a class="<?php echo $class;?>" href="https://patients.ttdoctors.org/pages/r.html?room=<?php echo $booking->id;?>">Join</a>
                            
                        </span>
                </div>
	</div>
	<?php if($editable_booking){ ?>
		<div class="customer-booking-buttons">
			<a href="<?php echo $booking->ical_download_link; ?>" target="_blank" class="latepoint-btn latepoint-btn-primary latepoint-btn-link">
				<i class="latepoint-icon latepoint-icon-ui-83"></i>
				<span><?php _e('Add to Calendar', 'latepoint'); ?></span>
			</a>
			<?php /* <a href="#" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-ui-46"></i><span><?php _e('Edit', 'latepoint'); ?></span></a> */ ?>
			<a href="#" class="latepoint-btn latepoint-btn-danger latepoint-request-booking-cancellation latepoint-btn-link" data-route="<?php echo OsRouterHelper::build_route_name('bookings', 'request_cancellation'); ?>">
				<i class="latepoint-icon latepoint-icon-ui-24"></i>
				<span><?php _e('Cancel', 'latepoint'); ?></span>
			</a>
		</div>
	<?php } ?>
</div>