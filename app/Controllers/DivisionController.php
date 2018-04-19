<?php
namespace App\Controllers;

use App\Config\DB;
use App\Models\DivisionModel;

class DivisionController
{
    public function index(){
        try{
            $division = DivisionModel::getALL('','',0,10);
            $c = DivisionModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);

            return view('Catalogos/division.twig', ['division' => $division, 'modelo' => 'Division', 'pag' => $p]);
        }catch(\Exception $e){
            redirect('500');
        }
    }
    public function save(){
        $reg = new DivisionModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);

        if($_POST['id'] == 0){
            $reg->add();
            return 1;
        } else{
            $reg->update();
            return 2;
        }

        //redirect('cpanel/division');
    }
    public function del(){
        $carrera = new DivisionModel();
        $carrera->delById($_POST['id']);

        return 3;
        //redirect('cpanel/division');
    }
}