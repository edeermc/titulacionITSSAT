<?php

namespace App\Models;

use App\Config\Executor;

class OpcionPlanModel extends Model {
    public $id_plan;
    public $id_opcion;

    function __construct() {
        self::$tablename = 'opcion_plan';
        $this->id_plan = '';
        $this->id_opcion = '';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (id_plan, id_opcion) VALUES ('{$this->id_plan}', '{$this->id_opcion}')";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET id_opcion='{$this->id_opcion}', id_plan='{$this->id_plan}' WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public function delByOpcion($id){
        $sql = "DELETE FROM ".self::$tablename." WHERE id_opcion = {$id}";
        Executor::doit($sql);
    }

    public function getOpcionTitulacion(){
        $r = new OpcionTitulacionModel();
        return $r->getById($this->id);
    }

    public function getOpcion(){
        $r = new OpcionTitulacionModel();
        return $r->getById($this->id_opcion);
    }

    public function getPlan(){
        $r = new PlanEstudiosModel();
        return $r->getById($this->id_plan);
    }

    public static function getByOpcion($idO){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id_opcion = {$idO}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new OpcionPlanModel());
    }

    public static function getByPlan($idP){
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id_plan = {$idP}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new OpcionPlanModel());
    }

    public static function existOpcion($idP, $idO){
        if ($idO != 0) {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE id_plan = {$idP} AND id_opcion = {$idO}";
            $query = Executor::doit($sql);

            return ($query[0]->num_rows > 0);
        } else
            return false;
    }
}