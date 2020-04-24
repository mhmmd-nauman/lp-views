<div class="os-row">
	<div class="os-col-lg-6">
		<div class="version-status-info" data-route="<?php echo OsRouterHelper::build_route_name('updates', 'check_version_status') ?>">
			<span class="loading"><?php _e('Checking Version Status', 'latepoint'); ?></span>
		</div>
		<div class="license-form-w">
			<?php include('_license_form.php'); ?>
		</div>
	</div>
	<div class="os-col-lg-6">
		<div class="version-log-w" data-route="<?php echo OsRouterHelper::build_route_name('updates', 'get_updates_log') ?>">
			<span class="loading"><?php _e('Loading Update Log', 'latepoint'); ?></span>
		</div>
	</div>
</div>