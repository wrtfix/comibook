<?php 
class Busqueda extends CI_Controller 
{
	public function __construct()
	{
            parent:: __construct();
            $this->layout->placeholder("title", "Sistema de Gestion de Contenidos");
            $this->load->model('consultorios','',TRUE);
            $this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
            $this->load->library('form_validation');
            $data['agregados'] = $this->consultorios->getConsultorios();
            $this->layout->setLayout("layouts/login_layout_3");
            $this->layout->view('pages/turnera/consultorio', $data);
	}
	
                
}
