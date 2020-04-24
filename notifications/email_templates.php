<?php include(LATEPOINT_VIEWS_ABSPATH. 'notifications/_available_vars.php'); ?>
<div class="latepoint-settings-w os-form-w">
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'update'); ?>">
    <div class="os-tp-box">
      <div class="os-tp-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Agent Email Notifications', 'latepoint'); ?></h3></div>
      </div>
      <div class="os-tp-box-content">
        <?php echo OsFormHelper::checkbox_field('settings[notification_agent_confirmation]', __('Enable Appointment Confirmation Email to Agent', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_agent_confirmation') == 'on'), array('data-toggle-element' => '.lp-notification-agent-confirmation')); ?>
        <div class="lp-form-checkbox-contents lp-notification-agent-confirmation" <?php echo (OsSettingsHelper::get_settings_value('notification_agent_confirmation') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_agent_new_booking_notification_subject]', __('Email Subject', 'latepoint'), OsNotificationsHelper::agent_new_booking_notification_subject()); ?>
          <?php OsFormHelper::wp_editor_field('settings[notification_agent_new_booking_notification_content]', 'settings_notification_agent_new_booking_notification_content', __('Email Message', 'latepoint'), OsNotificationsHelper::agent_new_booking_notification_content()); ?>
        </div>
        <?php echo OsFormHelper::checkbox_field('settings[notification_agent_booking_status_changed]', __('Enable Agent Notification of Appointment Status Change', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_agent_booking_status_changed') == 'on'), array('data-toggle-element' => '.lp-notification-agent-booking-status-changed')); ?>
        <div class="lp-form-checkbox-contents lp-notification-agent-booking-status-changed" <?php echo (OsSettingsHelper::get_settings_value('notification_agent_booking_status_changed') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_agent_booking_status_changed_notification_subject]', __('Email Subject', 'latepoint'), OsNotificationsHelper::agent_booking_status_changed_notification_subject()); ?>
          <?php OsFormHelper::wp_editor_field('settings[notification_agent_booking_status_changed_notification_content]', 'settings_notification_agent_booking_status_changed_notification_content', __('Email Message', 'latepoint'), OsNotificationsHelper::agent_booking_status_changed_notification_content()); ?>
        </div>
        <?php do_action('latepoint_after_agent_email_notification_templates'); ?>
      </div>
    </div>
    <div class="os-tp-box">
      <div class="os-tp-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Customer Email Notifications', 'latepoint'); ?></h3></div>
      </div>
      <div class="os-tp-box-content">
        <?php echo OsFormHelper::checkbox_field('settings[notification_customer_confirmation]', __('Enable Appointment Confirmation Email to Customer', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_customer_confirmation') == 'on'), array('data-toggle-element' => '.lp-notification-customer-booking-confirmation')); ?>
        <div class="lp-form-checkbox-contents lp-notification-customer-booking-confirmation" <?php echo (OsSettingsHelper::get_settings_value('notification_customer_confirmation') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_customer_booking_confirmation_subject]', __('Email Subject', 'latepoint'), OsNotificationsHelper::customer_booking_confirmation_subject()); ?>
          <?php OsFormHelper::wp_editor_field('settings[notification_customer_booking_confirmation_content]', 'settings_notification_customer_booking_confirmation_content', __('Email Message', 'latepoint'), OsNotificationsHelper::customer_booking_confirmation_content()); ?>
        </div>
        <?php echo OsFormHelper::checkbox_field('settings[notification_customer_booking_status_changed]', __('Enable Customer Notification of Appointment Status Change', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notification_customer_booking_status_changed') == 'on'), array('data-toggle-element' => '.lp-notification-customer-booking-status-changed')); ?>
        <div class="lp-form-checkbox-contents lp-notification-customer-booking-status-changed" <?php echo (OsSettingsHelper::get_settings_value('notification_customer_booking_status_changed') == 'on') ? '' : 'style="display: none;"' ?>>
          <?php echo OsFormHelper::text_field('settings[notification_customer_booking_status_changed_notification_subject]', __('Email Subject', 'latepoint'), OsNotificationsHelper::customer_booking_status_changed_notification_subject()); ?>
          <?php OsFormHelper::wp_editor_field('settings[notification_customer_booking_status_changed_notification_content]', 'settings_notification_customer_booking_status_changed_notification_content', __('Email Message', 'latepoint'), OsNotificationsHelper::customer_booking_status_changed_notification_content()); ?>
        </div>
        <?php do_action('latepoint_after_customer_email_notification_templates'); ?>
      </div>
    </div>
    <div class="os-tp-box">
      <div class="os-tp-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Other Customer Emails', 'latepoint'); ?></h3></div>
      </div>
      <div class="os-tp-box-content">
        <h3><?php _e('Customer Password Reset Request', 'latepoint'); ?></h3>
        <?php echo OsFormHelper::text_field('settings[email_customer_password_reset_request_subject]', __('Email Subject', 'latepoint'), OsNotificationsHelper::customer_password_reset_request_subject()); ?>
        <?php OsFormHelper::wp_editor_field('settings[email_customer_password_reset_request_content]', 'settings_email_customer_password_reset_request_content', __('Email Message', 'latepoint'), OsNotificationsHelper::customer_password_reset_request_content()); ?>
      </div>
    </div>
    <?php echo OsFormHelper::button('submit', __('Save Settings', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
  </form>
</div>