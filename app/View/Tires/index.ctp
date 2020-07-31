<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">Pneus</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4 w100-datatable" id="">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Listagem de Pneus</h6>
					<a data-toggle="modal" data-target="#modalAddTire" class="btn btn-primary btn-icon-split float-right">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Adicionar Pneu</span>
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
							<div class="row">
								<div class="col-sm-12 col-md-6">
									<div class="dataTables_length" id="dataTable_lengthTires"><label>

									</div>
								</div>
								<div class="col-sm-12 col-md-6">
									<div id="dataTable_filterTires" class="dataTables_filter">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<table class="table table-bordered dataTable" id="dataTableTires" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
										<thead>
											<tr role="row">
												<th>ID</th>
												<th>Modelo</th>
												<th>Fornecedor</th>
												<th>Medida</th>
												<th>Marca</th>
												<th>Largura do Pneu</th>
												<th>Altura do Pneu</th>
												<th>Roda</th>
												<th>Dt Criação</th>
												<th>Status</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>ID</th>
												<th>Modelo</th>
												<th>Fornecedor</th>
												<th>Medida</th>
												<th>Marca</th>
												<th>Largura do Pneu</th>
												<th>Altura do Pneu</th>
												<th>Roda</th>
												<th>Dt Criação</th>
												<th>Status</th>
												<th>Ações</th>
											</tr>
										</tfoot>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-5">
									<div class="dataTables_info" id="dataTable_infoTires" role="status" aria-live="polite"></div>
								</div>
								<div class="col-sm-12 col-md-7">
									<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginateTires">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>