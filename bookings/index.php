<?php if($bookings){ ?>
  <div class="table-with-pagination-w">
    <div class="os-bookings-list">
      <div class="os-table-w os-table-compact">
        <table class="os-table" data-route="<?php echo OsRouterHelper::build_route_name('bookings', 'index'); ?>">
          <thead>
            <tr>
              <th><?php _e('ID', 'latepoint'); ?></th>
              <th><?php _e('Live Call', 'latepoint'); ?></th>
              <th><?php _e('Service', 'latepoint'); ?></th>
              <th><?php _e('Date', 'latepoint'); ?></th>
              <th><?php _e('Time', 'latepoint'); ?></th>
              <?php if(!$show_single_agent){ ?><th><?php _e('Agent', 'latepoint'); ?></th><?php } ?>
              <th><?php _e('Customer', 'latepoint'); ?></th>
              <th><?php _e('Status', 'latepoint'); ?></th>
              <th><?php _e('Created On', 'latepoint'); ?></th>
              <th><?php _e('Actions', 'latepoint'); ?></th>
            </tr>
            <tr>
              <th><?php echo OsFormHelper::text_field('filter[id]', __('ID', 'latepoint'), '', ['style' => 'width: 40px;', 'class' => 'os-table-filter']); ?></th>
              <th>&nbsp;</th>
              <th><?php echo OsFormHelper::select_field('filter[service_id]', false, OsServiceHelper::get_services_list(), '', ['placeholder' => __('All Services', 'latepoint'), 'class' => 'os-table-filter']); ?></th>
              <th colspan="2">
                <div class="os-form-group">
                  <div class="os-date-range-picker os-table-filter-datepicker" data-can-be-cleared="yes" data-no-value-label="<?php _e('Search by Appointment Date', 'latepoint'); ?>" data-clear-btn-label="<?php _e('Reset Date Search', 'latepoint'); ?>">
                    <span class="range-picker-value"><?php _e('Search by Appointment Date', 'latepoint'); ?></span>
                    <i class="latepoint-icon latepoint-icon-chevron-down"></i>
                    <input type="hidden" class="os-table-filter os-datepicker-date-from" name="filter[booking_date_from]" value=""/>
                    <input type="hidden" class="os-table-filter os-datepicker-date-to" name="filter[booking_date_to]" value=""/>
                  </div>
                </div>
              </th>
              <?php if(!$show_single_agent){ ?>
                <th><?php echo OsFormHelper::select_field('filter[agent_id]', false, OsAgentHelper::get_agents_list(), '', ['placeholder' => __('All Agents', 'latepoint'), 'class' => 'os-table-filter']); ?></th>
              <?php } ?>
              <th><?php echo OsFormHelper::text_field('filter[customer]', __('Search by Customer', 'latepoint'), '', ['class' => 'os-table-filter']); ?></th>
              <th><?php echo OsFormHelper::select_field('filter[status]', false, OsBookingHelper::get_statuses_list(), '', ['placeholder' => __('All Statuses', 'latepoint'), 'class' => 'os-table-filter']); ?></th>
              <th>
                <div class="os-form-group">
                  <div class="os-date-range-picker os-table-filter-datepicker" data-single-date="yes" data-can-be-cleared="yes" data-no-value-label="<?php _e('Filter Date', 'latepoint'); ?>" data-clear-btn-label="<?php _e('Reset Date Search', 'latepoint'); ?>">
                    <span class="range-picker-value"><?php _e('Filter Date', 'latepoint'); ?></span>
                    <i class="latepoint-icon latepoint-icon-chevron-down"></i>
                    <input type="hidden" class="os-table-filter os-datepicker-date-from" name="filter[created_date_from]" value=""/>
                    <input type="hidden" class="os-table-filter os-datepicker-date-to" name="filter[created_date_to]" value=""/>
                  </div>
                </div>
              </th>
              <th><a href="<?php echo OsRouterHelper::build_admin_post_link(OsRouterHelper::build_route_name('bookings', 'index') ) ?>" target="_blank" class="latepoint-btn latepoint-btn-primary download-csv-with-filters"><i class="latepoint-icon latepoint-icon-download"></i><span><?php _e('Download .csv', 'latepoint'); ?></span></a></th>
            </tr>
          </thead>
          <tbody>
            <?php include('_table_body.php'); ?>
          </tbody>
          <tfoot>
            <tr>
              <th><?php _e('ID', 'latepoint'); ?></th>
              <th><?php _e('Service', 'latepoint'); ?></th>
              <th><?php _e('Date', 'latepoint'); ?></th>
              <th><?php _e('Time', 'latepoint'); ?></th>
              <?php if(!$show_single_agent){ ?><th><?php _e('Agent', 'latepoint'); ?></th><?php } ?>
              <th><?php _e('Customer', 'latepoint'); ?></th>
              <th><?php _e('Status', 'latepoint'); ?></th>
              <th><?php _e('Created On', 'latepoint'); ?></th>
              <th><?php _e('Actions', 'latepoint'); ?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="os-pagination-w">
      <div class="pagination-info"><?php echo __('Showing bookings', 'latepoint'). ' <span class="os-pagination-from">'. $showing_from . '</span> '.__('to', 'latepoint').' <span class="os-pagination-to">'. $showing_to .'</span> '.__('of', 'latepoint').' <span class="os-pagination-total">'. $total_bookings. '</span>'; ?></div>
      <div class="pagination-page-select-w">
        <label for=""><?php _e('Page:', 'latepoint'); ?></label>
        <select name="page" class="pagination-page-select">
          <?php 
          for($i = 1; $i <= $total_pages; $i++){
            $selected = ($current_page_number == $i) ? 'selected' : '';
            echo '<option '.$selected.'>'.$i.'</option>';
          } ?>
        </select>
      </div>
    </div>
  </div>

<?php }else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-book"></i></div>
    <h2><?php _e('No Existing Appointments Found', 'latepoint'); ?></h2>
    <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus"></i><span><?php _e('Add First Appointment', 'latepoint'); ?></span></a>
  </div>
<?php } ?>