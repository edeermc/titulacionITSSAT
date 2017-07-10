<?php

namespace App\Models;

use App\Config\Executor;

class ConfiguracionModel {
	public static $tablename = 'configuracion';
	public $id;
	public $nombre;
	public $configuracion;

	function __construct(){
		$this->nombre = '';
		$this->configuracion = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, modalidad) VALUES ('{$this->nombre}', '{$this->configuracion}')";
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
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', configuracion='{$this->configuracion}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
		$query = Executor::doit($sql);

		return Model::one($query[0], new ConfiguracionModel());
	}

	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);

		return Model::many($query[0], new ConfiguracionModel());
	}
}