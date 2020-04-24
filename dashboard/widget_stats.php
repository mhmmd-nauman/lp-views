<div class="os-widget os-widget-animated os-widget-stats" data-os-reload-action="<?php echo OsRouterHelper::build_route_name('dashboard', 'widget_top_agents'); ?>">
	<div class="os-widget-header with-actions">
		<h3 class="os-widget-header-text"><?php _e('Statistics', 'latepoint'); ?></h3>
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
		<div class="stats-grid">
			<div class="stats-grid-row">
				<div class="stats-grid-box">
					<div class="stats-grid-value">42</div>
					<div class="stats-grid-label">Bookings</div>
				</div>
				<div class="stats-grid-box">
					<div class="stats-grid-value">$1,353</div>
					<div class="stats-grid-label">Revenue</div>
				</div>
			</div>
			<div class="stats-grid-row">
				<div class="stats-grid-box">
					<div class="stats-grid-value">34</div>
					<div class="stats-grid-label">New Customers</div>
				</div>
				<div class="stats-grid-box">
					<div class="stats-grid-value">247</div>
					<div class="stats-grid-label">Hours Worked</div>
				</div>
			</div>
		</div>
		<div class="stats-progress-w">
			<div class="stats-progress-labels">
				<div class="stats-progress-value">78%</div>
				<div class="stats-progress-label">of Capacity Used</div>
				<div class="stats-progress-sub-value">234/400</div>
				<div class="stats-progress-sub-label">Hours</div>
			</div>
			<div class="stats-progress">
				<div class="stats-progress-bar" style="width: 75%;"></div>
			</div>
		</div>
	</div>
</div>