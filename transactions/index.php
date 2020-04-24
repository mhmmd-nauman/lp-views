<?php if($transactions){ ?>
  <div class="os-transactions-list">
    <div class="os-table-w os-table-compact">
      <table class="os-table">
        <thead>
          <tr>
            <th><?php _e('ID', 'latepoint'); ?></th>
            <th><?php _e('Token', 'latepoint'); ?></th>
            <th><?php _e('Booking ID', 'latepoint'); ?></th>
            <th><?php _e('Customer', 'latepoint'); ?></th>
            <th><?php _e('Processor', 'latepoint'); ?></th>
            <th><?php _e('Method', 'latepoint'); ?></th>
            <th><?php _e('Amount', 'latepoint'); ?></th>
            <th><?php _e('Status', 'latepoint'); ?></th>
            <th><?php _e('Date', 'latepoint'); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($transactions as $transaction): ?>
            <tr>
              <td><?php echo $transaction->id; ?></td>
              <td><?php echo $transaction->token; ?></td>
              <td>
                <?php if($transaction->booking_id){ ?>
                <?php echo '<a href="#" class="in-table-link" '.OsBookingHelper::quick_booking_btn_html($transaction->booking_id).'>'.$transaction->booking->id.'</a>'; ?>
                <?php }else{ echo 'n/a'; } ?>
              </td>
              <td>
                <?php if($transaction->customer_id){ ?>
                  <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'edit_form'), array('id' => $transaction->customer_id) ) ?>"><?php echo $transaction->customer->full_name; ?></a>
                <?php }else{ echo 'n/a'; } ?>
              </td>
              <td><div class="lp-processor-logo lp-processor-logo-<?php echo $transaction->processor; ?>"><?php echo $transaction->processor; ?></div></td>
              <td><div class="lp-method-logo lp-method-logo-<?php echo $transaction->payment_method; ?>"><?php echo $transaction->payment_method; ?></div></td>
              <td><?php echo $transaction->amount; ?></td>
              <td><span class="lp-transaction-status lp-transaction-status-<?php echo $transaction->status; ?>"><?php echo $transaction->status; ?></span></td>
              <td><?php echo $transaction->created_at; ?></td>
            </tr>
            <?php 
          endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th><?php _e('ID', 'latepoint'); ?></th>
            <th><?php _e('Token', 'latepoint'); ?></th>
            <th><?php _e('Booking ID', 'latepoint'); ?></th>
            <th><?php _e('Customer', 'latepoint'); ?></th>
            <th><?php _e('Processor', 'latepoint'); ?></th>
            <th><?php _e('Method', 'latepoint'); ?></th>
            <th><?php _e('Amount', 'latepoint'); ?></th>
            <th><?php _e('Status', 'latepoint'); ?></th>
            <th><?php _e('Date', 'latepoint'); ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
      <div class="os-pagination-w">
        <div class="pagination-info"><?php echo sprintf(__('Showing transactions %d to %d of %d total', 'latepoint'), $showing_from, $showing_to, $total_transactions); ?></div>
        <ul>
          <?php 
          for($i = 1; $i <= ceil($total_transactions / $per_page); $i++){
            echo '<li>';
              if($current_page_number == $i){
                echo '<span>'.$i.'</span>';
              }else{
                echo '<a href="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('transactions', 'index'), array('page_number' => $i) ).'">'.$i.'</a>';
              }
            echo '</li>';
          } ?>
        </ul>
      </div>
<?php } ?>