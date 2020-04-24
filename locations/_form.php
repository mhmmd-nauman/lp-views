<div class="os-form-w">
  <form action="" data-os-success-action="redirect" data-os-redirect-to="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('locations', 'index')); ?>" data-os-action="<?php echo $location->is_new_record() ? OsRouterHelper::build_route_name('locations', 'create') : OsRouterHelper::build_route_name('locations', 'update'); ?>">

    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
          <h3><?php _e('Basic Information', 'latepoint'); ?></h3>
          <?php if(!$location->is_new_record()){ ?>
            <div class="os-form-sub-header-actions"><?php echo __('Location ID:', 'latepoint').$location->id; ?></div>
          <?php } ?>  
        </div>
      </div>
      <div class="white-box-content">
        <div class="os-row">
          <div class="os-col-lg-4">
            <?php echo OsFormHelper::text_field('location[name]', __('Location Name', 'latepoint'), $location->name); ?>
            <?php echo OsFormHelper::select_field('location[status]', __('Status', 'latepoint'), array(LATEPOINT_SERVICE_STATUS_ACTIVE => __('Active', 'latepoint'), LATEPOINT_SERVICE_STATUS_DISABLED => __('Disabled', 'latepoint')), $location->status); ?>
            <?php echo OsFormHelper::media_uploader_field('location[selection_image_id]', 0, __('Location Photo', 'latepoint'), __('Remove Image', 'latepoint'), $location->selection_image_id); ?>
          </div>
          <div class="os-col-lg-8">
            <?php echo OsFormHelper::text_field('location[full_address]', __('Location Address', 'latepoint'), $location->full_address); ?>
            <?php if($location->full_address){ ?>
              <iframe width="100%" height="142" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo urlencode($location->full_address); ?>&output=embed"></iframe>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>


    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
          <h3><?php _e('Select Agents for This Location', 'latepoint'); ?></h3>
          <div class="os-form-sub-header-actions">
            <?php echo OsFormHelper::checkbox_field('select_all_agents', __('Select All', 'latepoint'), 'on', $location->is_new_record(), ['class' => 'os-select-all-toggler']); ?>
          </div>
        </div>
      </div>
      <div class="white-box-content">
        <div class="os-complex-agents-selector">
        <?php if($agents){
          foreach($agents as $agent){
            $is_active_agent = $location->is_new_record() ? true : $location->has_agent($agent->id);
            $is_active_agent_value = $is_active_agent ? 'yes' : 'no';
            $active_class = $is_active_agent ? 'active' : ''; 
            $services_count = $location->count_number_of_connected_services($agent->id);
            if($services_count == count($services)){
              $services_count_string = __('All', 'latepoint');
            }else{
              $services_count_string = $location->is_new_record() ? __('All', 'latepoint') : $services_count.'/'.count($services);
            }
            ?>

            <div class="agent <?php echo $active_class; ?>">
              <div class="agent-i selector-trigger">
                <div class="agent-avatar"><img src="<?php echo $agent->get_avatar_url(); ?>"/></div>
                <h3 class="agent-name"><?php echo $agent->full_name; ?></h3>
                <div class="selected-services" data-all-text="<?php echo __('All', 'latepoint'); ?>">
                  <strong><?php echo $services_count_string; ?></strong> 
                  <span><?php echo  __('Services Selected', 'latepoint'); ?></span>
                </div>
                <a href="#" class="customize-agent-service-btn"><i class="latepoint-icon latepoint-icon-ui-46"></i><span><?php echo __('Customize', 'latepoint'); ?></span></a>
              </div><?php
              if($services){ ?>
                <div class="agent-services-list-w">
                  <h4><?php echo sprintf(__('Select services %s will be offering at this location:', 'latepoint'), $agent->first_name); ?></h4>
                  <ul class="agent-services-list"><?php
                    foreach($services as $service){ 
                      $is_active_service = $location->is_new_record() ? true : $location->has_agent_and_service($agent->id, $service->id);
                      $is_active_service_value = $is_active_service ? 'yes' : 'no';
                      $active_class = $is_active_service ? 'active' : ''; ?>
                      <li class="<?php echo $active_class; ?>">
                        <?php echo OsFormHelper::hidden_field('location[agents][agent_'.$agent->id.'][service_'.$service->id.'][connected]', $is_active_service_value, array('class' => 'agent-service-connection'));?>
                        <?php echo $service->name; ?>
                      </li>
                    <?php } ?>
                  </ul>
                </div><?php
              } ?>
            </div><?php
          }
        }
        ?>
        </div>
      </div>
    </div>

    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
          <h3><?php _e('Location Schedule', 'latepoint'); ?></h3>
          <div class="os-form-sub-header-actions">
            <?php echo OsFormHelper::checkbox_field('is_custom_schedule', __('Set Custom Schedule', 'latepoint'), 'on', $is_custom_schedule, array('data-toggle-element' => '.custom-schedule-wrapper')); ?>
          </div>
        </div>
      </div>
      <div class="white-box-content">
        <div class="custom-schedule-wrapper" style="<?php if(!$is_custom_schedule) echo 'display: none;'; ?>">
          <?php $schedule_args = $location->is_new_record() ? ['flexible_search' => false] : ['location_id' => $location->id, 'flexible_search' => false]; ?>
          <?php OsWorkPeriodsHelper::generate_work_periods($custom_work_periods, $schedule_args, $location->is_new_record()); ?>
        </div>
        <div class="custom-schedule-wrapper" style="<?php if($is_custom_schedule) echo 'display: none;'; ?>">
          <div class="latepoint-message latepoint-message-subtle"><?php _e('This location is using general schedule which is set in main settings', 'latepoint'); ?></div>
        </div>
      </div>
    </div>

    <?php if(!$location->is_new_record()){ ?>
        
        <div class="white-box">
          <div class="white-box-header">
            <div class="os-form-sub-header"><h3><?php _e('Days With Custom Schedules', 'latepoint'); ?></h3></div>
          </div>
          <div class="white-box-content">
            <div class="latepoint-message latepoint-message-subtle"><?php _e('Location shares custom daily schedules that you set in general settings for your company, however you can add additional days with custom hours which will be specific to this location only.', 'latepoint'); ?></div>
            <?php OsWorkPeriodsHelper::generate_days_with_custom_schedule(['location_id' => $location->id]); ?>
          </div>
        </div>
        <div class="white-box">
          <div class="white-box-header">
            <div class="os-form-sub-header"><h3><?php _e('Holidays & Days Off', 'latepoint'); ?></h3></div>
          </div>
          <div class="white-box-content">
            <div class="latepoint-message latepoint-message-subtle"><?php _e('Location uses the same holidays you set in general settings for your company, however you can add additional holidays for this location here.', 'latepoint'); ?></div>
            <?php OsWorkPeriodsHelper::generate_off_days(['location_id' => $location->id]); ?>
          </div>
        </div>
    <?php } ?>
    <div class="os-form-buttons os-flex">
    <?php 
      if($location->is_new_record()){
        echo OsFormHelper::button('submit', __('Save Location', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
      }else{
        echo OsFormHelper::hidden_field('location[id]', $location->id);
        echo OsFormHelper::button('submit', __('Save Changes', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
        echo '<a href="#" class="latepoint-btn latepoint-btn-danger remove-location-btn" style="margin-left: auto;" 
                data-os-prompt="'.__('Are you sure you want to remove this location? It will remove all appointments associated with it. If you only want to temprorary disable it - it is better to just change status to disabled.', 'latepoint').'" 
                data-os-redirect-to="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('locations', 'index')).'" 
                data-os-params="'. OsUtilHelper::build_os_params(['id' => $location->id]). '" 
                data-os-success-action="redirect" 
                data-os-action="'.OsRouterHelper::build_route_name('locations', 'destroy').'">'.__('Delete Location', 'latepoint').'</a>';
      }

      ?>
    </div>
  </form>
</div>