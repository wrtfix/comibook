<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('user','',TRUE);
    $this->load->model('menus','',TRUE);
    $this->load->model('ambientes','',TRUE);
    $this->load->model('configuraciones', '', TRUE);
    $this->load->model('estadisticas','',TRUE);

    $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
    $this->load->spark('markdown-extra/0.0.0');
    $this->layout->setLayout("layouts/login_layout_2");
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
    $data['loginImage'] = $this->configuraciones->getConfiguracion("LOGIN_IMAGE");

    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
      $data['page'] = 'login_view';
      $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
      $this->layout->view('login_view', $data);
    }
    else
    {
      //Go to private area
      $data['page'] = 'portada';
      $data['textoAcercaDe'] = $this->configuraciones->getConfiguracion("ABOUT_MESSAGE");
//      $data['tituloAcercaDe'] = $this->configuraciones->getConfiguracion("SITE_NAME");
      $data['tituloAcercaDe'] = "¡Bienvenido!";
      $data['productoTotal'] =$this->estadisticas->getProductoTotal();
      $this->layout->setLayout("layouts/default_layout");
      $this->layout->view('pages/portada', $data);
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
          'id'=>$row->id,
          'username' => $row->username,
          'menu' =>  $this->menus->getUsuarioMenu($row->id),
          'idAmbiente' => $row->idAmbiente,
          'cantAmbientes'=> $this->ambientes->getUsuarioAmbiente($row->id)
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
