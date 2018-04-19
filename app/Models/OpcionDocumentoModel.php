<?php

namespace App\Models;

use App\Config\Executor;

class OpcionDocumentoModel extends Model {
    public static $tablename = 'opcion_documento';
    
    public $id_documento;
    public $id_opcion;


    public function delByOpcion($id){
        try {
            $sql = "DELETE FROM " . self::getTable() . " WHERE id_opcion = {$id}";
            Executor::doit($sql);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOpcionTitulacion(){
        try {
            return OpcionTitulacionModel::getById($this->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOpcion(){
        try {
            return OpcionTitulacionModel::getById($this->id_opcion);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDocumento(){
        try {
            return TipoDocumentoModel::getById($this->id_documento);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByOpcion($idO){
        try {
            return self::getAll("id_opcion = {$idO}");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByDocumento($idD){
        try {
            return self::getAll("id_documento = {$idD}");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function existOpcion($idD, $idO){
        try {
            if ($idO != 0) {
                $sql = "SELECT * FROM " . self::getTable() . " WHERE id_documento = {$idD} AND id_opcion = {$idO}";
                $n = Executor::doit($sql, [], true);
        
                return ($n > 0);
            } else
                return false;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}