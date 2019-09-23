<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->load->model('pedido', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->spark('markdown-extra/0.0.0');
        $this->layout->setLayout("layouts/login_layout_2");
    }

    function index() {
        $this->load->helper('form');
        $data['page'] = 'login_view';
        $data['userStateAdd'] = null;
        
        $this->load->library('FacebookSDK');
        if (!session_id()) {
            session_start();
        }
        $fb = new Facebook\Facebook(array(
            'app_id' => $this->configuraciones->getConfiguracion("FACEBOOK_KEY")[0]->valor,
            'app_secret' => $this->configuraciones->getConfiguracion("FACEBOOK_APP_SECRET")[0]->valor,
            'default_graph_version' => 'v3.3'
        ));
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://localhost/saltaChequeado/facebooklogin/login', $permissions);
        $data['loginUrlFacebook'] = '<a href="' . htmlspecialchars($loginUrl) . '"><i class="fa fa-facebook-official"></i> Facebook </a>';
        $data['loginFacebook'] = $this->configuraciones->getConfiguracion("FACEBOOK_LOGIN");
        $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
        $data['loginGoogle'] = $this->configuraciones->getConfiguracion("GOOGLE_LOGIN");
        $data['loginImage'] = $this->configuraciones->getConfiguracion("LOGIN_IMAGE");
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $this->layout->view('login_view', $data);
    }

}

?>
