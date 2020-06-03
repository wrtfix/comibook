<?php

class Provedores extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('provedor', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
    }

    public function index($nombre = null, $cuil = null, $numero = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $data['page'] = 'provedores';
            if ($nombre == null && $cuil == null && $numero == null) {
                $data['agregados'] = $this->provedor->getClientes();
            } else {
                $n = str_replace("null", " ", $nombre);
                $h = str_replace("%20", " ", $n);
                $c = str_replace("null", " ", $cuil);
                $num = str_replace("null", " ", $numero);
                $data['agregados'] = $this->provedor->getCliente($h, $c, " ", $num);
            }

            $this->layout->view('pages/provedores', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addCliente() {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
//            $this->form_validation->set_rules('numero', 'numero', 'required|numeric');
//            $this->form_validation->set_rules('nombre', 'nombre', 'required');
//
//            if ($this->form_validation->run() == FALSE) {
//                $this->output->set_status_header('400'); //Triggers the jQuery error callback
//            } else {
                $result = $this->provedor->addCliente();
//            }
            $data['page'] = 'provedores';
            $data['agregados'] = $this->provedor->getClientes();
            $this->layout->view('pages/provedores', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delCliente($identificador) {
        if ($this->session->userdata('logged_in')) {
            $this->provedor->delClientes($identificador);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updateCliente($id) {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('numero', 'numero', 'required|numeric');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->provedor->updateCliente($id);
            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
