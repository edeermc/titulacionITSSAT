<?php

namespace App\Models;

class DivisionModel extends Model{
    public static $tablename = 'division';
    
	public $id;
	public $nombre;

	function __construct(){
		$this->nombre = '';
	}
}