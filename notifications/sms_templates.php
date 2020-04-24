<?php include(LATEPOINT_VIEWS_ABSPATH. 'notifications/_available_vars.php'); ?>
<div class="latepoint-settings-w os-form-w">
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'update'); ?>">
    <div class="os-tp-box">
      <div class="os-tp-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Messages to Agent', 'latepoint'); ?></h3></div>
      </div>
      <div class="os-tp-box-content">
        <?php echo OsFormHelper::checkbox_field('settings[notification_sms_agent_confirmation]', __('Enable Appointment Confirmation SMS to Agent', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_sms_agent_confirmation') == 'on'), array('data-toggle-element' => '.lp-agent-notification-sms-message')); ?>
        <div class="lp-form-checkbox-contents lp-agent-notification-sms-message" <?php echo (OsSettingsHelper::get_settings_value('notification_sms_agent_confirmation') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_sms_agent_new_booking_notification_message]', __('Message Content', 'latepoint'), OsNotificationsHelper::agent_new_booking_notification_sms_message()); ?>
        </div>
      </div>
    </div>
    <div class="os-tp-box">
      <div class="os-tp-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Messages to Customer', 'latepoint'); ?></h3></div>
      </div>
      <div class="os-tp-box-content">
        <?php echo OsFormHelper::checkbox_field('settings[notification_sms_customer_confirmation]', __('Enable Appointment Confirmation SMS to Customer', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_sms_customer_confirmation') == 'on'), array('data-toggle-element' => '.lp-customer-notification-sms-message')); ?>
        <div class="lp-form-checkbox-contents lp-customer-notification-sms-message" <?php echo (OsSettingsHelper::get_settings_value('notification_sms_customer_confirmation') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_sms_customer_booking_confirmation_message]', __('Message Content', 'latepoint'), OsNotificationsHelper::customer_booking_confirmation_sms_message()); ?>
        </div>
      </div>
    </div>
    <?php echo OsFormHelper::button('submit', __('Save Settings', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
  </form>
</div>