<?php

function request( $val ) {
    return $_GET[$val];
}

function input( $val ) {
    return $_POST[$val];
}

function files( $val ) {
    return $_FILES[$val];
}

function user() {
    @session_start();
    return @$_SESSION['name'];
}

function user_id() {
    @session_start();
    return @$_SESSION['id'];
}

function userType() {
    @session_start();
    return @$_SESSION['access'];
}

function getDay($d = '') {
    if(empty($d)) $d = date('D');
    switch ($d) {
        case 'Mon':
            return "Lunes";
            break;
        case 'Tue':
            return "Martes";
            break;
        case 'Wed':
            return "Miércoles";
            break;
        case 'Thu':
            return "Jueves";
            break;
        case 'Fri':
            return "Viernes";
            break;
        case 'Sat':
            return "Sábado";
            break;
        case 'Sun':
            return "Domingo";
            break;
    }
}

function getMonth($m = '') {
    if(empty($m)) $m = date('m');
    switch ($m) {
        case 1:
            return "enero";
            break;
        case 2:
            return "febrero";
            break;
        case 3:
            return "marzo";
            break;
        case 4:
            return "abril";
            break;
        case 5:
            return "mayo";
            break;
        case 6:
            return "junio";
            break;
        case 7:
            return "julio";
            break;
        case 8:
            return "agosto";
            break;
        case 9:
            return "septiembre";
            break;
        case 10:
            return "octubre";
            break;
        case 11:
            return "noviembre";
            break;
        case 12:
            return "diciembre";
            break;
    }
}

function getDateTImeNow() {
    return getDay() . ', ' . date('d') . ' de ' . getMonth() . ' de ' . date('Y') . ' a las' . date('H:i');
}

function getDateNow() {
    return date('d') . ' de ' . getMonth() . ' de ' . date('Y');
}