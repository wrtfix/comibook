<?php 
class Pedientes extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('pedido','',TRUE);
	}

	public function index($nombre=null,$fechaDesde=null,$fechaHasta=null)
	{
		$data['page'] = 'pedientes';
		$this->load->library('form_validation');
		if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
			$data['agregados'] =  $this->pedido->getPedidoPedientes();
		}else{
			$n = str_replace("null"," ",$nombre);
			$h = str_replace("%20"," ",$n);
			$desde = str_replace("null"," ",$fechaDesde);
			$hasta = str_replace("null"," ",$fechaHasta);
			$data['agregados'] = $this->pedido->getPedidosPedientes($h,$desde,$hasta,"Si");
		}
		$this->layout->view('pages/pedientes', $data);
	}

}
