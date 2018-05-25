<?php 
class Backup extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('backups','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		$data['page'] = 'backup';
		$data['agregados'] =  $this->backups->generarBackUp();
		$this->layout->view('pages/backup', $data);
	}

}
