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
		$this->nombre = '';
		$this->apellido_paterno = '';
		$this->apellido_materno = '';
		$this->sexo = 'H';
		$this->cedula_profesional = '';
		$this->estatus = 'Si';
		$this->id_division = '';
		$this->id_carrera = '';
		$this->tipo = "Docente";
	}

	public function getDivision(){
		return DivisionModel::getById($this->id_division);
	}

	public function getCarrera(){
		return CarreraModel::getById($this->id_carrera);
	}

	public function getNombreCompleto(){
		return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
	}

	public static function getByCarrera($id, $ord = 'id'){
	    return self::getAll("id_carrera = '{$id}'", $ord);
	}

    public static function getByDivision($id, $ord = 'id'){
        return self::getAll("id_division = '{$id}'", $ord);
    }

    public static function getByTipo($tipo, $ord = 'id'){
        return self::getAll("tipo = '{$tipo}'", $ord);
    }

    public static function getByEstatus($est = 'Si', $ord = 'id'){
        return self::getAll("estatus = '{$est}'", $ord);
    }
}