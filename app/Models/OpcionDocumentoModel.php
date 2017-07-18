<?php

namespace App\Models;

use App\Config\Executor;

class OpcionDocumentoModel extends Model {
    public $id_documento;
    public $id_opcion;

    function __construct() {
        self::$tablename = 'opcion_documento';
        $this->id_documento = '';
        $this->id_opcion = '';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (id_documento, id_opcion) VALUES ('{$this->id_documento}', '{$this->id_opcion}')";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET id_opcion='{$this->id_opcion}', id_documento='{$this->id_documento}' WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public function delByOpcion($id){
        $sql = "DELETE FROM ".self::$tablename." WHERE id_opcion = {$id}";
        Executor::doit($sql);
    }

    public function getOpcionTitulacion(){
        $r = new OpcionTitulacionModel();
        return $r->getById($this->id);
    }

    public function getOpcion(){
        $r = new OpcionTitulacionModel();
        return $r->getById($this->id_opcion);
    }

    public function getDocumento(){
        $r = new TipoDocumentoModel();
        return $r->getById($this->id_documento);
    }

    public static function getByOpcion($idO){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id_opcion = {$idO}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new OpcionDocumentoModel());
    }

    public static function getByDocumento($idD){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id_documento = {$idD}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new OpcionDocumentoModel());
    }

    public static function existOpcion($idD, $idO){
        if ($idO != 0) {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE id_documento = {$idD} AND id_opcion = {$idO}";
            $query = Executor::doit($sql);

            return ($query[0]->num_rows > 0);
        } else
            return false;
    }
}