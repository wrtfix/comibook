<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ambiente extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('ambientes','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$data['page'] = 'ambiente';
			$data['agregados'] =  $this->ambientes->getAmbiente();
			$this->layout->view('pages/backoffice/ambiente', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

	public function addAmbiente(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
                        $nombre = $this->input->post('nombre');
			$result = $this->ambientes->addAmbiente($nombre);
			$data['page'] = 'ambiente';
			$data['agregados'] =  $this->ambientes->getAmbiente();
			$this->layout->view('pages/backoffice/ambiente', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delAmbiente($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$result = $this->ambientes->delAmbiente($id);	
			$data['page'] = 'ambiente';
			$data['agregados'] =  $this->ambientes->getAmbiente();
			$this->layout->view('pages/backoffice/ambiente', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function updateAmbiente($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$result = $this->menus->updateAmbiente($id);
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
        

        
}
