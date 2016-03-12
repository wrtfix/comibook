<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresas extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('cliente','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index($nombre=null,$cuil=null,$numero=null)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'empresas';
			
			if ($nombre==null && $cuil==null && $numero==null){
				$data['agregados'] =  $this->cliente->getClientes();
			}else{
				$n = str_replace("%20"," ",$nombre);
				$c = str_replace("%20"," ",$cuil);
				$num = str_replace("%20"," ",$numero);
				$data['agregados'] = $this->cliente->getCliente($n,$c,$num);
			}
			
			$this->layout->view('pages/empresas', $data);
		}else
		{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addCliente(){
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
		 	$this->form_validation->set_rules('numero','numero','required|numeric');
		   	$this->form_validation->set_rules('nombre','nombre','required');
			
	  		if ($this->form_validation->run() == FALSE) {
	  			$this->output->set_status_header('400'); //Triggers the jQuery error callback
	        } else {
				$result = $this->cliente->addCliente();
	        }
			$data['page'] = 'empresas';
			$data['agregados'] =  $this->cliente->getClientes();
			$this->layout->view('pages/empresas', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delCliente($identificador){
		if($this->session->userdata('logged_in'))
		{
			$this->cliente->delClientes($identificador);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

	public function updateCliente($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
		 	$this->form_validation->set_rules('numero','numero','required|numeric');
		   	$this->form_validation->set_rules('nombre','nombre','required');
			
	  		if ($this->form_validation->run() == FALSE) {
	  			$this->output->set_status_header('400'); //Triggers the jQuery error callback
	        } else {
	        	$result = $this->cliente->updateCliente($id);
	        }
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
}
