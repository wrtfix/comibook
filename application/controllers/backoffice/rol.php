<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rol extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('menus', '', TRUE);
        $this->load->model('user', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
    }

    public function index($idUsuario = null) {
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000') {
            $this->load->library('form_validation');
            $data['page'] = 'rol';
            $data['menu'] = $this->menus->getUsuarioMenuConfig($idUsuario);
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['items'] = $this->menus->getCountMenu($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $this->layout->view('pages/backoffice/rol', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addMenu() {

        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000') {
            $this->load->library('form_validation');
            $idUsuario = $this->input->post('idUsuario');
            $menuItems = $this->menus->getUsuarioMenuConfig($idUsuario);
            $result = $this->menus->addRUsuarioMenu($menuItems);

            $data['menu'] = $this->menus->getUsuarioMenuConfig($idUsuario);
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $data['items'] = $this->menus->getCountMenu($idUsuario);
            $data['exito'] = true;

            $this->layout->view('pages/backoffice/rol', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function update() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000') {
            $this->load->library('form_validation');
            $result = $this->menus->deleteRUsuarioMenu($this->input->post('idUsuario'));
            $menuItems = $this->menus->getUsuarioMenuConfig($this->input->post('idUsuario'));
            $result = $this->menus->addRUsuarioMenu($menuItems);
            $idUsuario = $this->input->post('idUsuario');

            $data['menu'] = $this->menus->getUsuarioMenuConfig($this->input->post('idUsuario'));
            $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
            $data['idUsuario'] = $idUsuario;
            $data['items'] = $this->menus->getCountMenu($idUsuario);
            $data['exito'] = true;

            $this->layout->view('pages/backoffice/rol', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
