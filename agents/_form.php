<div class="os-form-w">
	<?php if($show_admin_fields){ ?>
	<form action="" 
		data-os-success-action="redirect" 
		data-os-redirect-to="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'index')); ?>" 
		data-os-record-id-holder="agent[id]" data-os-action="<?php echo $agent->is_new_record() ? OsRouterHelper::build_route_name('agents', 'create') : OsRouterHelper::build_route_name('agents', 'update'); ?>">
	<?php }else{ ?>
	<form action="" 
		data-os-success-action="redirect" 
		data-os-redirect-to="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('dashboard', 'for_agent')); ?>" 
		data-os-action="<?php echo OsRouterHelper::build_route_name('agents', 'update'); ?>">
	<?php } ?>
		    <div class="white-box">
		      <div class="white-box-header">
		        <div class="os-form-sub-header">
		        	<h3><?php _e('General Information', 'latepoint'); ?></h3>
			        <?php if(!$agent->is_new_record()){ ?>
				        <div class="os-form-sub-header-actions"><?php echo __('Agent ID:', 'latepoint').$agent->id; ?></div>
				      <?php } ?>
		      	</div>
		      </div>
		      <div class="white-box-content">
				    <?php echo OsFormHelper::media_uploader_field('agent[avatar_image_id]', 0, __('Set Avatar', 'latepoint'), __('Remove Avatar', 'latepoint'), $agent->avatar_image_id); ?>
				    <div class="os-row">
					    <div class="os-col-lg-4"><?php echo OsFormHelper::text_field('agent[first_name]', __('First Name', 'latepoint'), $agent->first_name); ?></div>
					    <div class="os-col-lg-4"><?php echo OsFormHelper::text_field('agent[last_name]', __('Last Name', 'latepoint'), $agent->last_name); ?></div>
					    <div class="os-col-lg-4"><?php echo OsFormHelper::text_field('agent[display_name]', __('Display Name', 'latepoint'), $agent->display_name); ?></div>
				    </div>
				    <div class="os-row">
					    <div class="os-col-lg-4"><?php echo OsFormHelper::text_field('agent[email]', __('Email Address', 'latepoint'), $agent->email); ?></div>
				    	<div class="os-col-lg-4"><?php echo OsFormHelper::text_field('agent[phone]', __('Phone Number', 'latepoint'), $agent->phone); ?></div>
				    </div>
				    <?php if($show_admin_fields){ ?>
					    <div class="os-row">
						    <div class="os-col-4"><?php echo OsFormHelper::select_field('agent[wp_user_id]', __('Connect to WP User', 'latepoint'), $wp_users_for_select, $agent->wp_user_id, ['placeholder' => __('Select User', 'latepoint')]); ?></div>
					    	<div class="os-col-4"><?php echo OsFormHelper::select_field('agent[status]', __('Status', 'latepoint'), array(LATEPOINT_AGENT_STATUS_ACTIVE => __('Active', 'latepoint'), LATEPOINT_AGENT_STATUS_DISABLED => __('Disabled', 'latepoint')), $agent->status); ?></div>
					    </div>
					  <?php } ?>
					</div>
				</div>
		    <div class="white-box">
		      <div class="white-box-header">
		        <div class="os-form-sub-header">
						  <h3><?php _e('Additional Contact Information', 'latepoint'); ?></h3>
		      	</div>
		      </div>
		      <div class="white-box-content">
		    		<div class="latepoint-message latepoint-message-subtle"><?php _e('If you need to notify multiple persons about the appointment, you can list additional email addresses and phone numbers to send notification emails and sms to. You can list multiple numbers and emails separated by commas.', 'latepoint'); ?></div>
				    <div class="os-row">
					    <div class="os-col-lg-6"><?php echo OsFormHelper::text_field('agent[extra_emails]', __('Additional Email Addresses', 'latepoint'), $agent->extra_emails); ?></div>
				    	<div class="os-col-lg-6"><?php echo OsFormHelper::text_field('agent[extra_phones]', __('Additional Phone Numbers', 'latepoint'), $agent->extra_phones); ?></div>
				    </div>
		      </div>
		    </div>
		    <div class="white-box">
		      <div class="white-box-header">
		        <div class="os-form-sub-header">
		        	<h3><?php _e('Extra Information', 'latepoint'); ?></h3>
		      	</div>
		      </div>
		      <div class="white-box-content">

				    <?php echo OsFormHelper::media_uploader_field('agent[bio_image_id]', 0, __('Set Bio Image', 'latepoint'), __('Remove Bio Image', 'latepoint'), $agent->bio_image_id); ?>
				    <?php echo OsFormHelper::text_field('agent[title]', __('Agent Title', 'latepoint'), $agent->title); ?>
            <?php echo OsFormHelper::textarea_field('agent[bio]', __('Bio Text', 'latepoint'), $agent->bio, array('rows' => 5)); ?>
						<h3><?php _e('Agent Highlights', 'latepoint') ?></h3>
						<div class="latepoint-message latepoint-message-subtle"><?php _e('These value-label pairs will appear on agent information popup. You can enter things like years of experience, or number of clients served, to highlight agent accomplishments.', 'latepoint'); ?></div>
						<div class="os-agent-highlights">
							<?php for($i = 0; $i < 3; $i++){
								$feature_value = isset($agent->features_arr[$i]) ? $agent->features_arr[$i]['value'] : '';
								$feature_label = isset($agent->features_arr[$i]) ? $agent->features_arr[$i]['label'] : ''; ?>
								<div class="os-agent-highlight">
									<h4><?php echo __('Highlight #', 'latepoint').($i+1); ?></h4>
									<div class="os-agent-highlight-fields">
								    <?php echo OsFormHelper::text_field('agent[features]['.$i.'][value]', __('Value', 'latepoint'), $feature_value); ?>
								    <?php echo OsFormHelper::text_field('agent[features]['.$i.'][label]', __('Label', 'latepoint'), $feature_label); ?>
							   	</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
		    <div class="white-box">
		      <div class="white-box-header">
		        <div class="os-form-sub-header">
		        	<h3><?php _e('Offered Services', 'latepoint'); ?></h3>
		        	<div class="os-form-sub-header-actions">
		        		<?php echo OsFormHelper::checkbox_field('select_all_services', __('Select All', 'latepoint'), 'on', $agent->is_new_record(), ['class' => 'os-select-all-toggler']); ?>
		        	</div>
			      </div>
		      </div>
		      <div class="white-box-content">

		        <div class="os-complex-agents-selector complex-locations">
		        <?php if($locations){
		          foreach($locations as $location){
		            $is_active_location = $agent->is_new_record() ? true : $agent->has_location($location->id);
		            $is_active_location_value = $is_active_location ? 'yes' : 'no';
		            $location_active_class = $is_active_location ? 'active' : ''; 
		            $connected_services_count = $location->count_number_of_connected_services($agent->id);
		            $total_services = !empty($services) ? count($services) : '0';
		            if($connected_services_count == $total_services){
		              $services_count_string = __('All', 'latepoint');
		            }else{
		              $services_count_string = $location->is_new_record() ? __('All', 'latepoint') : $connected_services_count.'/'.$total_services;
		            }
		            ?>

		            <div class="agent <?php echo $location_active_class; ?>">
		              <div class="agent-i selector-trigger">
		                <h3 class="agent-name"><?php echo $location->name; ?></h3>
		                <div class="selected-services" data-all-text="<?php echo __('All', 'latepoint'); ?>">
		                  <strong><?php echo $services_count_string; ?></strong> 
		                  <span><?php echo  __('Services Selected', 'latepoint'); ?></span>
		                </div>
		                <a href="#" class="customize-agent-service-btn"><i class="latepoint-icon latepoint-icon-ui-46"></i><span><?php echo __('Customize', 'latepoint'); ?></span></a>
		              </div><?php
		              if($services){ ?>
		                <div class="agent-services-list-w">
		                  <h4><?php echo sprintf(__('Select services offered at %s', 'latepoint'), $location->name); ?></h4>
		                  <ul class="agent-services-list"><?php
		                    foreach($services as $service){ 
		                      $is_active_service = $agent->is_new_record() ? true : $agent->has_service_and_location($service->id, $location->id);
		                      $is_active_service_value = $is_active_service ? 'yes' : 'no';
		                      $service_active_class = $is_active_service ? 'active' : ''; ?>
		                      <li class="<?php echo $service_active_class; ?>">
		                        <?php echo OsFormHelper::hidden_field('agent[locations][location_'.$location->id.'][service_'.$service->id.'][connected]', $is_active_service_value, array('class' => 'agent-service-connection'));?>
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
				    <div class="os-services-selector">
				    <?php 
				    if(false && $locations){
				      foreach($locations as $location){

						    if($services){
						      foreach($services as $service){
						        $is_active_service = $agent->is_new_record() ? true : $agent->has_service_and_location($service->id, $location->id);
						        $is_active_service_value = $is_active_service ? 'yes' : 'no';
						        $active_class = $is_active_service ? 'active' : '';
						        echo '<div class="service '.$active_class.'">';
						          echo '<a href="#" class="service-customizer"><i class="latepoint-icon latepoint-icon-ui-46"></i><span>'.__('Set Custom Values', 'latepoint').'</span></a>';
						          echo '<h3 class="service-name">' . $service->name . '</h3>';
		                	echo OsFormHelper::hidden_field('agent[locations][location_'.$location->id.'][service_'.$service->id.'][connected]', $is_active_service_value, array('class' => 'agent-service-connection'));
						        echo '</div>';
						      }
						    }
						  }
						}
				    ?>
				    </div>
					</div>
				</div>

    <div class="white-box">
      <div class="white-box-header">
        <div class="os-form-sub-header">
        	<h3><?php _e('Agent Schedule', 'latepoint'); ?></h3>
        	<div class="os-form-sub-header-actions">
        		<?php echo OsFormHelper::checkbox_field('is_custom_schedule', __('Set Custom Schedule', 'latepoint'), 'on', $is_custom_schedule, array('data-toggle-element' => '.custom-schedule-wrapper')); ?>
        	</div>
      	</div>
      </div>
      <div class="white-box-content">
      	<div class="custom-schedule-wrapper" style="<?php if(!$is_custom_schedule) echo 'display: none;'; ?>">
          <?php $schedule_args = $agent->is_new_record() ? [] : array('agent_id' => $agent->id); ?>
					<?php OsWorkPeriodsHelper::generate_work_periods($custom_work_periods, $schedule_args, $agent->is_new_record()); ?>
				</div>
      	<div class="custom-schedule-wrapper" style="<?php if($is_custom_schedule) echo 'display: none;'; ?>">
      		<div class="latepoint-message latepoint-message-subtle"><?php _e('This agent is using general schedule which is set in main settings', 'latepoint'); ?></div>
      	</div>
			</div>
		</div>

    <?php if(!$agent->is_new_record()){ ?>

				
		    <div class="white-box">
		      <div class="white-box-header">
		        <div class="os-form-sub-header"><h3><?php _e('Days With Custom Schedules', 'latepoint'); ?></h3></div>
		      </div>
		      <div class="white-box-content">
		    		<div class="latepoint-message latepoint-message-subtle"><?php _e('Agent shares custom daily schedules that you set in general settings for your company, however you can add additional days with custom hours which will be specific to this agent only.', 'latepoint'); ?></div>
						<?php OsWorkPeriodsHelper::generate_days_with_custom_schedule(['agent_id' => $agent->id]); ?>
					</div>
				</div>
		    <div class="white-box">
		      <div class="white-box-header">
						<div class="os-form-sub-header"><h3><?php _e('Holidays & Days Off', 'latepoint'); ?></h3></div>
		      </div>
		      <div class="white-box-content">
		    		<div class="latepoint-message latepoint-message-subtle"><?php _e('Agent uses the same holidays you set in general settings for your company, however you can add additional holidays for this agent here.', 'latepoint'); ?></div>
						<?php OsWorkPeriodsHelper::generate_off_days(['agent_id' => $agent->id]); ?>
					</div>
				</div>
		<?php } ?>
		<?php do_action('latepoint_agent_form', $agent); ?>
		<div class="os-form-buttons os-flex">
    <?php 
      if($agent->is_new_record()){
        echo OsFormHelper::hidden_field('agent[id]', '');
        echo OsFormHelper::button('submit', __('Add Agent', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
      }else{
        echo OsFormHelper::hidden_field('agent[id]', $agent->id);
        echo OsFormHelper::button('submit', __('Save Changes', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); 
        if($show_admin_fields){
	        echo '<a href="#" class="latepoint-btn latepoint-btn-danger remove-agent-btn" style="margin-left: auto;" 
				        data-os-prompt="'.__('Are you sure you want to remove this agent?', 'latepoint').'" 
				        data-os-redirect-to="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'index')).'" 
				        data-os-params="'. OsUtilHelper::build_os_params(['id' => $agent->id]). '" 
				        data-os-success-action="redirect" 
				        data-os-action="'.OsRouterHelper::build_route_name('agents', 'destroy').'">'.__('Delete Agent', 'latepoint').'</a>';
	      }

      }
		?>
		</div>
  </form>
</div>