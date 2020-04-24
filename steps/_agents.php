<div class="step-agents-w latepoint-step-content">
  <div class="os-agents os-animated-parent os-items os-selectable-items os-as-grid os-three-columns">
    <?php $show_agent_bio = OsSettingsHelper::steps_show_agent_bio(); ?>
    <?php if(OsSettingsHelper::is_on('allow_any_agent')){ ?>
      <div class="os-animated-child os-item os-selectable-item"
          data-summary-field-name="agent" 
          data-summary-value="<?php _e('Any Agent', 'latepoint'); ?>" 
          data-id-holder=".latepoint_agent_id"
          data-item-id="<?php echo LATEPOINT_ANY_AGENT; ?>">
        <div class="os-animated-self os-item-i">
          <div class="os-item-img-w os-with-avatar"><div class="os-avatar" style="background-image: url(<?php echo LATEPOINT_IMAGES_URL . 'default-avatar.jpg'; ?>);"></div></div>
          <div class="os-item-name-w">
            <div class="os-item-name"><?php _e('Any Agent', 'latepoint'); ?></div>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php foreach($agents as $agent){ ?>
      <div class="os-animated-child os-item os-selectable-item with-details"
          data-summary-field-name="agent" 
          data-summary-value="<?php echo esc_attr($agent->name_for_front); ?>" 
          data-id-holder=".latepoint_agent_id"
          data-item-id="<?php echo $agent->id; ?>">
        <div class="os-animated-self os-item-i">
          <div class="os-item-img-w os-with-avatar"><div class="os-avatar" style="background-image: url(<?php echo $agent->avatar_url; ?>);"></div></div>
          <div class="os-item-name-w">
            <div class="os-item-name"><?php echo $agent->name_for_front; ?></div>
          </div>
        </div>
        <?php if($show_agent_bio){ ?>
          <div class="os-item-details-btn" data-agent-id="<?php echo $agent->id; ?>"><span><?php _e('View Details', 'latepoint'); ?></span></div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>
<?php if($show_agent_bio){ ?>
  <?php foreach($agents as $agent){ ?>
    <div class="os-agent-bio-popup" id="osAgentBioPopup<?php echo $agent->id; ?>" data-agent-id="<?php echo $agent->id; ?>">
      <a href="#" class="os-agent-bio-close"><span><?php _e('Close Details', 'latepoint'); ?></span><i class="latepoint-icon latepoint-icon-common-01"></i></a>
      <div class="agent-bio-popup-head" style="background-image: url(<?php echo $agent->bio_image_url; ?>)">
        <h3><?php echo $agent->name_for_front; ?></h3>
        <div class="agent-bio-title"><?php echo $agent->title; ?></div>
      </div>
      <div class="agent-bio-popup-content">
        <img class="bio-curve" src="<?php echo LATEPOINT_IMAGES_URL.'white-curve.png'; ?>" alt="">
        <div class="agent-bio-popup-features">
          <?php foreach($agent->features_arr as $feature){ ?>
            <div class="agent-bio-popup-feature">
              <div class="agent-bio-popup-feature-value"><?php echo $feature['value']; ?></div>
              <div class="agent-bio-popup-feature-label"><?php echo $feature['label']; ?></div>
            </div>
          <?php } ?>
        </div>
        <div class="agent-bio-popup-content-i">
          <?php echo $agent->bio; ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>