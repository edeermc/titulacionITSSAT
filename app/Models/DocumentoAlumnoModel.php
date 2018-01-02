<?php

namespace App\Models;

use App\Config\Executor;

class DocumentoAlumnoModel extends Model {
    public static $tablename = 'documento_alumno';
    public $n_control;
    public $ruta;
    public $id_tipo_documento;
    public $estatus;

    function __construct() {
        $this->n_control = '';
        $this->ruta = '';
        $this->id_tipo_documento = '';
        $this->estatus = 'Pendiente';
    }

    public function getAlumno(){
        return EgresadosModel::getById($this->n_control);
    }

    public function getDocumento(){
        return TipoDocumentoModel::getById($this->id_tipo_documento);
    }

    public static function getByEstatus($est = 'Pendiente', $ord = 'id'){
        return self::getAll("estatus = '{$est}'", $ord);
    }

    public static function getByDocumento($idD, $ord = 'id'){
        return self::getAll("id_tipo_documento = '{$idD}'", $ord);
    }

    public static function getByAlumno($idA, $ord = 'id'){
        return self::getAll("n_control = '{$idA}'", $ord);
    }

    public static function existDoc($idA, $idD){
        if ($idD != 0) {
            $sql = "SELECT * FROM " . self::getTable() . " WHERE n_control = '{$idA}' AND id_tipo_documento = {$idD}";
            $n = Executor::doit($sql, [], true);

            return ($n > 0);
        } else
            return false;
    }
}