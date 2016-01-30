<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Febrero2014 extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "J20 censo estudiantil docente");
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		//Esta linea se utiliza cuando se incorpora un formulario 
		$this->load->library('form_validation');
		
		if($this->session->userdata('logged_in'))
		    {
		        $session_data = $this->session->userdata('logged_in');
		        $data['username'] = $session_data['username'];
				$data['page'] = 'febrero2014';
				$data['titulo'] = 'Mesa de Finales 2014';
				$data['ayuda'] = 'En esta seccion usted debe dar de alta la informacion peteneciente a la mes de finales de Febrero 2014.';
				$this->layout->view('pages/febrero2014', $data);
		    }else
		    {
	      //If no session, redirect to login page
		     redirect('login', 'refresh');
		    }		
	
	}
	
	public function create()
	{

		
		echo "hola";
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');

		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			$data['page'] = 'login';
			$this->load->view('login_view');
		}
		else
		{
			
			redirect('welcome', 'refresh');
		}
		
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('news/create');
			$this->load->view('templates/footer');

		}
		else
		{
			//$this->news_model->set_news();
			$this->layout->view('pages/febrero2014', $data);
		}
		
		$this->layout->view('pages/febrero2014', $data);
	}
	
}

