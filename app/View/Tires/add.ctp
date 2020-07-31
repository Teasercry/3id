<div class="tires form">
<?php echo $this->Form->create('Tire'); ?>
	<fieldset>
		<legend><?php echo __('Add Tire'); ?></legend>
	<?php
		echo $this->Form->input('model');
		echo $this->Form->input('provider');
		echo $this->Form->input('measure');
		echo $this->Form->input('brand');
		echo $this->Form->input('height');
		echo $this->Form->input('width');
		echo $this->Form->input('wheel');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tires'), array('action' => 'index')); ?></li>
	</ul>
</div>
