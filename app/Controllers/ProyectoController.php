<?php

namespace App\Controllers;

use App\Models\ProyectoModel;

class ProyectoController {
    public function index(){
        $proyecto = new ProyectoModel();
        $proyectos = $proyecto->getRange(0, 10);
        $pr = $proyecto->getAll();
        $p = round(count($pr)/10) + (count($pr)%10 < 5 ? 1 : 0);

        return view('Catalogos/proyecto.twig', ['egresados' => $proyectos, 'modelo' => 'Egresado', 'pag' => $p]);
    }

    public function save(){
        $reg = new ProyectoModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->apellido_paterno = utf8_decode($_POST['apellido_paterno']);
        $reg->apellido_materno = utf8_decode($_POST['apellido_materno']);
        $reg->sexo = $_POST['sexo'];
        $reg->id_plan = $_POST['id_plan'];
        $reg->periodo_ingreso = $_POST['periodo_ingreso'];
        $reg->periodo_egreso = $_POST['periodo_egreso'];

        if ((!empty($_POST['id_proyecto'])) && (!empty($reg->id_proyecto)))
            $reg->id_proyecto = $_POST['id_proyecto'];
        else
            $reg->id_proyecto = 'null';

        if ((!empty($_POST['no_libro'])) && (!empty($reg->id_proyecto)))
            $reg->numero_libro = $_POST['no_libro'];
        else
            $reg->numero_libro = $_POST['no_libro'];

        if ((!empty($_POST['no_foja'])) && (!empty($reg->id_proyecto)))
            $reg->numero_foja = $_POST['no_foja'];
        else
            $reg->numero_foja = $_POST['no_foja'];

        if($_POST['id'] != 0){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('cpanel/proyecto');
    }

    public function del(){
        $proyecto = new ProyectoModel();
        $proyecto->delById($_POST['id']);

        redirect('cpanel/proyecto');
    }
}