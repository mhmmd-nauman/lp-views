<div class="latepoint-top-bar-w">
	<div class="latepoint-top-logo">
		<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('dashboard', 'index')); ?>"><img src="<?php echo LatePoint::images_url().'logo-admin.png' ?>" alt=""></a>
	</div>
	<div class="latepoint-top-search-w">
		<div class="latepoint-top-search-input-w">
			<i class="latepoint-icon latepoint-icon-x latepoint-mobile-top-search-trigger-cancel"></i>
			<input type="text" data-route="<?php echo OsRouterHelper::build_route_name('search', 'query_results') ?>" class="latepoint-top-search" placeholder="<?php _e('Start typing to find customers, agents or services...', 'latepoint'); ?>">
		</div>
		<div class="latepoint-top-search-results-w"></div>
	</div>
	<a href="#" class="latepoint-top-iconed-link latepoint-mobile-top-menu-trigger"><i class="latepoint-icon latepoint-icon-menu"></i></a>
	<a href="#" class="latepoint-top-iconed-link latepoint-mobile-top-search-trigger"><i class="latepoint-icon latepoint-icon-search"></i></a>
	<a href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('bookings', 'pending_approval')); ?>" class="latepoint-top-iconed-link latepoint-top-notifications-trigger">
		<i class="latepoint-icon latepoint-icon-bell"></i>
		<?php  
		$count_pending_bookings = OsBookingHelper::count_pending_bookings(OsAuthHelper::get_logged_in_agent_id(), OsLocationHelper::get_selected_location_id());
		if($count_pending_bookings > 0) echo '<span class="notifications-count">'.$count_pending_bookings.'</span>'; ?>
	</a>
	<a href="<?php echo $settings_link; ?>" class="latepoint-top-iconed-link latepoint-top-settings-trigger"><i class="latepoint-icon latepoint-icon-settings"></i></a>
	<a href="#" <?php echo OsBookingHelper::quick_booking_btn_html(); ?> class="latepoint-mobile-top-new-appointment-btn-trigger latepoint-top-iconed-link"><i class="latepoint-icon latepoint-icon-plus-circle"></i></a>
	<?php do_action('latepoint_top_bar_after_actions'); ?>
	<a href="#" class="latepoint-top-new-appointment-btn latepoint-btn latepoint-btn-primary" <?php echo OsBookingHelper::quick_booking_btn_html(); ?>>
		<i class="latepoint-icon latepoint-icon-plus"></i>
		<span><?php _e('New Appointment', 'latepoint'); ?></span>
	</a>
	<div class="latepoint-top-user-info-w">
		<?php 
    if ( in_array($logged_in_admin_user_type, [LATEPOINT_WP_ADMIN_ROLE, LATEPOINT_WP_AGENT_ROLE] )) { ?>
      <div class="avatar-w" style="background-image: url('<?php echo $logged_in_user_avatar_url; ?>');"></div>
	  	<div class="latepoint-user-info-dropdown">
	  		<div class="latepoint-uid-head">
					<div class="uid-avatar-w">
						<div class="uid-avatar" style="background-image: url('<?php echo $logged_in_user_avatar_url; ?>');"></div>
					</div>
					<div class="uid-info">
			  		<h4><?php echo $logged_in_user_displayname; ?></h4>
			  		<h5><?php echo $logged_in_user_role; ?></h5>
					</div>
				</div>
				<?php do_action('latepoint_top_bar_mobile_after_user'); ?>
	  		<ul>
	  			<li>
	  				<a href="<?php echo $settings_link; ?>">
		  				<i class="latepoint-icon latepoint-icon-ui-46"></i>
		  				<span><?php _e('Settings', 'latepoint'); ?></span>
		  			</a>
		  		</li>
	  			<li>
	  				<a href="<?php echo wp_logout_url(); ?>">
		  				<i class="latepoint-icon latepoint-icon-log-in"></i>
		  				<span><?php _e('Logout', 'latepoint'); ?></span>
	  				</a>
	  			</li>
	  		</ul>
	  	</div>
	  	<?php 
    } ?>
	</div>
</div>