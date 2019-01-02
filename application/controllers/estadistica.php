<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Estadistica extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
                $this->load->model('estadisticas','',TRUE);
                $this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
                $this->load->spark('markdown-extra/0.0.0');
                ini_set('memory_limit', '-1');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
                        $data['username'] = $session_data['username'];
                
                        $data['cantidadClientes'] = $this->estadisticas->getClienteTotal()[0]->clientes;
                        $data['cantidadPendientes'] = $this->estadisticas->getPedidoPedientesTotal();
                        $data['cantidadPedidos'] = $this->estadisticas->getPedidosTotal()[0]->pedidos;
                        $data['cantidadGastos'] = $this->estadisticas->getGastoTotal()[0]->gastos;
                        $data['moviminetoAnual'] = $this->estadisticas->getMovimientoAnual();
                        $data['pedidosAnual'] = $this->estadisticas->getPedidosAnual();
                        $data['historicoMensual'] = $this->estadisticas->getHistoricoMensual();
                        $data['historicoGanadoMensual'] = $this->estadisticas->getHistoricoGanadoMensual();
                        
                        
                        $data['tituloAcercaDe'] = $this->configuraciones->getConfiguracion("SITE_NAME");
                        
			$data['page'] = 'about';
			$this->layout->view('pages/estadistica', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
