<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pedidos extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('pedido','',TRUE);
                $this->load->model('contenido','',TRUE);
                $this->load->model('imagen','',TRUE);
                $this->load->model('cheque', '', TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

        private function  eliminarContenidoAntiguo(){
            $fecha = date('Y-m-d');
            $days = $this->cheque->getCheque("REMOVE_NEWS_OLD_DAY")[0]->proviene;
            $nuevafecha = strtotime ( '-'.$days.'day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            list($diaBorrar, $mesBorrar, $anoBorrar) = explode("-", $nuevafecha);
            $this->pedido->delNotificFecha($nuevafecha);
        }
	public function index($fecha=null)
	{
		if($this->session->userdata('logged_in'))
		{
                        self::eliminarContenidoAntiguo();
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
                        $data['imagenes'] = $this->imagen->getImagenes();
                        $data['agregados'] = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
			$this->layout->view('pages/pedidos', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addPedido(){
		if($this->session->userdata('logged_in'))
		{
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
                            $hoy = date("Y-m-d");
                            list($dia, $mes, $ano) = explode("-", $hoy);
                            $data['fechaSeleccionada'] =null;
                            $lafecha = $ano."-".$mes."-".$dia;
                            $data['page'] = 'pedidos';
                            $data['agregados'] = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
                            $this->layout->view('pages/pedidos', $data);
                        }
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

	    }
	 	
	}
	public function updatePedido($id){
		if($this->session->userdata('logged_in'))
		{
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
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
	public function delPedido($id){
		if($this->session->userdata('logged_in'))
		{
			$this->pedido->delPedido($id);
                        $this->contenido->deleteRContenidoMenu($id);
                        $this->contenido->delContenido($id);
                        $this->comentarios->deleteComentarioNoticia($id);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}

}
