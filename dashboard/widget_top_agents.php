<div class="os-widget os-widget-animated os-widget-top-agents" data-os-reload-action="<?php echo OsRouterHelper::build_route_name('dashboard', 'widget_top_agents'); ?>">
	<div class="os-widget-header with-actions">
		<h3 class="os-widget-header-text"><?php _e('Top Agents', 'latepoint'); ?></h3>
		<div class="os-widget-header-actions-trigger"><i class="latepoint-icon latepoint-icon-more-horizontal"></i></div>
		<div class="os-widget-header-actions">
			<div class="os-date-range-picker">
				<span class="range-picker-value"><?php echo $date_period_string; ?></span>
				<input type="hidden" name="date_from" value="<?php echo $date_from; ?>"/>
				<input type="hidden" name="date_to" value="<?php echo $date_to; ?>"/>
				<i class="latepoint-icon latepoint-icon-chevron-down"></i>
			</div>
		</div>
	</div>
	<div class="os-widget-content no-padding">
	<?php 
	if($top_agents){
		foreach($top_agents as $top_agent){ 
			$agent = new OsAgentModel($top_agent->agent_id);
			?>
			<div class="agent-stats-box">
				<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'edit_form'), array('id' => $agent->id) ) ?>" class="agent-info">
					<span class="avatar-w" style="background-image: url(<?php echo $agent->get_avatar_url(); ?>);"></span>
					<span class="agent-name"><?php echo $agent->full_name; ?></span>
				</a>
				<div class="agent-stats">
					<div class="agent-stats-values">
						<div class="agent-stats-value">
							<strong><?php echo $top_agent->total_appointments; ?></strong>
							<div><?php _e('Bookings', 'latepoint'); ?></div>
						</div>
						<div class="agent-stats-value">
							<strong><?php echo round($top_agent->total_minutes/60, 1); ?></strong>
							<div><?php _e('Hours', 'latepoint'); ?></div>
						</div>
						<div class="agent-stats-value">
							<strong><?php echo OsMoneyHelper::format_price($top_agent->total_price); ?></strong>
							<div><?php _e('Revenue', 'latepoint'); ?></div>
						</div>
					</div>
					<div class="agent-stats-chart">
						<div class="agent-chart-progress">
							<?php foreach($top_agent->service_breakdown as $service_info){ ?>
							<div class="ac-progress-value" style="width: <?php echo $service_info['total_appointments'] / $top_agent->total_appointments * 100; ?>%; background-color: <?php echo $service_info['bg_color']; ?>">
								<div class="progress-label-w">
									<div class="progress-value"><strong><?php echo $service_info['total_appointments']; ?></strong> <span><?php _e('Bookings', 'latepoint'); ?></span></div>
									<div class="progress-label"><?php echo $service_info['name']; ?></div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php }else{ ?>
	  <div class="no-results-w">
	    <div class="icon-w"><i class="latepoint-icon latepoint-icon-grid"></i></div>
	    <h2><?php _e('No Appointments in Period', 'latepoint'); ?></h2>
	    <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus-square"></i><span><?php _e('Create Appointment', 'latepoint'); ?></span></a>
	  </div>
	<?php } ?>
	</div>
</div>