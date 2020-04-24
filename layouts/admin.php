<?php
if($logged_in_admin_user_type == LATEPOINT_WP_ADMIN_ROLE){
	$current_wp_user = OsAuthHelper::get_logged_in_wp_user();
	$logged_in_user_avatar_url = get_avatar_url($current_wp_user->user_email);
	$logged_in_user_displayname = $logged_in_admin_user->display_name;
	$logged_in_user_role = __('Administrator', 'latepoint');
	$settings_link = OsRouterHelper::build_link(OsRouterHelper::build_route_name('settings', 'general'));
}elseif($logged_in_admin_user_type == LATEPOINT_WP_AGENT_ROLE){
	$logged_in_user_displayname = $logged_in_agent->full_name;
	$logged_in_user_avatar_url = $logged_in_agent->avatar_url;
	$logged_in_user_role = __('Agent', 'latepoint');
	$settings_link = OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'edit_form'), array('id' => OsAuthHelper::get_logged_in_agent_id()) );
} ?>
<div class="latepoint-all-wrapper <?php echo implode(' ', $extra_css_classes); ?>">
	<div class="latepoint-content-and-menu-w">
		<?php include(LATEPOINT_VIEWS_PARTIALS_ABSPATH . '_side_menu.php'); ?>
		<div class="latepoint-content-w">
			<?php include(LATEPOINT_VIEWS_PARTIALS_ABSPATH . '_top_bar.php'); ?>
			<?php if(isset($pre_page_header) && !empty($pre_page_header)){ ?>
				<h1 class="pre-page-header"><?php echo $pre_page_header; ?></h1>
			<?php } ?>
			<?php if(isset($page_header) && !empty($page_header)){ ?>
				<div class="page-header-w">
					<?php if(isset($page_header) && !empty($page_header)){
						if(is_array($page_header)){
							echo '<div class="os-page-tabs-w">';
							echo '<ul class="os-page-tabs">';
							foreach($page_header as $tab){
								$is_active_class = OsRouterHelper::link_has_route($route_name, $tab['link']) ? 'os-page-tab-active' : '';
								echo '<li class="'.$is_active_class.'"><a href="'.$tab['link'].'">'.$tab['label'].'</a></li>';
							}
							echo '</div>';
						}else{
							echo '<h1 class="page-header-main">'.$page_header.'</h1>';
						}
					} ?>
					<?php 
					if(isset($breadcrumbs) && (count($breadcrumbs) > 1)){
						echo '<div class="breadcrumbs-w"><ul class="breadcrumbs">';
						foreach($breadcrumbs as $crumb){
							if($crumb['link']){
								echo '<li><a href="'.$crumb['link'].'">'.$crumb['label'].'</a></li>';
							}else{
								echo '<li><span>'.$crumb['label'].'</span></li>';
							}
						}
						echo '</ul></div>';
					}?>
				</div><?php	
			} ?>
			<div class="latepoint-content">
				<?php include($view); ?>
			</div>
		</div>
	</div>
</div>