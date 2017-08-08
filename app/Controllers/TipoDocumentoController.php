<?php

namespace App\Controllers;

use App\Models\TipoDocumentoModel;

class TipoDocumentoController{
    function index(){
        $tipo = new TipoDocumentoModel();
        $tipos = $tipo->getRange(0, 10);
        $c = $tipo->getAll();
        $p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

        return view('Catalogos/tipoDocumento.twig', ['tipoDoc' => $tipos, 'modelo' => 'tipoDocto', 'pag' => $p]);
    }

    public function save(){
        $reg = new TipoDocumentoModel();
        if($_POST['id'] != 0){
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);

        if($_POST['id'] == 0){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('cpanel/tipodocumento');
    }

    public function del(){
        $tipoD = new TipoDocumentoModel();
        $tipoD->delById($_POST['id']);

        redirect('cpanel/tipodocumento');
    }
}