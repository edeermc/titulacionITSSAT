<?php

namespace App\Controllers;

use App\Models\DocenteModel;

class DocenteController {
	public function index(){
		$docente = new DocenteModel();
		$docentes = $docente->getRange(0, 10);
		$c = $docente->getAll();
		$p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

		return view('Catalogos/docente.twig', ['docentes' => $docentes, 'modelo' => 'Docente', 'pag' => $p]);
	}

	public function save(){
		$reg = new DocenteModel();
		if($_POST['id'] != 0){
			$reg = $reg->getById($_POST['id']);
		}

		$reg->nombre = utf8_decode($_POST['nombre']);
		$reg->apellido_paterno = utf8_decode($_POST['apellido_paterno']);
		$reg->apellido_materno = utf8_decode($_POST['apellido_materno']);
		$reg->sexo = $_POST['sexo'];
		$reg->cedula_profesional = $_POST['cedula_profesional'];
		$reg->id_division = $_POST['division'];
		$reg->id_carrera = $_POST['carrera'];
		$reg->estatus = $_POST['estatus'];

		if($_POST['id'] == 0){
			$reg->add();
		} else{
			$reg->update();
		}

		redirect('docente');
	}

	public function del(){
		$carrera = new DocenteModel();
		$carrera->delById($_POST['id']);

		redirect('docente');
	}
}