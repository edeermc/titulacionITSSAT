<?php

namespace App\Controllers;


use App\Config\DB;
use App\Models\OpcionDocumentoModel;
use App\Models\OpcionPlanModel;
use App\Models\OpcionTitulacionModel;

class OpcionTitulacionController {
    public function index(){
        try {
            $all = OpcionTitulacionModel::getAll('', '', 0, 10);
            $c = OpcionTitulacionModel::getNumRows();
            $p = round($c / 10) + ($c % 10 < 5 ? 1 : 0);

            return view('Catalogos/opcionTitulacion.twig', ['opc' => $all, 'modelo' => 'OpcionTitulacion', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $reg = new OpcionTitulacionModel();
            if ($_POST['id'] != 0) {
                $reg = OpcionTitulacionModel::getById($_POST['id']);
            }

            $reg->nombre = $_POST['nombre'];

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

        //redirect('cpanel/opciontitulacion');
    }

    public function savep() {
        DB::startTransaction();

        try {
            $planes = $_POST['id_plan'];
            OpcionPlanModel::delByOpcion($_POST['id']);
            $op = new OpcionPlanModel();
            for ($i = 0; $i < count($planes); $i++) {
                $op->id_opcion = $_POST['id'];
                $op->id_plan = $planes[$i];

                $op->add();
            }

            DB::commit();
            return 2;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }

        //redirect('cpanel/opciontitulacion');
    }

    public function saved(){
        DB::startTransaction();

        try {
            $doctos = $_POST['id_docto'];
            OpcionDocumentoModel::delByOpcion($_POST['id']);
            $op = new OpcionDocumentoModel();
            for ($i = 0; $i < count($doctos); $i++) {
                $op->id_opcion = $_POST['id'];
                $op->id_documento = $doctos[$i];

                $op->add();
            }

            DB::commit();
            return 2;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }

        //redirect('cpanel/opciontitulacion');
    }

    public function del(){
        DB::startTransaction();
        try {
            OpcionTitulacionModel::delById($_POST['id']);

            DB::commit();
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }

        //redirect('cpanel/opciontitulacion');
    }
}