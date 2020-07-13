<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('configuraciones', '', TRUE);
        
        $this->load->model('estadisticas', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
    }

    //FIXME validar si esto sirve de algo
    function index() {
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            //Go to private area
            $data['page'] = 'portada';
            $data['textoAcercaDe'] = $this->configuraciones->getConfiguracion("ABOUT_MESSAGE");
            $data['tituloAcercaDe'] = $this->configuraciones->getConfiguracion("SITE_NAME");
            $data['tituloAcercaDe'] = "¡Bienvenido!";
            $data['productoTotal'] = $this->estadisticas->getProductoTotal()[0]->productos;
            $data['solicitudTotal'] = $this->estadisticas->getSolicitudesTotal()[0]->solicitudes;
            $data['comentarioTotal'] = $this->estadisticas->getComentariosTotal()[0]->comentarios;
            $data['localTotal'] =$this->estadisticas->getLocalesTotal()[0]->consultorios;
            
            $this->layout->setLayout("layouts/default_layout");
            $this->layout->view('pages/portada', $data);
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login', 'refresh');
    }

}

?>