<?php 
class Construccion extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		//$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		$data['page'] = 'construccion';
		$this->layout->view('pages/construccion', $data);
	}

}
