<h3 class="os-wizard-sub-header"><?php echo sprintf(__('Step %d of %d', 'latepoint'), $current_step_number, 3); ?></h3>
<h2 class="os-wizard-header"><?php _e('Create Your Agents', 'latepoint'); ?></h2>
<div class="os-wizard-desc"><?php _e('You can also create more and edit existing agents in your LatePoint admin panel, you will be able to set custom schedules, add agent bio and other parameters there.', 'latepoint'); ?></div>
<div class="os-wizard-step-content-i">
	<?php 
	if($agents){
		include('_list_agents.php');
	}else{
		include('_form_agent.php');
	} ?>
</div>