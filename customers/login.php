<div class="latepoint-w">
	<div class="os-form-w latepoint-login-form-w">
		<h4><?php _e('Login to your account', 'latepoint'); ?></h4>
		<form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'do_login'); ?>" data-os-success-action="redirect">
			<?php echo OsFormHelper::text_field('customer_login[email]', __('Email Address', 'latepoint')); ?>
			<?php echo OsFormHelper::password_field('customer_login[password]', __('Password', 'latepoint')); ?>
			<div class="os-form-buttons os-flex">
				<?php echo OsFormHelper::button('submit', __('Log me in', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
				<a href="#" class="latepoint-btn latepoint-btn-primary latepoint-btn-link" data-os-action="<?php echo OsRouterHelper::build_route_name('customers', 'request_password_reset_token'); ?>" data-os-output-target=".latepoint-login-form-w"><?php _e('Forgot Password?', 'latepoint'); ?></a>
			</div>
			<?php if(OsSettingsHelper::is_using_google_login() || OsSettingsHelper::is_using_facebook_login()){ ?>
			  <div class="os-social-or"><span><?php _e('OR', 'latepoint'); ?></span></div>
			  <div class="os-social-login-options">
			  	<?php if(OsSettingsHelper::is_using_facebook_login()){ ?>
				  	<div id="facebook-signin-btn" data-login-action="<?php echo OsRouterHelper::build_route_name('auth', 'login_customer_using_facebook_token'); ?>" class="os-social-login-facebook os-social-login-option"><i class="latepoint-icon latepoint-icon-facebook"></i><span><?php _e('Login with Facebook', 'latepoint'); ?></span></div>
				  <?php } ?>
			  	<?php if(OsSettingsHelper::is_using_google_login()){ ?>
				  	<div id="google-signin-btn" data-login-action="<?php echo OsRouterHelper::build_route_name('auth', 'login_customer_using_google_token'); ?>" class="os-social-login-google os-social-login-option"><i class="latepoint-icon latepoint-icon-google"></i><span><?php _e('Login with Google', 'latepoint'); ?></span></div>
				  <?php } ?>
			  </div>
			<?php } ?>
		</form>
	</div>
</div>