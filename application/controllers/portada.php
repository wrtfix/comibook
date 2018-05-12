<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portada extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->layout->placeholder("title", "Salta Chequeado");
    $this->load->spark('markdown-extra/0.0.0');
    $this->load->model('gasto','',TRUE);
    $this->load->model('pedido','',TRUE);
	  $this->layout->setLayout("layouts/portada_layout");
  }


  function index()
  {
    $this->load->helper('form');
    $data['page'] = 'portada_view';
    $data['menu'] =  $this->gasto->getGastos();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hoy = date("Y-m-d");
    list($dia, $mes, $ano) = explode("-", $hoy);
    $lafecha = $ano."-".$mes."-".$dia;
    $data['noticiasPrincipales'] = $this->pedido->getPedidoPedientes();
    $data['noticiasMasLeidas'] = $this->pedido->getPedidoPedientes();
    $data['resumenNoticias'] = $this->pedido->getPedidoPedientes();
    $this->layout->view('portada_view', $data);
  }

}

?>