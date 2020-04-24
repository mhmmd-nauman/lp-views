<?php 
if($bookings){
  foreach ($bookings as $booking): 
    $room_link =  $booking->id.base64_encode($booking->nice_start_date);
    $room_name = str_replace("'", "", $booking->service->name);
    $room_name = str_replace(" ", "", $room_name);
    ?>
    <tr>
      <td class="os-column-faded text-center"><?php echo $booking->id; ?></td>
      <td class="os-column-faded text-center"><span class="os-column-status os-column-status-<?php echo $booking->status; ?>"><a target="_blank" <?php if(empty($booking->room_text)){?> class='generateLink' <?php }?> id='<?php echo $booking->id;?>' href="<?php echo $booking->room_text;?>&isAdmin=1">Join</a></span></td>
      <td>
        <span class="os-column-service-color" style="background-color: <?php echo $booking->service->bg_color; ?>"></span> 
        <a href="#" <?php echo OsBookingHelper::quick_booking_btn_html($booking->id); ?>><?php echo $booking->service->name; ?></a></td>
      <td><?php echo $booking->nice_start_date; ?></td>
      <td><?php echo $booking->nice_start_time; ?></td>
      <?php if(!$show_single_agent){ ?>
        <td>
          <a class="os-with-avatar" href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('agents', 'edit_form'), array('id' => $booking->agent_id) ); ?>" target="_blank">
            <span class="os-avatar" style="background-image: url(<?php echo $booking->agent->get_avatar_url(); ?>)"></span>
            <span class="os-name"><?php echo $booking->agent->full_name; ?></span>
          </a>
        </td>
      <?php } ?>
      <td>
        <a class="os-with-avatar" href="<?php echo OsRouterHelper::build_link(OsRouterHelper::build_route_name('customers', 'edit_form'), array('id' => $booking->customer_id) ); ?>" target="_blank">
          <span class="os-avatar" style="background-image: url(<?php echo $booking->customer->get_avatar_url(); ?>)"></span>
          <span class="os-name"><?php echo (isset($customer_name_query)) ? preg_replace("/($customer_name_query)/i", '<strong class="os-search-query-match">$1</strong>', $booking->customer->full_name) : $booking->customer->full_name; ?></span>
        </a>
      </td>
      <td><span class="os-column-status os-column-status-<?php echo $booking->status; ?>"><?php echo $booking->nice_status; ?></span></td>
      <td><?php echo $booking->nice_created_at; ?></td>
      <td><button class="latepoint-btn latepoint-btn-link latepoint-btn-primary" <?php echo OsBookingHelper::quick_booking_btn_html($booking->id); ?>><i class="latepoint-icon latepoint-icon-edit-2"></i><span><?php _e('Edit Record', 'latepoint'); ?></span></button></td>
    </tr>
    <?php 
  endforeach; 
}?>