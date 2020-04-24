<div class="quick-transaction-info-w">
  <div class="quick-transaction-head">
    <div class="quick-transaction-amount"><?php echo OsMoneyHelper::format_price($transaction->amount); ?></div>
    <div class="lp-processor-logo lp-processor-logo-<?php echo $transaction->processor; ?>"><?php echo $transaction->processor; ?></div>
    <?php if($transaction->payment_method == LATEPOINT_PAYMENT_METHOD_CARD) echo '<div class="lp-method-logo"><i class="latepoint-icon latepoint-icon-credit-card"></i></div>'; ?>
    <?php if($transaction->payment_method == LATEPOINT_PAYMENT_METHOD_PAYPAL) echo '<div class="lp-method-logo"><i class="latepoint-icon latepoint-icon-paypal"></i></div>'; ?>
    <div class="lp-transaction-status lp-transaction-status-<?php echo $transaction->status; ?>"><?php echo $transaction->status; ?></div>
  </div>
  <div class="quick-transaction-sub">
    <div><?php echo $transaction->formatted_created_date(get_option( 'date_format' )); ?></div>
    <div><?php echo $transaction->token; ?></div>
  </div>
</div>