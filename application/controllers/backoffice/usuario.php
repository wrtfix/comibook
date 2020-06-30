<?php 
class Usuario extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
		$this->load->model('user','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000' ||  $this->session->userdata('logged_in')['menu'][0]->peso === '50')
		{
			$this->load->library('form_validation');
			$data['agregados'] = $this->user->getUsers();
			$this->layout->view('pages/backoffice/usuarios', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	public function addUser(){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$data['page'] = 'usuarios';
			$this->user->addUser();
			$data['agregados'] = $this->user->getUsers();
            $this->layout->view('pages/backoffice/usuarios', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delUser($id){
		if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['menu'][0]->peso === '1000')
		{
			$this->load->library('form_validation');
			$this->user->delUser($id);
			$data['agregados'] = $this->user->getUsers();
			$this->layout->view('pages/backoffice/usuarios', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function updateUser($id){
            if($this->session->userdata('logged_in'))
            {
                    $this->load->library('form_validation');
                    $result = $this->user->updateUser($id);
	    }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
	    }
	}
        
        public function perfil()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
                        $data['agregados'] = $this->user->getUser($this->session->userdata('logged_in')['id']);
			$this->layout->view('pages/backoffice/perfil', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
