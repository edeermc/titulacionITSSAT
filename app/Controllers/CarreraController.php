<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class CarreraController {
	public function index(){
	    try {
            $carreras = CarreraModel::getAll('', '', 0, 10);
            $c = CarreraModel::getNumRows();
            $p = round(count($c) / 10) + (count($c) % 10 < 5 ? 1 : 0);
        
            return view('Catalogos/carrera.twig', ['carreras' => $carreras, 'modelo' => 'Carrera', 'pag' => $p]);
        } catch (\Exception $e){
	        redirect('500');
        }
	}

	public function save(){
        $reg = new CarreraModel();
        if ($_POST['id'] != 0) {
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = $_POST['nombre'];
        $reg->siglas = strtoupper($_POST['siglas']);
        $reg->modalidad = $_POST['modalidad'];

        if ($_POST['id'] == 0) {
            $reg->add();
            return 1;
        } else {
            $reg->update();
            return 2;
        }
        //redirect('cpanel/carrera');
	}

	public function del(){
        $carrera = new CarreraModel();
        $carrera->delById($_POST['id']);

        return 3;
        //redirect('cpanel/carrera');
	}
}