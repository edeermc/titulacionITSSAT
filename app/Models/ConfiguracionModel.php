<?php

namespace App\Models;

class ConfiguracionModel extends Model {
	public static $tablename = 'configuracion';
	
	public $id;
	public $nombre;
	public $configuracion;

	function __construct(){
		$this->nombre = '';
		$this->configuracion = '';
	}
}