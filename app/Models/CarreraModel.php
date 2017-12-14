<?php

namespace App\Models;

use App\Config\Executor;

class CarreraModel extends Model {
    public static $tablename = 'carrera';
    
	public $nombre;
    public $siglas;
    public $modalidad;

	public function getPlanes(){
	    $r = new PlanEstudiosModel();
	    return $r->getByCarrera($this->id);
    }
}