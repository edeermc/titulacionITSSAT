<?php

namespace App\Controllers;

use App\Models\CarreraModel;

class CarreraController {
	public function index(){
		$carreras = CarreraModel::getAll();

		return view('Catalogos/carrera.twig', ['carreras' => $carreras]);
	}

	public function save(){

	}

	public function del(){

	}
}