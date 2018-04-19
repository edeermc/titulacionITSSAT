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
        try {
            return OpcionTitulacionModel::getById($this->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getOpcion(){
        try {
            return OpcionTitulacionModel::getById($this->id_opcion);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPlan(){
        try {
            return PlanEstudiosModel::getById($this->id_plan);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByOpcion($idO){
        try {
            return self::getAll("id_opcion = {$idO}");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getByPlan($idP){
        try {
            return self::getAll("id_plan = {$idP}");
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function existOpcion($idP, $idO){
        try {
            if ($idO != 0) {
                $sql = "SELECT * FROM " . self::getTable() . " WHERE id_plan = {$idP} AND id_opcion = {$idO}";
                $n = Executor::doit($sql, [], true);
        
                return ($n > 0);
            } else
                return false;
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}