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
    return @$_SESSION['user'];
}

function user_id() {
    @session_start();
    return @$_SESSION['id'];
}

function userType() {
    @session_start();
    return @$_SESSION['type'];
}