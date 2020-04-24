<?php if($activities){ ?>
	<div class="activities-index">
		<div class="os-table-w color-scheme-dark">
			<table class="os-table">
				<thead>
					<tr>
						<th><?php _e('Type', 'latepoint'); ?></th>
						<th><?php _e('Action By', 'latepoint'); ?></th>
						<th><?php _e('Date/Time', 'latepoint'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($activities as $activity){ ?>
						<tr>
						<td><?php echo $activity->name; ?> <a href="<?php echo $activity->link_to_object; ?>"><?php _e('View', 'latepoint'); ?></a></td>
						<td><?php echo $activity->user_link_with_avatar; ?></td>
						<td><?php echo $activity->nice_created_at; ?></td>
						</tr>
						<?php
					} ?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php _e('Type', 'latepoint'); ?></th>
						<th><?php _e('Action By', 'latepoint'); ?></th>
						<th><?php _e('Date/Time', 'latepoint'); ?></th>
					</tr>
				</tfoot>
				</table>
			</div>
	</div>
<?php }else{ ?>
  <div class="no-results-w">
    <div class="icon-w"><i class="latepoint-icon latepoint-icon-bell"></i></div>
    <h2><?php _e('No Activity', 'latepoint'); ?></h2>
  </div>
<?php } ?>