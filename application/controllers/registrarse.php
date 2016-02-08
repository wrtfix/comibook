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
	 	$this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_check_captcha');
    	$userCaptcha = $this->input->post('userCaptcha');
    	//Generacion de captch
		$this->load->helper('captcha');
  		$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
  		$vals = array(
         'word' => $random_number,
         'img_path' => './captcha/',
         'img_url' => base_url().'captcha/',
         'img_width' => 140,
         'img_height' => 32,
         'expiration' => 7200
        );
  		$data['captcha'] = create_captcha($vals);
  		$this->session->set_userdata('captchaWord',$data['captcha']['word']);
  		//Fin de generacion de captch

		$data['userAdd'] = null; 
		if($this->form_validation->run() == FALSE)
    	{
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

	public function check_captcha($str){
	    $word = $this->session->userdata('captchaWord');
	    if(strcmp(strtoupper($str),strtoupper($word)) == 0){
	      return true;
	    }
	    else{
	      $this->form_validation->set_message('check_captcha', 'Please enter correct words!');
	      return false;
	    }
  }

}
