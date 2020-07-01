<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Literales extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('literal','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
                        $data['page'] = 'literales';
			$data['agregados'] =  $this->literal->getLiterales();
			$this->layout->view('pages/backoffice/literales', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

	public function addLiteral(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$result = $this->literal->addLiteral();
			$data['agregados'] =  $this->literal->getLiterales();
			$this->layout->view('pages/backoffice/literales', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delLiteral($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$result = $this->literal->delLiteral($id);	
			$data['agregados'] =  $this->literal->getLiterales();
			$this->layout->view('pages/backoffice/literal', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function updateLiteral($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$result = $this->literal->updateLiteral($id);
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
        

        
}
