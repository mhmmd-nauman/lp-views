<h2 class="os-wizard-header"><?php _e('Setup Complete', 'latepoint'); ?></h2>
<div class="os-wizard-desc"><?php _e('That was easy, right? You can now add [latepoint_book_button] shortcode on your pages and your customers will be able to book appointments. You can also modify agents, services and locations in your admin panel.', 'latepoint'); ?></div>
<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('dashboard', 'index')); ?>" class="latepoint-btn latepoint-btn-outline latepoint-btn-lg">
	<span><?php _e('Go To Dashboard', 'latepoint'); ?></span>
	<i class="latepoint-icon latepoint-icon-arrow-right"></i>
</a>