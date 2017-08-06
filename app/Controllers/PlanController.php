<?php

namespace App\Controllers;

use App\Models\PlanEstudiosModel;

class PlanController {
    public function index(){
        $plan = new PlanEstudiosModel();
        $planes = $plan->getRange(0, 10);
        $pl = $plan->getAll();
        $p = round(count($pl)/10) + (count($pl)%10 < 5 ? 1 : 0);

        return view('Catalogos/planestudios.twig', ['plan' => $planes, 'modelo' => 'Plan', 'pag' => $p]);
    }

    public function save(){
        $reg = new PlanEstudiosModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->id_carrera = strtoupper($_POST['id_carrera']);

        if($_POST['id'] == 0){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('planestudios');
    }

    public function del(){
        $plan = new PlanEstudiosModel();
        $plan->delById($_POST['id']);

        redirect('planestudios');
    }
}