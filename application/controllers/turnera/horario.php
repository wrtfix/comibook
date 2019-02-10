<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Horario extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
                $this->load->model('menus','',TRUE);
                $this->load->model('configuraciones', '', TRUE);
	}

	public function index($idConsultorio=null)
	{
		if($this->session->userdata('logged_in'))
		{
                        $this->load->library('form_validation');
			$data['page'] = 'horario';
                        $data['idConsultorio'] = $idConsultorio;
			$this->layout->view('pages/turnera/horario', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        public function addHorario()
	{
            if($this->session->userdata('logged_in'))
		{
            		$this->load->library('form_validation');	
			$this->layout->view('pages/turnera/horario', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
        }

}
