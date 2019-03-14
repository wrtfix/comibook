<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UsuarioAmbiente extends CI_Controller {

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
            $data['menu'] = $this->ambientes->getUsuarioAmbienteConfig($idUsuario);
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['items'] = $this->ambientes->getCountAmbiente($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $this->layout->view('pages/backoffice/usuarioAmbiente', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function add() {

        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000') {
            $this->load->library('form_validation');
            $idUsuario = $this->input->post('idUsuario');
            $menuItems = $this->ambientes->getUsuarioAmbienteConfig($idUsuario);
            $result = $this->ambientes->addRUsuarioAmbiente($menuItems);
            
            
            $data['menu'] = $this->ambientes->getUsuarioAmbienteConfig($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['items'] = $this->ambientes->getCountAmbiente($idUsuario);
            $data['exito'] = true;
            
            $this->layout->view('pages/backoffice/usuarioAmbiente', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function update() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000') {
            $this->load->library('form_validation');
            $result = $this->ambientes->deleteRUsuarioAmbiente($this->input->post('idUsuario'));
            $menuItems = $this->ambientes->getUsuarioAmbienteConfig($this->input->post('idUsuario'));
            $result = $this->ambientes->addRUsuarioAmbiente($menuItems);
            
            $data['menu'] = $this->ambientes->getUsuarioAmbienteConfig($this->input->post('idUsuario'));
            $data['idUsuario'] = $this->input->post('idUsuario');
            $data['usuarioSeleccionado'] = $this->user->getUser($this->input->post('idUsuario'));
            $data['items'] = $this->ambientes->getCountAmbiente($this->input->post('idUsuario'));
            $data['exito'] = true;
            
            $this->layout->view('pages/backoffice/usuarioAmbiente', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
