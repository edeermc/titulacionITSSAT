<?php

namespace App\Models;

use App\Config\Executor;

class DocumentoAlumnoModel extends Model {
    public $n_control;
    public $ruta;
    public $id_tipo_documento;
    public $estatus;

    function __construct() {
        self::$tablename = 'documento_alumno';
        $this->n_control = '';
        $this->ruta = '';
        $this->id_tipo_documento = '';
        $this->estatus = 'Pendiente';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (n_control, ruta, id_tipo_documento, estatus) VALUES ('{$this->n_control}', '{$this->ruta}', 
        '{$this->id_tipo_documento}', '{$this->estatus}')";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET n_control='{$this->n_control}', ruta='{$this->ruta}', id_tipo_documento='{$this->id_tipo_documento}', 
        estatus='{$this->estatus}' WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public function delByAlumno($id){
        $sql = "DELETE FROM ".self::$tablename." WHERE n_control = '{$id}'";
        Executor::doit($sql);
    }

    public function getAlumno(){
        $r = new EgresadosModel();
        return $r->getById($this->n_control);
    }

    public function getDocumento(){
        $r = new TipoDocumentoModel();
        return $r->getById($this->id_tipo_documento);
    }

    public static function getByEstatus($est = 'Pendiente', $ord = 'id'){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE estatus = '{$est}' ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocumentoAlumnoModel());
    }

    public static function getByDocumento($idD, $ord = 'id'){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id_tipo_documento = {$idD} ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocumentoAlumnoModel());
    }

    public static function getByAlumno($idA, $ord = 'id'){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE n_control = '{$idA}' ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocumentoAlumnoModel());
    }

    public static function existDoc($idA, $idD){
        if ($idD != 0) {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE n_control = '{$idA}' AND id_tipo_documento = {$idD}";
            $query = Executor::doit($sql);

            return ($query[0]->num_rows > 0);
        } else
            return false;
    }
}