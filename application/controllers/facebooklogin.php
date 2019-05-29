<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Facebooklogin extends CI_Controller {

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
        
        if (!session_id()) {
            session_start();
        }
        
        $this->load->library('FacebookSDK');
        
        $fb = new Facebook\Facebook(array(
            'app_id' => $this->configuraciones->getConfiguracion("FACEBOOK_KEY")[0]->valor,
            'app_secret' => $this->configuraciones->getConfiguracion("FACEBOOK_APP_SECRET")[0]->valor,
            'default_graph_version' => 'v3.3'
        ));
        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            
        }

        $oAuth2Client = $fb->getOAuth2Client();
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        $tokenMetadata->validateAppId('436221990500814'); // Replace {app-id} with your app id
        
        $tokenMetadata->validateExpiration();

        if ($accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
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
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                exit;
            }

            $_SESSION['fb_access_token'] = (string) $accessToken;

        }
    }

}
