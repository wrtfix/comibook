<?php 
class Pedidos extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('pedido','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index($fecha=null)
	{
		$this->load->library('form_validation');
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$hoy = date("Y-m-d");
		list($dia, $mes, $ano) = explode("-", $hoy);
		if ($fecha!=null){
			$data['fechaSeleccionada'] = $fecha; 
			$lafecha = $fecha; 	
		}else{
			$data['fechaSeleccionada'] =null;
			$lafecha = $ano."-".$mes."-".$dia;
		}
		$data['page'] = 'pedidos';
		
		$data['agregados'] = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
		$this->layout->view('pages/pedidos', $data);
	}
	
	public function addPedido(){
	 	$this->load->library('form_validation');
	 	$this->form_validation->set_rules('ClienteOrigen','ClienteOrigen','required');
	   	$this->form_validation->set_rules('Bultos','Bultos','required|numeric');
	   	$this->form_validation->set_rules('ClienteDestino','ClienteDestino','required');
	   	$this->form_validation->set_rules('valorDeclarado','valorDeclarado','numeric');
	   	$this->form_validation->set_rules('CostoFlete','CostoFlete','required|numeric');
				
	 	if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {
        	$this->pedido->addPedido();
        }
	 	
	}
	public function updatePedido($id){
		$this->load->library('form_validation');
	 	$this->form_validation->set_rules('ClienteOrigen','ClienteOrigen','required');
	   	$this->form_validation->set_rules('Bultos','Bultos','required|numeric');
	   	$this->form_validation->set_rules('ClienteDestino','ClienteDestino','required');
	   	$this->form_validation->set_rules('valorDeclarado','valorDeclarado','numeric');
	   	$this->form_validation->set_rules('CostoFlete','CostoFlete','required|numeric');
				
	 	if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {
			$this->pedido->updatePedidos($id);
        }
	}
	public function delPedido($id){
		$this->pedido->delPedido($id);
	}

}
