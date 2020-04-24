<?php 
if(!empty($services) && !empty($agents)){ ?>
	<div class="bookings-daily-agents" data-route="<?php echo OsRouterHelper::build_route_name('calendars', 'daily_agents'); ?>">
		<div class="daily-agent-monthly-calendar-w horizontal-calendar">
	    <?php 
	    $calendar_settings = ['service_id' => $selected_service_id, 
	    											'agent_id' => LATEPOINT_ANY_AGENT, 
	    											'location_id' => OsLocationHelper::get_selected_location_id(), 
	    											'number_of_months_to_preload' => 0,
	    											'layout' => 'horizontal',
	    											'allow_full_access' => true, 
	    											'highlight_target_date' => true];
	    OsBookingHelper::generate_monthly_calendar($target_date->format('Y-m-d'), $calendar_settings); ?>
	  </div>
		<div class="daily-agent-calendar-w <?php if(count($agents) > 5) echo 'make-scrollable'; ?>">
			<div class="calendar-daily-agent-w">
				<?php if(($calendar_start_minutes < $calendar_end_minutes) && ($timeblock_interval > 0)){ 
					$total_periods = floor(($calendar_end_minutes - $calendar_start_minutes) / $timeblock_interval) + 1;
					$period_height = floor(OsSettingsHelper::get_day_calendar_min_height() / $total_periods);
					$period_css = (($total_periods * 20) < OsSettingsHelper::get_day_calendar_min_height()) ? "height: {$period_height}px;" : ''; ?>

					<div class="calendar-hours">
						<div class="ch-hours">
							<div class="ch-filter">
								<div class="ch-filter-trigger"></div>
							</div>
							<?php for($minutes = $calendar_start_minutes; $minutes <= $calendar_end_minutes; $minutes+= $timeblock_interval){ ?>
								<?php 
								$period_class = 'chh-period';
								$period_class.= (($minutes == $calendar_end_minutes) || (($minutes + $timeblock_interval) > $calendar_end_minutes)) ? ' last-period' : '';
								$period_class.= (($minutes % 60) == 0) ? ' chh-period-hour' : ' chh-period-minutes';
								echo '<div class="'.$period_class.'" style="'.$period_css.'"><span>'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</span></div>';
								?>
							<?php } ?>
						</div>
						<div class="ch-agents">
							<div class="da-head-agents">
						  <?php foreach($agents as $agent){ ?>
								<div class="da-head-agent">
									<div class="da-head-agent-avatar" style="background-image: url(<?php echo $agent->get_avatar_url(); ?>)"></div>
									<a href="<?php echo OsRouterHelper::build_link(['agents', 'edit_form'], ['id' => $agent->id]); ?>" class="da-head-agent-name"><?php echo $agent->full_name; ?></a>
								</div>
							<?php } ?>
							</div>
							<div class="da-agents-bookings">
							  <?php foreach($agents as $agent){
									list($agent_work_start_minutes, $agent_work_end_minutes) = OsBookingHelper::get_work_start_end_time_for_date(['custom_date' => $target_date->format('Y-m-d'), 
																																																																'location_id' => OsLocationHelper::get_selected_location_id(),
																																																																'agent_id' => $agent->id]);
									$agent_work_periods_arr = OsBookingHelper::get_work_periods(['custom_date' => $target_date->format('Y-m-d'),
								                                                              'agent_id' => $agent->id,
								                                                              'location_id' => OsLocationHelper::get_selected_location_id(),
								                                                              'week_day' => $target_date->format('N')]);
									$agent_total_work_time = $agent_work_end_minutes - $agent_work_start_minutes;
									$day_off_class = ($agent_total_work_time > 0) ? '' : 'agent-has-day-off'; ?>
									<div class="da-agent-bookings-and-periods">
										<div class="ch-day-periods ch-day-<?php echo strtolower($target_date->format('N')); ?>">

											<?php for($minutes = $calendar_start_minutes; $minutes <= $calendar_end_minutes; $minutes+= $timeblock_interval){ ?>
												<?php 
												$period_class = 'chd-period';
												if($minutes > $agent_work_end_minutes || $minutes < $agent_work_start_minutes || !OsBookingHelper::is_minute_in_work_periods($minutes, $agent_work_periods_arr)) $period_class.= ' chd-period-off ';
												$period_class.= (($minutes == $calendar_end_minutes) || (($minutes + $timeblock_interval) > $calendar_end_minutes)) ? ' last-period' : '';
												$period_class.= (($minutes % 60) == 0) ? ' chd-period-hour' : ' chd-period-minutes';
												$btn_params = OsBookingHelper::quick_booking_btn_html(false, array('start_time'=> $minutes, 'start_date' => $target_date->format('Y-m-d'), 'agent_id' => $agent->id));
												echo '<div class="'.$period_class.'" '.$btn_params.' style="'.$period_css.'"><div class="chd-period-minutes-value">'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</div></div>';
												?>
											<?php } ?>

										</div>
										<div class="da-agent-bookings">
											<?php 
											if(isset($bookings[$agent->id]) && !empty($bookings[$agent->id])){
												$overlaps_count = 1;
												$total_attendies_in_group = 0;
												$total_bookings_in_group = 0;
												$total_bookings = count($bookings[$agent->id]);
												foreach($bookings[$agent->id] as $index => $booking){
													$next_booking = (($index + 1) < $total_bookings) ? $bookings[$agent->id][$index + 1] : false;

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
											do_action('latepoint_calendar_daily_timeline', $target_date, ['agent_id' => $agent->id, 'work_start_minutes' => $calendar_start_minutes, 'work_end_minutes' => $calendar_end_minutes, 'work_total_minutes' => $calendar_total_minutes]);
											?>
										</div>
									</div>
								<?php } ?>
							</div>
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