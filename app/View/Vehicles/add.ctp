<div class="vehicles form">
<?php echo $this->Form->create('Vehicle'); ?>
	<fieldset>
		<legend><?php echo __('Add Vehicle'); ?></legend>
	<?php
		echo $this->Form->input('brand');
		echo $this->Form->input('model');
		echo $this->Form->input('year');
		echo $this->Form->input('version');
		echo $this->Form->input('category');
		echo $this->Form->input('load_index');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Vehicles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Related Tires'), array('controller' => 'related_tires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Tire'), array('controller' => 'related_tires', 'action' => 'add')); ?> </li>
	</ul>
</div>
