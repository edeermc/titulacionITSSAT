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