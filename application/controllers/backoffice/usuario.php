<?php 
class Usuario extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Contenidos");
		$this->load->model('user','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
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
		if($this->session->userdata('logged_in'))
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
		if($this->session->userdata('logged_in'))
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
	

}
