<?php

namespace App\Models;

class OpcionTitulacionModel extends Model {
	protected static $tablename = 'opcion_titulacion';
    public $nombre;

	public function getPlanes(){
	    try {
            return OpcionPlanModel::getByOpcion($this->id);
        } catch (\Exception $e) {
	        throw new Exception($e->getMessage());
        }
    }
}