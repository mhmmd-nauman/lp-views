<div class="os-service os-service-status-<?php echo $service->status; ?>">
  <div class="os-service-header">
    <?php if($service->is_hidden()) echo '<i class="latepoint-icon latepoint-icon-eye-off service-hidden"></i>'; ?>
    <h3 class="service-name"><?php echo $service->name; ?></h3>
  </div>
  <div class="os-service-body">
    <div class="os-service-agents">
      <div class="label"><?php _e('Agents:', 'latepoint'); ?></div>
      <div class="agents-avatars">
        <?php foreach($service->agents as $index => $agent){ 
          if ($index > 1) break; ?>
          <div class="agent-avatar" style="background-image: url(<?php echo $agent->get_avatar_url(); ?>)"></div>
        <?php } ?>
        <?php if(count($service->agents) > 2) echo '<div class="agents-more">+'.(count($service->agents) - 2).' '.__('more', 'latepoint').'</div>'; ?>
      </div>
    </div>
    <div class="os-service-info">
      <div class="service-info-row">
        <div class="label"><?php _e('Duration:', 'latepoint'); ?></div>
        <div class="value"><strong><?php echo $service->duration; ?></strong> <?php _e('min', 'latepoint'); ?></div>
      </div>
      <div class="service-info-row">
        <div class="label"><?php _e('Price:', 'latepoint'); ?></div>
        <div class="value"><strong><?php echo $service->price_min_formatted; ?></strong></div>
      </div>
      <div class="service-info-row">
        <div class="label"><?php _e('Buffer:', 'latepoint'); ?></div>
        <div class="value"><strong><?php echo $service->buffer_before.'/'.$service->buffer_after; ?></strong> <?php _e('min', 'latepoint'); ?></div>
      </div>
    </div>
  </div>
  <div class="os-service-foot">
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('services', 'edit_form'), array('id' => $service->id) ) ?>" class="latepoint-btn latepoint-btn-block latepoint-btn-secondary">
      <i class="latepoint-icon latepoint-icon-edit-3"></i>
      <span><?php _e('Edit Service', 'latepoint'); ?></span>
    </a>
  </div>
</div>