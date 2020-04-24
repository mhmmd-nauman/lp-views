<div class="os-form-w">
  <form action="" data-os-success-action="redirect" data-os-redirect-to="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'index')); ?>" data-os-action="<?php echo $service->is_new_record() ? OsRouterHelper::build_route_name('services', 'create') : OsRouterHelper::build_route_name('services', 'update'); ?>">

    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
          <h3><?php _e('Basic Information', 'latepoint'); ?></h3>
          <?php if(!$service->is_new_record()){ ?>
            <div class="os-form-sub-header-actions"><?php echo __('Service ID:', 'latepoint').$service->id; ?></div>
          <?php } ?>  
        </div>
      </div>
      <div class="white-box-content">
        <div class="os-row">
          <div class="os-col-lg-6">
            <?php echo OsFormHelper::text_field('service[name]', __('Service Name', 'latepoint'), $service->name); ?>
            <?php echo OsFormHelper::service_selector_adder_field('service[category_id]', __('Category', 'latepoint'), __('Add Category', 'latepoint'), $service_categories_for_select, $service->category_id); ?>
            <?php echo OsFormHelper::color_picker('service[bg_color]', __('Background Color', 'latepoint'), $service->bg_color); ?>
          </div>
          <div class="os-col-lg-6">
            <?php echo OsFormHelper::textarea_field('service[short_description]', __('Short Description', 'latepoint'), $service->short_description, array('rows' => 1)); ?>
            <?php echo OsFormHelper::select_field('service[status]', __('Status', 'latepoint'), array(LATEPOINT_SERVICE_STATUS_ACTIVE => __('Active', 'latepoint'), LATEPOINT_SERVICE_STATUS_DISABLED => __('Disabled', 'latepoint')), $service->status); ?>
            <?php echo OsFormHelper::select_field('service[visibility]', __('Visibility', 'latepoint'), array(LATEPOINT_SERVICE_VISIBILITY_VISIBLE => __('Visible to everyone', 'latepoint'), LATEPOINT_SERVICE_VISIBILITY_HIDDEN => __('Visible only to admins and agents', 'latepoint')), $service->visibility); ?>
          </div>
        </div>
      </div>
    </div>


    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Media', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">

        <div class="os-row">
          <div class="os-col-lg-6">
            <div class="label-with-description">
              <h3><?php _e('Selection Image', 'latepoint'); ?></h3>
              <div class="label-desc"><?php _e('This image will be used as a background image of the header and category tile for the single page with full description of the service', 'latepoint'); ?></div>
            </div>
            <?php echo OsFormHelper::media_uploader_field('service[selection_image_id]', 0, __('Step Image', 'latepoint'), __('Remove Image', 'latepoint'), $service->selection_image_id); ?>
          </div>
          <div class="os-col-lg-6">
            <div class="label-with-description">
              <h3><?php _e('Service Page Image', 'latepoint'); ?></h3>
              <div class="label-desc"><?php _e('This image will be used as a background image of the header and category tile for the single page with full description of the service', 'latepoint'); ?></div>
            </div>
            <?php echo OsFormHelper::media_uploader_field('service[description_image_id]', 0, __('Step Image', 'latepoint'), __('Remove Image', 'latepoint'), $service->description_image_id); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Service Durations', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">
        <div class="service-duration-box">
          <div class="os-row">
            <div class="os-col-lg-4">
              <?php echo OsFormHelper::text_field('service[duration]', __('Service Duration (minutes)', 'latepoint'), $service->duration); ?>
            </div>
            <div class="os-col-lg-4">
              <?php echo OsFormHelper::text_field('service[charge_amount]', __('Charge Amount', 'latepoint'), $service->charge_amount); ?>
            </div>
            <div class="os-col-lg-4">
              <?php echo OsFormHelper::text_field('service[deposit_amount]', __('Deposit Amount', 'latepoint'), $service->deposit_amount); ?>
            </div>
          </div>
        </div>
        <?php do_action('latepoint_service_edit_durations', $service); ?>
      </div>
    </div>
    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header"><h3><?php _e('Other Price and Duration Settings', 'latepoint'); ?></h3></div>
      </div>
      <div class="white-box-content">
        <div class="os-row">
          <div class="os-col-lg-2">
            <?php echo OsFormHelper::text_field('service[price_min]', __('Minimum Price', 'latepoint'), $service->price_min); ?>
          </div>
          <div class="os-col-lg-2">
            <?php echo OsFormHelper::text_field('service[price_max]', __('Maximum Price', 'latepoint'), $service->price_max); ?>
          </div>
          <div class="os-col-lg-2">
            <?php echo OsFormHelper::text_field('service[buffer_before]', __('Buffer Before (minutes)', 'latepoint'), $service->buffer_before); ?>
          </div>
          <div class="os-col-lg-2">
            <?php echo OsFormHelper::text_field('service[buffer_after]', __('Buffer After (minutes)', 'latepoint'), $service->buffer_after); ?>
          </div>
          <div class="os-col-lg-4">
            <?php echo OsFormHelper::text_field('service[timeblock_interval]', __('Override Time Intervals (minutes)', 'latepoint'), $service->timeblock_interval); ?>
          </div>
        </div>
      </div>
    </div>

    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
          <h3><?php _e('Agents', 'latepoint'); ?></h3>
          <div class="os-form-sub-header-actions">
            <?php echo OsFormHelper::checkbox_field('select_all_agents', __('Select All', 'latepoint'), 'off', false, ['class' => 'os-select-all-toggler']); ?>
          </div>
        </div>
      </div>
      <div class="white-box-content">

        <div class="os-complex-agents-selector">
        <?php if($agents){
          foreach($agents as $agent){
            $is_active_agent = $service->is_new_record() ? true : $service->has_agent($agent->id);
            $is_active_agent_value = $is_active_agent ? 'yes' : 'no';
            $active_class = $is_active_agent ? 'active' : ''; 
            $locations_count = $service->count_number_of_connected_locations($agent->id);
            if($locations_count == count($locations)){
              $locations_count_string = __('All', 'latepoint');
            }else{
              $locations_count_string = $service->is_new_record() ? __('All', 'latepoint') : $locations_count.'/'.count($locations);
            }
            ?>

            <div class="agent <?php echo $active_class; ?>">
              <div class="agent-i selector-trigger">
                <div class="agent-avatar"><img src="<?php echo $agent->get_avatar_url(); ?>"/></div>
                <h3 class="agent-name"><?php echo $agent->full_name; ?></h3>
                <div class="selected-services" data-all-text="<?php echo __('All', 'latepoint'); ?>">
                  <strong><?php echo $locations_count_string; ?></strong> 
                  <span><?php echo  __('Locations Selected', 'latepoint'); ?></span>
                </div>
                <a href="#" class="customize-agent-service-btn"><i class="latepoint-icon latepoint-icon-ui-46"></i><span><?php echo __('Customize', 'latepoint'); ?></span></a>
              </div><?php
              if($locations){ ?>
                <div class="agent-services-list-w">
                  <h4><?php echo sprintf(__('Select services %s will be offering at this service:', 'latepoint'), $agent->first_name); ?></h4>
                  <ul class="agent-services-list"><?php
                    foreach($locations as $location){ 
                      $is_active_service = $service->is_new_record() ? true : $location->has_agent_and_service($agent->id, $service->id);
                      $is_active_service_value = $is_active_service ? 'yes' : 'no';
                      $active_class = $is_active_service ? 'active' : ''; ?>
                      <li class="<?php echo $active_class; ?>">
                        <?php echo OsFormHelper::hidden_field('service[agents][agent_'.$agent->id.'][location_'.$location->id.'][connected]', $is_active_service_value, array('class' => 'agent-service-connection'));?>
                        <?php echo $location->name; ?>
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
          <h3><?php _e('Service Schedule', 'latepoint'); ?></h3>
          <div class="os-form-sub-header-actions">
            <?php echo OsFormHelper::checkbox_field('is_custom_schedule', __('Set Custom Schedule', 'latepoint'), 'on', $is_custom_schedule, array('data-toggle-element' => '.custom-schedule-wrapper')); ?>
          </div>
        </div>
      </div>
      <div class="white-box-content">
        <div class="custom-schedule-wrapper" style="<?php if(!$is_custom_schedule) echo 'display: none;'; ?>">
          <?php $schedule_args = $service->is_new_record() ? [] : array('service_id' => $service->id); ?>
          <?php OsWorkPeriodsHelper::generate_work_periods($custom_work_periods, $schedule_args, $service->is_new_record()); ?>
        </div>
        <div class="custom-schedule-wrapper" style="<?php if($is_custom_schedule) echo 'display: none;'; ?>">
          <div class="latepoint-message latepoint-message-subtle"><?php _e('This service is using general schedule which is set in main settings', 'latepoint'); ?></div>
        </div>
      </div>
    </div>

    <?php if(!$service->is_new_record()){ ?>

        
        <div class="white-box">
          <div class="white-box-header">
            <div class="os-form-sub-header"><h3><?php _e('Days With Custom Schedules', 'latepoint'); ?></h3></div>
          </div>
          <div class="white-box-content">
            <div class="latepoint-message latepoint-message-subtle"><?php _e('Service shares custom daily schedules that you set in general settings for your company, however you can add additional days with custom hours which will be specific to this service only.', 'latepoint'); ?></div>
            <?php OsWorkPeriodsHelper::generate_days_with_custom_schedule(['service_id' => $service->id]); ?>
          </div>
        </div>
        <div class="white-box">
          <div class="white-box-header">
            <div class="os-form-sub-header"><h3><?php _e('Holidays & Days Off', 'latepoint'); ?></h3></div>
          </div>
          <div class="white-box-content">
            <div class="latepoint-message latepoint-message-subtle"><?php _e('Service uses the same holidays you set in general settings for your company, however you can add additional holidays for this service here.', 'latepoint'); ?></div>
            <?php OsWorkPeriodsHelper::generate_off_days(['service_id' => $service->id]); ?>
          </div>
        </div>
    <?php } ?>
    <?php do_action('latepoint_service_form_after', $service); ?>
    <div class="os-form-buttons os-flex">
    <?php 
      if($service->is_new_record()){
        echo OsFormHelper::button('submit', __('Add Service', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
      }else{
        echo OsFormHelper::hidden_field('service[id]', $service->id);
        echo OsFormHelper::button('submit', __('Save Changes', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
        echo '<a href="#" class="latepoint-btn latepoint-btn-danger remove-service-btn" style="margin-left: auto;" 
                data-os-prompt="'.__('Are you sure you want to remove this service? It will remove all appointments associated with it. You can also change status to disabled if you want to temprorary disable it instead.', 'latepoint').'" 
                data-os-redirect-to="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'index')).'" 
                data-os-params="'. OsUtilHelper::build_os_params(['id' => $service->id]). '" 
                data-os-success-action="redirect" 
                data-os-action="'.OsRouterHelper::build_route_name('services', 'destroy').'">'.__('Delete Service', 'latepoint').'</a>';
      }

      ?>
    </div>
  </form>
</div>