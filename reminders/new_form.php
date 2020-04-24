<form data-os-reminder-id="<?php echo $reminder['id']; ?>" 
			data-os-action="<?php echo OsRouterHelper::build_route_name('reminders', 'save'); ?>" 
			data-os-after-call="latepoint_reminder_saved" 
			class="os-reminder-form <?php if(empty($reminder['name'])) echo 'os-is-editing'; ?>">
	<div class="os-reminder-form-i">
		<div class="os-reminder-form-info">
			<div class="os-reminder-name"><?php echo !empty($reminder['name']) ? $reminder['name'] : __('Reminder', 'latepoint'); ?></div>
			<div class="os-reminder-edit-btn"><i class="latepoint-icon latepoint-icon-edit-3"></i></div>
		</div>
		<div class="os-reminder-form-params">
			<div class="os-row">
				<div class="os-col-lg-3">
					<?php echo OsFormHelper::text_field('reminders['.$reminder['id'].'][name]', __('Reminder Name', 'latepoint'), $reminder['name'], ['class' => 'os-reminder-name-input']); ?>
				</div>
				<div class="os-col-6 os-col-lg-2">
				  <?php echo OsFormHelper::select_field('reminders['.$reminder['id'].'][medium]', false, array( 'email' => __('Email', 'latepoint'), 
																																																			'sms' => __('SMS Message', 'latepoint')), $reminder['medium'], ['class' => 'os-reminder-medium-select']); ?>
				</div>
				<div class="os-col-6 os-col-lg-2">
				  <?php echo OsFormHelper::select_field('reminders['.$reminder['id'].'][receiver]', false, array( 'customer' => __('To Customer', 'latepoint'), 
																																																			'agent' => __('To Agent', 'latepoint')), $reminder['receiver']); ?>
				</div>
				<div class="os-col-3 os-col-lg-1">
					<?php echo OsFormHelper::text_field('reminders['.$reminder['id'].'][value]', __('When?', 'latepoint'), $reminder['value']); ?>
				</div>
				<div class="os-col-4 os-col-lg-2">
				  <?php echo OsFormHelper::select_field('reminders['.$reminder['id'].'][unit]', false, array( 'day' => __('Days', 'latepoint'), 
																																																			'hour' => __('Hours', 'latepoint')), $reminder['unit']); ?>
				</div>
				<div class="os-col-5 os-col-lg-2">
				  <?php echo OsFormHelper::select_field('reminders['.$reminder['id'].'][when]', false, array( 'before' => __('Before', 'latepoint'), 
																																																			'after' => __('After', 'latepoint')), $reminder['when']); ?>
				</div>
			</div>
			<div class="os-row">
				<div class="os-col-12 os-reminder-email-subject" <?php if($reminder['medium'] == 'sms') echo 'style="display: none;"'; ?>>
					<?php echo OsFormHelper::text_field('reminders['.$reminder['id'].'][subject]', __('Email Subject of Reminder', 'latepoint'), $reminder['subject']); ?>
				</div>
			</div>
			<div class="os-row">
				<div class="os-col-12">
	        <?php echo OsFormHelper::textarea_field('reminders['.$reminder['id'].'][content]', __('Message', 'latepoint'), $reminder['content']); ?>
				</div>
			</div>
		  <button type="submit" class="os-reminder-save-btn latepoint-btn latepoint-btn-outline"><span><?php _e('Save', 'latepoint'); ?></span></button>
		</div>
	</div>
	<?php echo OsFormHelper::hidden_field('reminders['.$reminder['id'].'][id]', $reminder['id'], ['class' => 'os-reminder-id']); ?>
	<a href="#" data-os-prompt="<?php _e('Are you sure you want to remove this reminder?', 'latepoint'); ?>"  data-os-after-call="latepoint_reminder_removed" data-os-pass-this="yes" data-os-action="<?php echo OsRouterHelper::build_route_name('reminders', 'delete'); ?>" data-os-params="<?php echo OsUtilHelper::build_os_params(['id' => $reminder['id']]) ?>" class="os-remove-reminder"><i class="latepoint-icon latepoint-icon-cross"></i></a>
</form>