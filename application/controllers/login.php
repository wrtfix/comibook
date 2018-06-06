<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->layout->placeholder("title", "Salta Chequeado");
    $this->load->spark('markdown-extra/0.0.0');
    $this->load->model('gasto','',TRUE);
    $this->load->model('pedido','',TRUE);
	  $this->layout->setLayout("layouts/login_layout");
  }


  function index()
  {
    $this->load->helper('form');
    $data['page'] = 'login_view';
    //$data['menu'] =  $this->gasto->getGastos();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $this->layout->view('login_view', $data);
  }

}

?>