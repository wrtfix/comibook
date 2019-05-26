<?php

class Facebook {

    public function __construct($config =  array()) {
        require_once APPPATH.'third_party/facebook/vendor/autoload.php';
        $this->fb = new Facebook\Facebook($config);
        $this->permissions = ['public_profile','email'];
        $this->fb_helper = $this->fb->getRedirectLoginHelper();

    }
    
    public function loginURL($url) {
        return $this->fb_helper->getLoginUrl($url, $this->permissions);
    }
    
    public function authenticate($code = null) {
        return $this->client->authenticate($code);
    }
    
    public function getAccessToken() {
        try{
            $token = $this->fb_helper->getAccessToken();
            return array('token' => $token, 'message' => '');

        }catch(Facebook\Exceptions\FacebookResponseException $e)
        {
            // When Graph returns an error
            return array('token' => false,
                'message' => 'There was an error while trying to login using Facebook: ' . $e->getMessage()
                );
        }catch(Facebook\Exceptions\FacebookSDKException $e)
        {
            // When validation fails or other local issues
            return array('token' => false,
                'message' => 'Facebook SDK returned an error: ' . $e->getMessage()
                );
        }
    }
    
    public function setAccessToken($token) {
        if (!empty($token)) {
            $this->fb->setDefaultAccessToken($token);
        }
    }
    
    public function revokeToken() {
        return $this->client->revokeToken();
    }
    
    public function getUserInfo() {
        try{
            $response = $this->fb->get('/me?fields=id,first_name,last_name,name,email,verified');
            return array('user_info' => $response->getGraphUser(), 'message' => '');

        }catch(Facebook\Exceptions\FacebookResponseException $e)
        {
          // When Graph returns an error
            return array('user_info' => false,
                'message' => 'Could not retrieve user data: ' . $e->getMessage()
                );
        }
        catch(Facebook\Exceptions\FacebookSDKException $e)
        {
          // When validation fails or other local issues
            return array('user_info' => false,
                'message' => 'Facebook SDK returned an error: ' . $e->getMessage()
                );
        }
    }
    
} 