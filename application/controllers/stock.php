<?php

class Stock extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->spark('markdown-extra/0.0.0');
        $this->load->model('stocks', '', TRUE);
        $this->load->model('cliente', '', TRUE);
        $this->load->model('productos', '', TRUE);
    }

    public function index($fechaDesde = null, $fechaHasta = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $data['page'] = 'stock';
            if ($fechaDesde == null && $fechaHasta == null) {
                $data['agregados'] = $this->stocks->getStocks();
            } else {
                $desde = str_replace("null", " ", $fechaDesde);
                $hasta = str_replace("null", " ", $fechaHasta);
                $data['agregados'] = $this->stocks->getStock($desde, $hasta);
            }
            $this->layout->view('pages/stock', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addStock() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
//            $this->form_validation->set_rules('banco', 'banco', 'required');
//            $this->form_validation->set_rules('importe', 'importe', 'required|numeric');
//            $this->form_validation->set_rules('origen', 'origen', 'required');
//            $this->form_validation->set_rules('fecha', 'fecha', 'required');
//            $this->form_validation->set_rules('vencimiento', 'vencimiento', 'required');
//            if ($this->form_validation->run() == FALSE) {
//                $this->output->set_status_header('400'); //Triggers the jQuery error callback
//            } else {
                $result = $this->stocks->addStock();
//            }
            $data['page'] = 'stock';
            $data['agregados'] = $this->stocks->getStocks();
            $this->layout->view('pages/stock', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delStock($id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $result = $this->stocks->delStocks($id);
            $data['page'] = 'stocks';
            $data['agregados'] = $this->stocks->getStocks();
            $this->layout->view('pages/stock', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updateStock($id) {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
//            $this->form_validation->set_rules('banco', 'banco', 'required');
//            $this->form_validation->set_rules('importe', 'importe', 'required|numeric');
//            $this->form_validation->set_rules('proviene', 'proviene', 'required');
//            $this->form_validation->set_rules('fecha', 'fecha', 'required');
//            $this->form_validation->set_rules('fechavto', 'vencimiento', 'required');
//            if ($this->form_validation->run() == FALSE) {
//                $this->output->set_status_header('400'); //Triggers the jQuery error callback
//            } else {
                $result = $this->stocks->updateStock($id);
//            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function getProducto($numero) {
        if ($this->session->userdata('logged_in')) {
            $respuesta = json_encode($this->productos->getProducto($numero));
            print_r($respuesta);
            return $respuesta;
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
    public function getProductoNombre($nombre) {
        if ($this->session->userdata('logged_in')) {
            $respuesta = json_encode($this->productos->getProductoNombre($nombre));
            print_r($respuesta);
            return $respuesta;
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
    public function getProductoStock($numero) {
        if ($this->session->userdata('logged_in')) {
            $respuesta = json_encode($this->stocks->getProductoStocks($numero));
            print_r($respuesta);
            return $respuesta;
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
