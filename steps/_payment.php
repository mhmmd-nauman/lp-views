<div class="step-payment-w latepoint-step-content <?php echo $payment_css_class; ?>" 
  data-full-amount="<?php echo $booking->full_amount_to_charge(); ?>" 
  data-current-payment-step="<?php echo $payment_css_class; ?>" 
  data-prev-payment-step="" 
  data-default-portion="<?php echo OsBookingHelper::get_default_payment_portion_type($booking); ?>">
  <?php if(OsSettingsHelper::is_accepting_payments_cards()){ ?>
    <div class="lp-card-w">
      <?php if(OsSettingsHelper::is_env_demo()) echo '<div class="lp-demo-mode-msg">'.__('Demo Mode, click Next Step to proceed', 'latepoint').'</div>'; ?>
      <div class="lp-card-i">
        <div class="lp-card-chip"><div class="chip-i"></div></div>
        <div class="payment-type-credit-card">
          <h4 class="lp-card-header"><?php _e('Card Details', 'latepoint'); ?></h4>
          <div class="token"></div>
          <div class="os-row">
            <?php echo OsFormHelper::text_field('payment[name_on_card]', __('Name on card', 'latepoint'), '', array('class' => 'required'), array('class' => 'os-col-9')); ?>
            <?php echo OsFormHelper::text_field('payment[zip]', __('ZIP', 'latepoint'), '', array('class' => 'required'), array('class' => 'os-col-3')); ?>
            <?php echo OsFormHelper::hidden_field('payment[token]', ''); ?>
            <?php echo OsFormHelper::hidden_field('payment[type]', 'card'); ?>
          </div>
          <div class="os-row">
            <div class="os-col-12">
              <?php if(OsSettingsHelper::is_env_demo()){ ?>
                <?php echo OsFormHelper::text_field('payment[card_number]', __('Card Number', 'latepoint'), ''); ?>
              <?php }else{ ?>
                <div class="os-form-group os-form-group-transparent os-form-textfield-group">
                  <label for="payment_card_number"><?php _e('Card Number', 'latepoint'); ?></label>
                  <div id="payment_card_number" data-placeholder="<?php _e('Enter Card Number', 'latepoint'); ?>" class="os-form-control os-framed-field"></div>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="os-row">
            <div class="os-col-6">
            </div>
            <div class="os-col-3">
              <?php if(OsSettingsHelper::is_env_demo()){ ?>
                <?php echo OsFormHelper::text_field('payment[exp_date]', __('Exp.Date', 'latepoint'), ''); ?>
              <?php }else{ ?>
                <div class="os-form-group os-form-group-transparent os-form-textfield-group">
                  <label for="payment_card_expiration"><?php _e('Exp.Date', 'latepoint'); ?></label>
                  <div id="payment_card_expiration" data-placeholder="<?php _e('Exp.Date', 'latepoint'); ?>" class="os-form-control os-framed-field"></div>
                </div>
              <?php } ?>
            </div>
            <div class="os-col-3">
              <?php if(OsSettingsHelper::is_env_demo()){ ?>
                <?php echo OsFormHelper::text_field('payment[cvc]', __('CVC', 'latepoint'), ''); ?>
              <?php }else{ ?>
                <div class="os-form-group os-form-group-transparent os-form-textfield-group">
                  <label for="payment_card_cvc"><?php _e('CVC', 'latepoint'); ?></label>
                  <div id="payment_card_cvc" data-placeholder="<?php _e('CVC', 'latepoint'); ?>" class="os-form-control os-framed-field"></div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="latepoint-secured-payments-label"><?php _e('All transactions are secure and encrypted. Credit card information is never stored.', 'latepoint'); ?></div>
    </div>
  <?php } ?>
  <?php if(OsSettingsHelper::is_accepting_payments_paypal()){ ?>
    <div class="lp-paypal-btn-trigger-w">
      <div class="latepoint-step-content-text-centered">
        <h4><?php _e('Click the button below to pay using PayPal', 'latepoint'); ?></h4>
        <div><?php _e('You will be able to verify your booking information and confirm it before submitting the payment on the next step.', 'latepoint'); ?></div>
      </div>
      <?php if(OsSettingsHelper::is_env_demo()){ ?>
        <div class="lp-paypal-demo-mode-trigger"><img src="<?php echo LATEPOINT_IMAGES_URL.'payment_paypal.png'; ?>" alt=""><span><?php _e('Demo Mode, click here to continue', 'latepoint'); ?></span></div>
      <?php }else{ ?>
        <div class="lp-paypal-btn-trigger" data-deposit-amount="<?php echo $paypal_amount_to_charge[LATEPOINT_PAYMENT_PORTION_DEPOSIT];?>" data-full-amount="<?php echo $paypal_amount_to_charge[LATEPOINT_PAYMENT_PORTION_FULL];?>"></div>
      <?php } ?>
    </div>
  <?php } ?>


  <?php if(count($pay_times) == 2){ ?>
    <div class="lp-payment-times-w">
      <div class="latepoint-step-content-text-centered">
        <h4><?php _e('When would you like to pay for the service?', 'latepoint'); ?></h4>
        <div><?php _e('You can either pay now or pay locally on arriaval. You will be able to select payment method in the next step.', 'latepoint'); ?></div>
      </div>
      <div class="lp-options lp-options-grid lp-options-grid-three">
        <?php foreach($pay_times as $pay_time){
          echo $pay_time;
        } ?>
      </div>
    </div>
  <?php } ?>

  <?php if(count($pay_methods) == 2){ ?>
    <div class="lp-payment-methods-w">
      <div class="latepoint-step-content-text-centered">
        <h4><?php _e('How would you like to make a payment?', 'latepoint'); ?></h4>
        <div><?php _e('You can either make a full payment now or just leave a deposit and pay the rest after.', 'latepoint'); ?></div>
      </div>
      <div class="lp-options lp-options-grid lp-options-grid-three">
      <?php foreach($pay_methods as $pay_method){
        echo $pay_method;
      } ?>
      </div>
    </div>
  <?php } ?>

  <?php if(($booking->deposit_amount_to_charge() > 0) && ($booking->full_amount_to_charge() > 0)){ ?>
    <div class="lp-payment-portion-selection-w">
      <div class="latepoint-step-content-text-centered">
        <h4><?php _e('How much do you want to pay now?', 'latepoint'); ?></h4>
        <div><?php _e('You can either make a full payment now or just leave a deposit and pay the rest after.', 'latepoint'); ?></div>
      </div>
      <div class="lp-options lp-options-grid lp-options-grid-three">
        <div class="lp-option lp-trigger-payment-portion-selector" data-portion="<?php echo LATEPOINT_PAYMENT_PORTION_FULL; ?>">
          <div class="lp-option-amount-w">
            <div class="lp-option-amount lp-amount-full"><div class="lp-amount-value"><?php echo $booking->formatted_full_price() ?></div></div>
          </div>
          <div class="lp-option-label"><?php _e('Full Amount', 'latepoint'); ?></div>
        </div>
        <div class="lp-option lp-trigger-payment-portion-selector" data-portion="<?php echo LATEPOINT_PAYMENT_PORTION_DEPOSIT; ?>">
          <div class="lp-option-amount-w">
            <div class="lp-option-amount lp-amount-deposit"><div class="lp-slice"></div><div class="lp-amount-value"><?php echo $booking->formatted_deposit_price() ?></div></div>
          </div>
          <div class="lp-option-label"><?php _e('Deposit Only', 'latepoint'); ?></div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php echo OsBookingHelper::get_payment_total_info_html($booking); ?>
</div>