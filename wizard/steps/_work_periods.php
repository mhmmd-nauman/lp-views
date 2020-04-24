<h3 class="os-wizard-sub-header"><?php echo sprintf(__('Step %d of %d', 'latepoint'), $current_step_number, 3); ?></h3>
<h2 class="os-wizard-header"><?php _e('Set Your Work Hours', 'latepoint'); ?></h2>
<div class="os-wizard-desc"><?php _e('These will be your default work hours, they will be default work hours for all your locations, agents and services. You can set custom hours for each agent, service or location in LatePoint admin panel.', 'latepoint'); ?></div>
<div class="os-wizard-step-content-i">
  <form class="weekday-schedules-w">
      <?php OsWorkPeriodsHelper::generate_work_periods(); ?>
  </form>
</div>