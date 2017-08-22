/*
var url_base = window.location.protocol + "//" + window.location.host + '/titulacion';    //  Obtener la dirección base para los post

$('#status-all-check').on('click', function(){
    $('#allitems').attr('checked', false);
    $('.itemschecked').attr('checked', false);
    $('#status-all-check').addClass('hidden');
    $('#status-all-uncheck').removeClass('hidden');
    $('.status-check').addClass('hidden');
    $('.status-uncheck').removeClass('hidden');
});

$('#status-all-uncheck').on('click', function(){
    $('#allitems').attr('checked', true);
    $('.itemschecked').attr('checked', true);
    $('#status-all-check').removeClass('hidden');
    $('#status-all-uncheck').addClass('hidden');
    $('.status-check').removeClass('hidden');
    $('.status-uncheck').addClass('hidden');
});

$('tbody tr').on('click', function(){
    var item = $(this).find('td input.itemschecked');

    if(item.attr('checked') === undefined) {
        item.attr('checked', true);
        $(this).find('td').addClass('active');
        $(this).find('td .status-check').removeClass('hidden');
        $(this).find('td .status-uncheck').addClass('hidden');
    } else {
        item.attr('checked', false);
        $(this).find('td').removeClass('active');
        $(this).find('td .status-check').addClass('hidden');
        $(this).find('td .status-uncheck').removeClass('hidden');
    }

    checkEstatus();
});

function checkEstatus() {
    var n_items = $('.itemschecked').length;
    var n_checked = $('input:checked.itemschecked').length;

    if(n_items === n_checked) {
        $('#allitems').attr('checked', false);
        $('#status-all-check').removeClass('hidden');
        $('#status-all-uncheck').addClass('hidden');
    } else{
        $('#allitems').attr('checked', true);
        $('#status-all-check').addClass('hidden');
        $('#status-all-uncheck').removeClass('hidden');
    }
}

$(function () {
    $('#siderbar').metisMenu();
});

$('#siderbar').metisMenu({
    // auto collapse.
    toggle: true,

    // prevents or allows dropdowns' onclick events after expanding/collapsing.
    preventDefault: false,

    // CSS classes
    activeClass: 'active',
    collapseClass: 'collapse',
    collapseInClass: 'in',
    collapsingClass: 'collapsing',
    triggerElement: 'a',
    parentTrigger: 'li',
    subMenu: 'ul',

    // callbacks
    onTransitionStart: false,
    onTransitionEnd: false
});
*/

function showMessage(n) {
    var msg = '';

    msg = '<div class="alert alert-info" style="margin-top: 25px;">' +
        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
        '<strong>Operación extitosa!</strong> ';
    switch (n){
        case '1':
            msg += 'Registro agregado correctamente.';
            break;
        case '2':
            msg += 'Registro actualizado correctamente.';
            break;
        case '3':
            msg += 'Registro eliminado correctamente.';
            break;
        case '0':
            msg = '<div class="alert alert-danger" style="margin-top: 25px;">'+
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                '<strong>Error inesperado!</strong> Vuelva a intentarlo, si el error persiste recargue la página.';
            break;
        default:
            msg = '<div class="alert alert-danger" style="margin-top: 25px;">'+
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                '<strong>Error inesperado!</strong> Error: <i>'+n+'</i>.';
    }

    msg += '</div>';
    $('#getMesagge').html(msg);
}


function sendForm(send_to,model) {
    $.ajax({
        url: send_to,
        type: 'POST',
        data: $('#form-submit').serialize(),
        beforeSend: function () {
            $('#operationModal').modal('hide');
            waitingDialog.show();
        },
        success: function (data) {
            waitingDialog.hide();
            showMessage(data);

            $.ajax({
                url: url_request,
                type: 'POST',
                data: {
                    model: model,
                    function: 'Paginacion',
                    page: (data != '3') ? ($(".pagination > li").length) - 2 : 1
                },
                success: function (data) {
                    $('#table-content').html(data);
                }
            });
        },
        error: function () {
            waitingDialog.hide();
            showMessage(0);
        }
    });

    return false;
}

$(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
