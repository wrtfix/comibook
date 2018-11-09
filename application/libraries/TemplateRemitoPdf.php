<?php
require_once APPPATH."/third_party/fpdf/fpdf.php";

class TemplateRemitoPdf extends FPDF {
	public function __construct() {
		parent::__construct();
	}
	
	public function Header(){
	
	}
}
?>