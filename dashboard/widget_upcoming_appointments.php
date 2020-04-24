<div class="os-widget os-widget-transparent os-widget-animated os-widget-upcoming-appointments" data-os-reload-action="<?php echo OsRouterHelper::build_route_name('dashboard', 'widget_upcoming_appointments'); ?>">
	<div class="os-widget-header with-actions" style="display: none">
		<h3 class="os-widget-header-text"><?php _e('Upcoming', 'latepoint'); ?></h3>
		<div class="os-widget-header-actions-trigger"><i class="latepoint-icon latepoint-icon-more-horizontal"></i></div>
		<div class="os-widget-header-actions">
			<?php $agents_selector_css = (is_array($agents) && (count($agents) == 1)) ? 'display: none;' : ''; ?>
			<select name="agent_id" id="" class="os-trigger-reload-widget" style="<?php echo $agents_selector_css; ?>">
				<option value=""><?php _e('All Agents', 'latepoint'); ?></option>
				<?php if($agents){ ?>
					<?php foreach($agents as $agent){ ?>
					<option value="<?php echo $agent->id ?>" <?php if($agent->id == $agent_id) echo 'selected="selected"' ?>><?php echo $agent->full_name; ?></option>
					<?php } ?>
				<?php } ?>
			</select>
			<select name="service_id" id="" class="os-trigger-reload-widget">
				<option value=""><?php _e('All Services', 'latepoint'); ?></option>
				<?php if($services){ ?>
					<?php foreach($services as $service){ ?>
					<option value="<?php echo $service->id ?>" <?php if($service->id == $service_id) echo 'selected="selected"' ?>><?php echo $service->name; ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>		
	</div>
	<div class="os-widget-content">
		<div class="appointment-boxes-squared-w">
			<div class="appointment-boxes-caption"><div><?php _e('Upcoming', 'latepoint'); ?></div></div>
			<?php if($upcoming_bookings){ ?>
			<?php foreach($upcoming_bookings as $booking){ 
				$max_capacity = OsServiceHelper::get_max_capacity($booking->service); ?>
				<div class="appointment-box-squared" <?php echo ($max_capacity > 1) ? OsBookingHelper::group_booking_btn_html($booking->id) : OsBookingHelper::quick_booking_btn_html($booking->id); ?>>
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
					<div class="appointment-sub-info">
						<?php if($max_capacity > 1){ 
							$css_width = min(((max($booking->total_attendies_sum, 1) / $max_capacity) * 100), 100); ?>
							<div class="appointment-capacity-info">
								<div class="appointment-capacity-info-label">
									<strong><?php echo max($booking->total_attendies_sum, 1).' '.__('of', 'latepoint').' '.$max_capacity; ?></strong>
									<span><?php _e('Slots Booked', 'latepoint'); ?></span>
								</div>
								<div class="appointment-capacity-progress-w">
									<div class="appointment-capacity-progress" style="width: <?php echo $css_width; ?>%;"></div>
								</div>
							</div>
						<?php }else{ ?>

							<div class="appointment-person-info">
								<?php if($booking->total_customers > 1){ ?>
						      <div class="avatar-w" style="background-image: url(<?php echo $booking->customer->get_avatar_url(); ?>);"></div>
						      <div class="agent-info">
						        <div class="agent-label"><?php echo $booking->total_attendies_sum; ?> <?php _e('Attendies', 'latepoint'); ?></div>
						        <div class="agent-name"><?php echo $booking->total_customers; ?> <?php _e('Customers', 'latepoint'); ?></div>
									</div>
								<?php }else{ ?>
						      <div class="avatar-w" style="background-image: url(<?php echo $booking->customer->get_avatar_url(); ?>);"></div>
						      <div class="agent-info">
						        <div class="agent-label"><?php _e('Customer', 'latepoint'); ?></div>
						        <div class="agent-name"><?php echo $booking->customer->full_name; ?></div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		  <div class="no-results-w">
		    <div class="count-number"><?php echo count($upcoming_bookings); ?></div>
		    <h2><?php _e('Upcoming Appointments', 'latepoint'); ?></h2>
		    <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Another One', 'latepoint'); ?></span></a>
		  </div>
		<?php }else{ ?>
		  <div class="no-results-w">
		    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
		    <h2><?php _e('No Upcoming Appointments', 'latepoint'); ?></h2>
		    <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Appointment', 'latepoint'); ?></span></a>
		  </div>
		<?php } ?>
		</div>
	</div>
</div>