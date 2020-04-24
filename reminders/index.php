<?php if(!apply_filters('latepoint_reminders_addon_installed', false)){
	?>
	<a href="<?php echo OsRouterHelper::build_link(['addons', 'index']); ?>" class="os-add-box" >
    <div class="add-box-graphic-w"><div class="add-box-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div></div>
    <div class="add-box-label"><?php _e('Install Reminders Add-on', 'latepoint'); ?></div>
  </a>
  <?php
}else{
	do_action('latepoint_reminders_index');
} ?>