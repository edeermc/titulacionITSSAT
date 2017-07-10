<?php

namespace App\Models;

use App\Config\Executor;

class CarreraModel {
	public static $tablename = 'carrera';
	public $id;
	public $nombre;
	public $modalidad;

	function __construct(){
		$this->nombre = '';
		$this->modalidad = 'Escolarizado';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, modalidad) VALUES ('{$this->nombre}', '{$this->modalidad}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public static function delById($id){
		$sql = "DELETE FROM ".self::$tablename." WHERE id = {$id}";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "DELETE FROM ".self::$tablename." WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', modalidad='{$this->modalidad}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
		$query = Executor::doit($sql);

		return Model::one($query[0], new CarreraModel());
	}

	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);

		return Model::many($query[0], new CarreraModel());
	}
}