<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registrarse extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->layout->setLayout("layouts/login_layout");
		$this->load->model('user','',TRUE);
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]');
    	$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$data['userAdd'] = null; 
		if($this->form_validation->run() == FALSE)
    	{
      		//Field validation failed.  User redirected to login page
      		$data['page'] = 'registrarse';
      		$this->layout->view('pages/registrarse', $data);
      		
    	}else{
    		$username = $this->input->post('username');
    		$password = $this->input->post('password');
    		$email = $this->input->post('email');
    		$tel = $this->input->post('tel');
    		$this->user->add($username,$password,$email,$tel);
    		$data['userAdd'] = 'El usuario se registro correctamente'; 
    		$data['page'] = 'registrarse';
      		$this->layout->view('pages/registrarse', $data);
    	}
	
	}

}
