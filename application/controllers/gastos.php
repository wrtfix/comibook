<?php

class Gastos extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->spark('markdown-extra/0.0.0');
        $this->load->model('gasto', '', TRUE);
    }

    public function index($nombre = null, $fechaDesde = null, $fechaHasta = null) {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $data['page'] = 'gastos';
            if ($nombre == null && $fechaDesde == null && $fechaHasta == null) {
                $data['agregados'] = $this->gasto->getGastos();
            } else {
                $n = str_replace("null", " ", $nombre);
                $desde = str_replace("null", " ", $fechaDesde);
                $hasta = str_replace("null", " ", $fechaHasta);
                $data['agregados'] = $this->gasto->getGasto($n, $desde, $hasta);
            }
            $this->layout->view('pages/gastos', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addGasto() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('importe', 'importe', 'required|numeric');
            $this->form_validation->set_rules('fecha', 'fecha', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->gasto->addGasto();
            }
            $data['page'] = 'gastos';
            $data['agregados'] = $this->gasto->getGastos();
            $this->layout->view('pages/gastos', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delGasto($id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $result = $this->gasto->delGastos($id);
            $data['page'] = 'gastos';
            $data['agregados'] = $this->gasto->getGastos();
            $this->layout->view('pages/gastos', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updateGasto($id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            $this->form_validation->set_rules('importe', 'importe', 'required|numeric');
            $this->form_validation->set_rules('fecha', 'fecha', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->gasto->updateGastos($id);
            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
