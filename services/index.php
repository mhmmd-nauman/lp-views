<?php if($uncategorized_services){ ?>
    <div class="os-service-category-w">
      <div class="os-form-sub-header sub-level"><h3><?php _e('Uncategorized', 'latepoint'); ?></h3></div>
      <div class="os-services-list">
        <?php foreach ($uncategorized_services as $service): ?>
          <?php include('_service_index_item.php'); ?>
        <?php endforeach; ?>
        <a class="create-service-link-w" href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'new_form') ) ?>">
          <div class="create-service-link-i">
            <div class="add-service-graphic-w">
              <div class="add-service-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div>
            </div>
            <div class="add-service-label"><?php _e('Add Service', 'latepoint'); ?></div>
          </div>
        </a>
      </div>
    </div>
<?php } ?>
<?php if($service_categories){ ?>
  <?php foreach ($service_categories as $service_category): ?>
    <div class="os-service-category-w">
      <div class="os-form-sub-header sub-level"><h3><?php echo $service_category->name; ?></h3></div>
      <div class="os-services-list">
      <?php 
        if($service_category->services){ ?>
          <?php foreach ($service_category->services as $service): ?>
            <?php include('_service_index_item.php'); ?>
          <?php endforeach; ?>
          <?php 
        } ?>
        <a class="create-service-link-w" href="<?php echo OsRouterHelper::build_link(['services', 'new_form'], ['service_category_id' => $service_category->id] ); ?>">
          <div class="create-service-link-i">
            <div class="add-service-graphic-w">
              <div class="add-service-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div>
            </div>
            <div class="add-service-label"><?php _e('Add Service', 'latepoint'); ?></div>
          </div>
        </a>
      </div>
    </div>
  <?php endforeach; ?>
 
<?php }else{ ?>
  <?php if(!$uncategorized_services){ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-book"></i></div>
    <h2><?php _e('No Services Found', 'latepoint'); ?></h2>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'new_form') ) ?>" class="latepoint-btn">
      <i class="latepoint-icon latepoint-icon-plus-square"></i>
      <span><?php _e('Add Service', 'latepoint'); ?></span>
    </a>
  </div>
<?php } ?>
<?php } ?>