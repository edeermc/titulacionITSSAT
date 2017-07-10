var url_request = window.location.protocol + "//" + window.location.host + "/titulacion/app/Request/";
var spinner = '<div class="text-center"><i class="fa fa-spinner fa-cog fa-3x fa-fw"></i> <span class="sr-only">Cargando...</span></div>';

$('#operationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var operation = button.data('operation');
    var model = button.data('model');
    var id = button.data('id');
    var modal = $(this);

    $.ajax({
        url: url_request + model + 'Request.php',
        type: 'POST',
        data: {
            function: (operation == 'Agregar' || operation == 'Editar') ?  'Agregar' : operation,
            model: model,
            id: id
        },
        beforeSend: function () {
            modal.find('.modal-title').html('<h3>' + operation + ' registro</h3>');
            modal.find('.modal-body').html(spinner);
        },
        success: function (data) {
            modal.find('.modal-body').html(data);
        },
        error: function () {
            modal.find('.modal-body').html('<i class="fa fa-warning text-warning"></i> Error al cargar los datos!');
        }
    });
});