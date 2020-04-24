<div class="os-form-w">
	<h3><?php _e('License Key Registration', 'latepoint'); ?></h3>
  <form action="" data-os-action="<?php echo OsRouterHelper::build_route_name('updates', 'save_license_information'); ?>">
		<?php if($license['status_message']){ ?>
			<?php if($license['is_active'] == 'yes'){ ?>
				<div class="os-form-message-w status-success"><ul><li><?php echo $license['status_message']; ?></li></ul></div>
			<?php }else{ ?>
				<div class="os-form-message-w status-error"><ul><li><?php echo $license['status_message']; ?></li></ul></div>
			<?php } ?>
		<?php }else{
			echo '<div class="os-form-message-w"><ul><li>'.__('Please enter your LatePoint license key to receive free plugin updates and install addons.', 'latepoint').'</li></ul></div>';
		} ?>
  	<div class="os-row">
  		<div class="os-col-lg-6">
				<?php echo OsFormHelper::text_field('license[full_name]', __('Your Name', 'latepoint'), $license['full_name']); ?>
			</div>
  		<div class="os-col-lg-6">
				<?php echo OsFormHelper::text_field('license[email]', __('Your Email Address', 'latepoint'), $license['email']); ?>
  		</div>
  	</div>
  	<div class="os-row">
  		<div class="os-col-12">
				<?php echo OsFormHelper::text_field('license[license_key]', __('License Key', 'latepoint'), $license['license_key']); ?>
  		</div>
  	</div>
    <?php echo OsFormHelper::button('submit', __('Activate Licence Key', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
	</form>
</div>