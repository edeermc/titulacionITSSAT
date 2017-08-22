<?php

namespace App\Controllers;

use App\Models\ProyectoModel;

class ProyectoController {
    public function index(){
        $proyecto = new ProyectoModel();
        $proyectos = $proyecto->getRange(0, 10);
        $pr = $proyecto->getAll();
        $p = round(count($pr)/10) + (count($pr)%10 < 5 ? 1 : 0);

        return view('Catalogos/proyecto.twig', ['proyectos' => $proyectos, 'modelo' => 'Proyecto', 'pag' => $p]);
    }

    public function save(){
        $reg = new ProyectoModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->id_opcion = !empty($_POST['id_opcion']) ? $_POST['id_opcion'] : 'null';
        $reg->id_presidente = !empty($_POST['id_presidente']) ? $_POST['id_presidente'] : 'null';
        $reg->id_secretario = !empty($_POST['id_secretario']) ? $_POST['id_secretario'] : 'null';
        $reg->id_vocal = !empty($_POST['id_vocal']) ? $_POST['id_vocal'] : 'null';
        $reg->id_vocal_suplente = !empty($_POST['id_vocal_suplente']) ? $_POST['id_vocal_suplente'] : 'null';
        $reg->id_asesor = !empty($_POST['id_asesor']) ? $_POST['id_asesor'] : 'null';
        $reg->id_asesor2 = !empty($_POST['id_asesor2']) ? $_POST['id_asesor2'] : 'null';
        $reg->observaciones = utf8_decode($_POST['observaciones']);
        $reg->id_presidenteacademia = !empty($_POST['id_presidenteacademia']) ? $_POST['id_presidenteacademia'] : 'null';
        $reg->id_secretarioacademia = !empty($_POST['id_secretarioacademia']) ? $_POST['id_secretarioacademia'] : 'null';
        $reg->id_jefecarrera = !empty($_POST['id_jefecarrera']) ? $_POST['id_jefecarrera'] : 'null';
        $reg->fecha_liberacion = !empty($_POST['fecha_liberacion']) ? $_POST['fecha_liberacion'] : 'null';
        $reg->fecha_notificacion = !empty($_POST['fecha_notificacion']) ? $_POST['fecha_notificacion'] : 'null';
        $reg->estatus = $_POST['estatus'];

        if($_POST['id'] == 0){
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

    public function validar(){

    }

    public function dictamen(){

    }

    public function liberar(){

    }

    public function examen(){
        $cond =  '';
        $proyecto = new ProyectoModel();
        $proyectos = $proyecto->getRange(0, 10);
        $pr = $proyecto->getAll();
        $p = round(count($pr)/10) + (count($pr)%10 < 5 ? 1 : 0);

        return view('Catalogos/proyecto.twig', ['proyectos' => $proyectos, 'modelo' => 'Proyecto', 'pag' => $p]);
    }
}