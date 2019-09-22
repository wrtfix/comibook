<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Horario extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->spark('markdown-extra/0.0.0');
        $this->load->model('horarios', '', TRUE);
        $this->load->model('configuraciones', '', TRUE);
    }

    public function index($idConsultorio = null) {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->load->library('form_validation');
            $data['page'] = 'horario';
            $data['agregados'] = $this->horarios->getHorario($idConsultorio);
            $data['idConsultorio'] = $idConsultorio;
            $this->layout->view('pages/turnera/horario', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addHorario() {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->load->library('form_validation');
            $this->horarios->addHorario();
            $data['agregados'] = $this->horarios->getHorario($this->input->post('idConsultorio'));
            $data['idConsultorio'] = $this->input->post('idConsultorio');
            $this->layout->view('pages/turnera/horario', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delHorario($identificador) {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->horarios->delHorario($identificador);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updateHorario($id) {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->horarios->updateHorario($id);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
