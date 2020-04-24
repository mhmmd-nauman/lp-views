<div class="latepoint-system-status-w">
	<ul>
	<li>
		<?php 
		_e('LatePoint Plugin Version:', 'latepoint'); ?> <strong><?php echo LATEPOINT_VERSION; ?></strong>
	</li>
	<li>
		<?php 
		_e('PHP Version:', 'latepoint'); ?> <strong><?php echo phpversion(); ?></strong>
	</li>
	<li>
		<?php 
		global $wpdb;
		_e('MySQL Version:', 'latepoint'); ?> <strong><?php echo $wpdb->db_version(); ?></strong>
	</li>
	<li>
		<?php 
		global $wpdb;
		_e('WordPress Version:', 'latepoint'); ?> <strong><?php echo get_bloginfo( 'version' ); ?></strong>
	</li>
	</ul>
</div>