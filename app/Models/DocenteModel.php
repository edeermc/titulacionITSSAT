<?php

namespace App\Models;

use App\Config\Executor;

class DocenteModel extends Model {
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
		self::$tablename = 'docente';
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

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, apellido_paterno, apellido_materno, sexo, cedula_profesional, estatus, id_division, 
					id_carrera, tipo) VALUES ('{$this->nombre}', '{$this->apellido_paterno}', '{$this->apellido_materno}', '{$this->sexo}', 
				   '{$this->cedula_profesional}', '{$this->estatus}', '{$this->id_division}', '{$this->id_carrera}', '{$this->tipo}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', apellido_paterno='{$this->apellido_paterno}',
		apellido_materno='{$this->apellido_materno}', sexo='{$this->sexo}', cedula_profesional='{$this->cedula_profesional}',
		estatus='{$this->estatus}', id_division='{$this->id_division}', id_carrera='{$this->id_carrera}', tipo='{$this->tipo}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public function getDivision(){
		$r = new DivisionModel();
		return $r->getById($this->id_division);
	}

	public function getCarrera(){
		$r = new CarreraModel();
		return $r->getById($this->id_carrera);
	}

	public function getNombreCompleto(){
		return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
	}

	public static function getByCarrera($id, $ord = 'id'){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id_carrera = {$id} ORDER BY {$ord}";
		$query = Executor::doit($sql);

		return self::Many($query[0], new DocenteModel());
	}

    public static function getByDivision($id, $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id_division = {$id} ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocenteModel());
    }

    public static function getByTipo($tipo, $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE tipo = '{$tipo}' ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocenteModel());
    }

    public static function getByEstatus($est = 'Si', $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE estatus = '{$est}' ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new DocenteModel());
    }
}