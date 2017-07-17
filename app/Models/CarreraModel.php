<?php

namespace App\Models;

use App\Config\Executor;

class CarreraModel extends Model {
	public $nombre;
    public $siglas;
    public $modalidad;

	function __construct(){
	    self::$tablename = 'carrera';
        $this->nombre = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, siglas, modalidad) VALUES ('{$this->nombre}', '{$this->siglas}', '{$this->modalidad}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', siglas='{$this->siglas}', modalidad='{$this->modalidad}' 
		WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public function getPlanes(){
	    $r = new PlanEstudiosModel();
	    return $r->getByCarrera($this->id);
    }
}