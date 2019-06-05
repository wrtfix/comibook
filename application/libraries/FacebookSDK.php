<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

date_default_timezone_set('UTC');
require 'Facebook/Facebook.php';
require_once dirname(__FILE__) . '/Facebook/Facebook.php';
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/Facebook/');
require_once __DIR__ . '/Facebook/autoload.php';

class FacebookSDK{

    private $fb;
    
    function __construct() {

    }
    
    public function setFB($fb){
        $this->fb = $fb;
    }
    public function getFB(){
        return $this->fb;
    }
}