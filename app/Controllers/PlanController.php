<?php

namespace App\Controllers;

use App\Models\PlanEstudiosModel;
use App\Config\DB;

class PlanController {
    public function index(){
        try {
            $planes = PlanEstudiosModel::getAll('', '', 0, 10);
            $pl = PlanEstudiosModel::getNumRows();
            $p = round($pl / 10) + ($pl % 10 < 5 ? 1 : 0);
    
            return view('Catalogos/planestudios.twig', ['plan' => $planes, 'modelo' => 'Plan', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $reg = new PlanEstudiosModel();
            if ($_POST['id'] != 0) {
                $reg = PlanEstudiosModel::getById($_POST['id']);
            }
    
            $reg->nombre = $_POST['nombre'];
            $reg->id_carrera = strtoupper($_POST['id_carrera']);
    
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
            PlanEstudiosModel::delById($_POST['id']);
            DB::commit();
            
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            
            return 0;
        }
    }
}