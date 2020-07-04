<?php

class Carrito extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->model('solicitud', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
        ini_set('memory_limit', '-1');
    }

    public function index($idSolicitud=null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $data['page'] = 'listarSolicitudes';
            $data['agregados'] = $this->solicitud->getSolicitudPorProducto($idSolicitud);
            $data['idSolicitud'] = $idSolicitud;
            $this->layout->view('pages/carrito', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
     public function updateSolicitud() {
        $idSolicitud = $this->input->post('idSolicitud');
        $idLocal=null;
         
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            
            $this->solicitud->updateSolicitud($idSolicitud);
            
            $data['idSolicitud'] = $idSolicitud;
            if ($idLocal !=null){
                $data['solicitudes'] = $this->solicitud->getSolicitudProductosPorLocal($idLocal);
                $data['idLocal'] = $idLocal;
            }else{
                $data['solicitudes'] = $this->solicitud->getSolicitudProductos();
            }
            
            $this->layout->view('pages/ecommerce/listarSolicitudes', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
    


}
