<?php if($agents){ ?>
	<div class="index-agent-boxes">
		<?php
			foreach($agents as $agent){ ?>
				<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'edit_form'), array('id' => $agent->id) ); ?>" class="agent-box-w agent-status-<?php echo $agent->status; ?>">
					<div class="agent-edit-icon"><i class="latepoint-icon latepoint-icon-edit-3"></i></div>
					<div class="agent-avatar" style="background-image: url(<?php echo $agent->avatar_url; ?>)"></div>
					<div class="agent-name"><?php echo $agent->full_name; ?></div>
				</a>
				<?php
			}
		?>
		<?php if($this->logged_in_admin_user_id){ ?>
			<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="create-agent-link-w">
        <div class="create-agent-link-i">
          <div class="add-agent-graphic-w">
            <div class="add-agent-plus"><i class="latepoint-icon latepoint-icon-plus4"></i></div>
          </div>
          <div class="add-agent-label"><?php _e('Add Agent', 'latepoint'); ?></div>
        </div>
			</a>
		<?php } ?>
	</div>
<?php }else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-users"></i></div>
    <h2><?php _e('No Existing Agents Found', 'latepoint'); ?></h2>
    <a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'new_form') ) ?>" class="latepoint-btn"><i class="latepoint-icon latepoint-icon-plus"></i><span><?php _e('Add First Agent', 'latepoint'); ?></span></a>
  </div>
<?php } ?>