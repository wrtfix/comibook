<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
  }
  //FIXME validar si esto sirve de algo
  function index()
  {
    if($this->session->userdata('logged_in'))
    {
      
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
    }
    else
    {
      //If no session, redirect to login page
      redirect('login', 'refresh');
	}
  }

  
  function logout()
  {
    $this->session->unset_userdata('logged_in');
    try{
      session_destroy();
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

 
    redirect('login', 'refresh');
  }


}

?>