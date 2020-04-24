<div class="latepoint-settings-w os-form-w">
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'update'); ?>">
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Email Settings', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">
        <?php echo OsFormHelper::checkbox_field('settings[notifications_email]', __('Enable Email Notifications', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notifications_email') == 'on')); ?>
      </div>
    </div>
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('SMS Settings', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">
        <?php if(apply_filters('latepoint_has_sms_processors', false)){ ?>
          <?php echo OsFormHelper::checkbox_field('settings[notifications_sms]', __('Enable SMS Notifications', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('notifications_sms') == 'on'), array('data-toggle-element' => '.lp-sms-processor-credentials')); ?>
          <div class="lp-form-checkbox-contents lp-sms-processor-credentials" <?php echo (OsSettingsHelper::get_settings_value('notifications_sms') == 'on') ? '' : 'style="display: none;"' ?>>
            <?php do_action('latepoint_notifications_settings_sms'); ?>
          </div>
        <?php }else{ ?>
          <a href="<?php echo OsRouterHelper::build_link(['addons', 'index']); ?>" class="os-add-box" >
            <div class="add-box-graphic-w"><div class="add-box-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div></div>
            <div class="add-box-label"><?php _e('Install SMS Processing Add-on', 'latepoint'); ?></div>
          </a><?php
        } ?>
      </div>
    </div>
    <?php echo OsFormHelper::button('submit', __('Save Settings', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
  </form>
</div>