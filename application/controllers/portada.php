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
    $this->load->model('comentarios','',TRUE);
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
      $this->load->library('form_validation');
      $data = self::getSetters(null);
      $data['noticiasRelacionadas'] = $this->pedido->getNoticiasRelacionadas($filter);
      $this->pedido->updateVisita($filter);
      $result = $this->contenido->getContenido($filter);
      $data['idNoticia'] = $filter;
      $data['noticia'] = $result;
      $data['page'] = 'portada_detalle';
      $data['comentarios'] = $this->comentarios->getComentarios($filter);
      $this->layout->view('portada_detalle', $data);
  }
  
  function addComentario(){
        $this->load->library('form_validation');
        $filter = $this->input->post('idNoticia');
        $data = self::getSetters(null);
        $data['noticiasRelacionadas'] = $this->pedido->getNoticiasRelacionadas($filter);
        $result = $this->contenido->getContenido($filter);
        $fecha = date("Y-m-d");
        $this->form_validation->set_rules('numero','numero','required|numeric');
        $this->form_validation->set_rules('comentario','comentario','required');
        $this->form_validation->set_rules('nombe','nombre','required');
        $this->form_validation->set_rules('email','email','required');
        if ($this->form_validation->run() == FALSE) {
            $this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {
            $this->comentarios->addComentario($fecha);
            $data['comentarios'] = $this->comentarios->getComentarios($filter);
            $data['noticia'] = $result;
            $data['idNoticia'] = $filter;
            $data['page'] = 'portada_detalle';
            $this->layout->view('portada_detalle', $data);
        
        }
  }
  
  
}

?>