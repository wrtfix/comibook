<?php

class Solicitudes extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->model('pedido', '', TRUE);
        $this->load->model('solicitud', '', TRUE);
        $this->load->model('cliente', '', TRUE);
        $this->load->model('productos', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
        ini_set('memory_limit', '-1');
    }

    public function index($idLocal=null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $data['idLocal'] = 1;
            $data['page'] = 'listarSolicitudes';
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
    
    public function list($idLocal){
        
         if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            
            $data['page'] = 'solicitudes';
            $data['productos'] = $this->productos->getProductosByLocal($idLocal);
            
            $this->layout->view('pages/solicitudes', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
        
    }

    public function addSolicitud() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->solicitud->addSolicitud();
            $data['page'] = 'listarSolicitudes';
            $idLocal = $this->input->post('idLocal');
            if ($idLocal != null){
                $data['solicitudes'] = $this->solicitud->getSolicitudProductosPorLocal($idLocal);
                $data['idLocal'] = $idLocal;
            }else{
                $data['solicitudes'] = $this->solicitud->getSolicitudProductos();
            }

            $this->layout->view('pages/ecommerce/listarSolicitudes', $data);
        }else{
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
        
    }
    
    public function addSolicitudWithOutSession(){
        $query = $this->solicitud->addSolicitud();
        $this->solicitud->addSolicitudProducto($this->cart->contents(),$query);
        print_r($query);
        return $query;
    }


}
