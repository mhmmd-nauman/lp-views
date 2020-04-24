<?php 
if($addons){ ?>
	<div class="addons-boxes-w">
		<?php foreach($addons as $addon){ 
			$installed = is_plugin_active($addon->wp_plugin_path);
			$addon_css_class = '';
			if($installed){
				$addon_css_class.= ' status-installed';
				$addon_data = get_plugin_data(OsAddonsHelper::get_addon_plugin_path($addon->wp_plugin_path));
				$installed_version = (isset($addon_data['Version'])) ? $addon_data['Version'] : '1.0.0';
				if(version_compare($addon->version, $installed_version) > 0) $addon_css_class.= ' status-update-available';
			}
			?>
			<div class="addon-box <?php echo $addon_css_class; ?>">
				<div class="addon-media" style="background-image: url(<?php echo $addon->media_url; ?>);"></div>
				<div class="addon-header">
					<h3 class="addon-name"><?php echo $addon->name; ?></h3>
				</div>
				<div class="addon-body">
					<div class="addon-desc"><?php echo $addon->description; ?></div>
					<div class="addon-meta">
						<?php 
						if($installed){
								if(version_compare($addon->version, $installed_version) > 0){
									echo '<div>'.__('Latest Version: ', 'latepoint').$addon->version.'</div>';
									echo '<div>'.__('Installed Version: ', 'latepoint').$installed_version.'</div>';
								}else{
									echo '<div>'.__('Installed Version: ', 'latepoint').$installed_version.'</div>';
								}
						}else{
							echo '<div>'.__('Latest Version: ', 'latepoint').$addon->version.'</div>';
						} ?>
					</div>
				</div>
				<div class="addon-footer">
						<?php 
							if($installed){
								if(version_compare($addon->version, $installed_version) > 0){
									echo '<a href="#" class="os-install-addon-btn" data-route-name="'.OsRouterHelper::build_route_name('addons', 'install_addon').'" data-addon-name="'.$addon->wp_plugin_name.'">';
										echo '<span><i class="latepoint-icon latepoint-icon-grid-18"></i></span><span>'.__('Update Now', 'latepoint').'</span>';
									echo '</a>';
								}else{
									echo '<div class="os-addon-installed-label"><span><i class="latepoint-icon latepoint-icon-checkmark"></i></span><span>'.__('Installed', 'latepoint').'</span></div>';
								}
							}else{
								if($addon->price > 0){
									if($addon->purchased){
										echo '<a href="#" class="os-install-addon-btn" data-route-name="'.OsRouterHelper::build_route_name('addons', 'install_addon').'" data-addon-name="'.$addon->wp_plugin_name.'">';
											echo '<span>'.__('Install Now', 'latepoint').'</span>';
										echo '</a>';
									}else{
										echo '<a target="_blank" href="'.$addon->purchase_url.'" class="os-purchase-addon-btn">';
											echo '<span>'.'$'.number_format($addon->price).'</span>';
											echo '<span>'.__('Learn More', 'latepoint').'</span>';
										echo '</a>';
									}
								}else{
									echo '<a href="#" class="os-install-addon-btn" data-route-name="'.OsRouterHelper::build_route_name('addons', 'install_addon').'" data-addon-name="'.$addon->wp_plugin_name.'">';
										echo '<span>'.__('Install Now', 'latepoint').'</span>';
									echo '</a>';
								}
							}?>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
