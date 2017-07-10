<?php

namespace App\Models;

use App\Config\Executor;

class PerfilModel {
	public static $tablename = 'perfil';
	public $id;
	public $nombre;
	public $modulo;
	public $permiso;

	function __construct(){
		$this->nombre = '';
		$this->modulo = '';
		$this->permiso = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, modulo, permiso) VALUES ('{$this->nombre}', '{$this->modulo}', '{$this->permiso}')";
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
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', modulo='{$this->modulo}', permiso='{$this->permiso}'
		 WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
		$query = Executor::doit($sql);

		return Model::one($query[0], new PerfilModel());
	}

	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);

		return Model::many($query[0], new PerfilModel());
	}
}