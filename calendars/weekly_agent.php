<?php if($agents){ ?>
	<div class="calendar-week-agent-w" data-calendar-action="<?php echo OsRouterHelper::build_route_name('calendars', 'weekly_agent'); ?>">
		<div class="calendar-controls">
			<div class="cc-agent-selector">
				<label for=""><?php _e('Show Agent:', 'latepoint'); ?></label>
				<select name="" id="" class="calendar-agent-selector">
					<?php foreach($agents as $agent){ ?>
						<option value="<?php echo $agent->id; ?>" <?php if($agent->id == $selected_agent->id) echo 'selected'; ?>><?php echo join(' ', array($agent->first_name, $agent->last_name)); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="cc-date"><?php echo OsUtilHelper::get_month_name_by_number($calendar_start->format('n')).' '.$calendar_start->format('Y'); ?></div>
			<div class="cc-actions">
				<a href="#" class="cc-action-prev calendar-load-target-date" data-target-date="<?php echo $calendar_prev->format('Y-m-d'); ?>"><i class="latepoint-icon latepoint-icon-chevron-left"></i></a>
				<a href="#" class="cc-action-today calendar-load-target-date" data-target-date="<?php echo $today_date->format('Y-m-d'); ?>"><?php _e('Today', 'latepoint'); ?></a>
				<a href="#" class="cc-action-next calendar-load-target-date" data-target-date="<?php echo $calendar_next->format('Y-m-d'); ?>"><i class="latepoint-icon latepoint-icon-chevron-right"></i></a>
			</div>
			<?php 
			echo OsFormHelper::hidden_field('calendar[selected_agent_id]', $selected_agent->id, array('class' => 'calendar-selected-agent-id')); 
			echo OsFormHelper::hidden_field('calendar[calendar_start_date]', $calendar_start->format('Y-m-d'), array('class' => 'calendar-start-date')); 
			?>
		</div>
		<div class="calendar-self-w">
			<?php if(($work_start_minutes < $work_end_minutes) && ($timeblock_interval > 0)){ 
					$total_periods = floor(($work_end_minutes - $work_start_minutes) / $timeblock_interval) + 1;
					$period_height = floor(OsSettingsHelper::get_day_calendar_min_height() / $total_periods);
					$period_css = (($total_periods * 20) < OsSettingsHelper::get_day_calendar_min_height()) ? "height: {$period_height}px;" : '';
				?>
				<div class="calendar-hours">
					<div class="ch-hours">
						<div class="ch-info">
							<span><?php _e('Date', 'latepoint'); ?></span>
							<span><?php _e('Time', 'latepoint'); ?></span>
						</div>
						<?php for($minutes = $work_start_minutes; $minutes <= $work_end_minutes; $minutes+= $timeblock_interval){ ?>
							<?php 
							$period_class = 'chh-period';
							$period_class.= (($minutes == $work_end_minutes) || (($minutes + $timeblock_interval) > $work_end_minutes)) ? ' last-period' : '';
							$period_class.= (($minutes % 60) == 0) ? ' chh-period-hour' : ' chh-period-minutes';
							echo '<div class="'.$period_class.'" style="'.$period_css.'"><span>'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</span></div>';
							?>
						<?php } ?>
					</div>
					<div class="ch-day-periods-w">
					<?php
			    for($day_date=clone $calendar_start; $day_date<=$calendar_end; $day_date->modify('+1 day')){ 
			    	$day_work_periods_arr = OsBookingHelper::get_work_periods(['agent_id' => $selected_agent->id, 
                                                              'custom_date' => $day_date->format('Y-m-d'),
                                                              'location_id' => OsLocationHelper::get_selected_location_id(),
                                                              'week_day' => $day_date->format('N')]);
			    	?>
						<div class="ch-day-periods-i">
							<div class="ch-day ch-day-<?php echo strtolower($day_date->format('N')); ?> <?php if($today_date == $day_date) echo 'is-today'; ?>">
								<span><?php echo OsUtilHelper::get_weekday_name_by_number($day_date->format('N'), true); ?></span>
								<strong><?php echo $day_date->format('j'); ?></strong>
							</div>
				    	<?php 
					    list($agent_work_start_minutes, $agent_work_end_minutes) = OsBookingHelper::get_work_start_end_time_for_date(['custom_date' => $day_date->format('Y-m-d'), 'agent_id' => $selected_agent->id]);
							$agent_total_work_time = $agent_work_end_minutes - $agent_work_start_minutes;
							$day_off_class = ($agent_total_work_time > 0) ? '' : 'ch-day-off'; ?>
							<div class="ch-day-periods ch-day-<?php echo strtolower($day_date->format('N'));?> <?php echo $day_off_class; ?>">

								<?php for($minutes = $work_start_minutes; $minutes <= $work_end_minutes; $minutes+= $timeblock_interval){ ?>
									<?php 
									$period_class = 'chd-period';
									if($minutes > $agent_work_end_minutes || $minutes < $agent_work_start_minutes || !OsBookingHelper::is_minute_in_work_periods($minutes, $day_work_periods_arr)) $period_class.= ' chd-period-off ';
									$period_class.= (($minutes == $work_end_minutes) || (($minutes + $timeblock_interval) > $work_end_minutes)) ? ' last-period' : '';
									$period_class.= (($minutes % 60) == 0) ? ' chd-period-hour' : ' chd-period-minutes';
									$btn_params = OsBookingHelper::quick_booking_btn_html(false, array('start_time'=> $minutes, 'agent_id' => $selected_agent->id, 'start_date' => $day_date->format('Y-m-d')));
									echo '<div class="'.$period_class.'" '.$btn_params.' style="'.$period_css.'"><div class="chd-period-minutes-value">'.OsTimeHelper::minutes_to_hours_and_minutes($minutes).'</div></div>';
									?>
								<?php } ?>

								<?php 
								$day_bookings = OsBookingHelper::get_bookings_for_date($day_date->format('Y-m-d'), ['agent_id' => $selected_agent->id, 'location_id' => OsLocationHelper::get_selected_location_id()]);
								if($day_bookings){
									$overlaps_count = 1;
									$total_attendies_in_group = 0;
									$total_bookings_in_group = 0;
									$total_bookings = count($day_bookings);
									foreach($day_bookings as $index => $booking){
										$next_booking = (($index + 1) < $total_bookings) ? $day_bookings[$index + 1] : false;

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
								do_action('latepoint_calendar_daily_timeline', $day_date, ['agent_id' => $selected_agent->id, 'work_start_minutes' => $work_start_minutes, 'work_end_minutes' => $work_end_minutes, 'work_total_minutes' => $work_total_minutes]);
								?>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
			<?php }else{ ?>
			  <div class="no-results-w">
			    <div class="icon-w"><i class="latepoint-icon latepoint-icon-calendar"></i></div>
			    <h2><?php _e('Looks like you have not set your working hours yet.', 'latepoint'); ?></h2>
			    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('settings', 'general')); ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Set Working Hours', 'latepoint'); ?></span></a>
			  </div>
			<?php } ?>
		</div>
	</div>
<?php }else{ ?>

  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-users"></i></div>
    <h2><?php _e('No Existing Agents Found', 'latepoint'); ?></h2>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus"></i><span><?php _e('Add First Agent', 'latepoint'); ?></span></a>
  </div>
<?php } ?>