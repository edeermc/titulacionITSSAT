<?php

namespace App\Controllers;


use App\Models\OpcionDocumentoModel;
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

        if($_POST['id'] == 0) {
            $reg->add();
            return 1;
        } else {
            $reg->update();
            return 2;
        }

        //redirect('cpanel/opciontitulacion');
    }

    public function savep(){
        $reg = new OpcionTitulacionModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $planes = $_POST['id_plan'];
        $op = new OpcionPlanModel();
        $op->delByOpcion($reg->id);
        for ($i=0; $i<count($planes); $i++) {
            $op->id_opcion = $reg->id;
            $op->id_plan = $planes[$i];

            $op->add();
        }
        return 2;

        //redirect('cpanel/opciontitulacion');
    }

    public function saved(){
        $reg = new OpcionTitulacionModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $doctos = $_POST['id_docto'];
        $op = new OpcionDocumentoModel();
        $op->delByOpcion($reg->id);
        for ($i=0; $i<count($doctos); $i++) {
            $op->id_opcion = $reg->id;
            $op->id_documento = $doctos[$i];

            $op->add();
        }
        return 2;

        //redirect('cpanel/opciontitulacion');
    }

    public function del(){
        $tipoD = new OpcionTitulacionModel();
        $tipoD->delById($_POST['id']);
        return 3;

        //redirect('cpanel/opciontitulacion');
    }
}