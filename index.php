<?php

require_once "vendor/autoload.php";
require_once 'config_vars.php';

use App\Router\Router;

$r = new Router();

echo $r->run();