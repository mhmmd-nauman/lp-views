<?php 
if($agents){ ?>
	<?php if(!$calendar_only){ ?>
		<div class="page-header-main-actions">
			<label><?php _e('Calendar Month', 'latepoint'); ?></label>
			<?php echo OsFormHelper::select_field('monthly_calendar_month_select', false, OsUtilHelper::get_months_for_select(), $calendar_start_date->format('n')); ?>
			<?php echo OsFormHelper::select_field('monthly_calendar_year_select', false, [OsTimeHelper::today_date('Y') - 1, OsTimeHelper::today_date('Y'), OsTimeHelper::today_date('Y') + 1], $calendar_start_date->format('Y')); ?>
		</div>
	<?php } ?>
	<?php
	$agents_head_html = '';
	foreach($agents as $agent){
		$agents_head_html.= 
			'<div class="ma-head-agent">
				<div class="ma-head-agent-avatar" style="background-image: url('.$agent->get_avatar_url().')"></div>
				<div class="ma-head-agent-name">'.$agent->full_name.'</div>
			</div>';
	}
	$calendar_not_scrollable_class = (count($agents) > 4) ? '' : 'calendar-month-not-scrollable';
	if(!$calendar_only) echo '<div class="calendar-month-agents-w '.$calendar_not_scrollable_class.'" data-route="'.OsRouterHelper::build_route_name('calendars', 'monthly_agents').'">';
		echo '<div class="ma-floated-days-w">';
			echo '<div class="ma-head-info"><span>'.__('Date', 'latepoint').'</span><span>'.__('Agent', 'latepoint').'</span></div>';
			$calendar_start_date = new OsWpDateTime($start_date_string);
			for($i = 0; $i < $calendar_start_date->format('d'); $i++){
		    list($work_start_minutes, $work_end_minutes) = OsBookingHelper::get_work_start_end_time_for_date(['custom_date' => $calendar_start_date->format('Y-m-d')]);
				$total_work_time = $work_end_minutes - $work_start_minutes;
				echo '<div class="ma-day ma-day-number-'.$calendar_start_date->format('N').'">';
					echo '<div class="ma-day-info">';
						echo '<span class="ma-day-number">'.$calendar_start_date->format('j').'</span>';
						echo '<span class="ma-day-weekday">'.OsUtilHelper::get_weekday_name_by_number($calendar_start_date->format('N'), true).'</span>';
					echo '</div>';
				echo '</div>';
		    $calendar_start_date->modify('+1 day');
			}
		echo '</div>';
		echo '<div class="ma-days-with-bookings-w">';
			echo '<div class="ma-days-with-bookings-i">';
				echo '<div class="ma-head">';
					echo $agents_head_html;
				echo '</div>';
				$calendar_start_date = new OsWpDateTime($start_date_string);
				for($i = 0; $i < $calendar_start_date->format('d'); $i++){
					echo '<div class="ma-day ma-day-number-'.$calendar_start_date->format('N').'">';
						foreach($agents as $agent){
					    list($work_start_minutes, $work_end_minutes) = OsBookingHelper::get_work_start_end_time_for_date(['custom_date' => $calendar_start_date->format('Y-m-d'), 'agent_id' => $agent->id]);
							$total_work_time = $work_end_minutes - $work_start_minutes;
							echo '<div class="ma-day-agent-bookings">';
								if($total_work_time > 0){
									$day_bookings = OsBookingHelper::get_bookings_for_date($calendar_start_date->format('Y-m-d'), ['agent_id' => $agent->id, 'location_id' => OsLocationHelper::get_selected_location_id()]);
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

												$width = ($booking->end_time - $booking->start_time) / $total_work_time * 100;
												$left = ($booking->start_time - $work_start_minutes) / $total_work_time * 100;
												
												$max_capacity = OsServiceHelper::get_max_capacity($booking->service);
												if($max_capacity > 1){
												  $action_html = OsBookingHelper::group_booking_btn_html($booking->id);
												}else{
													$action_html = OsBookingHelper::quick_booking_btn_html($booking->id);
												}
												if($width <= 0 || $left >= 100 || (($left + $width) <= 0)) continue;
												if($left < 0){
													$width = $width + $left;
													$left = 0;
												}
												if(($left + $width) > 100) $width = 100 - $left;

												echo '<div class="ma-day-booking" style="left: '.$left.'%; width: '.$width.'%; background-color: '.$booking->service->bg_color.'" '.$action_html.'>';
																$hide_agent_info = true;
																include(LATEPOINT_VIEWS_ABSPATH.'dashboard/_booking_info_box_small.php');
												echo '</div>';
												// time overlaps
												$overlaps_count = ($next_booking && ($next_booking->start_time < $booking->end_time)) ? $overlaps_count + 1 : 1;
												// reset
												$total_attendies_in_group = 0;
											}
										}
									}
								}else{
									echo '<div class="ma-day-off"><span>'.__('Day Off', 'latepoint').'</span></div>';
								}
							echo '</div>';
						}
					echo '</div>';
			    $calendar_start_date->modify('+1 day');
			}
			echo '</div>';
		echo '</div>';
	if(!$calendar_only) echo '</div>';
}else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
    <h2><?php _e('No Agents Created', 'latepoint'); ?></h2>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Agent', 'latepoint'); ?></span></a>
  </div>
<?php } ?>
