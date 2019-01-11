<?php

namespace App\Controllers;

use App\Config\PDF;
use App\Models\EgresadosModel;
use App\Models\ProyectoModel;

class ReporteController {
    public function solicitud() {
        $n_control = request('ncontrol');
        $student = EgresadosModel::getById($n_control);

        $pdf = new PDF("solicitud_{$n_control}", "FORMATO DE SOLICITUD PARA TITULACIÓN INTEGRAL");
        $pdf->AddPage();

        $pdf->Cell(0, 5, "Lugar: San Adrés Tuxtla, Veracruz. Fecha: " . getDateNow(), '', 14, 'R', false, '', 11);

        $pdf->Ln(12);
        $pdf->Cell(0, 5, "    M.I.I. Dalia Anaí González Vargas", 0, 7, 'L', false, 'B', 12);
        $pdf->Cell(0, 5, "    Jefa del Departamento de Estudios Profesionales del ITSSAT", 0, 7, 'L', false, 'B', 12);
        $pdf->Cell(0, 5, "    P  R  E  S  E  N  T  E", 0, 7, 'L', false, 'B', 12);
        $pdf->Ln(11);
        $pdf->MultiCell(0, 5, "Por medio del presente, solicito la autorización para iniciar trámite de registro del proyecto de titulación integral:", 0, 'J');

        $pdf->Ln();
        $pdf->Cell(50, 7, "Nombre", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->getNombreCompleto(), 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "Carrera", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->getPlan()->getCarrera()->nombre, 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "Plan de estudios", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->getPlan()->nombre, 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "No. de control", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->id, 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "Nombre del proyecto", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->getProyecto()->nombre, 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "Nombre del producto", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(140, 7, $student->getProyecto()->getOpcion()->nombre, 1, 0, 'L', false, '', 12);
        $pdf->Ln(11);

        $pdf->MultiCell(0, 5, "En espera de la aceptación de esta solicitud, quedo a sus órdenes.", 0,'J');
        $pdf->Ln(11);

        $pdf->Cell(0, 5, "A T E N T A M E N T E", 0,'5', 'C', false, 'B', 12);
        $pdf->Ln(13);
        $pdf->Cell(0, 7, "________________________________", 0,'5', 'C', false, 'B', 12);
        $pdf->Cell(0, 7, "Nombre y firma del estudiante", 0,'5', 'C', false, 'B', 12);
        $pdf->Ln(11);

        $pdf->MultiCell(50, 6, "Dirección (calle, núm, col, cd)", 1, 'L', false, 'B', 12);
        $pdf->Ln(-12);
        $pdf->SetX(60);
        $pdf->MultiCell(140, 6, $student->getDireccionCompleta(), 1, 'L', false, '', 11);
        $pdf->Cell(50, 7, "Teléfono", 1, 0, 'L', false, 'B', 11);
        $pdf->Cell(140, 7, $student->telefono, 1, 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(50, 7, "Correo electrónico", 1, 0, 'L', false, 'B', 11);
        $pdf->Cell(140, 7, $student->correo, 1, 0, 'L', false, '', 12);

        $pdf->hideFooter();
        $pdf->generatePDF();
    }

    public function registroProyecto() {
        $id_proyecto = request('proyecto');
        $proyecto = ProyectoModel::getById($id_proyecto);

        $pdf = new PDF("registro_{$proyecto->nombre}", "REGISTRO DEL PROYECTO PARA TITULACIÓN INTEGRAL");
        $pdf->AddPage();

        $pdf->Cell(0, 5, "Asunto: Registro de proyecto ", '', 14, 'R', false, '', 12);
        $pdf->Cell(0, 5, "para titulación integral.", '', 14, 'R', false, '', 12);
        $pdf->Ln(12);

        $pdf->Cell(0, 5, "    M.I.I. Dalia Anaí González Vargas", 0, 7, 'L', false, 'B', 12);
        $pdf->Cell(0, 5, "    Jefa del Departamento de Estudios Profesionales del ITSSAT", 0, 7, 'L', false, 'B', 12);
        $pdf->Cell(0, 5, "    P  R  E  S  E  N  T  E", 0, 7, 'L', false, 'B', 12);
        $pdf->Ln(12);

        $pdf->Cell(0, 5, "Departamento de: {$proyecto->getCarrera()->nombre}", '', 5, 'L', false, '', 12);
        $pdf->Cell(0, 5, "Lugar: San Adrés Tuxtla, Veracruz.          Fecha: " . getDateNow(), '', 5, 'L', false, '', 12);
        $pdf->Ln(11);

        $pdf->Cell(80, 7, "Nombre del proyecto", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(110, 7, $proyecto->nombre, 1, 0, 'L', false, '', 11);
        $pdf->Ln();
        if (!empty($proyecto->getAsesor2())) {
            $pdf->Cell(80, 7, "Nombre(s) del (de los) asesor(es)", 'LTR', 0, 'L', false, 'B', 12);
            $pdf->Cell(110, 7, $proyecto->getAsesor()->getNombreCompleto(), 'LTR', 0, 'L', false, '', 11);
            $pdf->Ln();
            $pdf->Cell(80, 7, "", 'LBR', 0, 'L', false, 'B', 12);
            $pdf->Cell(110, 7, $proyecto->getAsesor2()->getNombreCompleto(), 'LBR', 0, 'L', false, '', 11);
        } else {
            $pdf->Cell(80, 7, "Nombre(s) del (de los) asesor(es)", 1, 0, 'L', false, 'B', 12);
            $pdf->Cell(110, 7, $proyecto->getAsesor()->getNombreCompleto(), 1, 0, 'L', false, '', 11);
        }
        $pdf->Ln();
        $pdf->Cell(80, 7, "Numero de estudiantes", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(110, 7, count($proyecto->getAlumnos()), 1, 0, 'L', false, '', 11);
        $pdf->Ln(11);

        $pdf->Cell(0, 5, "Datos del (de los) estudiante(s):", '', 0, 'L', false, '', 12);
        $pdf->Ln();
        $pdf->Cell(90, 7, "Nombre", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(30, 7, "No. de control", 1, 0, 'L', false, 'B', 12);
        $pdf->Cell(70, 7, "Carrera", 1, 0, 'L', false, 'B', 12);
        $pdf->Ln();
        foreach ($proyecto->getAlumnos() as $al) {
            $pdf->Cell(90, 7, $al->getNombreCompleto(), 1, 0, 'L', false, '', 11);
            $pdf->Cell(30, 7, $al->id, 1, 0, 'L', false, '', 11);
            $pdf->Cell(70, 7, $al->getPlan()->getCarrera()->nombre, 1, 0, 'L', false, '', 11);
            $pdf->Ln();
        }
        $pdf->Ln(8);

        $pdf->MultiCell(0, 5, "Observaciones\n El producto obtenido es: {$proyecto->getOpcion()->nombre} \n El comité está integrado por: Presidente {$proyecto->getPresidente()->getNombreCompleto()}, Secretario: {$proyecto->getSecretario()->getNombreCompleto()} y vocal {$proyecto->getVocal()->getNombreCompleto()}. ", 1,'L');
        $pdf->Ln(11);

        $pdf->Cell(0, 5, "A T E N T A M E N T E", 0,'5', 'C', false, 'B', 12);
        $pdf->Ln(13);
        $pdf->Cell(0, 7, "________________________________", 0,'5', 'C', false, 'B', 12);
        $pdf->Cell(0, 7, "Nombre y firma del estudiante", 0,'5', 'C', false, 'B', 12);
        $pdf->Ln(15);
        $pdf->Cell(0, 7, "c.c.p. - Expediente.", 0, 0, 'L', false, '', 9);

        $pdf->generatePDF();
    }
}