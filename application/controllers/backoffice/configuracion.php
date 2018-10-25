<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuracion extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('configuraciones','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'configuraciones';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addConfiguracion(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->configuraciones->addConfiguracion();	
	       	$data['page'] = 'configuracion';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
	
	public function delConfiguracion($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->configuraciones->delConfiguracion($id);	
			$data['page'] = 'configuracion';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
	
	
	public function updateConfiguracion($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
		   		$result = $this->configuraciones->updateConfiguracion($id);
	        }
        	else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
	
}
