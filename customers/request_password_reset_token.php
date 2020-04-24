<div class="os-password-reset-form-w">
	<?php if($from_booking){ ?>
		<a href="#" class="password-reset-back-to-login"><span><?php _e('cancel', 'latepoint'); ?></span><i class="latepoint-icon latepoint-icon-common-01"></i></a>
	<?php } ?>
	<h4><?php _e('Reset Password Request', 'latepoint'); ?></h4>
	<?php if(isset($reset_token_error) && $reset_token_error) echo '<div class="os-form-message-w status-error">'.$reset_token_error.'</div>'; ?>
	<p><?php _e("We'll email you a secret key. Once you receive it, you can use it to change your password.", 'latepoint'); ?></p>
	<?php if($from_booking){ ?>
		<?php echo OsFormHelper::text_field('password_reset_email', __('Email Address', 'latepoint')); ?>
		<?php echo OsFormHelper::hidden_field('from_booking', true); ?>
		<div class="os-form-buttons os-flex os-space-between">
			<a href="#" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'request_password_reset_token'); ?>" data-os-output-target=".os-password-reset-form-holder" data-os-source-of-params=".os-password-reset-form-w" class="latepoint-btn latepoint-btn-primary" ><?php _e('Submit Request', 'latepoint'); ?></a>
			<a href="#" class="latepoint-btn latepoint-btn-primary latepoint-btn-link" data-os-params="<?php echo OsUtilHelper::build_os_params(['from_booking' => true]) ?>" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'password_reset_form'); ?>" data-os-output-target=".os-password-reset-form-holder"><?php _e('Already have a key?', 'latepoint'); ?></a>
		</div>
	<?php }else{ ?>
		<form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'request_password_reset_token'); ?>" data-os-output-target=".latepoint-login-form-w">
			<?php echo OsFormHelper::text_field('password_reset_email', __('Email Address', 'latepoint')); ?>
			<div class="os-form-buttons os-flex os-space-between">
				<?php echo OsFormHelper::button('submit', __('Submit Request', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
				<a href="#" class="latepoint-btn latepoint-btn-primary latepoint-btn-link" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'password_reset_form'); ?>" data-os-output-target=".latepoint-login-form-w"><?php _e('Already have a key?', 'latepoint'); ?></a>
			</div>
		</form>
	<?php } ?>
</div>