<form action="" data-os-success-action="reload" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'save_custom_day_schedule'); ?>">
	<div class="latepoint-lightbox-content">
  	<div class="custom-day-schedule-w">
	  	<div class="custom-day-calendar" data-show-schedule="<?php echo ($day_off) ? 'no' : 'yes'; ?>">
	  		<div class="custom-day-calendar-head">
					<h3><?php _e('Pick a Date', 'latepoint'); ?></h3>
	  			<?php echo OsFormHelper::select_field('custom_day_calendar_month', false, OsUtilHelper::get_months_for_select(), $target_date->format('n')); ?>
	  			<?php echo OsFormHelper::select_field('custom_day_calendar_year', false, [OsTimeHelper::today_date('Y'), OsTimeHelper::today_date('Y') + 1], $target_date->format('Y')); ?>
	  		</div>
	  		<div class="custom-day-calendar-month" data-route="<?php echo OsRouterHelper::build_route_name('calendars', 'load_monthly_calendar_days_only'); ?>">
	  			<?php OsBookingHelper::generate_monthly_calendar_days_only($target_date->format('Y-m-d'), $date_is_preselected); ?>
	  		</div>
	  	</div>
	  	<div class="custom-day-schedule">
	  		<div class="custom-day-schedule-head">
					<h3><?php _e('Set Schedule', 'latepoint'); ?></h3>
				</div>
  			<div class="weekday-schedule-form active">
		      <?php 
		      $args = ['period_id' => false, 'agent_id' => $agent_id, 'service_id' => $service_id, 'location_id' => $location_id];
		      $work_periods = false;
		      $preselected_date = '';
		      if($day_off){
		      	$args['start_time'] = 0;
		      	$args['end_time'] = 0;
		      }elseif($date_is_preselected){
		      	$preselected_date = $target_date->format('Y-m-d');
		      	$work_periods = new OsWorkPeriodModel();
		      	$work_periods = $work_periods->where(['agent_id' => $agent_id, 
		      																				'service_id' => $service_id, 
		      																				'location_id' => $location_id, 
		      																				'custom_date' => $target_date->format('Y-m-d')])->get_results_as_models();
		      }
		      if($work_periods){
	      		$allow_remove = false;
	      		foreach($work_periods as $work_period){
	      			echo OsWorkPeriodsHelper::generate_work_period_form(array('period_id' => $work_period->id, 
                                                                        'week_day' => $target_date->format('N'), 
                                                                        'is_active' => $work_period->is_active, 
                                                                        'agent_id' => $work_period->agent_id, 
                                                                        'service_id' => $work_period->service_id, 
                                                                        'location_id' => $work_period->location_id, 
                                                                        'start_time' => $work_period->start_time, 
                                                                        'custom_date' => $work_period->custom_date, 
                                                                        'end_time' => $work_period->end_time), $allow_remove);
	      			$allow_remove = true;
	      		}
	      	}else{
		      	echo OsWorkPeriodsHelper::generate_work_period_form($args, false);
		      }
		      ?>
          <div class="ws-period-add" data- 
          data-os-params="<?php echo OsUtilHelper::build_os_params(['custom_date' => $preselected_date, 
          																													'service_id' => $service_id, 
          																													'agent_id' => $agent_id, 
          																													'location_id' => $location_id]); ?>" 
          data-os-before-after="before" 
          data-os-after-call="latepoint_init_work_period_form"
          data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'load_work_period_form'); ?>">
            <div class="add-period-graphic-w">
              <div class="add-period-plus"><i class="latepoint-icon latepoint-icon-plus-square"></i></div>
            </div>
            <div class="add-period-label"><?php _e('Add another work period', 'latepoint'); ?></div>
          </div>
        </div>
	  	</div>
  	</div>
    <?php echo OsFormHelper::hidden_field('custom_day_date', $preselected_date, ['class' => 'custom_day_schedule_date']); ?>
	</div>
	<div class="latepoint-lightbox-footer" <?php if(!$date_is_preselected) echo 'style="display: none;"'; ?>>
  	<button type="submit" class="latepoint-btn latepoint-btn-block latepoint-btn-lg latepoint-btn-outline latepoint-save-day-schedule-btn"><?php echo ($day_off) ? __('Set as Day Off', 'latepoint') : __('Save Schedule', 'latepoint'); ?></button>
	</div>
</form>