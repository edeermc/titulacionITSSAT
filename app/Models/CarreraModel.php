<?php

namespace App\Models;

class CarreraModel extends Model {
    public static $tablename = 'carrera';
    
	public $nombre;
    public $siglas;
    public $modalidad;

	public function getPlanes(){
	    return PlanEstudiosModel::getByCarrera($this->id);
    }
}