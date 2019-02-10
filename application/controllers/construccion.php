<?php 
class Construccion extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
	}

	public function index()
	{
		$data['page'] = 'construccion';
		$this->layout->view('pages/construccion', $data);
	}

}
