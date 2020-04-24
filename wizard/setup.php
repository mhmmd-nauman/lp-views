<div class="os-wizard-setup-w step-<?php echo $current_step; ?>">
	<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('dashboard', 'index')); ?>" class="os-wizard-close-trigger"><span>Close</span><i class="latepoint-icon latepoint-icon-x"></i></a>
	<div class="os-wizard-setup-i">
		<div class="os-wizard-step-content-w">
			<div class="os-wizard-step-content">
				<?php include($step_file_to_include); ?>
			</div>
	    <div class="os-wizard-footer">
	    	<?php echo OsFormHelper::hidden_field('current_step', $current_step, ['id' => 'wizard_current_step']); ?>
	      <a href="#" data-route-name="<?php echo OsRouterHelper::build_route_name('wizard', 'prev_step'); ?>" class="latepoint-btn latepoint-btn-lg latepoint-btn-white os-wizard-prev-btn" style="display: none;"><i class="latepoint-icon latepoint-icon-arrow-left"></i> <span><?php _e('Back', 'latepoint'); ?></span></a>
	      <a href="#" data-route-name="<?php echo OsRouterHelper::build_route_name('wizard', 'next_step'); ?>" class="latepoint-btn latepoint-btn-lg os-wizard-next-btn"><span><?php _e('Next Step', 'latepoint'); ?></span> <i class="latepoint-icon latepoint-icon-arrow-right"></i></a>
	    </div>
		</div>
	</div>
</div>