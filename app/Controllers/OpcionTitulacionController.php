<?php

namespace App\Controllers;


use App\Models\OpcionPlanModel;
use App\Models\OpcionTitulacionModel;

class OpcionTitulacionController {
    public function index(){
        $opc = new OpcionTitulacionModel();
        $all = $opc->getRange(0, 10);
        $c = $opc->getAll();
        $p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

        return view('Catalogos/opcionTitulacion.twig', ['opc' => $all, 'modelo' => 'OpcionTitulacion', 'pag' => $p]);
    }

    public function save(){
        $reg = new OpcionTitulacionModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);

        if($_POST['id'] == 0){
            $id = $reg->add();
        } else{
            $reg->update();
            $id = $reg->id;
        }

        $planes = $_POST['id_plan'];
        $op = new OpcionPlanModel();
        $op->delByOpcion($id);
        for ($i=0;$i<count($planes);$i++) {
            $op->id_opcion = $id;
            $op->id_plan = $planes[$i];

            $op->add();
        }

        redirect('opciontitulacion');
    }

    public function del(){
        $tipoD = new OpcionTitulacionModel();
        $tipoD->delById($_POST['id']);

        redirect('opciontitulacion');
    }
}