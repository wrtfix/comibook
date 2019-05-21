<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Googlelogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_once APPPATH . 'third_party/src/Google_Client.php';
        require_once APPPATH . 'third_party/src/contrib/Google_Oauth2Service.php';
        $this->load->model('user', '', TRUE);
        $this->load->model('menus', '', TRUE);
        $this->load->model('ambientes', '', TRUE);
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->spark('markdown-extra/0.0.0');
        $this->layout->setLayout("layouts/login_layout_2");
    }

    public function index() {
        $this->load->view('login_view');
    }

    public function login() {

        $clientId = $this->configuraciones->getConfiguracion("GOOGLE_CLIEN_ID")[0]->valor; //Google client ID
        $clientSecret = $this->configuraciones->getConfiguracion("GOOGLE_CLIEN_SECRET")[0]->valor; //Google client secret
        $redirectURL = base_url() . 'googlelogin/login';

        //https://curl.haxx.se/docs/caextract.html
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('Login');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_GET['code'])) {
            $gClient->authenticate($_GET['code']);
            $_SESSION['token'] = $gClient->getAccessToken();
//            header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['token'])) {
            $gClient->setAccessToken($_SESSION['token']);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
//            print_r($userProfile);

            $sess_array = array(
                'id' => '1',
                'username' => 'wrtfix',
                'menu' => '1',
                'idAmbiente' => '1',
                'cantAmbientes' => '1',
            );
            $this->session->set_userdata('logged_in', $sess_array);

            //Go to private area
            $data['page'] = 'about';
            $data['textoAcercaDe'] = $this->configuraciones->getConfiguracion("ABOUT_MESSAGE");
            $data['tituloAcercaDe'] = $this->configuraciones->getConfiguracion("SITE_NAME");
            $this->layout->setLayout("layouts/default_layout");
            $this->layout->view('pages/about', $data);
            
        } else {
            $url = $gClient->createAuthUrl();
            header("Location: $url");
            exit;
        }
    }

}
