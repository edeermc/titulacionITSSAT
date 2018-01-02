<?php

namespace App\Models;

use App\Config\Executor;

class OpcionPlanModel extends Model {
    public static $tablename = 'opcion_plan';
    
    public $id_plan;
    public $id_opcion;

    function __construct() {
        $this->id_plan = '';
        $this->id_opcion = '';
    }

    public function delByOpcion($id){
        $sql = "DELETE FROM ".self::getTable()." WHERE id_opcion = {$id}";
        Executor::doit($sql);
    }

    public function getOpcionTitulacion(){
        return OpcionTitulacionModel::getById($this->id);
    }

    public function getOpcion(){
        return OpcionTitulacionModel::getById($this->id_opcion);
    }

    public function getPlan(){
        return PlanEstudiosModel::getById($this->id_plan);
    }

    public static function getByOpcion($idO){
        return self::getAll("id_opcion = {$idO}");
    }

    public static function getByPlan($idP){
        return self::getAll("id_plan = {$idP}");
    }

    public static function existOpcion($idP, $idO){
        if ($idO != 0) {
            $sql = "SELECT * FROM " . self::getTable() . " WHERE id_plan = {$idP} AND id_opcion = {$idO}";
            $n = Executor::doit($sql, [], true);

            return ($n > 0);
        } else
            return false;
    }
}