<?php 
class Clientes extends CI_Controller 
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
		$this->load->library('form_validation');
		$data['page'] = 'clientes';
		if ($nombre==null && $cuil==null && $numero==null){
			$data['agregados'] =  $this->cliente->getClientes();
		}else{
			$n = str_replace("null"," ",$nombre);
			$h = str_replace("%20"," ",$n);
			$c = str_replace("null"," ",$cuil);
			$num = str_replace("null"," ",$numero);
			$data['agregados'] = $this->cliente->getCliente($h,$c," ",$num);
		}
		
		$this->layout->view('pages/clientes', $data);
	}
	
	public function addCliente(){
		

		$this->load->library('form_validation');
	 	$this->form_validation->set_rules('numero','numero','required|numeric');
	   	$this->form_validation->set_rules('nombre','nombre','required');
		
  		if ($this->form_validation->run() == FALSE) {
  			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {
			$result = $this->cliente->addCliente();
        }
		$data['page'] = 'clientes';
		$data['agregados'] =  $this->cliente->getClientes();
		$this->layout->view('pages/clientes', $data);
	}
	
	public function delCliente($identificador){
		$this->cliente->delClientes($identificador);
	}

	public function updateCliente($id){
		$this->load->library('form_validation');
	 	$this->form_validation->set_rules('numero','numero','required|numeric');
	   	$this->form_validation->set_rules('nombre','nombre','required');
		
  		if ($this->form_validation->run() == FALSE) {
  			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {
        	$result = $this->cliente->updateCliente($id);
        }
	}
	
}
