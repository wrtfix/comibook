<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuracion extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('configuraciones','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$data['page'] = 'configuraciones';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addConfiguracion(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
                        $data['result'] = $this->configuraciones->addConfiguracion();	
                        $data['page'] = 'configuracion';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
        
	
	public function delConfiguracion($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000' )
		{
			$this->load->library('form_validation');
			$result = $this->configuraciones->delConfiguracion($id);	
			$data['page'] = 'configuracion';
			$data['agregados'] =  $this->configuraciones->getConfiguraciones();
			$this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
	
	
	public function updateConfiguracion(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
                        $result = $this->configuraciones->updateConfiguracion();
	        }
        	else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
        
        public function update(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
                    $this->load->library('github_updater');
                    $data["resultado"] = $this->github_updater->update() ? 'SUCCESS' : 'FAILED';
                    $this->layout->view('pages/backoffice/configuracion', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        public function testSendEmail(){
            if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
                    $this->load->library('email');
                    $emailFrom = $this->configuraciones->getConfiguracion("EMAIL_FROM")[0]->valor;
                    $emailTo = $this->configuraciones->getConfiguracion("EMAIL_TO")[0]->valor;
                    $password = $this->configuraciones->getConfiguracion("EMAIL_PASSWORD")[0]->valor;
                    $body = $this->configuraciones->getConfiguracion("ABOUT_MESSAGE")[0]->valor;
                    $title = $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor;
                    $protocol = $this->configuraciones->getConfiguracion("EMAIL_PROTOCOL")[0]->valor;
                    $puerto = $this->configuraciones->getConfiguracion("EMAIL_PORT")[0]->valor;
                    if (!$this->email->send($protocol, $puerto, $emailFrom,$emailTo,$title,$body,$emailFrom,$password)){
                        $this->output->set_status_header('400'); //Triggers the jQuery error callback
                    }
                    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
        }
        
        public function loadCard(){
            $this->layout->setLayout("layouts/empty");
            $this->layout->view('pages/backoffice/configurationCard');
        }
	
}
