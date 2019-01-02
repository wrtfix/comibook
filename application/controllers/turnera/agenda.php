<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Agenda extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
                $this->load->model('menus','',TRUE);
                $this->load->model('configuraciones', '', TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['page'] = 'about';
			$this->layout->view('pages/turnera/agenda', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
