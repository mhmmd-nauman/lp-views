<div class="latepoint-top-search-results">
<h3><i class="latepoint-icon latepoint-icon-users"></i><span><?php _e('Customers', 'latepoint'); ?></span></h3>
<?php if($customers){ ?>
	<div class="latepoint-search-results-tiles-w">
		<?php foreach($customers as $customer){ ?>
		<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'edit_form'), array('id' => $customer->id) ); ?>" class="customer-result latepoint-search-result">
			<div class="avatar" style="background-image: url(<?php echo $customer->avatar_url; ?>)"></div>
			<div class="name"><?php echo preg_replace("/($query)/i", "<strong>$1</strong>", $customer->full_name); ?></div>
		</a>
		<?php } ?>
	</div>
<?php }else{
	echo '<div class="search-no-results">'.__('No Matched Customers found.', 'latepoint').' <a href="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'create')).'">'.__('Add Customer', 'latepoint').'</a></div>';
} ?>
<?php if($logged_in_admin_user_id){ 
	// This results are only for admins
	?>
	<h3><i class="latepoint-icon latepoint-icon-briefcase"></i><span><?php _e('Agents', 'latepoint'); ?></span></h3>
	<?php if($agents){ ?>
		<div class="latepoint-search-results-tiles-w">
			<?php foreach($agents as $agent){ ?>
			<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'edit_form'), array('id' => $agent->id) ); ?>" class="agent-result latepoint-search-result">
				<div class="avatar" style="background-image: url(<?php echo $agent->avatar_url; ?>)"></div>
				<div class="name"><?php echo preg_replace("/($query)/i", "<strong>$1</strong>", $agent->full_name); ?></div>
			</a>
			<?php } ?>
		</div>
	<?php }else{
		echo '<div class="search-no-results">'.__('No Matched Agents found.', 'latepoint').' <a href="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'create')).'">'.__('Add Agent', 'latepoint').'</a></div>';
	} ?>
	<h3><i class="latepoint-icon latepoint-icon-package"></i><span><?php _e('Services', 'latepoint'); ?></span></h3>
	<?php if($services){ ?>
		<div class="latepoint-search-results-tiles-w">
			<?php foreach($services as $service){ ?>
			<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'edit_form'), array('id' => $service->id) ); ?>" class="service-result latepoint-search-result">
				<div class="avatar" style="background-image: url(<?php echo $service->selection_image_url; ?>)"></div>
				<div class="name"><?php echo preg_replace("/($query)/i", "<strong>$1</strong>", $service->name); ?></div>
			</a>
			<?php } ?>
		</div>
	<?php }else{
		echo '<div class="search-no-results">'.__('No Matched Services found.', 'latepoint').' <a href="'.OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'create')).'">'.__('Add Service', 'latepoint').'</a></div>';
	} ?>
<?php } ?>
</div>