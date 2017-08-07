<?php

namespace App\Models;

use App\Config\Executor;

class EgresadosModel extends Model {
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $sexo;
    public $id_plan;
    public $id_proyecto;
    public $numero_libro;
    public $numero_foja;
    public $periodo_ingreso;
    public $periodo_egreso;

    function __construct(){
        self::$tablename = 'egresados';
        $this->nombre = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->sexo = 'H';
        $this->id_plan = '';
        $this->id_proyecto = 'null';
        $this->numero_libro = 'null';
        $this->numero_foja = 'null';
        $this->periodo_ingreso = '';
        $this->periodo_egreso = '';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (id, nombre, apellido_paterno, apellido_materno, sexo, id_plan, id_proyecto, numero_libro,
					numero_foja, periodo_ingreso, periodo_egreso) VALUES ('{$this->id}', '{$this->nombre}', '{$this->apellido_paterno}', 
					'{$this->apellido_materno}', '{$this->sexo}', '{$this->id_plan}', {$this->id_proyecto}, {$this->numero_libro}, {$this->numero_foja},
					'{$this->periodo_ingreso}', '{$this->periodo_egreso}')";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', apellido_paterno='{$this->apellido_paterno}',
		apellido_materno='{$this->apellido_materno}', sexo='{$this->sexo}', id_plan='{$this->id_plan}', id_proyecto={$this->id_proyecto}, 
		numero_libro={$this->numero_libro}, numero_foja={$this->numero_foja}, periodo_ingreso='{$this->periodo_ingreso}', periodo_egreso='{$this->periodo_egreso}' 
		WHERE id = '{$this->id}'";

        echo $sql;
        Executor::doit($sql);
    }

    public function getPlan(){
        $r = new PlanEstudiosModel();
        return $r->getById($this->id_plan);
    }

    public function getProyecto(){
        $r = new ProyectoModel();
        return $r->getById($this->id_proyecto);
    }

    public function getNombreCompleto(){
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public static function getByProyecto($id, $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id_proyecto = {$id} ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new EgresadosModel());
    }

    public static function getByPlan($id, $ord = 'id'){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id_plan = {$id} ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::Many($query[0], new EgresadosModel());
    }

    public static function exist($id){
        $sql = "SELECT * FROM ".self::$tablename." WHERE id = '{$id}'";
        $query = Executor::doit($sql);

        return ($query[0]->num_rows > 0);
    }
}