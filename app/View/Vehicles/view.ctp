<div class="vehicles view">
<h2><?php echo __('Vehicle'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Model'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['model']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['version']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Load Index'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['load_index']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($vehicle['Vehicle']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vehicle'), array('action' => 'edit', $vehicle['Vehicle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vehicle'), array('action' => 'delete', $vehicle['Vehicle']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vehicle['Vehicle']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Vehicles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vehicle'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Tires'), array('controller' => 'related_tires', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Tire'), array('controller' => 'related_tires', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Related Tires'); ?></h3>
	<?php if (!empty($vehicle['RelatedTire'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Measure'); ?></th>
		<th><?php echo __('Vehicle Id'); ?></th>
		<th><?php echo __('Tire Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($vehicle['RelatedTire'] as $relatedTire): ?>
		<tr>
			<td><?php echo $relatedTire['id']; ?></td>
			<td><?php echo $relatedTire['measure']; ?></td>
			<td><?php echo $relatedTire['vehicle_id']; ?></td>
			<td><?php echo $relatedTire['tire_id']; ?></td>
			<td><?php echo $relatedTire['created']; ?></td>
			<td><?php echo $relatedTire['modified']; ?></td>
			<td><?php echo $relatedTire['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'related_tires', 'action' => 'view', $relatedTire['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'related_tires', 'action' => 'edit', $relatedTire['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'related_tires', 'action' => 'delete', $relatedTire['id']), array('confirm' => __('Are you sure you want to delete # %s?', $relatedTire['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Related Tire'), array('controller' => 'related_tires', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
