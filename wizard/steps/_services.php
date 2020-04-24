<h3 class="os-wizard-sub-header"><?php echo sprintf(__('Step %d of %d', 'latepoint'), $current_step_number, 3); ?></h3>
<h2 class="os-wizard-header"><?php _e('Add Services You Offer', 'latepoint'); ?></h2>
<div class="os-wizard-desc"><?php _e('When adding a service, make sure to select agents who will be offering it. You can set custom schedules and prices for each service in LatePoint admin panel later.', 'latepoint'); ?></div>
<div class="os-wizard-step-content-i">
	<?php 
	if($services){
		include('_list_services.php');
	}else{
		include('_form_service.php');
	} ?>
</div>