<?php

namespace App\Models;

use App\Config\Executor;

class CarreraModel extends Model {
	//public static $tablename = 'carrera';
	public $nombre;
    public $siglas;
    public $modalidad;

	function __construct(){
	    self::$tablename = 'carrera';
        $this->nombre = '';
        $this->siglas = '';
		$this->modalidad = 'Escolarizado';
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
}