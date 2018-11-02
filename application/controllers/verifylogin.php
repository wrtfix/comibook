<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
    $this->load->spark('markdown-extra/0.0.0');
    $this->layout->setLayout("layouts/login_layout");
    $this->load->model('user','',TRUE);
    $this->load->model('menus','',TRUE);
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
      $data['page'] = 'login_view';
      $this->layout->view('login_view', $data);
      //$this->load->view('login_view');
    }
    else
    {
      //Go to private area
      $data['page'] = 'about';
      $this->layout->setLayout("layouts/default_layout");
      $this->layout->view('pages/about', $data);
      //redirect('home', 'refresh');
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->user->login($username, $password);
    
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'id' => $row->id,
          'username' => $row->username,
          'menu' =>  $this->menus->getUsuarioMenu($row->id)
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return true;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }
}
?>