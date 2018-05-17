<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portada extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->layout->placeholder("title", "Salta Chequeado");
    $this->load->spark('markdown-extra/0.0.0');
    $this->load->model('gasto','',TRUE);
    $this->load->model('pedido','',TRUE);
    $this->load->model('contenido','',TRUE);
	  $this->layout->setLayout("layouts/portada_layout");
  }

  private function getSetters($filter){
    $data['page'] = 'portada_view';
    $data['menu'] =  $this->gasto->getGastos();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hoy = date("Y-m-d");
    list($dia, $mes, $ano) = explode("-", $hoy);
    $lafecha = $ano."-".$mes."-".$dia;
    $data['noticiasPrincipales'] = $this->pedido->getPedidoPedientes($filter);
    $data['noticiasMasLeidas'] = $this->pedido->getNoticiasMasLeidas($filter);
    $data['resumenNoticias'] = $this->pedido->getNoticiasMasPopulares($filter);
    
    $zona_horaria = "-3"; 
    $formato = "d M Y"; 
    $fecha = gmdate($formato,time()+($zona_horaria*3600));
    $data['fechaActual'] = $fecha;  
    return $data;
  }
  
  function index($filter=null)
  {
    $this->load->helper('form');
    $data = self::getSetters($filter);
    $this->layout->view('portada_view', $data);
  }

  function detalle($filter=null){
      $data = self::getSetters($filter);
      $data['noticia'] = $this->contenido->getContenido($filter);
      $data['page'] = 'portada_detalle';
      $this->layout->view('portada_detalle', $data);
  }
}

?>