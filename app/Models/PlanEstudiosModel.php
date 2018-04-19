<?php

namespace App\Models;

use App\Config\Executor;

class PlanEstudiosModel extends Model {
    public static $tablename = 'plan_estudios';
    
    public $nombre;
    public $id_carrera;

    public function getCarrera(){
        try {
            return CarreraModel::getById($this->id_carrera);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function isChecked($id){
        return OpcionPlanModel::existOpcion($this->id, $id);
    }

    public static function getByCarrera($id, $ord = 'id'){
        try {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE id_carrera = {$id} ORDER BY {$ord}";
            $query = Executor::doit($sql);
    
            return self::Many($query[0], new PlanEstudiosModel());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}