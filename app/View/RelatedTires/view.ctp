<div class="relatedTires view">
<h2><?php echo __('Related Tire'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($relatedTire['RelatedTire']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo h($relatedTire['RelatedTire']['measure']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vehicle'); ?></dt>
		<dd>
			<?php echo $this->Html->link($relatedTire['Vehicle']['id'], array('controller' => 'vehicles', 'action' => 'view', $relatedTire['Vehicle']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tire'); ?></dt>
		<dd>
			<?php echo $this->Html->link($relatedTire['Tire']['id'], array('controller' => 'tires', 'action' => 'view', $relatedTire['Tire']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($relatedTire['RelatedTire']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($relatedTire['RelatedTire']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($relatedTire['RelatedTire']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Related Tire'), array('action' => 'edit', $relatedTire['RelatedTire']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Related Tire'), array('action' => 'delete', $relatedTire['RelatedTire']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $relatedTire['RelatedTire']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Tires'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Tire'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('controller' => 'vehicles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('controller' => 'vehicles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tires'), array('controller' => 'tires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tire'), array('controller' => 'tires', 'action' => 'add')); ?> </li>
	</ul>
</div>
