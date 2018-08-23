<?php
namespace App\Config;

class Logger {
    /**
     * @function WriteLog
     * @param $message - Mensaje que se desea escribir en el log.
     * @param int $type - Tipo de mensaje que se escribira (Error, waning e info), por defecto error.
     * @param string $path - Dirección donde se guardara el log, por defecto la dirección del sistema.
     * @param string $name - Nombre del archivo de log, por defecto app.log.
     */
    public static function WriteLog($message, $type = APP_ERROR, $path = LOG_DIR, $name = 'app.log') {
        if (($type == APP_ERROR && ERROR_LOGGER) || ($type == APP_WARNING && DEBUG_LOGGER) || ($type == APP_INFO)) {
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $file = fopen($path . $name, 'a');
            $level = ($type != APP_ERROR) ? (($type != APP_WARNING) ? 'INFO' : 'DEBUG') : 'ERROR';
            fwrite($file, date("d-m-Y H:i:s") . " - " . $level . " - " . $message . PHP_EOL);
            fclose($file);
        }
    }
}