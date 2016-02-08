<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
    $this->load->spark('markdown-extra/0.0.0');
	  $this->layout->setLayout("layouts/login_layout");
  }


  function index()
  {
    $this->load->helper('form');
    $data['page'] = 'login_view';
    $this->layout->view('login_view', $data);
  }

}

?>