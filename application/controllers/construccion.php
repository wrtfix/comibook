<?php 
class Construccion extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
	}

	public function index()
	{
		$data['page'] = 'construccion';
		$this->layout->view('pages/construccion', $data);
	}

}
