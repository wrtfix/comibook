<?php

class Clientes extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->model('cliente', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
    }

    public function index($nombre = null, $cuil = null, $numero = null) {
        if ($this->session->userdata('logged_in')) {
            //Inicio de mapa
            $this->load->library('leaflet');
            $config = array(
                'center' => '-37.29643, -59.15102', // Center of the map
                'zoom' => 16, // Map zoom
            );
            $this->leaflet->initialize($config);

            $marker = array(
                'latlng' => '-37.29643, -59.15102', // Marker Location
                'popupContent' => 'Onemorecode software factory!!', // Popup Content
            );
            $this->leaflet->add_marker($marker);
            $data['map'] = $this->leaflet->create_map();

            //Fin de mapa

            $this->load->library('form_validation');
            $data['page'] = 'clientes';
            if ($nombre == null && $cuil == null && $numero == null) {
                $data['agregados'] = $this->cliente->getClientes();
            } else {
                $n = str_replace("null", " ", $nombre);
                $h = str_replace("%20", " ", $n);
                $c = str_replace("null", " ", $cuil);
                $num = str_replace("null", " ", $numero);
                $data['agregados'] = $this->cliente->getCliente($h, $c, " ", $num, "CLIENTE");
            }

            $this->layout->view('pages/clientes', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addCliente() {
        if ($this->session->userdata('logged_in')) {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('numero', 'numero', 'required|numeric');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $result = $this->cliente->addCliente();
            }
            $data['page'] = 'clientes';
            $data['agregados'] = $this->cliente->getClientes();
            $this->layout->view('pages/clientes', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delCliente($identificador) {
        if ($this->session->userdata('logged_in')) {
            $this->cliente->delClientes($identificador);
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
                $result = $this->cliente->updateCliente($id);
            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function getClientes() {
        if ($this->session->userdata('logged_in')) {
            $respuesta = json_encode($this->cliente->getClientes());
            print_r($respuesta);
            return $respuesta;
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
