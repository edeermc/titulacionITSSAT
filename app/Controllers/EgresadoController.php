<?php

namespace App\Controllers;

use App\Models\DocumentoAlumnoModel;
use App\Models\EgresadosModel;
use App\Models\OpcionDocumentoModel;
use App\Models\OpcionPlanModel;
use App\Models\ProyectoModel;

class EgresadoController {
    public function index(){
        $egresado = new EgresadosModel();
        $egresados = $egresado->getRange(0, 10);
        $e = $egresado->getAll();
        $p = round(count($e)/10) + (count($e)%10 < 5 ? 1 : 0);

        return view('Catalogos/alumno.twig', ['egresados' => $egresados, 'modelo' => 'Egresado', 'pag' => $p]);
    }

    public function save(){
        $reg = new EgresadosModel();
        if(!$reg->exist($_POST['id'])){
            $reg->id = strtoupper($_POST['id']);
        } else{
            $reg = $reg->getById($_POST['id']);
        }

        $reg->nombre = utf8_decode($_POST['nombre']);
        $reg->apellido_paterno = utf8_decode($_POST['apellido_paterno']);
        $reg->apellido_materno = utf8_decode($_POST['apellido_materno']);
        $reg->sexo = $_POST['sexo'];
        $reg->id_plan = $_POST['id_plan'];
        $reg->periodo_ingreso = $_POST['periodo_ingreso'];
        $reg->periodo_egreso = $_POST['periodo_egreso'];
        $reg->id_proyecto = !empty($_POST['id_proyecto']) ? $_POST['id_proyecto'] : 'null';
        $reg->numero_libro = !empty($_POST['numero_libro']) ? $_POST['numero_libro'] : 'null';
        $reg->numero_foja = !empty($_POST['numero_foja']) ? $_POST['numero_foja'] : 'null';

        if(!$reg->exist($_POST['id'])){
            $reg->add();
        } else{
            $reg->update();
        }

        redirect('cpanel/egresado');
    }

    public function del(){
        $egresado = new EgresadosModel();
        $egresado->delById($_POST['id']);

        redirect('cpanel/egresado');
    }

    public function panel(){
        $egresado = new EgresadosModel();
        $egresado = $egresado->getById('121u0229');

        if(!empty($egresado->calle)) {
            $doctosE = $egresado->getDoctos();

            $proyectos = new ProyectoModel();
            $proyectos = $proyectos->getByEstatus();

            $opciones = new OpcionPlanModel();
            $opciones = $opciones->getByPlan($egresado->id_plan);

            if (!empty($egresado->id_proyecto)) {
                $opc = $egresado->getProyecto()->id_opcion;
                $doctos = new OpcionDocumentoModel();
                $doctos = $doctos->getByOpcion($opc);
            } else
                $doctos = array();

            return view('estudiante/panel.twig', ['egresado' => $egresado, 'proyectos' => $proyectos, 'opciones' => $opciones, 'documentos' => $doctos, 'docAlumno' => $doctosE]);
        } else{
            redirect('egresado/datospersonales');
        }
    }

    public function config(){
        $egresado = new EgresadosModel();
        $egresado = $egresado->getById('121u0229');

        return view('estudiante/datospersonales.twig', ['egresado' => $egresado]);
    }

    public function registro(){
        return view('estudiante/registro.twig');
    }

    public function save2(){
        $reg = new EgresadosModel();
        $reg = $reg->getById($_POST['id']);

        $reg->id_proyecto = (!empty($reg->id_proyecto)) ? $reg->id_proyecto : 'null';
        $reg->numero_foja = (!empty($reg->numero_foja)) ? $reg->numero_foja : 'null';
        $reg->numero_libro = (!empty($reg->numero_libro)) ? $reg->numero_libro : 'null';
        $reg->calle = utf8_decode($_POST['calle']);
        $reg->colonia = utf8_decode($_POST['colonia']);
        $reg->cp = utf8_decode($_POST['cp']);
        $reg->ciudad = utf8_decode($_POST['ciudad']);
        $reg->municipio = utf8_decode($_POST['municipio']);
        $reg->estado = utf8_decode($_POST['estado']);
        $reg->telefono = $_POST['telefono'];
        //$reg->correo = $_POST['correo'];

        $reg->update();

        redirect('egresado');
    }

    public function save3(){
        $proy = new ProyectoModel();
        if ($proy->exist(utf8_decode($_POST['proyecto']))){
            $proy = $proy->getByNombre(utf8_decode($_POST['proyecto']));

            $id_proy = $proy->id;
            $proy->id_opcion = $_POST['id_opciontitulacion'];
            $proy->id_presidente = (!empty($proy->id_presidente)) ? $proy->id_presidenteacademia : 'null';
            $proy->id_secretario = (!empty($proy->id_secretario)) ? $proy->id_secretario : 'null';
            $proy->id_vocal = (!empty($proy->id_vocal)) ? $proy->id_vocal : 'null';
            $proy->id_vocal_suplente = (!empty($proy->id_vocal_suplente)) ? $proy->id_vocal_suplente : 'null';
            $proy->id_asesor = (!empty($proy->id_asesor)) ? $proy->id_asesor : 'null';
            $proy->id_asesor2 = (!empty($proy->id_asesor2)) ? $proy->id_asesor2 : 'null';
            $proy->id_presidenteacademia = (!empty($proy->id_presidenteacademia)) ? $proy->id_presidenteacademia : 'null';
            $proy->id_secretarioacademia = (!empty($proy->id_secretarioacademia)) ? $proy->id_secretarioacademia : 'null';
            $proy->id_jefecarrera = (!empty($proy->id_jefecarrera)) ? $proy->id_jefecarrera : 'null';
            $proy->update();
        } else{
            $proy->nombre = utf8_decode($_POST['proyecto']);
            $proy->id_opcion = $_POST['id_opciontitulacion'];
            $id_proy = $proy->add();
        }

        $reg = new EgresadosModel();
        $reg = $reg->getById($_POST['id']);
        $reg->numero_foja = (!empty($reg->numero_foja)) ? $reg->numero_foja : 'null';
        $reg->numero_libro = (!empty($reg->numero_libro)) ? $reg->numero_libro : 'null';
        $reg->id_proyecto = $id_proy;

        $reg->update();

        redirect('egresado');
    }

    public function save4(){
        $reg = new EgresadosModel();
        $reg = $reg->getById($_POST['id']);
        $opc = $reg->getProyecto()->id_opcion;

        $doctos = new OpcionDocumentoModel();
        $doctos = $doctos->getByOpcion($opc);

        foreach ($doctos as $d){
            if(isset($_FILES['documento-'.$d->id_documento])){
                $da = new DocumentoAlumnoModel();
                $da->n_control = $_POST['id'];
                $da->id_tipo_documento = $d->id_documento;
                $da->estatus = 'Pendiente';
                $da->ruta = md5($_POST['id'] . '-' . $d->id_documento) . '.pdf'; // <------- Guardar aqui

                $dir = $_SERVER["DOCUMENT_ROOT"] . '/titulacion/public/documentos/' . md5($da->n_control);
                if (!file_exists($dir))
                    mkdir($dir, 0777, true);

                if (move_uploaded_file($_FILES['documento-'.$d->id_documento]['tmp_name'],$dir . '/' . $da->ruta)) {
                    $da->add();
                }
            }
        }

        redirect('egresado');
    }
}