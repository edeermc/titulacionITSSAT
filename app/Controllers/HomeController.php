<?php

namespace App\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class HomeController{
    public function index() {
        return view('index.twig');
    }

	public function cpindex() {
		return view('cpanel/index.twig');
    }

    public function test() {
        Settings::setPdfRenderer(Settings::PDF_RENDERER_MPDF, MPDF_DIR);
        //Settings::setPdfRendererPath(DOMPDF_DIR);
        //Settings::setPdfRendererName('DOMPDF');
        $temp = new TemplateProcessor(TEMPLATES_DIR . 'formato_solicitud.docx');

        $temp->setValue('date', date('d/m/Y'));
        $temp->setValue('name', "Eder Morga Camacho");
        $temp->setValue('address', "Calle José María Mata no. 117 Col. Chichipilco, San Andrés Tuxtla, Veracruz.");
        $temp->setValue('phone', "294 137 3534");
        $temp->setValue('email', "edeermc@gmail.com");
        $temp->setValue('career', "Ingeniería en Sistemas Computacionales");
        $temp->setValue('plan', "ISC-2012-0248");
        $temp->setValue('id', "121U0229");
        $temp->setValue('option', "Memoria de residencias");
        $temp->setValue('project', "Medición de la truza");
        $temp->setValue('anyelse', "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
        $temp->setValue('otherstuff', "this is not showing in the docx file");

        /* DOCX */
        /* header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="generated.docx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0'); */

        /* PDF */
        /* header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename='downloaded.pdf'");
        readfile("original.pdf"); */

        $temp->saveAs(TEMPLATES_DIR . "generated.docx");
        echo "docx generated <br>";

        $docto = IOFactory::load(TEMPLATES_DIR . "generated.docx");
        $pdf = IOFactory::createWriter($docto, 'PDF');
        $pdf->save(TEMPLATES_DIR . 'result.pdf');
        echo "pdf generated";
    }
}