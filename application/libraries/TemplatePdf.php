<?php
// Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class TemplatePdf extends FPDF {
	public function __construct() {
		parent::__construct();
		$this->DefOrientation = 'L'; 
	}
	// El encabezado del PDF
	public function Header(){
		//$this->Image('imagenes/logo.png',10,8,22);
		$this->SetFont('Arial','B',13);
		$this->Cell(30);
		$this->Cell(200,10,$this->titulo,0,0,'C');
		$this->Ln('5');
		$this->SetFont('Arial','B',8);
		$this->Cell(30);
		echo $this->title;
		$this->Cell(200,10,$this->subtitulo,0,0,'C');
		$this->Ln(10);

		$this->SetFillColor(200,200,200);
		$this->SetFont('Arial','B',10);
			
		for($i=0;$i<count($this->columnas);$i++)
			$this->Cell($this->ancho[$i],7,$this->columnas[$i],1,0,$this->alineacion[$i],true);
		$this->Ln(7);


	}
	// El pie del pdf
	public function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
	public function setTitulos($titulo,$subtitle){
		$this->titulo = $titulo;
		$this->subtitulo = $subtitle;
	}

	public function setTabla($columnas,$ancho,$alineacion){
		$this->ancho =  $ancho;
		$this->columnas = $columnas;
		$this->alineacion = $alineacion;
		
	}
}
?>