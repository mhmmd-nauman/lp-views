<?php 
$load_more_btn_html = '<div class="os-availability-next-w">
												<a href="#" data-start-date="'. $calendar_end_date.'" 
																		class="load-more-quick-availability os-availability-next-w latepoint-btn latepoint-btn-outline latepoint-btn-block">
													<i class="latepoint-icon latepoint-icon-arrow-down"></i>
													<span>'.__('Load next 30 days', 'latepoint').'</span>
												</a>
											</div>';
?>
<?php if($show_days_only){ ?>
	<?php echo $days_availability_html; ?>
	<?php echo $load_more_btn_html; ?>
	<?php
}else{ ?>
	<div class="quick-availability-per-day-w side-sub-panel" data-agent-id="<?php echo $booking->agent_id; ?>">
		<div class="os-form-header">
			<h2><?php _e('Availability for', 'latepoint'); ?></h2>
	    <select name="booking[agent_id]" class="os-form-control">
	      <?php foreach($agents as $agent){ ?>
	        <option value="<?php echo $agent->id; ?>" <?php if($agent->id == $booking->agent_id) echo 'selected'; ?>><?php echo $agent->full_name; ?></option>
	      <?php } ?>
	    </select>
	    <a href="#" class="latepoint-quick-availability-close"><i class="latepoint-icon latepoint-icon-x"></i></a>
		</div>
		<div class="separate-timeslots-w">
			<?php 

	      
				for($current_minutes = $work_start_end[0]; $current_minutes <= $work_start_end[1]; $current_minutes+=$timeblock_interval){
		      $ampm = OsTimeHelper::am_or_pm($current_minutes);
		      $timeslot_class = 'separate-timeslot';
		      $tick_html = '';
		      if(($current_minutes % 60) == 0){
		        $timeslot_class.= ' with-tick';
		        $tick_html = '<span class="separate-timeslot-tick"><strong>'. OsTimeHelper::minutes_to_hours($current_minutes) .'</strong>'.' '.$ampm.'</span>';
		      }
		      echo '<div class="'.$timeslot_class.'">'.$tick_html.'</div>';
		    }
		  ?>
	  </div>
		<div class="os-availability-days">
			<?php echo $days_availability_html; ?>
			<?php echo $load_more_btn_html; ?>
		</div>
	</div>
	<?php
} ?>