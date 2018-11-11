<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->load->model('pedido', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->spark('markdown-extra/0.0.0');
        $this->layout->setLayout("layouts/login_layout_2");
    }

    function index() {
        $this->load->helper('form');
        $data['page'] = 'login_view';
        $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $this->layout->view('login_view', $data);
    }

}

?>