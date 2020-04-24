<h3 class="os-wizard-sub-header"><?php echo sprintf(__('Step %d of %d', 'latepoint'), $current_step_number, 3); ?></h3>
<h2 class="os-wizard-header"><?php _e('Add services you offer', 'latepoint'); ?></h2>
<div class="os-wizard-desc"><?php _e('Day and, through to this separated is rhetoric regretting the magnitude, perception is keep in', 'latepoint'); ?></div>
<div class="os-wizard-step-content-i">
	<div class="os-form-w">
		<form action="" data-os-output-target=".os-wizard-step-content-i" data-os-after-call="latepoint_wizard_item_editing_cancelled" data-os-action="<?php echo OsRouterHelper::build_route_name('wizard', 'save_agent'); ?>">
			<?php echo OsFormHelper::text_field('settings[purchase_code]', __('Plugin Purchase Code', 'latepoint'), OsSettingsHelper::get_settings_value('purchase_code')); ?>
	  </form>
	</div>
</div>