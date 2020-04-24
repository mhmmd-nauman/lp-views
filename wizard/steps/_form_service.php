<div class="os-form-w">
  <form action="" data-os-after-call="latepoint_wizard_item_editing_cancelled" data-os-output-target=".os-wizard-step-content-i" data-os-action="<?php echo OsRouterHelper::build_route_name('wizard', 'save_service'); ?>">
    <div class="os-row">
      <div class="os-col-lg-8">
        <?php echo OsFormHelper::text_field('service[name]', __('Service Name', 'latepoint'), $service->name); ?>
      </div>
      <div class="os-col-lg-4">
        <?php echo OsFormHelper::text_field('service[duration]', __('Duration (minutes)', 'latepoint'), $service->duration); ?>
      </div>
    </div>
    <?php 
      echo OsFormHelper::media_uploader_field('service[selection_image_id]', 0, __('Upload Image for Service', 'latepoint'), __('Remove Image', 'latepoint'), $service->selection_image_id);
      if(!$service->is_new_record()) echo OsFormHelper::hidden_field('service[id]', $service->id);
    ?>
    <?php if($agents){ ?>
      <h3 class="sub-header"><span><?php _e('Pick Agents for Service','latepoint'); ?></span></h3>
      <div class="os-agents-selector">
        <?php
        foreach($agents as $agent){
          $is_active_service = $service->is_new_record() ? true : $location->has_agent_and_service($agent->id, $service->id);
          $is_active_service_value = $is_active_service ? 'yes' : 'no';
          $active_class = $is_active_service ? 'active' : '';
          echo '<div class="agent '.$active_class.'">';
            echo '<div class="agent-avatar" style="background-image: url(' . $agent->get_avatar_url() . ')"></div>';
            echo '<div class="agent-name">' . $agent->full_name . '</div>';
            echo OsFormHelper::hidden_field('service[agents][agent_'.$agent->id.'][location_'.$location->id.'][connected]', $is_active_service_value, array('class' => 'agent-service-connection'));
          echo '</div>';
        } ?>
      </div>
    <?php } ?>
    <div class="side-by-side-buttons">
      <div class="os-row">
        <?php if(!isset($hide_cancel_btn)){ ?>
        <div class="os-col-lg-6">
          <button type="button" data-os-after-call="latepoint_wizard_item_editing_cancelled" data-os-output-target=".os-wizard-step-content" data-os-params="current_step=services" data-os-action="<?php echo OsRouterHelper::build_route_name('wizard', 'load_step'); ?>" class="wizard-finished-editing-trigger latepoint-btn latepoint-btn-lg latepoint-btn-secondary"><?php _e('Cancel', 'latepoint'); ?></button>
        </div>
        <?php } ?>
        <div class="os-col-lg-<?php echo(!isset($hide_cancel_btn)) ? '6' : '12'; ?>">
          <button type="submit" class="latepoint-btn latepoint-btn-lg latepoint-btn-primary">
            <i class="latepoint-icon latepoint-icon-checkmark"></i>
            <span><?php echo ($service->is_new_record()) ? __('Save Service', 'latepoint') : __('Save Changes', 'latepoint'); ?></span>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>