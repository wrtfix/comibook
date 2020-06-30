<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class About extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		
		$this->load->spark('markdown-extra/0.0.0');
                $this->load->model('menus','',TRUE);
                $this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
                        $data['username'] = $session_data['username'];
                        $data['textoAcercaDe'] = $this->configuraciones->getConfiguracion("ABOUT_MESSAGE");
                        $data['tituloAcercaDe'] = $this->configuraciones->getConfiguracion("SITE_NAME");
                        
			$data['page'] = 'about';
			$this->layout->view('pages/about', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
