<?php

require_once "vendor/autoload.php";

$funcion = $_POST['function'];
call_user_func($funcion);
