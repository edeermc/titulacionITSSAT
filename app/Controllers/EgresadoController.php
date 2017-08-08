<?php

namespace App\Controllers;

use App\Models\EgresadosModel;

class EgresadoController {
    public function index(){
        $egresado = new EgresadosModel();
        $egresados = $egresado->getRange(0, 10);
        $e = $egresado->getAll();
        $p = round(count($e)/10) + (count($e)%10 < 5 ? 1 : 0);

        return view('Catalogos/alumno.twig', ['egresados' => $egresados, 'modelo' => 'Egresado', 'pag' => $p]);
    }

    public function save(){
        $reg = new EgresadosModel();
        if(!$reg->exist($_POST['id'])){
            $reg->id = $_POST['id'];
        } else{
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->apellido_paterno = utf8_decode($_POST['apellido_paterno']);
        $reg->apellido_materno = utf8_decode($_POST['apellido_materno']);
        $reg->sexo = $_POST['sexo'];
        $reg->id_plan = $_POST['id_plan'];
        $reg->periodo_ingreso = $_POST['periodo_ingreso'];
        $reg->periodo_egreso = $_POST['periodo_egreso'];

        if (!empty($_POST['id_proyecto']))
            $reg->id_proyecto = $_POST['id_proyecto'];
        else
            $reg->id_proyecto = 'null';

        if (!empty($_POST['no_libro']))
            $reg->numero_libro = $_POST['no_libro'];
        else
            $reg->numero_libro = 'null';

        if (!empty($_POST['no_foja']))
            $reg->numero_foja = $_POST['no_foja'];
        else
            $reg->numero_foja = 'null';

        if(!$reg->exist($_POST['id'])){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('cpanel/egresado');
    }

    public function del(){
        $egresado = new EgresadosModel();
        $egresado->delById($_POST['id']);

        redirect('cpanel/egresado');
    }
}