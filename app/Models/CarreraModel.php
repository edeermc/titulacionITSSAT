<?php

namespace App\Models;

use App\Config\Executor;

class CarreraModel {
	public static $tablename = 'carrera';
	public $id;
	public $nombre;
    public $siglas;
    public $modalidad;

	function __construct(){
        $this->nombre = '';
        $this->siglas = '';
		$this->modalidad = 'Escolarizado';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre, siglas, modalidad) VALUES ('{$this->nombre}', '{$this->siglas}', '{$this->modalidad}')";
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
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', siglas='{$this->siglas}', modalidad='{$this->modalidad}' 
		WHERE id = {$this->id}";
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

    public static function getRange($i, $q){
        $sql = "SELECT * FROM ".self::$tablename." LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);

        return Model::many($query[0], new CarreraModel());
    }
}