<?php 
class About extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		$data['page'] = 'about';
		$this->layout->view('pages/about', $data);
	}

}
