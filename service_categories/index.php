<div class="os-categories-ordering-w" data-category-order-update-route="<?php echo OsRouterHelper::build_route_name('service_categories', 'udpate_order_of_categories'); ?>">
	<div class="os-category-children">
	<?php OsServiceHelper::generate_service_categories_list(); ?>
	<?php if(is_array($uncategorized_services)){
		foreach($uncategorized_services as $service){
			echo '<div class="service-in-category-w status-'.$service->status.'" data-id="'.$service->id.'"><div class="os-category-service-drag"></div><div class="os-category-service-name">'.$service->name.'</div></div>';
		}
	} ?>
	</div>
	<div class="add-service-category-box add-service-category-trigger">
		<div class="add-service-category-graphic-w">
			<div class="add-service-category-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div>
		</div>
		<div class="add-service-category-label"><?php _e('Create New Category', 'latepoint'); ?></div>
	</div>
	<div class="os-form-w os-category-w editing os-new-service-category-form-w" style="display:none;">
		<div class="os-category-head">
			<div class="os-category-name"><?php _e('Create New Service Category', 'latepoint'); ?></div>
		</div>
		<div class="os-category-body">
			<?php 
			$service_category = new OsServiceCategoryModel();
			include('_form.php'); ?>
		</div>
	</div>
</div>