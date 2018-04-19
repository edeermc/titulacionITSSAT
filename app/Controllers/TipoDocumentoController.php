<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\TipoDocumentoModel;

class TipoDocumentoController{
    public function index(){
        try {
            $tipos = TipoDocumentoModel::getAll('', '', 0, 10);
            $c = TipoDocumentoModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);
    
            return view('Catalogos/tipoDocumento.twig', ['tipoDoc' => $tipos, 'modelo' => 'tipoDocto', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $reg = new TipoDocumentoModel();
            if ($_POST['id'] != 0) {
                $reg = $reg->getById($_POST['id']);
            }
    
            $reg->nombre = ($_POST['nombre']);
    
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
    }

    public function del(){
        DB::startTransaction();
        try {
            TipoDocumentoModel::delById($_POST['id']);
            DB::commit();
            
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }
}