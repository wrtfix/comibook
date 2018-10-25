<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('menus','',TRUE);
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'menu';
			$data['agregados'] =  $this->menus->getMenu();
			$this->layout->view('pages/backoffice/menu', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

	public function addMenu(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->menus->addMenu();
			$data['page'] = 'menu';
			$data['agregados'] =  $this->menus->getMenu();
			$this->layout->view('pages/backoffice/menu', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delMenu($id){
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$result = $this->menus->delMenu($id);	
			$data['page'] = 'menu';
			$data['agregados'] =  $this->menus->getMenu();
			$this->layout->view('pages/backoffice/menu', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function updateMenu($id){
		if($this->session->userdata('logged_in'))
		{
			$result = $this->menus->updateMenu($id);
	    }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
	    }
	}
	

}
