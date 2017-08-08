<?php
namespace App\Controllers;

use App\Models\DivisionModel;

class DivisionController
{
    public function index(){
        $division = new DivisionModel();
        $d = $division->getRange(0, 10);
        $c = $division->getAll();
        $p = round(count($c)/10) + (count($c)%10 > 0 ? 1 : 0);

        return view('Catalogos/division.twig', ['division' => $d, 'modelo' => 'Division', 'pag' => $p]);
    }
    public function save(){
        $reg = new DivisionModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);

        if($_POST['id'] == 0){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('cpanel/division');
    }
    public function del(){
        $carrera = new DivisionModel();
        $carrera->delById($_POST['id']);

        redirect('cpanel/division');
    }
}