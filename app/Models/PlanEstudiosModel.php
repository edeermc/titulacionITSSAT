<?php

namespace App\Models;

use App\Config\Executor;

class PlanEstudiosModel extends Model {
    public $nombre;
    public $id_carrera;

    function __construct(){
        self::$tablename = 'plan_estudios';
        $this->nombre = '';
        $this->id_carrera = '';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (nombre, id_carrera) VALUES ('{$this->nombre}', '{$this->id_carrera}')";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', id_carrera='{$this->id_carrera}' WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public function getCarrera(){
        $r = new CarreraModel();
        return $r->getById($this->id_carrera);
    }

    public function isChecked($id){
        $r = new OpcionPlanModel();
        return $r->existOpcion($this->id, $id);
    }

    public static function getByCarrera($id, $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id_carrera = {$id} ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new PlanEstudiosModel());
    }
}