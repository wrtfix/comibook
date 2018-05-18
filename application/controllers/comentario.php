<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comentario extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('comentarios','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'comentarios';
			$data['comentarios'] = $this->comentarios->getComentarios($this->input->post('idNoticia'));
			$this->layout->view('pages/comentarios', $data);
		}else
		{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function deleteComentarios($id){
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
                        $this->comentarios->deleteComentario($id);
			return true;
	       }else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
   
}