<?php

namespace App\Models;

use App\Config\Executor;

class OpcionDocumentoModel extends Model {
    public static $tablename = 'opcion_documento';
    
    public $id_documento;
    public $id_opcion;

    function __construct() {
        $this->id_documento = '';
        $this->id_opcion = '';
    }

    public function delByOpcion($id){
        $sql = "DELETE FROM ".self::getTable()." WHERE id_opcion = {$id}";
        Executor::doit($sql);
    }

    public function getOpcionTitulacion(){
        return OpcionTitulacionModel::getById($this->id);
    }

    public function getOpcion(){
        return OpcionTitulacionModel::getById($this->id_opcion);
    }

    public function getDocumento(){
        return TipoDocumentoModel::getById($this->id_documento);
    }

    public static function getByOpcion($idO){
        return self::getAll("id_opcion = {$idO}");
    }

    public static function getByDocumento($idD){
        return self::getAll("id_documento = {$idD}");
    }

    public static function existOpcion($idD, $idO){
        if ($idO != 0) {
            $sql = "SELECT * FROM " . self::getTable() . " WHERE id_documento = {$idD} AND id_opcion = {$idO}";
            $n = Executor::doit($sql, [], true);

            return ($n > 0);
        } else
            return false;
    }
}