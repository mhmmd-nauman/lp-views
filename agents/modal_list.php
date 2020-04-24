<div class="os-agents-list-w">
  <h3 class="agents-header"><?php _e('Select Agents', 'latepoint'); ?></h3>
  <div class="os-agents-list">
    <?php foreach ($agents as $agent): ?>
      <div class="os-agent <?php if(in_array($agent->post_id, $selected_agent_ids_arr)) echo 'selected'; ?>" data-agent-id="<?php echo $agent->post_id; ?>">
        <div class="agent-avatar">
          <img src="<?php echo OsImageHelper::get_agent_avatar($agent->post_id); ?>" alt="">
        </div>
        <h4 class="agent-name"><?php echo $agent->name; ?></h4>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="agents-footer" style="display: none;">
    <a href="#" class="latepoint-btn latepoint-btn-secondary cancel-assign-agents"><?php _e('Cancel', 'latepoint'); ?></a>
    <a href="#" class="latepoint-btn latepoint-btn-primary save-assign-agents" data-service-id="<?php echo $service_id; ?>"><?php _e('Save Agents', 'latepoint'); ?></a>
  </div>
</div>
<script>
( function( $ ) {
  "use strict";
  $( function() {
    $('.os-agents-list .os-agent').on('click', function(){
      $(this).toggleClass('selected');
      $('.agents-footer').slideDown(300);
    });

    $('.cancel-assign-agents').on('click', function(){
      $('.os-agents-list-w').remove();
    });

    $('.save-assign-agents').on('click', function(){
      var agent_ids = [];
      var new_agents = '';
      $('.os-agents-list-w .os-agent.selected').each(function(index){
        agent_ids.push($(this).data('agent-id'));
        new_agents+= '<img src="' + $(this).find('img').attr('src') + '"/>';
      });
      $(this).closest('.os-service').find('.service-agents-avatars').html(new_agents);

      $('input[name="service[agent_ids]"]').val(agent_ids.join(','));
      $('.os-agents-list-w').remove();
      return false;
    });
  });
} )( jQuery );
</script>