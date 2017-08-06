<?php

namespace App\Models;

use App\Config\Executor;

class ProyectoModel extends Model {
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
    public $fecha_liberacion;
    public $fecha_notificacion;


    function __construct(){
        self::$tablename = 'proyecto';
        $this->nombre = '';
        $this->id_opcion = 'null';
        $this->id_presidente = 'null';
        $this->id_secretario = 'null';
        $this->id_vocal = 'null';
        $this->id_vocal_suplente = 'null';
        $this->id_asesor = 'null';
        $this->id_asesor2 = 'null';
        $this->observaciones = '';
        $this->id_presidenteacademia = 'null';
        $this->fecha_liberacion = 'null';
        $this->fecha_notificacion = 'null';
    }

    public function add(){
        $query = "INSERT INTO ".self::$tablename." (nombre, id_opcion, id_presidente, id_secretario, id_vocal, id_vocal_suplente, id_asesor, id_asesor2,
					observaciones, id_presidenteacademia, fecha_libreacion, fecha_notificacion) VALUES ('{$this->nombre}', {$this->id_opcion}, 
					{$this->id_presidente}, {$this->id_secretario}, {$this->id_vocal}, {$this->id_vocal_suplente}, {$this->id_asesor}, {$this->id_asesor2}, 
					'{$this->observaciones}', {$this->id_presidenteacademia}, {$this->fecha_liberacion}, {$this->fecha_notificacion})";
        $sql = Executor::doit($query);

        return $sql[1];
    }

    public function update(){
        $sql = "UPDATE ".self::$tablename." SET nombre='{$this->nombre}', id_opcion='{$this->id_opcion}', id_presidente='{$this->id_presidente}',
		id_secretario='{$this->id_secretario}', id_vocal='{$this->id_vocal}', id_vocal_suplente='{$this->id_vocal_suplente}', id_asesor='{$this->id_asesor}', 
		id_asesor2='{$this->id_asesor2}', observaciones='{$this->observaciones}', id_presidenteacademia='{$this->id_presidenteacademia}', 
		fecha_liberacion='{$this->fecha_liberacion}', fecha_notificacion='{$this->fecha_notificacion}' WHERE id = {$this->id}";
        Executor::doit($sql);
    }

    public function getOpcion(){
        $r = new OpcionTitulacionModel();
        return $r->getById($this->id_opcion);
    }

    public function getPresidente(){
        $r = new DocenteModel();
        return $r->getById($this->id_presidente);
    }

    public function getSecretario(){
        $r = new DocenteModel();
        return $r->getById($this->id_secretario);
    }

    public function getVocal(){
        $r = new DocenteModel();
        return $r->getById($this->id_vocal);
    }

    public function getVocalSuplente(){
        $r = new DocenteModel();
        return $r->getById($this->id_vocal_suplente);
    }

    public function getAsesor(){
        $r = new DocenteModel();
        return $r->getById($this->id_asesor);
    }

    public function getAsesor2(){
        $r = new DocenteModel();
        return $r->getById($this->id_asesor2);
    }

    public function getPresidenteAcademia(){
        $r = new DocenteModel();
        return $r->getById($this->id_presidenteacademia);
    }

    public function getAlumnos(){
        $r = new EgresadosModel();
        return $r->getByProyecto($this->id);
    }
}