<?php
// Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones

class TemplateRemitoPdf extends FPDF {
	public function __construct() {
		parent::__construct();
	}
	// El encabezado del PDF
	public function Header(){
		//$this->Image('imagenes/logo.png',10,8,22);
	}
}
?>