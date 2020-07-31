<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('Vehicles', array('class' => 'horizontal-form', 'id' => 'formVehiclesEdit', 'type' => 'file', 'novalidate')); ?>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Marca *</label>
						<?= $this->Form->input('Vehicle.id', array('class' => 'form-control', 'div' => false, 'label' => false, 'type' => 'hidden')); ?>

						<?= $this->Form->input('Vehicle.brand', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite a marca')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Modelo *</label>
						<?= $this->Form->input('Vehicle.model', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite o modelo')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Ano *</label>
						<input name="data[Vehicle][year]" class="form-control" placeholder="Ano do veículo" type="text" id="VehicleAno" value="<?= $this->request->data['Vehicle']['year'] ?>">
					</div>
				</div>

			</div>

			<div class="row">

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Versão *</label>
						<?= $this->Form->input('Vehicle.version', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Versão do veículo')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Categoria *</label>
						<?= $this->Form->input('Vehicle.category', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Categoria do veículo')); ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Load Index *</label>
						<?= $this->Form->input('Vehicle.load_index', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Load Index')); ?>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-check">
						<?= $this->Form->input('Vehicle.status', array('class' => 'form-check-input', 'type' => 'checkbox', 'div' => false, 'label' => false, $this->request->data['Vehicle']['status']? 'cheked':'')); ?>
						<label class="form-check-label" for="VehicleStatus">Status</label>
					</div>
				</div>
			</div></br></br>
			<div class="row">
				<div class="col-md-12 text-center">
                <?php echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-primary col-md-6', 'div' => false, 'id' => 'btnFormEditVehicles')); ?>
				</div>
			</div>
		</div>
	</div>
</div>