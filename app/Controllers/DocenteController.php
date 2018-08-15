<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\DocenteModel;

class DocenteController {
	public function index(){
	    try {
            $docentes = DocenteModel::getAll('', '', 0, 10);
            $c = DocenteModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);

            return view('Catalogos/docente.twig', ['docentes' => $docentes, 'modelo' => 'Docente', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
	}

	public function save(){
	    DB::startTransaction();
	    try {
            $reg = new DocenteModel();
            if ($_POST['id'] != 0) {
                $reg = DocenteModel::getById($_POST['id']);
            }

            $reg->nombre = $_POST['nombre'];
            $reg->apellido_paterno = $_POST['apellido_paterno'];
            $reg->apellido_materno = $_POST['apellido_materno'];
            $reg->sexo = $_POST['sexo'];
            $reg->cedula_profesional = $_POST['cedula_profesional'];
            $reg->id_division = $_POST['division'];
            $reg->id_carrera = $_POST['carrera'];
            $reg->estatus = $_POST['estatus'];
            $reg->tipo = $_POST['tipo'];

            if ($_POST['id'] == 0) {
                $reg->add();
                DB::commit();

                return 1;
            } else {
                $reg->update();
                DB::commit();

                return 2;
            }
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }

		//redirect('cpanel/docente');
	}

	public function del(){
	    DB::startTransaction();
	    try {
            DocenteModel::delById($_POST['id']);
            DB::commit();

            return 3;
        } catch (\Exception $e) {
	        DB::rollback();
	        return 0;
        }

		//redirect('cpanel/docente');
	}
}