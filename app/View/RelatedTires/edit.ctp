<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Form->create('RelatedTire', array('class' => 'horizontal-form', 'id' => 'formRelatedTireEdit', 'type' => 'file', 'novalidate')); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Medida *</label>
						<?= $this->Form->input('RelatedTire.id', array('class' => 'form-control', 'div' => false, 'label' => false, 'type' => 'hidden')); ?>

						<?= $this->Form->input('RelatedTire.measure', array('class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Digite a marca')); ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Veículo *</label>
						<select name="data[RelatedTire][vehicle_id]" class="form-control js-select2" id="RelatedTireVehicleId">
							<option value="">Seleciona o Veículos</option>
							<?php foreach ($array_vehicles as $vehicle) { ?>
								<option value="<?= $vehicle['vehicle_id'] ?>"><?= $vehicle['vehicle'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Pneu *</label>
						<select name="data[RelatedTire][tire_id]" class="form-control js-select2" id="RelatedTireTireId" value="14">
							<option value="">Seleciona o Pneu</option>
							<?php foreach ($array_tires as $tire) { ?>
								<option value="<?= $tire['tire_id'] ?>"><?= $tire['tire'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-check">
						<?= $this->Form->input('RelatedTire.status', array('class' => 'form-check-input', 'type' => 'checkbox', 'div' => false, 'label' => false, $this->request->data['RelatedTire']['status'] ? 'cheked' : '')); ?>
						<label class="form-check-label" for="RelatedTireStatus">Status</label>
					</div>
				</div>
			</div></br></br>
			<div class="row">
				<div class="col-md-12 text-center">
					<?php echo $this->Form->end(array('label' => 'Salvar', 'class' => 'btn btn-primary col-md-6', 'div' => false, 'id' => 'btnFormEditRelatedTire')); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
	  $('#RelatedTireTireId').val('<?= $this->request->data['RelatedTire']['tire_id'] ?>');
      $('#RelatedTireVehicleId').val('<?= $this->request->data['RelatedTire']['vehicle_id'] ?>');
	  
    });
  </script>
