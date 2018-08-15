<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\DocenteModel;
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
            $reg->observaciones = $_POST['observaciones'];
            $reg->estatus = $_POST['estatus'];
    
            if ($_POST['id'] != 0) {
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