<?php

namespace App\Config;

use Fpdf\Fpdf;

class PDF extends Fpdf {
    public $PDFtitle;
    public $reportName;
    public $default_size;
    protected $setFooter = true;
    protected $setPageNumber = false;
    protected $javascript;
    protected $n_js;

    function __construct($t, $r, $o = 'P', $u = 'mm', $s = 'A4'){
        parent::__construct($o, $u, $s);
        $this->reportName = $r;
        $this->PDFtitle = utf8_decode($t);

        $this->SetTitle($this->reportName, true);
        $this->SetAuthor('ITSSAT', true);
        $this->SetCreator('ITSSAT', true);
        $this->AliasNbPages('{nb}');
    }

    // Cabecera de página
    public function Header() {
        $this->Image(resource('img/itssat.jpg'), 8, 5, 23, 23, 'JPG');
        $this->Image(resource('img/depto.jpg'), 175, 5, 20, 20, 'JPG');
        $this->SetY(10);
        $this->Cell(0, 6,"INSTITUTO TECNOLÓGICO SUPERIOR DE SAN ANDRÉS TUXTLA", '', 6, 'C', false, 'B', 11);
        $this->Cell(0, 6,"DEPARTAMENTO DE ESTUDIOS PROFESIONALES", '',6,'C', false, 'B', 11);
        $this->Cell(0, 6, $this->reportName, '',6, 'C', false, 'B', 11);
        $this->Ln(7);
    }

    // Pie de página
    public function Footer() {
        if ($this->setFooter || $this->setPageNumber)
            $this->SetY($this->setFooter ? -21 : -11);

        $this->Cell(0, 1, "", 'T', 5, 'J');
        if ($this->setFooter) {
            $this->SetY(-20);
            $this->MultiCell(0, 3, "Carr. Costera del Golfo S/N, KM 140+100 \nLoc. Matacapan, Mpio, San Andrés Tuxtla, Ver. \nC.P. 95804 A.P. 110 \nTel: 01(294)9479100 ext. 131 \n9479107", '', 'L', false, 'I', 7);
        }

        if ($this->setPageNumber) {
            $this->SetY($this->setFooter ? -20 : -10);
            $this->MultiCell(0, 3, 'Fecha: ' . getDateNow(), 0, 'R', false, '', 7);
            $this->MultiCell(0, 3, 'Página ' . $this->PageNo() . ' de {nb}', 0, 'R', false, '', 7);
        }
    }

    public function hideFooter(){
        $this->setFooter = false;
    }

    public function showPageNumber(){
        $this->setPageNumber = true;
    }

    function IncludeJS($script, $isUTF8 = true) {
        if(!$isUTF8)
            $script = utf8_encode($script);
        $this->javascript = $script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }

    public function setTitleStyle($bold = true, $size = 9, $color = true){
        if ($color)
            $this->SetFillColor(192, 192, 192);
        $this->SetFont('Helvetica', ($bold ? 'B' : ''), $size);
    }

    public function setSubTitleStyle($bold = true, $size = 8, $color = true){
        if ($color)
            $this->SetFillColor(204, 255, 255);
        $this->SetFont('Helvetica', ($bold ? 'B' : ''), $size);
    }

    public function setBodyStyle($bold = false, $size = 8, $color = true){
        if ($color)
            $this->SetFillColor(255, 255, 255);
        $this->SetFont('Helvetica', ($bold ? 'B' : ''), $size);
    }

    public function generatePDF($type = 'I', $print = false){
        if ($print)
            $this->IncludeJS('print(true)');
        $this->Output(str_replace(' ', '', $this->PDFtitle) . '_' . date('YmdHis') . '.pdf', $type);
    }

    function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $style = '', $size = 0) {
        #$style = $style == 0 ? $this->FontStyle : $style;
        $size = $size == 0 ? $this->FontSizePt : $size;

        $this->SetFont('Helvetica', $style);
        $this->SetFontSize($size);
        parent::Cell($w, $h, utf8_decode($txt), $border, $ln, $align, $fill);
    }

    function MultiCell($w, $h = 0, $txt = '', $border = 0, $align = '', $fill = false, $style = '', $size = 0) {
        #$style = $style == 0 ? $this->FontStyle : $style;
        $size = $size == 0 ? $this->FontSizePt : $size;

        $this->SetFont('Helvetica', $style);
        $this->SetFontSize($size);
        parent::MultiCell($w, $h, $txt, $border, $align, $fill);
    }
}