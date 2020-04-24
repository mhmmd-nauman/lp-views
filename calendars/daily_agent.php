<?php 
if(!empty($services) && !empty($agents)){
	list($agent_work_start_minutes, $agent_work_end_minutes) = OsBookingHelper::get_work_start_end_time_for_date(['custom_date' => $target_date->format('Y-m-d'), 'agent_id' => $selected_agent->id]);
	$agent_total_work_time = $agent_work_end_minutes - $agent_work_start_minutes;
	$day_off_class = ($agent_total_work_time > 0) ? '' : 'agent-has-day-off'; ?>
	<div class="bookings-daily-agents is-single" data-route="<?php echo OsRouterHelper::build_route_name('calendars', 'daily_agent'); ?>">

		<div class="daily-agent-monthly-calendar-w horizontal-calendar">
	    <?php 
	    $calendar_settings = ['service_id' => $selected_service_id, 
	    											'agent_id' => $selected_agent_id, 
	    											'location_id' => OsLocationHelper::get_selected_location_id(), 
	    											'number_of_months_to_preload' => 0,
	    											'allow_full_access' => true, 
	    											'layout' => 'horizontal',
	    											'highlight_target_date' => true];
	    OsBookingHelper::generate_monthly_calendar($target_date->format('Y-m-d'), $calendar_settings); ?>
    </div>
    <div class="bookings-daily-agents-contents">
			<div class="daily-agent-calendar-w">
				<input type="hidden" name="agent_id" id="" value="<?php echo $selected_agent_id; ?>" class="agent-select os-trigger-reload-widget"/>
				<div class="calendar-daily-agent-w">
					<?php if(($work_start_minutes < $work_end_minutes) && ($timeblock_interval > 0)){ 
						$total_periods = floor(($work_end_minutes - $work_start_minutes) / $timeblock_interval) + 1;
						$period_height = floor(OsSettingsHelper::get_day_calendar_min_height() / $total_periods);
						$period_css = (($total_periods * 20) < OsSettingsHelper::get_day_calendar_min_height()) ? "height: {$period_height}px;" : ''; ?>

					<div class="calendar-hours">
						<div class="ch-hours">
							<?php for($minutes = $work_start_minutes; $minutes <= $work_end_minutes; $minutes+= $timeblock_interval){ ?>
								<?php 
								$period_class = 'chh-period';
								$period_class.= (($minutes == $work_end_minutes) || (($minutes + $timeblock_interval) > $work_end_minutes)) ? ' last-period' : '';
								$period_class.= (($minutes % 60) == 0) ? ' chh-period-hour' : ' chh-period-minutes';
								echo '<div class="'.$period_class.'" style="'.$period_css.'"><span>'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</span></div>';
								?>
							<?php } ?>
						</div>
						<div class="ch-day-periods ch-day-<?php echo strtolower($target_date->format('N')); ?>">

							<?php for($minutes = $work_start_minutes; $minutes <= $work_end_minutes; $minutes+= $timeblock_interval){ ?>
								<?php 
								$period_class = 'chd-period';
								if($minutes > $agent_work_end_minutes || $minutes < $agent_work_start_minutes || !OsBookingHelper::is_minute_in_work_periods($minutes, $work_periods_arr)) $period_class.= ' chd-period-off ';
								$period_class.= (($minutes == $work_end_minutes) || (($minutes + $timeblock_interval) > $work_end_minutes)) ? ' last-period' : '';
								$period_class.= (($minutes % 60) == 0) ? ' chd-period-hour' : ' chd-period-minutes';
								$btn_params = OsBookingHelper::quick_booking_btn_html(false, array('start_time'=> $minutes, 'agent_id' => $selected_agent_id, 'start_date' => $target_date->format('Y-m-d')));
								echo '<div class="'.$period_class.'" '.$btn_params.' style="'.$period_css.'"><div class="chd-period-minutes-value">'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</div></div>';
								?>
							<?php } ?>

							<?php 
							if($bookings){
								$overlaps_count = 1;
								$total_attendies_in_group = 0;
								$total_bookings_in_group = 0;
								$total_bookings = count($bookings);
								foreach($bookings as $index => $booking){
									$next_booking = (($index + 1) < $total_bookings) ? $bookings[$index + 1] : false;

									if(OsBookingHelper::check_if_group_bookings($booking, $next_booking)){
										// skip this output because multiple bookings in the same slot because next booking has the same start and end time 
										$total_attendies_in_group+= $booking->total_attendies;
										$total_bookings_in_group++;
										continue;
									}else{
										include('_booking_box_on_calendar.php');
										// time overlaps
										$overlaps_count = ($next_booking && ($next_booking->start_time < $booking->end_time)) ? $overlaps_count + 1 : 1;
										// reset
										$total_attendies_in_group = 0;
									}
								}
							}
							do_action('latepoint_calendar_daily_timeline', $target_date, ['agent_id' => $selected_agent_id, 'work_start_minutes' => $work_start_minutes, 'work_end_minutes' => $work_end_minutes, 'work_total_minutes' => $work_total_minutes]);
							?>
						</div>
					</div>
					<?php }else{ ?>
					  <div class="no-results-w">
					    <div class="icon-w"><i class="latepoint-icon latepoint-icon-calendar"></i></div>
					    <h2><?php _e('You have not set any working hours for this day.', 'latepoint'); ?></h2>
					    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('settings', 'general')); ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Edit Working Hours', 'latepoint'); ?></span></a>
					  </div>
					<?php } ?>
				</div>
			</div>
			<div class="daily-agent-side">
				<div class="os-widget">
					<div class="os-widget-header">
						<h3><?php _e('Daily Statistics', 'latepoint'); ?></h3>
					</div>
					<div class="os-widget-content no-padding">
						<div class="daily-calendar-stats-row">
							<div class="os-info-tile tile-centered">
								<div class="os-tile-value"><?php echo $total_bookings; ?></div>
								<div class="os-tile-info">
									<div class="os-tile-label"><?php _e('Appointments', 'latepoint'); ?></div>
								</div>
							</div>
							<div class="os-info-tile tile-centered">
								<div class="os-tile-value"><?php echo $total_openings; ?></div>
								<div class="os-tile-info">
									<div class="os-tile-label"><?php _e('Openings', 'latepoint'); ?></div>
								</div>
							</div>
						</div>
						<div class="daily-calendar-stats-row">
							<div class="os-info-tile tile-centered">
								<div class="os-tile-value"><?php echo $total_customers; ?></div>
								<div class="os-tile-info">
									<div class="os-tile-label"><?php _e('Customers', 'latepoint'); ?></div>
								</div>
							</div>
							<div class="os-info-tile tile-centered">
								<div class="os-tile-value"><?php echo OsMoneyHelper::format_price($total_revenue); ?></div>
								<div class="os-tile-info">
									<div class="os-tile-label"><?php _e('Revenue', 'latepoint'); ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="os-widget os-widget-transparent">
					<div class="os-widget-header centered">
						<h3><?php echo __('Availability For', 'latepoint').' <span>'.$nice_selected_date.'<span>'; ?></h3>
					</div>
					<div class="os-widget-content">
						<div class="tall-slots-timeline">
							<div class="daily-agent-availability-w">
						    <?php OsAgentHelper::availability_timeline($selected_agent, $selected_service, OsLocationHelper::get_selected_location(), $target_date->format('Y-m-d'), array('show_avatar' => false)); ?>
						  </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
    <h2><?php _e('No Agents or Services Created', 'latepoint'); ?></h2>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Agent', 'latepoint'); ?></span></a>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Service', 'latepoint'); ?></span></a>
  </div>
<?php
}