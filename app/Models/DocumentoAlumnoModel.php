<?php

namespace App\Models;

use App\Config\Executor;

class DocumentoAlumnoModel extends Model {
    protected static $tablename = 'documento_alumno';
    public $n_control;
    public $ruta;
    public $id_tipo_documento;
    public $estatus;

    function __construct() {
        $this->estatus = 'Pendiente';
    }

    public function getAlumno(){
        try {
            return EgresadosModel::getById($this->n_control);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDocumento(){
        try {
            return TipoDocumentoModel::getById($this->id_tipo_documento);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByEstatus($est = 'Pendiente', $ord = 'id'){
        try {
            return self::getAll("estatus = '{$est}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByDocumento($idD, $ord = 'id'){
        try {
            return self::getAll("id_tipo_documento = '{$idD}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByAlumno($idA, $ord = 'id'){
        try {
            return self::getAll("n_control = '{$idA}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function existDoc($idA, $idD){
        try {
            if ($idD != 0) {
                $sql = "SELECT * FROM " . self::getTable() . " WHERE n_control = '{$idA}' AND id_tipo_documento = {$idD}";
                $n = Executor::doit($sql, [], true);
        
                return ($n > 0);
            } else
                return false;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}