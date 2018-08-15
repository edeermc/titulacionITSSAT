<?php

namespace App\Controllers;

use App\Config\DB;
use App\Models\DocumentoAlumnoModel;
use App\Models\EgresadosModel;
use App\Models\OpcionDocumentoModel;
use App\Models\OpcionPlanModel;
use App\Models\ProyectoModel;
use App\Models\DocenteModel;

class EgresadoController {
    public function index(){
        try {
            $egresados = EgresadosModel::getAll('', '', 0, 10);
            $e = EgresadosModel::getNumRows();
            $p = round($e / 10) + ($e % 10 < 5 ? 1 : 0);
    
            return view('Catalogos/alumno.twig', ['egresados' => $egresados, 'modelo' => 'Egresado', 'pag' => $p]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function save(){
        DB::startTransaction();
        try {
            $reg = new EgresadosModel();
            if (!EgresadosModel::exist($_POST['id'])) {
                $reg->id = strtoupper($_POST['id']);
            } else {
                $reg = EgresadosModel::getById($_POST['id']);
            }
    
            $reg->nombre = $_POST['nombre'];
            $reg->apellido_paterno = ($_POST['apellido_paterno']);
            $reg->apellido_materno = ($_POST['apellido_materno']);
            $reg->sexo = $_POST['sexo'];
            $reg->id_plan = $_POST['id_plan'];
            $reg->periodo_ingreso = $_POST['periodo_ingreso'];
            $reg->periodo_egreso = $_POST['periodo_egreso'];
            if (!empty($_POST['id_proyecto']))
                $reg->id_proyecto = $_POST['id_proyecto'];
            if (!empty($_POST['numero_libro']))
                $reg->numero_libro = $_POST['numero_libro'];
            if (!empty($_POST['numero_foja']))
                $reg->numero_foja = $_POST['numero_foja'];
    
            if (!$reg->exist($_POST['id'])) {
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
            EgresadosModel::delById($_POST['id']);
            DB::commit();
            
            return 3;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function panel(){
        try {
            $egresado = EgresadosModel::getById('121u0123');
    
            if (!empty($egresado->calle)) {
                $doctosE = $egresado->getDocumentos();
                $proyectos = ProyectoModel::getByEstatus();
                $opciones = OpcionPlanModel::getByPlan($egresado->id_plan);
        
                if (!empty($egresado->id_proyecto)) {
                    $opc = $egresado->getProyecto()->id_opcion;
                    $doctos = OpcionDocumentoModel::getByOpcion($opc);
                } else
                    $doctos = array();
        
                return view('estudiante/panel.twig', ['egresado' => $egresado, 'proyectos' => $proyectos, 'opciones' => $opciones, 'documentos' => $doctos, 'docAlumno' => $doctosE]);
            } else {
                redirect('egresado/datospersonales');
            }
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function config(){
        try {
            $egresado = EgresadosModel::getById('121u0123');
    
            return view('estudiante/datospersonales.twig', ['egresado' => $egresado]);
        } catch (\Exception $e) {
            redirect('500');
        }
    }

    public function registro(){
        return view('estudiante/registro.twig');
    }

    public function save2(){
        DB::startTransaction();
        try {
            $reg = EgresadosModel::getById($_POST['id']);
    
            $reg->calle = $_POST['calle'];
            $reg->colonia = $_POST['colonia'];
            $reg->cp = $_POST['cp'];
            $reg->ciudad = $_POST['ciudad'];
            $reg->municipio = $_POST['municipio'];
            $reg->estado = $_POST['estado'];
            $reg->telefono = $_POST['telefono'];

            $reg->update();
            DB::commit();
            
            redirect('egresado');
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function save3(){
        DB::startTransaction();
        $proy = new ProyectoModel();
        try {
            $reg = EgresadosModel::getById($_POST['id']);
            if (ProyectoModel::exist($_POST['proyecto'])) {
                $proy = ProyectoModel::getByNombre($_POST['proyecto']);

                $id_proy = $proy->id;
                $proy->id_opcion = $_POST['id_opciontitulacion'];

                $id_career = $reg->getPlan()->id_carrera;
                if(empty($proy->id_presidenteacademia))
                    $proy->id_presidenteacademia =  DocenteModel::getCargoAcademia($id_career, 1)->id;
                if(empty($proy->id_secretarioacademia))
                    $proy->id_secretarioacademia = DocenteModel::getCargoAcademia($id_career, 2)->id;
                if(empty($proy->id_jefecarrera))
                    $proy->id_jefecarrera = DocenteModel::getCargoAcademia($id_career, 3)->id;

                $proy->update();
            } else {
                $proy->nombre = $_POST['proyecto'];
                $proy->id_opcion = $_POST['id_opciontitulacion'];
                $proy->id_presidenteacademia =  DocenteModel::getCargoAcademia($reg->getPlan()->id_carrera, 1)->id;
                $proy->id_secretarioacademia = DocenteModel::getCargoAcademia($reg->getPlan()->id_carrera, 2)->id;
                $proy->id_jefecarrera = DocenteModel::getCargoAcademia($reg->getPlan()->id_carrera, 3)->id;
                $id_proy = $proy->add();
            }

            $reg->id_proyecto = $id_proy;
            $reg->update();
            DB::commit();
    
            redirect('egresado');
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function save4(){
        DB::startTransaction();
        try {
            $reg = EgresadosModel::getById($_POST['id']);
            $doctos = OpcionDocumentoModel::getByOpcion($reg->getProyecto()->id_opcion);
    
            foreach ($doctos as $d) {
                if (isset($_FILES['documento-' . $d->id_documento])) {
                    $da = new DocumentoAlumnoModel();
                    $da->n_control = $_POST['id'];
                    $da->id_tipo_documento = $d->id_documento;
                    $da->estatus = 'Pendiente';
                    $da->ruta = md5($_POST['id'] . '-' . $d->id_documento) . '.pdf'; // <------- Guardar aqui
            
                    $dir = $_SERVER["DOCUMENT_ROOT"] . '/titulacionITSSAT/public/documentos/' . md5($da->n_control);
                    if (!file_exists($dir))
                        mkdir($dir, 0777, true);
            
                    if (move_uploaded_file($_FILES['documento-' . $d->id_documento]['tmp_name'], $dir . '/' . $da->ruta)) {
                        $da->add();
                    }
                }
            }
            DB::commit();
    
            redirect('egresado');
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    public function validatedoctos() {
        DB::startTransaction();
        try {
            $files = array();
            foreach ($_POST as $file => $status) {
                if ($file != "id") {
                    $files[] = ['id' => explode('_', $file)[1], 'stat' => $status];
                }
            }

            foreach ($files as $f) {
                $tmp = DocumentoAlumnoModel::getById($f['id']);
                $tmp->estatus = $f['stat'];
                $tmp->update();
            }

            DB::commit();
            return 2;
        } catch (\Exception $e) {
            DB::rollback();
            return 0;
        }
    }
}