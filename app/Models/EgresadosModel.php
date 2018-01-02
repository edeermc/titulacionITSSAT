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
        $this->nombre = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->sexo = 'H';
        $this->id_plan = '';
        $this->calle = '';
        $this->colonia = '';
        $this->cp = '';
        $this->ciudad = '';
        $this->municipio = '';
        $this->estado = '';
        $this->telefono = '';
        $this->correo = '';
        $this->contrasena = '';
        $this->id_proyecto = 'null';
        $this->numero_libro = 'null';
        $this->numero_foja = 'null';
        $this->periodo_ingreso = '';
        $this->periodo_egreso = '';
        $this->token = '';
        $this->estatus = 'Registro';
    }

    public function getPlan(){
        return PlanEstudiosModel::getById($this->id_plan);
    }

    public function getProyecto(){
        return ProyectoModel::getById($this->id_proyecto);
    }

    public function getDoctos(){
        return DocumentoAlumnoModel::getByAlumno($this->id);
    }

    public function getNombreCompleto(){
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function getDireccionCompleta(){
        return 'Calle '.$this->calle.' Col. '.$this->colonia.' C.P. '.$this->cp.', '.$this->municipio.', '.$this->ciudad.', '.$this->estado;
    }

    public static function getByProyecto($id, $ord = 'id'){
        return self::getAll("id_proyecto = {$id}", $ord);
    }

    public static function getByPlan($id, $ord = 'id'){
        return self::getAll("id_plan = {$id}", $ord);
    }

    public static function getByEstatus($stat = 'Registro', $ord = 'id'){
        return self::getAll("estatus = {$stat}", $ord);
    }

    public static function getByToken($token){
        return self::getAll("token = {$token}");
    }

    public static function exist($id){
        $sql = "SELECT * FROM " . self::getTable() . " WHERE id = '{$id}'";
        $n = Executor::doit($sql, [], true);

        return ($n > 0);
    }
}