<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 ">Estoque Cauto</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4 w100-datatable">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Listagem de produtos no Estoque Cauto</h6>
                    <!-- <a data-toggle="modal" data-target="#modalAddRelatedTires" class="btn btn-primary btn-icon-split float-right">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Adicionar Pneu Relacionado</span>
					</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="dataTable_length"><label>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="dataTable_filter" class="dataTables_filter">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataEstoqueCauto" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Cai</th>
                                                <th>ID</th>
                                                <th>Descrição</th>
                                                <th>Medida</th>
                                                <th>Loja</th>
                                                <th>Tab A</th>
                                                <th>Tab B</th>
                                                <th>Estoque</th>
                                                <th>Calculo</th>
                                                <th>CEspeciais</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Cai</th>
                                                <th>ID</th>
                                                <th>Descrição</th>
                                                <th>Medida</th>
                                                <th>Loja</th>
                                                <th>Tab A</th>
                                                <th>Tab B</th>
                                                <th>Estoque</th>
                                                <th>Calculo</th>
                                                <th>CEspeciais</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
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
                                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite"></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>