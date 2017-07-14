<?php

namespace App\Models;

use App\Config\Executor;

class TipoDocumentoModel extends Model{
	public $id;
	public $nombre;

	function __construct(){
		$this->nombre = '';
		self::$tablename='tipo_documento';
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