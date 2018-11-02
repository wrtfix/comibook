<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rol extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('menus','',TRUE);
                $this->load->model('user','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index($idUsuario=null)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'rol';
			$data['menu'] = $this->menus->getUsuarioMenuConfig($idUsuario);
                        $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
                        $data['$items'] = $this->menus->getCountMenu($idUsuario);
			$data['idUsuario'] = $idUsuario;
			$this->layout->view('pages/backoffice/rol', $data);
		}else
		{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function addMenu(){
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
                        $idUsuario = $this->input->post('idUsuario');
	        	$menuItems = $this->menus->getUsuarioMenuConfig($idUsuario);
                        $result = $this->menus->addRUsuarioMenu($menuItems);
                        $data['menu'] = $this->menus->getUsuarioMenuConfig($idUsuario);
                        $data['usuarioSeleccionado'] = $this->user->getUser($idUsuario);
                        $data['page'] = 'rol';
                        $data['idUsuario'] = $idUsuario;
                        $this->layout->view('pages/backoffice/rol', $data);
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
                $menuItems = $this->menus->getMenu();
                $result = $this->contenido->addRContenidoMenu($menuItems);
                $data['noticia'] = $this->contenido->getContenidoNoticia($this->input->post('idNoticia'));
                $data['noticiaSeleccionada'] = $this->noticia->getNoticia($this->input->post('idNoticia'));
                $data['menu'] = $this->contenido->getItemMenu($this->input->post('idNoticia'));
                $data['idNoticia'] = $this->input->post('idNoticia');
                $this->layout->view('pages/contenido', $data);
                    
	    }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
	    }

        }
        function delContenido($identificador){
		$result = $this->db->delete('contenido', array('idContenido' => $identificador));
                return $result;
	}
}
