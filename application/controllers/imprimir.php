<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imprimir extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('imagen','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		
		if($this->session->userdata('logged_in'))
		{
                        $data['imagenes'] = $this->imagen->getImagenes();
			$this->layout->view('pages/imprimir', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        public function eliminarImagen($nombre)
	{
		
		if($this->session->userdata('logged_in'))
		{
                        $data['imagenes'] = $this->imagen->delImagen($nombre);
                        if(unlink("/opt/lampp/htdocs/saltaChequeado/uploads/".$nombre)) {
                            echo 'deleted successfully';
                        }
                        else {
                             echo 'errors occured';
                        }
                        
			$this->layout->view('pages/imprimir', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function do_upload()
        {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 3000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $data['page'] = 'imprimir';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    $this->layout->view('pages/imprimir', $error);
            }
            else
            {       $results=$this->upload->data();
                    $data['results'] = $results;
                    $this->imagen->addImagen($results['file_name']);
                    $data['imagenes'] = $this->imagen->getImagenes();
                    $this->layout->view('pages/imprimir', $data);
            }
    }

}
