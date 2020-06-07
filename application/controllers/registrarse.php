<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registrarse extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('user', '', TRUE);
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->spark('markdown-extra/0.0.0');
        $this->layout->setLayout("layouts/login_layout_2");
        $this->load->model('ambientes','',TRUE);
        $this->load->model('menus','',TRUE);
        
    }

    public function index() {
        $this->load->library('form_validation');
        $this->load->library('recaptcha');
        $data['page'] = 'registrarse';
        $data['userAdd'] = null;
        $this->layout->view('pages/registrarse', $data);
    }
    
    public function addUser(){
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        $data['userAdd'] = null;
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        

        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        // Processing ...
	if ($this->configuraciones->getConfiguracion("VALIDATE_CAPTCHA")[0]->valor == 'true'){
	        if ($response['success'] && $this->form_validation->run()) {
	            $nombre = $this->input->post('username');
	            $idAmbiente = $this->ambientes->addAmbienteById($nombre);
	            $idUsuario = $this->user->addUserById($idAmbiente );
            
	            $this->ambientes->addItemRUsuarioAmbiente($idAmbiente,$idUsuario);
	            $idMenu = $this->configuraciones->getConfiguracion("MENU_DEFAULT")[0]->valor;
	            $menuItems = $this->menus->addItemRusuarioMenu($idUsuario, $idMenu);
	            $data['userStateAdd'] = 'El usuario se registro correctamente';
	            $this->layout->view('login_view', $data);
	        }else{
	            $data['page'] = 'registrarse';
	            $this->layout->view('pages/registrarse', $data);
		}
	}else{
            $this->user->addUser();
            $data['userStateAdd'] = 'El usuario se registro correctamente';
            $this->layout->view('login_view', $data);        
        }
        
    }

}
