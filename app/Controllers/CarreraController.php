<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class CarreraController {
	public function index(){
		$carreras = CarreraModel::getAll();

		return view('Catalogos/carrera.twig', ['carreras' => $carreras]);
	}

	public function save(){
        if($_POST['id'] == 0){
            $reg = new CarreraModel();
        } else{
            $reg = CarreraModel::getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->siglas = $_POST['siglas'];
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