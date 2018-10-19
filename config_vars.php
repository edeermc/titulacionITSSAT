<?php
//CONFIGURACION PARA LA CONEXION A LA BASE DE DATOS
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "titulacion");
define("DB_DRIVER", "mysql");
define("DB_CHARSET", "UTF8");

//CONFIGURACION DE LA RUTA ROOT DE LA APLICACION
define("APPLICATION_ROOT", "http://localhost/titulacionITSSAT");

//CONFIGURACION DE LA ZONA HORARIA
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, ['es_ES.UTF-8', 'es_ES', 'es_MX.UTF-8', 'es_MX']);

//CONFIGURACIÓN PARA GUARDAR ARCHIVOS
define("FILES_DIR", $_SERVER["DOCUMENT_ROOT"] . "/titulacionITSSAT/public/documentos/");
define("IMAGES_DIR", $_SERVER["DOCUMENT_ROOT"] . "/titulacionITSSAT/public/img/");
define("TEMPLATES_DIR", $_SERVER["DOCUMENT_ROOT"] . "/titulacionITSSAT/public/plantillas/");
define("MPDF_DIR", $_SERVER["DOCUMENT_ROOT"] . "/titulacionITSSAT/vendor/mpdf");

//CONFIGURACION PARA EL MANEJO DE ERRORES
define("DEBUG_LOGGER", true);
define("ERROR_LOGGER", true);
define("LOG_DIR", $_SERVER["DOCUMENT_ROOT"] . '/titulacionITSSAT/');

define("APP_ERROR", 1);
define("APP_WARNING", 2);
define("APP_INFO", 3);

//CONFIGURACION DE CORREOS
define("SMTP_SERVER", "smtp.sicemex.com");
define("SMTP_PORT", "35");
define("SMTP_SSL", false);
define("SMTP_TLS", false);
define("SMTP_EMAIL", "emc@sicemex.com");
define("SMTP_PASS", "Sice7910");