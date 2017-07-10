<?php

namespace App\Models;

use App\Config\Executor;

class OpcionTitulacionModel {
	public static $tablename = 'opcion_titulacion';
	public $id;
	public $nombre;
	public $id_plan;

	function __construct(){
		$this->nombre = '';
		$this->id_plan = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, id_plan) VALUES ('{$this->nombre}', '{$this->id_plan}')";
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
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', id_plan='{$this->id_plan}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id = {$id}";
		$query = Executor::doit($sql);

		return Model::one($query[0], new OpcionTitulacionModel());
	}

	public static function getAll(){
		$sql = "SELECT * FROM ".self::$tablename;
		$query = Executor::doit($sql);

		return Model::many($query[0], new OpcionTitulacionModel());
	}

	public function getOpcion(){
		return OpcionTitulacionModel::getById($this->id_plan);
	}
}