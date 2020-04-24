<div class="os-widget os-widget-animated" data-os-reload-action="<?php echo OsRouterHelper::build_route_name('dashboard', 'widget_agent_availability_timeline_for_period'); ?>">
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
	<div class="os-widget-content no-padding">
		<div class="agent-availability-timeslots-for-period">
			<?php echo $days_availability_html; ?>
		</div>
	</div>
</div>