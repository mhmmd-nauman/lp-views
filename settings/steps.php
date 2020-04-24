<div class="os-form-sub-header"><h3><?php _e('Step Editing', 'latepoint'); ?></h3></div>
<div class="steps-ordering-w" data-step-order-update-route="<?php echo OsRouterHelper::build_route_name('settings', 'udpate_order_of_steps'); ?>">
	<?php
	foreach($steps as $step){
		OsStepsHelper::output_step_edit_form($step);
	}
	?>
</div>
<?php if(!apply_filters('latepoint_can_add_custom_steps', false)){ ?>
	<a href="<?php echo OsRouterHelper::build_link(['addons', 'index']); ?>" class="os-add-box" >
    <div class="add-box-graphic-w"><div class="add-box-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div></div>
    <div class="add-box-label"><?php _e('Install Custom Steps Add-on', 'latepoint'); ?></div>
  </a>
  <?php
}else{
	do_action('latepoint_settings_steps_list_after');
} ?>
<div class="os-form-w">
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'update'); ?>">
		<div class="os-form-sub-header"><h3><?php _e('Other Step Settings', 'latepoint'); ?></h3></div>
		<?php echo OsFormHelper::checkbox_field('settings[steps_show_service_categories]', __('Show Service Categories', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('steps_show_service_categories') == 'on')); ?>
		<?php echo OsFormHelper::checkbox_field('settings[steps_show_agent_bio]', __('Show Agent Bio Popup', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('steps_show_agent_bio') == 'on')); ?>
		<?php echo OsFormHelper::checkbox_field('settings[steps_require_setting_password]', __('Require Customers to Set Account Password', 'latepoint'), 'on', OsSettingsHelper::is_on('steps_require_setting_password')); ?>
		<?php echo OsFormHelper::checkbox_field('settings[steps_hide_registration_prompt]', __('Hide "Create Account" Prompt on Confirmation Step', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('steps_hide_registration_prompt') == 'on')); ?>
		<?php echo OsFormHelper::checkbox_field('settings[steps_hide_login_register_tabs]', __('Remove Login/Register Tabs on Contact Info Step', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('steps_hide_login_register_tabs') == 'on')); ?>
		<?php echo OsFormHelper::checkbox_field('settings[steps_hide_agent_info]', __('Do not show Agent Name on Summary and Confirmation steps', 'latepoint'), 'on', OsSettingsHelper::is_on('steps_hide_agent_info')); ?>
    <?php echo OsFormHelper::checkbox_field('settings[manual_next_step]', __('Do not go to next step until a next step button is pressed', 'latepoint'), 'on', OsSettingsHelper::is_on('manual_next_step')); ?>
    <?php echo OsFormHelper::checkbox_field('settings[steps_skip_verify_step]', __('Skip Verification Step', 'latepoint'), 'on', OsSettingsHelper::is_on('steps_skip_verify_step')); ?>
    <?php echo OsFormHelper::checkbox_field('settings[steps_always_show_agent_step]', __('Always show agent selection step, even if only one agent is available', 'latepoint'), 'on', OsSettingsHelper::is_on('steps_always_show_agent_step')); ?>
    <?php echo OsFormHelper::checkbox_field('settings[allow_any_agent]', __('Add "Any Agent" option to agent selection', 'latepoint'), 'on', OsSettingsHelper::is_on('allow_any_agent'), array('data-toggle-element' => '.lp-any-agent-settings')); ?>
    <div class="lp-form-checkbox-contents lp-any-agent-settings" <?php echo (OsSettingsHelper::is_on('allow_any_agent')) ? '' : 'style="display: none;"' ?>>
      <h3><?php _e('Any Agent Settings', 'latepoint'); ?></h3>
      <?php echo OsFormHelper::select_field('settings[any_agent_order]', __('If "Any Agent" Selected Assign to', 'latepoint'), [ 
        LATEPOINT_ANY_AGENT_ORDER_RANDOM => __('Random', 'latepoint'),
        LATEPOINT_ANY_AGENT_ORDER_PRICE_HIGH => __('Most expensive agent', 'latepoint'),
        LATEPOINT_ANY_AGENT_ORDER_PRICE_LOW => __('Least expensive agent', 'latepoint'),
        LATEPOINT_ANY_AGENT_ORDER_BUSY_HIGH => __('Agent with most bookings on that day', 'latepoint'),
        LATEPOINT_ANY_AGENT_ORDER_BUSY_LOW => __('Agent with least bookings on that day', 'latepoint') ], OsSettingsHelper::get_any_agent_order()); ?>
    </div>
    <?php do_action('latepoint_settings_steps_after'); ?>
		<?php echo OsFormHelper::wp_editor_field('settings[steps_support_text]', 'settings_steps_support_text', __('Content for a bottom part of a booking side panel', 'latepoint'), OsSettingsHelper::get_steps_support_text(), array('editor_height' => 100)); ?>

		<div class="os-form-sub-header"><h3><?php _e('Tracking Code', 'latepoint'); ?></h3></div>
		<div class="available-vars-w">
		  <div class="latepoint-message latepoint-message-subtle">
		    <div><?php _e('You can track conversions from ads or other landing pages by placing a tracking code your ad manager generates on a confirmation page. You can use these variables in your tracking code. Click on the variable to copy.', 'latepoint'); ?></div>
		  </div>
		  <div class="available-vars-i">
		    <div class="available-vars-block">
		      <ul>
		        <li><span class="var-label"><?php _e('Appointment ID#:', 'latepoint'); ?></span> <span class="var-code os-click-to-copy">{booking_id}</span></li>
		        <li><span class="var-label"><?php _e('Service ID#:', 'latepoint'); ?></span> <span class="var-code os-click-to-copy">{service_id}</span></li>
		        <li><span class="var-label"><?php _e('Agent ID#:', 'latepoint'); ?></span> <span class="var-code os-click-to-copy">{agent_id}</span></li>
		        <li><span class="var-label"><?php _e('Customer ID#:', 'latepoint'); ?></span> <span class="var-code os-click-to-copy">{customer_id}</span></li>
					</ul>
				</div>
			</div>
		</div>
		<?php echo OsFormHelper::text_field('settings[confirmation_step_tracking_code]', __('Enter Tracking code here', 'latepoint'), OsSettingsHelper::get_settings_value('confirmation_step_tracking_code', '')); ?>
		<?php echo OsFormHelper::button('submit', __('Save Settings', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
	</form>
</div>
