<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contenidos extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('contenido','',TRUE);
                $this->load->model('pedido','',TRUE);
		$this->load->model('gasto','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index($idNoticia=null)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'contenido';
                        $data['noticiaSeleccionada'] = $this->pedido->getNoticia($idNoticia);
			$data['noticia'] = $this->contenido->getContenidoNoticia($idNoticia);
			$data['menu'] = $this->contenido->getItemMenu($idNoticia);
			$data['idNoticia'] = $idNoticia;
			$this->layout->view('pages/contenido', $data);
		}else
		{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addContenido(){
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('contenido','contenido','required');
			$this->form_validation->set_rules('idNoticia','idNoticia','required');
	  		if ($this->form_validation->run() == FALSE) {
	  			$this->output->set_status_header('400'); //Triggers the jQuery error callback
	        } else {
	        	$menuItems = $this->gasto->getGastos();
                        $result = $this->contenido->addContenido();
                        $result = $this->contenido->addRContenidoMenu($menuItems);
                        $data['menu'] = $this->contenido->getItemMenu($this->input->post('idNoticia'));;
	        }
                $data['noticiaSeleccionada'] = $this->pedido->getNoticia($this->input->post('idNoticia'));
                $data['noticia'] = $this->contenido->getContenidoNoticia($this->input->post('idNoticia'));
                $data['page'] = 'contenido';
                $data['idNoticia'] = $this->input->post('idNoticia');
                $this->layout->view('pages/contenido', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
    public function update(){
            if($this->session->userdata('logged_in'))
            {
                $this->load->library('form_validation');
                $result = $this->contenido->update();
                $result = $this->contenido->deleteRContenidoMenu($this->input->post('idNoticia'));
                $menuItems = $this->gasto->getGastos();
                $result = $this->contenido->addRContenidoMenu($menuItems);
                $data['noticia'] = $this->contenido->getContenidoNoticia($this->input->post('idNoticia'));
                $data['noticiaSeleccionada'] = $this->pedido->getNoticia($this->input->post('idNoticia'));
                $data['menu'] = $this->contenido->getItemMenu($this->input->post('idNoticia'));
                $data['idNoticia'] = $this->input->post('idNoticia');
                $this->layout->view('pages/contenido', $data);
                    
	    }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
	    }

        }
        function delContenido($identificador){
		return $this->db->delete('contenido', array('idContenido' => $identificador));
	}
}
