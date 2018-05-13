<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pedientes extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Contenido");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('pedido','',TRUE);
	}

	public function index($nombre=null,$fechaDesde=null,$fechaHasta=null)
	{
		if($this->session->userdata('logged_in'))
		{
			$data['page'] = 'pedientes';
			$this->load->library('form_validation');
			if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
				$data['agregados'] =  $this->pedido->getPedidoPedientes();
			}else{
				$n = str_replace("%20"," ",$nombre);
				$desde = str_replace("%20"," ",$fechaDesde);
				$hasta = str_replace("%20"," ",$fechaHasta);
				$data['agregados'] = $this->pedido->getPedidosPedientes($n,$desde,$hasta,"Si");
			}
			$this->layout->view('pages/pedientes', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
