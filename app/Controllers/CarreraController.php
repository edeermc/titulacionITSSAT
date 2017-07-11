<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class CarreraController {
	public function index(){
        $carreras = CarreraModel::getRange(0, 10);
        $c = CarreraModel::getAll();
        $p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

		return view('Catalogos/carrera.twig', ['carreras' => $carreras, 'pag' => $p]);
	}

	public function save(){
        if($_POST['id'] == 0){
            $reg = new CarreraModel();
        } else{
            $reg = CarreraModel::getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->siglas = strtoupper($_POST['siglas']);
        $reg->modalidad = $_POST['modalidad'];

        if($_POST['id'] == 0){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('carrera');
	}

	public function del(){
        CarreraModel::delById($_POST['id']);

        redirect('carrera');
	}
}