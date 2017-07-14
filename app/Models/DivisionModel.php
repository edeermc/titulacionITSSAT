<?php

namespace App\Models;

use App\Config\Executor;

class DivisionModel extends Model{
	public $id;
	public $nombre;

	function __construct(){
		self::$tablename="division";
		$this->nombre = '';

	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (nombre) VALUES ('{$this->nombre}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}' WHERE id = {$this->id}";
		Executor::doit($sql);
	}

}