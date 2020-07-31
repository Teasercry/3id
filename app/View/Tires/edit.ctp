<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Tires', array('class' => 'horizontal-form', 'id' => 'formTiresEdit', 'type' => 'file', 'novalidate')); ?>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Modelo *</label>
						<?= $this->Form->input('Tire.id', array('class' => 'form-control', 'div' => false, 'label' => false, 'type' => 'hidden')); ?>

						<?= $this->Form->input('Tire.model', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite o modelo')); ?>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Fornecedor *</label>
						<?= $this->Form->input('Tire.provider', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite o fornecedor')); ?>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Medida *</label>
						<?= $this->Form->input('Tire.measure', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite a medida')); ?>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Marca *</label>
						<?= $this->Form->input('Tire.brand', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite a marca')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Altura do Pneu *</label>
						<?= $this->Form->input('Tire.height', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Altura do pneu')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Largura do Pneu *</label>
						<?= $this->Form->input('Tire.width', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Largura do Pneu')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Aro *</label>
						<?= $this->Form->input('Tire.wheel', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Tamanho da Roda')); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-check">
						<?= $this->Form->input('Tire.status', array('class' => 'form-check-input', 'type' => 'checkbox', 'div' => false, 'label' => false, $this->request->data['Tire']['status']? 'cheked':'')); ?>
						<label class="form-check-label" for="TireStatus">Status</label>
					</div>
				</div>
			</div></br></br>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-primary col-md-6', 'div' => false, 'id' => 'btnFormEditTires')); ?>

				</div>
			</div>
		</div>
	</div>
</div>