<?php

namespace App\Config;

use PDO;
use PDOException;

class DB {
    public static $db;
    public static $con;
    
    function connect(){
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
        
        try {
            /**
             * @desc Conectar a la base de datos
             */
            if (DB_DRIVER != 'odbc')
                $con = new PDO($dsn, DB_USER, DB_PASS);
            else
                $con = new PDO("odbc:" . DB_NAME);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            /**
             * @desc Seleccionar la codificacion de la base de datos
             */
            if (DB_DRIVER != 'mysql')
                $con->query("SET CLIENT_ENCODING TO '" . DB_CHARSET . "'");
            else
                $con->query("SET NAMES '". DB_CHARSET . "'");
            
            return $con;
        } catch (\Exception $e) {
            Logger::WriteLog('Falló la conexión: ' . $e->getMessage());
        }
    }
    
    public static function getCon(){
        if(self::$con == null && self::$db == null){
            self::$db = new DB();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }
    
    public static function startTransaction(){
        if(self::$con == null && self::$db == null){
            self::$db = new DB();
            self::$con = self::$db->connect();
        }

        if (!self::$con->inTransaction()) {
            self::$con->beginTransaction();
            Logger::WriteLog('- - - Inicia transacción - - - - ', APP_DEBUG);
        }
    }
    
    public static function commit(){
        if(self::$con != null && self::$db != null && self::$con->inTransaction()){
            self::$con->commit();

            Logger::WriteLog('- - - Consolidando cambios en la base de datos. - - - - ', APP_DEBUG);
        }
    }
    
    public static function rollback(){
        if(self::$con != null && self::$db != null && self::$con->inTransaction()){
            self::$con->rollback();

            Logger::WriteLog('- - - Revirtiendo cambios en la base de datos. - - - - ', APP_DEBUG);
        }
    }
}