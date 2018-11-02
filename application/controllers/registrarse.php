<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registrarse extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->spark('markdown-extra/0.0.0');
        $this->layout->setLayout("layouts/login_layout");
        $this->load->model('user', '', TRUE);
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
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $data['userAdd'] = null;

        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        // Processing ...
        if ($response['success']) {
            $this->user->addUser();
            $data['userAdd'] = 'El usuario se registro correctamente';
            $data['page'] = 'registrarse';
            $this->layout->view('pages/registrarse', $data);
        }
        $data['page'] = 'registrarse';
        $this->layout->view('pages/registrarse', $data);
    }

}
