<div class="os-password-reset-form-w">
	<?php if($from_booking){ ?>
		<a href="#" class="password-reset-back-to-login"><span><?php _e('cancel', 'latepoint'); ?></span><i class="latepoint-icon latepoint-icon-common-01"></i></a>
	<?php } ?>
	<h4><?php _e('Change Your Password', 'latepoint'); ?></h4>
	<p><?php _e("Enter a secret key you received via email to change your account password.", 'latepoint'); ?></p>
	<?php if($from_booking){ ?>
		<?php echo OsFormHelper::text_field('password_reset_token', __('Enter Your Secret Key', 'latepoint')); ?>
		<?php echo OsFormHelper::password_field('password', __('New Password', 'latepoint')); ?>
		<?php echo OsFormHelper::password_field('password_confirmation', __('Confirm New Password', 'latepoint')); ?>
		<?php echo OsFormHelper::hidden_field('from_booking', true); ?>
		<div class="os-form-buttons os-flex os-space-between">
			<a href="#" class="latepoint-btn latepoint-btn-primary" data-os-pass-response="yes" data-os-after-call="latepoint_password_changed_show_login" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'change_password'); ?>" data-os-output-target=".os-password-reset-form-holder" data-os-source-of-params=".os-password-reset-form-w"><?php _e("Save Password", 'latepoint'); ?></a>
			<a href="#" class="latepoint-btn latepoint-btn-primary latepoint-btn-link" data-os-params="<?php echo OsUtilHelper::build_os_params(['from_booking' => true]) ?>" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'request_password_reset_token'); ?>" data-os-output-target=".os-password-reset-form-holder"><?php _e("Don't have a secret key?", 'latepoint'); ?></a>
		</div>
	<?php }else{ ?>
		<form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'change_password'); ?>" data-os-output-target=".latepoint-login-form-w" data-os-success-action="reload">
			<?php echo OsFormHelper::text_field('password_reset_token', __('Enter Your Secret Key', 'latepoint')); ?>
			<?php echo OsFormHelper::password_field('password', __('New Password', 'latepoint')); ?>
			<?php echo OsFormHelper::password_field('password_confirmation', __('Confirm New Password', 'latepoint')); ?>
			<div class="os-form-buttons os-flex os-space-between">
				<?php echo OsFormHelper::button('submit', __('Save Password', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
				<a href="#" class="latepoint-btn latepoint-btn-primary latepoint-btn-link" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'request_password_reset_token'); ?>" data-os-output-target=".latepoint-login-form-w"><?php _e("Don't have a secret key?", 'latepoint'); ?></a>
			</div>
		</form>
	<?php } ?>
</div>