<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\ProyectoModel;

class ProyectoController {
    public function index(){
        try {
            $proyectos = ProyectoModel::getAll('', '', 0, 10);
            $pr = ProyectoModel::getNumRows();
            $p = round($pr / 10) + ($pr % 10 < 5 ? 1 : 0);
    
            return view('Catalogos/proyecto.twig', ['proyectos' => $proyectos, 'modelo' => 'Proyecto', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $reg = new ProyectoModel();
            if ($_POST['id'] != 0) {
                $reg = ProyectoModel::getById($_POST['id']);
            }
    
            $reg->nombre = ($_POST['nombre']);
            if(!empty($_POST['id_opcion'])) $reg->id_opcion = $_POST['id_opcion'];
            if(!empty($_POST['id_presidente'])) $reg->id_presidente = $_POST['id_presidente'];
            if(!empty($_POST['id_secretario'])) $reg->id_secretario = $_POST['id_secretario'];
            if(!empty($_POST['id_vocal'])) $reg->id_vocal = $_POST['id_vocal'];
            if(!empty($_POST['id_vocal_suplente'])) $reg->id_vocal_suplente = $_POST['id_vocal_suplente'];
            if(!empty($_POST['id_asesor'])) $reg->id_asesor = $_POST['id_asesor'];
            if(!empty($_POST['id_asesor2'])) $reg->id_asesor2 = $_POST['id_asesor2'];
            $reg->observaciones = $_POST['observaciones'];
            if(!empty($_POST['id_presidenteacademia'])) $reg->id_presidenteacademia =  $_POST['id_presidenteacademia'];
            if(!empty($_POST['id_secretarioacademia'])) $reg->id_secretarioacademia = $_POST['id_secretarioacademia'];
            if(!empty($_POST['id_jefecarrera'])) $reg->id_jefecarrera = $_POST['id_jefecarrera'];
            if(!empty($_POST['fecha_liberacion'])) $reg->fecha_liberacion = $_POST['fecha_liberacion'];
            if(!empty($_POST['fecha_notificacion'])) $reg->fecha_notificacion = $_POST['fecha_notificacion'];
            $reg->estatus = $_POST['estatus'];
    
            if ($_POST['id'] == 0) {
                $reg->add();
                DB::commit();
    
                return 1;
            } else {
                $reg->update();
                DB::commit();
                
                return 2;
            }
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            //return 0;
        }
    }

    public function del(){
        DB::startTransaction();
        try {
            ProyectoModel::delById($_POST['id']);
            DB::commit();
    
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function validar(){

    }

    public function dictamen(){

    }

    public function liberar(){

    }

    public function examen(){
        $cond =  '';
        $proyectos = ProyectoModel::getRange(0, 10);
        $pr = ProyectoModel::getAll();
        $p = round(count($pr)/10) + (count($pr)%10 < 5 ? 1 : 0);

        return view('Catalogos/proyecto.twig', ['proyectos' => $proyectos, 'modelo' => 'Proyecto', 'pag' => $p]);
    }
}