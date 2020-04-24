<div class="os-form-w">
	<form action="" data-os-output-target=".os-wizard-step-content-i" data-os-after-call="latepoint_wizard_item_editing_cancelled" data-os-action="<?php echo OsRouterHelper::build_route_name('wizard', 'save_agent'); ?>">
		<div class="os-row">
			<div class="os-col-6">
		    <?php echo OsFormHelper::text_field('agent[first_name]', __('First Name', 'latepoint'), $agent->first_name); ?>
			</div>
			<div class="os-col-6">
		    <?php echo OsFormHelper::text_field('agent[last_name]', __('Last Name', 'latepoint'), $agent->last_name); ?>
			</div>
		</div>
		<div class="os-row">
			<div class="os-col-lg-6">
		    <?php echo OsFormHelper::text_field('agent[email]', __('Email Address', 'latepoint'), $agent->email); ?>
			</div>
			<div class="os-col-lg-6">
		    <?php echo OsFormHelper::text_field('agent[phone]', __('Phone Number', 'latepoint'), $agent->phone); ?>
			</div>
		</div>
    <?php echo OsFormHelper::media_uploader_field('agent[avatar_image_id]', 0, __('Upload Agent\'s Photo', 'latepoint'), __('Remove Agent\'s Photo', 'latepoint'), $agent->avatar_image_id, false, false, true); ?>
    <?php if(!$agent->is_new_record()) echo OsFormHelper::hidden_field('agent[id]', $agent->id); ?>

    <div class="side-by-side-buttons">
    	<div class="os-row">
    		<?php if(!isset($hide_cancel_btn)){ ?>
					<div class="os-col-lg-6">
			      <button type="button" data-os-after-call="latepoint_wizard_item_editing_cancelled" data-os-output-target=".os-wizard-step-content" data-os-params="current_step=agents" data-os-action="<?php echo OsRouterHelper::build_route_name('wizard', 'load_step'); ?>" class="wizard-finished-editing-trigger latepoint-btn latepoint-btn-lg latepoint-btn-secondary"><?php _e('Cancel', 'latepoint'); ?></button>
					</div>
				<?php } ?>
				<div class="os-col-lg-<?php echo(!isset($hide_cancel_btn)) ? '6' : '12'; ?>">
		      <button type="submit" class="latepoint-btn latepoint-btn-lg latepoint-btn-primary">
		      	<i class="latepoint-icon latepoint-icon-checkmark"></i>
		      	<span><?php echo ($agent->is_new_record()) ? __('Save Agent', 'latepoint') : __('Save Changes', 'latepoint'); ?></span>
	      	</button>
				</div>
			</div>
    </div>
  </form>
</div>