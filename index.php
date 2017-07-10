<?php

require_once "vendor/autoload.php";
require_once 'app/Lib/PhpExcel/PHPExcel/IOFactory.php';
require_once 'app/Lib/FPDF/fpdf.php';

use App\Router\Router;

$r = new Router();

echo $r->run();