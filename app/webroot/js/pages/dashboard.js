jQuery(document).ready(function() {

    // Start Select2
    $('.js-select2').select2();

    // Datatable dataEstoqueCauto
    if ($('#dataEstoqueCauto')[0]) {
        $('#dataEstoqueCauto').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "/App/getEstoqueCauto",
            "order": [
                [1, "asc"]
            ],
            "responsive": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": " de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Buscar Registros",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "initComplete": function() {},
            "drawCallback": function(settings) {},
            "rowCallback": function(row, data, index) {
                $(row).css('cursor', 'pointer');
            }
        });
    }

    $('#updateStockManual').on('click', function() {
        $.ajax({
            url: "/Pages/estoque_automatico",
            type: "post",
            dataType: "json",
            beforeSend: function(data) {
                $('#loading').modal('show');
            },
            success: function(data) {
                $('#loading').modal('hide');
                if (data.status) {
                    $('.modal').modal('hide')
                    swal(data.title, data.message, data.icon);
                    if (DataTable) {
                        $(DataTable).DataTable().ajax.reload();
                    }
                } else {
                    swal(data.title, data.message, data.icon);
                }
            },
            error: function(data) {
                $('#loading').modal('hide');
                swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
            }
        });
    });

});

// Funções
function addNew(Controller, Form, Url, DataTable = null) {
    let datastring = $(Form).serialize();
    $.ajax({
        url: "/" + Controller + "/" + Url,
        type: "post",
        dataType: "json",
        data: datastring,
        beforeSend: function(data) {
            $('#loading').modal('show');
        },
        success: function(data) {
            $('#loading').modal('hide');
            if (data.status) {
                $(Form)[0].reset();
                $('.modal').modal('hide')
                swal(data.title, data.message, data.icon);
                if (DataTable) {
                    $(DataTable).DataTable().ajax.reload();
                }
            } else {
                swal(data.title, data.message, data.icon);
            }
        },
        error: function(data) {
            $('#loading').modal('hide');
            swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
        }
    });
}

// Edit
function editRecord(Controller, Form, Url, DataTable = null) {
    let datastring = $(Form).serialize();
    $.ajax({
        url: "/" + Controller + "/" + Url,
        type: "put",
        dataType: "json",
        data: datastring,
        beforeSend: function(data) {
            $('#loading').modal('show');
        },
        success: function(data) {
            $('#loading').modal('hide');
            if (data.status) {
                $(Form)[0].reset();
                $('.modal').modal('hide')
                swal(data.title, data.message, data.icon);
                if (DataTable) {
                    $(DataTable).DataTable().ajax.reload();
                }
            } else {
                swal(data.title, data.message, data.icon);
            }
        },
        error: function(data) {
            $('#loading').modal('hide');
            swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
        }
    });
}

// Delete
function deleteRecord(nameController, idRecord, DataTable, Route = null) {
    if (!Route) {
        Route = '/' + nameController + '/delete/' + idRecord
    }
    swal({
            title: "Deseja deletar esse registro?",
            text: "Uma vez excluído, você não poderá recuperar esse registro!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: Route,
                    type: "delete",
                    dataType: "json",
                    beforeSend: function(data) {
                        $('#loading').modal('show');
                    },
                    success: function(data) {
                        $('#loading').modal('hide');
                        if (data.status) {
                            swal(data.title, data.message, data.icon);
                            if (DataTable) {
                                $(DataTable).DataTable().ajax.reload();
                            }
                        } else {
                            swal(data.title, data.message, data.icon);
                        }
                    },
                    error: function(data) {
                        $('#loading').modal('hide');
                        swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
                    }
                });

            } else {
                swal("Seu registro esta a salvo!");
            }
        });
}

function updateManualStock(idProduct) {

    let valueStock = $("#estoque-" + idProduct).val();

    $.ajax({
        url: "/App/atualizarEstoqueManual/" + idProduct + "/" + valueStock,
        type: "post",
        dataType: "json",
        beforeSend: function(data) {
            $('#loading').modal('show');
        },
        success: function(data) {
            $('#loading').modal('hide');
            if (data.status) {
                $('.modal').modal('hide')
                swal(data.title, data.message, data.icon);
                if (DataTable) {
                    $(DataTable).DataTable().ajax.reload();
                }
            } else {
                swal(data.title, data.message, data.icon);
            }
        },
        error: function(data) {
            $('#loading').modal('hide');
            swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
        }
    });
}

function gerarToken() {
    $.ajax({
        url: "/App/gerarToken",
        type: "post",
        dataType: "json",
        beforeSend: function(data) {
            $('#loading').modal('show');
        },
        success: function(data) {
            $('#loading').modal('hide');
            if (data.status) {
                $('.modal').modal('hide')
                swal(data.title, data.message, data.icon);
                if (DataTable) {
                    $(DataTable).DataTable().ajax.reload();
                }
            } else {
                swal(data.title, data.message, data.icon);
            }
        },
        error: function(data) {
            $('#loading').modal('hide');
            swal('Erro ao adicionar contato', 'Tivemos um problema, favor tentar novamente', 'error');
        }
    });
}