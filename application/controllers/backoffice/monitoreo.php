<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Monitoreo extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('auditoria','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'auditoria';
			$data['agregados'] =  $this->auditoria->getAuditoria();
			$this->layout->view('pages/backoffice/monitoreo', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
}
