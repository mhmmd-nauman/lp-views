<div class="os-row">
  <div class="os-col-6">
    <?php echo OsFormHelper::text_field('customer[first_name]', __('First Name', 'latepoint'), $selected_customer->first_name); ?>
  </div>
  <div class="os-col-6">
    <?php echo OsFormHelper::text_field('customer[last_name]', __('Last Name', 'latepoint'), $selected_customer->last_name); ?>
  </div>
</div>
<div class="os-row">
  <div class="os-col-12">
    <?php echo OsFormHelper::text_field('customer[email]', __('Email Address', 'latepoint'), $selected_customer->email); ?>
  </div>
</div>
<div class="os-row">
  <div class="os-col-12">
    <?php echo OsFormHelper::text_field('customer[phone]', __('Telephone Number', 'latepoint'), $selected_customer->formatted_phone, array('class' => 'os-mask-phone')); ?>
  </div>
</div>
<div class="os-row">
  <div class="os-col-12">
    <?php echo OsFormHelper::textarea_field('customer[notes]', __('Customer Notes', 'latepoint'), $selected_customer->notes, ['rows' => 1]); ?>
  </div>
</div>
<div class="os-row">
  <div class="os-col-12">
    <?php echo OsFormHelper::textarea_field('customer[admin_notes]', __('Notes only visible to admins', 'latepoint'), $selected_customer->admin_notes, ['rows' => 1]); ?>
  </div>
</div>
<?php 
// Custom fields for customer
if(isset($custom_fields_for_customer) && !empty($custom_fields_for_customer)){ ?>
  <div class="os-form-sub-header"><h3><?php _e('Custom Fields', 'latepoint'); ?></h3></div>
  <div class="os-row">
    <?php foreach($custom_fields_for_customer as $custom_field){
      $required_class = ($custom_field['required'] == 'on') ? 'required' : '';
      switch ($custom_field['type']) {
        case 'text':
          echo OsFormHelper::text_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], $selected_customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
          break;
        case 'textarea':
          echo OsFormHelper::textarea_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], $selected_customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
          break;
        case 'select':
          echo OsFormHelper::select_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], OsFormHelper::generate_select_options_from_custom_field($custom_field['options']), $selected_customer->get_meta_by_key($custom_field['id'], ''), ['class' => $required_class, 'placeholder' => $custom_field['placeholder']], array('class' => $custom_field['width']));
          break;
        case 'checkbox':
          echo OsFormHelper::checkbox_field('customer[custom_fields]['.$custom_field['id'].']', $custom_field['label'], 'on', ($selected_customer->get_meta_by_key($custom_field['id'], 'off') == 'on') , ['class' => $required_class], array('class' => $custom_field['width']));
          break;
      }
    } ?>
  </div>
  <?php
}?>

<?php echo OsFormHelper::hidden_field('booking[customer_id]', $selected_customer->id); ?>