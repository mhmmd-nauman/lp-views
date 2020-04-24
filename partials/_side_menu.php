<div class="latepoint-side-menu-w <?php echo (OsAuthHelper::is_admin_logged_in()) ? 'side-menu-'.OsSettingsHelper::get_menu_layout_style() : 'side-menu-compact'; ?>">
	<div class="side-menu-top-part-w">
		<div class="logo-w"><a href="<?php echo OsRouterHelper::build_link(['dashboard', 'index']); ?>" class="os-logo"></a></div>
		<div class="menu-color-toggler">
			<div class="mc-toggler-label"><i class="latepoint-icon latepoint-icon-sun"></i></div>
		</div>
		<?php if(OsAuthHelper::is_admin_logged_in()) echo '<div class="menu-toggler" data-route="'.OsRouterHelper::build_route_name('settings', 'set_menu_layout_style').'"><div class="menu-toggler-lines"></div></div>'; ?>
	</div>
	<?php if(OsAuthHelper::is_admin_logged_in()){ ?>
	<div class="back-to-wp-link-w">
		<a class="back-to-wp-link" href="<?php echo get_admin_url(); ?>">
			<i class="latepoint-icon latepoint-icon-arrow-left"></i>
			<span><?php _e('To WordPress', 'latepoint'); ?></span>
		</a>
	</div>
	<?php } ?>
	<ul class="side-menu">
		<?php 
		foreach(OsMenuHelper::get_side_menu_items() as $menu_item){
			if(empty($menu_item['label'])){
				if(isset($menu_item['small_label'])){
					echo '<li class="menu-spacer with-label"><span>'.$menu_item['small_label'].'<span></li>';
				}else{
					echo '<li class="menu-spacer"></li>';
				}
				continue;
			} 
			$sub_menu_html = '';
			$is_active = OsRouterHelper::link_has_route($route_name, $menu_item['link']);


			if(isset($menu_item['children'])){ 
				$sub_menu_html.= '<ul class="side-sub-menu">';
				$sub_menu_html.= '<li class="side-sub-menu-header">'.$menu_item['label'].'</li>';
				foreach($menu_item['children'] as $child_menu_item){
					if(OsRouterHelper::link_has_route($route_name, $child_menu_item['link'])){
						$is_active = true;
						$sub_item_active_class = 'sub-item-is-active';
					}else{
						$sub_item_active_class = '';
					}
					$sub_menu_html.= '<li class="'.$sub_item_active_class.'"><a href="'.$child_menu_item['link'].'"><span>'.$child_menu_item['label'].'</span></a></li>';
				}
				$sub_menu_html.= '</ul>';
			}else{
				$sub_menu_html.= '<ul class="side-sub-menu only-menu-header">';
				$sub_menu_html.= '<li class="side-sub-menu-header">'.$menu_item['label'].'</li>';
				$sub_menu_html.= '</ul>';
			}
			?>
			<li class="<?php if(isset($menu_item['children'])) echo ' has-children'; ?><?php if($is_active) echo ' menu-item-is-active'; ?>">
				<a href="<?php echo $menu_item['link']; ?>">
					<i class="<?php echo $menu_item['icon']; ?>"></i>
					<span><?php echo $menu_item['label']; ?></span>
				</a>
				<?php echo $sub_menu_html; ?>
			</li>
		<?php } ?>
		<?php if(OsAuthHelper::is_admin_logged_in()){ ?>
			<li class="back-to-wp-item">
				<a href="<?php echo get_admin_url(); ?>"><i class="latepoint-icon latepoint-icon-wordpress"></i><span><?php _e('Back to WordPress', 'latepoint'); ?></span></a>
				<ul class="side-sub-menu only-menu-header"><li class="side-sub-menu-header"><?php _e('Back to WordPress', 'latepoint'); ?></li></ul>
			</li>
		<?php } ?>
	</ul>
</div>