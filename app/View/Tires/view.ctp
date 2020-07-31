<div class="tires view">
<h2><?php echo __('Tire'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['provider']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['measure']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wheel'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['wheel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($tire['Tire']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tire'), array('action' => 'edit', $tire['Tire']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tire'), array('action' => 'delete', $tire['Tire']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $tire['Tire']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Tires'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tire'), array('action' => 'add')); ?> </li>
	</ul>
</div>
