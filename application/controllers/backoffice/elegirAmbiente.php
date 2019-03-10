<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ElegirAmbiente extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('ambientes', '', TRUE);
        $this->load->model('user', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
    }

    public function index($idUsuario = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $data['page'] = 'rol';
            $data['menu'] = $this->ambientes->getUsuarioAmbiente($idUsuario);
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['items'] = $this->ambientes->getCountAmbiente($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $this->layout->view('pages/backoffice/elegirAmbiente', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function update() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $result = $this->ambientes->updateUsuarioAmbiente();
            
            $sess_array = $this->session->userdata('logged_in');
            $sess_array['idAmbiente'] = $this->input->post('idAmbiente');
            $this->session->set_userdata('logged_in', $sess_array);
            
            $data['menu'] = $this->ambientes->getUsuarioAmbiente($this->input->post('idUsuario'));
            $data['idUsuario'] = $this->input->post('idUsuario');
            $data['usuarioSeleccionado'] = $this->user->getUser($this->input->post('idUsuario'));
            $data['items'] = $this->ambientes->getCountAmbiente($this->input->post('idUsuario'));
            $data['exito'] = true;
            
            $this->layout->view('pages/backoffice/elegirAmbiente', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
