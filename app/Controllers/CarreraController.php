<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\CarreraModel;

class CarreraController {
	public function index(){
	    try {
            $carreras = CarreraModel::getAll('', '', 0, 10);
            $c = CarreraModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);
        
            return view('Catalogos/carrera.twig', ['carreras' => $carreras, 'modelo' => 'Carrera', 'pag' => $p]);
        } catch (\Exception $e){
	        redirect('500');
        }
	}

	public function save(){
	    DB::startTransaction();
	    try {
            $reg = new CarreraModel();
            if ($_POST['id'] != 0) {
                $reg = $reg->getById($_POST['id']);
            }
        
            $reg->nombre = $_POST['nombre'];
            $reg->siglas = strtoupper($_POST['siglas']);
            $reg->modalidad = $_POST['modalidad'];
        
            
            if ($_POST['id'] == 0) {
                $reg->add();
                DB::commit();
                
                return 1;
            } else {
                $reg->update();
                DB::commit();
                
                return 2;
            }
        } catch (\Exception $e){
	        DB::rollback();
	        return 0;
        }
        //redirect('cpanel/carrera');
	}

	public function del(){
	    DB::startTransaction();
	    try {
            $carrera = new CarreraModel();
            $carrera->delById($_POST['id']);
            DB::commit();
            
            return 3;
        } catch (\Exception $e){
	        DB::rollback();
	        return 0;
        }
        //redirect('cpanel/carrera');
	}
}