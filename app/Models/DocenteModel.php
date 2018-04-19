<?php

namespace App\Models;

class DocenteModel extends Model {
    public static $tablename = 'docente';
    
    public $id;
	public $nombre;
	public $apellido_paterno;
	public $apellido_materno;
	public $sexo;
	public $cedula_profesional;
	public $estatus;
	public $id_division;
	public $id_carrera;
    public $tipo;

	function __construct(){
		$this->sexo = 'H';
		$this->estatus = 'Si';
		$this->tipo = "Docente";
	}

	public function getDivision(){
	    try {
            return DivisionModel::getById($this->id_division);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

	public function getCarrera(){
	    try {
            return CarreraModel::getById($this->id_carrera);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

	public function getNombreCompleto(){
	    try {
            return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

	public static function getByCarrera($id, $ord = 'id'){
	    try {
            return self::getAll("id_carrera = '{$id}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

    public static function getByDivision($id, $ord = 'id'){
	    try {
            return self::getAll("id_division = '{$id}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByTipo($tipo, $ord = 'id'){
	    try {
            return self::getAll("tipo = '{$tipo}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByEstatus($est = 'Si', $ord = 'id'){
	    try {
            return self::getAll("estatus = '{$est}'", $ord);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}