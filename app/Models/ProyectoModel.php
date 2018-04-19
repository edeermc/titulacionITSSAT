<?php

namespace App\Models;

use App\Config\Executor;

class ProyectoModel extends Model {
    public static $tablename = 'proyecto';
    
    public $nombre;
    public $id_opcion;
    public $id_presidente;
    public $id_secretario;
    public $id_vocal;
    public $id_vocal_suplente;
    public $id_asesor;
    public $id_asesor2;
    public $observaciones;
    public $id_presidenteacademia;
    public $id_secretarioacademia;
    public $id_jefecarrera;
    public $fecha_liberacion;
    public $fecha_notificacion;
    public $estatus;


    function __construct(){
        $this->estatus = 'Abierto';
    }
    
    public function getOpcion(){
        try {
            return OpcionTitulacionModel::getById($this->id_opcion);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPresidente(){
        try {
            return DocenteModel::getById($this->id_presidente);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getSecretario(){
        try {
            return DocenteModel::getById($this->id_secretario);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getVocal(){
        try {
            return DocenteModel::getById($this->id_vocal);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getVocalSuplente(){
        try {
            return DocenteModel::getById($this->id_vocal_suplente);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAsesor(){
        try {
            return DocenteModel::getById($this->id_asesor);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAsesor2(){
        try {
            return DocenteModel::getById($this->id_asesor2);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPresidenteAcademia(){
        try {
            return DocenteModel::getById($this->id_presidenteacademia);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getSecretarioAcademia(){
        try {
            return DocenteModel::getById($this->id_secretarioacademia);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getJefeCarrera(){
        try {
            return DocenteModel::getById($this->id_jefecarrera);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAlumnos(){
        try {
            return EgresadosModel::getByProyecto($this->id);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getByEstatus($stat = 'Abierto', $ord = 'id'){
        try {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE estatus = '{$stat}' ORDER BY {$ord}";
            $query = Executor::doit($sql);
    
            return self::many($query[0], new ProyectoModel());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getByNombre($name){
        try {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE nombre = '{$name}' LIMIT 1";
            $query = Executor::doit($sql);
    
            return self::one($query[0], new ProyectoModel());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function exist($name){
        try {
            $sql = "SELECT * FROM " . self::$tablename . " WHERE nombre = '{$name}' LIMIT 1";
            $query = Executor::doit($sql);
    
            return ($query[0]->num_rows > 0);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}