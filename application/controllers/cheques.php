<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cheques extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('cheque','',TRUE);
		$this->load->model('cliente','',TRUE);
	}

	public function index($nombre=null,$fechaDesde=null,$fechaHasta=null)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'cheques';
			if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
				$data['agregados'] =  $this->cheque->getCheques();
			}else{
				$n = str_replace("%20"," ",$nombre);
				$desde = str_replace("%20"," ",$fechaDesde);
				$hasta = str_replace("%20"," ",$fechaHasta);
				$data['agregados'] = $this->cheque->getCheque($n,$desde,$hasta);
			}
			$this->layout->view('pages/cheques', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addCheques(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->cheque->addCheque();	
	        	$data['page'] = 'cheques';
			$data['agregados'] =  $this->cheque->getCheques();
			$this->layout->view('pages/cheques', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
	
	public function delCheque($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->cheque->delCheques($id);	
			$data['page'] = 'cheque';
			$data['agregados'] =  $this->cheque->getCheques();
			$this->layout->view('pages/cheques', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
	
	
	public function updateCheque($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
		   		$result = $this->cheque->updateCheques($id);
	        }
        	else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
	
	public function getCliente($numero){
		if($this->session->userdata('logged_in'))
		{
			$respuesta = json_encode($this->cliente->getCliente(" "," ",$numero));
			print_r($respuesta); 
			return $respuesta;			
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
}
