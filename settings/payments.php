<div class="latepoint-settings-w os-form-w">
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('settings', 'update'); ?>">
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Payment Settings', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">
        <?php if(apply_filters('latepoint_total_payment_methods', 1) > 1){ ?>
          <?php echo OsFormHelper::checkbox_field('settings[enable_payments]', __('Enable Accepting Payments', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('enable_payments') == 'on'), array('data-toggle-element' => '.lp-payments-settings')); ?>
          <div class="lp-form-checkbox-contents lp-payments-settings" <?php echo (OsSettingsHelper::get_settings_value('enable_payments') == 'on') ? '' : 'style="display: none;"' ?>>
            <?php echo OsFormHelper::select_field('settings[payments_environment]', __('Environment', 'latepoint'), array(LATEPOINT_ENV_LIVE => __('Live (Production)', 'latepoint'), LATEPOINT_ENV_DEV => __('Sandbox (Development)', 'latepoint'), LATEPOINT_ENV_DEMO => __('Demo', 'latepoint')), OsSettingsHelper::get_payments_environment()); ?>

            <?php if(apply_filters('latepoint_has_cc_payment_processors', false)){ ?>
              <?php echo OsFormHelper::checkbox_field('settings[enable_payments_cc]', __('Accept Credit Cards', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('enable_payments_cc') == 'on'), array('data-toggle-element' => '.lp-payments-cc')); ?>
              <div class="lp-form-checkbox-contents lp-payments-cc" <?php echo (OsSettingsHelper::get_settings_value('enable_payments_cc') == 'on') ? '' : 'style="display: none;"' ?>>
                <?php do_action('latepoint_payment_settings_credit_cards'); ?>
              </div>
            <?php } ?>
            <?php do_action('latepoint_payment_settings_other'); ?>

            <?php echo OsFormHelper::checkbox_field('settings[enable_payments_local]', __('Allow Paying Locally', 'latepoint'), 'on', (OsSettingsHelper::get_settings_value('enable_payments_local') == 'on')); ?>
          </div>
        <?php }else{ ?>
          <a href="<?php echo OsRouterHelper::build_link(['addons', 'index']); ?>" class="os-add-box" >
            <div class="add-box-graphic-w"><div class="add-box-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div></div>
            <div class="add-box-label"><?php _e('Install Payment Gateway Add-on', 'latepoint'); ?></div>
          </a><?php
        } ?>
      </div>
    </div>
    <?php echo OsFormHelper::button('submit', __('Save Settings', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
  </form>
</div>