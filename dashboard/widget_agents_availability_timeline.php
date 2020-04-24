<div class="os-widget os-widget-animated" data-os-reload-action="<?php echo OsRouterHelper::build_route_name('dashboard', 'widget_agents_availability_timeline'); ?>">
	<div class="os-widget-header with-actions">
		<h3 class="os-widget-header-text"><?php _e('Availability', 'latepoint'); ?></h3>
		<div class="os-widget-header-actions-trigger"><i class="latepoint-icon latepoint-icon-more-horizontal"></i></div>
		<div class="os-widget-header-actions">
			<?php if($services){ ?>
				<select name="service_id" id="" class="os-trigger-reload-widget">
					<?php foreach($services as $service){ ?>
					<option value="<?php echo $service->id ?>" <?php if($service->id == $selected_service->id) echo 'selected="selected"' ?>><?php echo $service->name; ?></option>
					<?php } ?>
				</select>
			<?php } ?>
			<div class="os-date-range-picker" data-single-date="yes">
				<span class="range-picker-value"><?php echo $target_date_string; ?></span>
				<i class="latepoint-icon latepoint-icon-chevron-down"></i>
				<input type="hidden" name="date_from" value="<?php echo $target_date; ?>"/>
				<input type="hidden" name="date_to" value="<?php echo $target_date; ?>"/>
			</div>
		</div>
	</div>
	<div class="os-widget-content">
		<div class="agents-day-availability-timeslots">
			<?php 
			if($services && $agents){
				$agent_ids = array_map(function($agent){ return $agent->id; }, $agents);
				$shared_start_end_time = OsBookingHelper::get_work_start_end_time_for_date_multi_agent($agent_ids, array('service_id' => $selected_service->id, 'custom_date' => $target_date));
				foreach($agents as $agent){ 
					OsAgentHelper::availability_timeline($agent, $selected_service, OsLocationHelper::get_selected_location(), $target_date, array('preset_work_start_end_time' => $shared_start_end_time));
				}
			}else{ ?>
				  <div class="no-results-w">
				    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
				    <h2><?php _e('No Agents Created', 'latepoint'); ?></h2>
				    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Agent', 'latepoint'); ?></span></a>
				  </div>
				<?php 
			} ?>
		</div>
	</div>
</div>