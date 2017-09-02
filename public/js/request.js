var url_request = window.location.protocol + "//" + window.location.host + "/titulacion/requested.php";
var spinner = '<div class="text-center"><i class="fa fa-spinner fa-cog fa-3x fa-fw"></i> <span class="sr-only">Cargando...</span></div>';
var ajaxError = '<i class="fa fa-warning text-warning"></i> Error al cargar los datos!';


// Abrir el modal
$('#operationModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var operation = button.data('operation');
    var model = button.data('model');
    var id = button.data('id');
    var modal = $(this);

    $.ajax({
        url: url_request,
        type: 'POST',
        data: {
            function: (operation == 'Agregar' || operation == 'Editar') ?  'Agregar' : operation,
            model: model,
            id: id
        },
        beforeSend: function () {
            modal.find('.modal-title').html('<h3 style="margin: 0">' + operation + ' registro</h3>');
            modal.find('.modal-body').html(spinner);
        },
        success: function (data) {
            waitingDialog.hide();
            modal.find('.modal-body').html(data);
        },
        error: function () {
            waitingDialog.hide();
            modal.find('.modal-body').html(ajaxError);
        }
    });
});

// Paginacion
$('.pag').click(function () {
    var model = $(this).data('model');
    var prev = $('#pag-prev');
    var next = $('#pag-next');
    var p = $(this).data('page');
    var n = ($(".pagination > li").length) - 2;

    $.ajax({
        url: url_request,
        type: 'POST',
        data: {
            model: model,
            function: 'Paginacion',
            page: p
        },
        beforeSend: function () {
            waitingDialog.show();
            //$('#table-content').html(spinner);
        },
        success: function (data) {
            waitingDialog.hide();
            $('#table-content').html(data);

            if(p === 1)
                prev.parent().addClass('disabled');
            else
                prev.parent().removeClass('disabled');

            if(p === n)
                next.parent().addClass('disabled');
            else
                next.parent().removeClass('disabled');
        },
        error: function () {
            waitingDialog.hide();
            $('#table-content').html(ajaxError);
        }
    });
});

// Busquedas en el catalogo
$('#buscar').on('keyup', function () {
    var model = $(this).data('model');
    var key = $(this).val();

    if(!key){
        $('#pag-nav').show();
        $.ajax({
            url: url_request,
            type: 'POST',
            data: {
                model: model,
                function: 'Paginacion',
                page: 1
            },
            beforeSend: function () {
                //waitingDialog.show();
                $('#table-content').html(spinner);
            },
            success: function (data) {
                //waitingDialog.hide();
                $('#table-content').html(data);
            },
            error: function () {
                //waitingDialog.hide();
                $('#table-content').html(ajaxError);
            }
        });
    } else {
        $.ajax({
            url: url_request,
            type: 'POST',
            data: {
                model: model,
                function: 'Buscar',
                key: key
            },
            beforeSend: function () {
                //waitingDialog.show();
                $('#table-content').html(spinner);
            },
            success: function (data) {
                //waitingDialog.hide();
                $('#table-content').html(data);
                $('#pag-nav').hide();
            },
            error: function () {
                //waitingDialog.hide();
                $('#table-content').html(ajaxError);
            }
        });
    }
});