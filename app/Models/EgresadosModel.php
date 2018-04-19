<?php

namespace App\Models;

use App\Config\Executor;

class EgresadosModel extends Model {
    public static $tablename = 'egresados';
    
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $sexo;
    public $id_plan;
    public $calle;
    public $colonia;
    public $cp;
    public $ciudad;
    public $municipio;
    public $estado;
    public $telefono;
    public $correo;
    public $contrasena;
    public $id_proyecto;
    public $numero_libro;
    public $numero_foja;
    public $periodo_ingreso;
    public $periodo_egreso;
    public $token;
    public $estatus;

    function __construct(){
        $this->sexo = 'H';
        $this->estatus = 'Registro';
    }

    public function getPlan(){
        try {
            return PlanEstudiosModel::getById($this->id_plan);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getProyecto(){
        try {
            return ProyectoModel::getById($this->id_proyecto);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getDoctos(){
        try {
            return DocumentoAlumnoModel::getByAlumno($this->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getNombreCompleto(){
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function getDireccionCompleta(){
        return 'Calle '.$this->calle.' Col. '.$this->colonia.' C.P. '.$this->cp.', '.$this->municipio.', '.$this->ciudad.', '.$this->estado;
    }

    public static function getByProyecto($id, $ord = 'id'){
        try {
            return self::getAll("id_proyecto = {$id}", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByPlan($id, $ord = 'id'){
        try {
            return self::getAll("id_plan = {$id}", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByEstatus($stat = 'Registro', $ord = 'id'){
        try {
            return self::getAll("estatus = {$stat}", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByToken($token){
        try {
            return self::getAll("token = {$token}");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function exist($id){
        try {
            $sql = "SELECT * FROM " . self::getTable() . " WHERE id = '{$id}'";
            $n = Executor::doit($sql, [], true);
    
            return ($n > 0);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}