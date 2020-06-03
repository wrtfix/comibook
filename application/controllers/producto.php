<?php

class Producto extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('productos', '', TRUE);
        $this->load->model('cliente', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
    }

    public function index($nombre = null, $cuil = null, $numero = null) {
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('idLocal') != null){
                $this->load->library('form_validation');
                
                $data['page'] = 'producto';
                $data['idLocal'] = $this->input->post('idLocal');
                
                $data['agregados'] = $this->productos->getProductosPorLocalProveedor($this->input->post('idLocal'));
                $this->layout->view('pages/producto', $data);
                
            }else{
                $this->load->library('form_validation');
                $data['page'] = 'producto';
                $data['agregados'] = $this->productos->getProductos();
                $this->layout->view('pages/producto', $data);
            }
            
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addProducto() {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('numero', 'numero', 'required|numeric');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->productos->addProducto();
            }
            if ($this->input->post('idLocal') !=null){
                $data['agregados'] = $this->productos->getProductosPorLocalProveedor($this->input->post('idLocal'));
            }else{
                $data['agregados'] = $this->productos->getProductos();
            }
            
            $data['page'] = 'producto';
            
            $this->layout->view('pages/producto', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delProducto($identificador) {
        if ($this->session->userdata('logged_in')) {
            $this->productos->delProducto($identificador);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updateProducto($id) {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('numero', 'numero', 'required|numeric');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->productos->updateProducto($id);
            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
    public function getProveedor($numero) {
        if ($this->session->userdata('logged_in')) {
            $respuesta = json_encode($this->cliente->getClientePorNumero($numero,"PROVEDOR"));
            print_r($respuesta);
            return $respuesta;
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
