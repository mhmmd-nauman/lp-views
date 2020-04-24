<div class="os-form-w">
  <div class="os-form-header">
    <h3><?php _e('Add Service Category', 'latepoint'); ?></h3>
  </div>
  <form action="" data-os-after-call="latepoint_reload_select_service_categories" id="newServiceCategoryForm" data-os-action="<?php echo OsRouterHelper::build_route_name('service_categories', 'create'); ?>">
    <div class="os-row">
      <div class="os-col-12">
        <?php echo OsFormHelper::text_field('service_category[name]', __('Category Name', 'latepoint')); ?>
        <?php echo OsFormHelper::textarea_field('service_category[short_description]', __('Quick Description', 'latepoint')); ?>
      </div>
    </div>

    <?php // echo OsFormHelper::media_uploader_field('service[image_id]', 0, __('Step Image', 'latepoint'), __('Remove Image', 'latepoint')); ?>
    <div class="os-form-buttons">
      <?php echo OsFormHelper::button('submit', __('Save Service Category', 'latepoint'), 'submit', ['class' => 'latepoint-btn']); ?>
    </div>
  </form>
</div>