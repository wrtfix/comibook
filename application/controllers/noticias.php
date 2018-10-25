<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Noticias extends CI_Controller 
{
	public function __construct()
	{
            parent:: __construct();
            $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
            $this->load->model('noticia','',TRUE);
            $this->load->model('contenido','',TRUE);
            $this->load->model('imagen','',TRUE);
            $this->load->model('configuraciones', '', TRUE);
            $this->load->spark('markdown-extra/0.0.0');
	}

        private function  eliminarContenidoAntiguo(){
            $fecha = date('Y-m-d');
            $days = $this->configuraciones->getConfiguracion("REMOVE_NEWS_OLD_DAY")[0]->valor;
            $nuevafecha = strtotime ( '-'.$days.'day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            list($diaBorrar, $mesBorrar, $anoBorrar) = explode("-", $nuevafecha);
            $this->noticia->delNotificFecha($nuevafecha);
        }
        
	public function index($fecha=null)
	{
            if($this->session->userdata('logged_in'))
            {
                    self::eliminarContenidoAntiguo();
                    $this->load->library('form_validation');
                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $hoy = date("Y-m-d");
                    list($dia, $mes, $ano) = explode("-", $hoy);
                    if ($fecha!=null){
                            $data['fechaSeleccionada'] = $fecha; 
                            $lafecha = $fecha; 	
                    }else{
                            $data['fechaSeleccionada'] =null;
                            $lafecha = $ano."-".$mes."-".$dia;
                    }
                    $data['page'] = 'noticias';
                    $data['imagenes'] = $this->imagen->getImagenes();
                    $data['agregados'] = $this->noticia->getNoticiaFecha(null,$lafecha,$lafecha,"No");
                    $this->layout->view('pages/noticias', $data);
            }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
            }
	}
	
	public function addNoticia(){
            if($this->session->userdata('logged_in'))
            {
                    $this->load->library('form_validation');
                    $this->noticia->addNoticia();
                    $hoy = date("Y-m-d");
                    list($dia, $mes, $ano) = explode("-", $hoy);
                    $data['fechaSeleccionada'] =null;
                    $lafecha = $ano."-".$mes."-".$dia;
                    $data['page'] = 'noticias';
                    $data['agregados'] = $this->noticia->getNoticiaFecha(null,$lafecha,$lafecha,"No");
                    $this->layout->view('pages/noticias', $data);
            } else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);

	    }
	 	
	}
	public function updateNoticia($id){
            if($this->session->userdata('logged_in'))
            {
                    $this->load->library('form_validation');
                    $this->noticia->updateNoticia($id);
            }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
	    }
	}
        
	public function delNoticia($id){
		if($this->session->userdata('logged_in'))
		{
			$this->noticia->delNoticia($id);
                        $this->contenido->deleteRContenidoMenu($id);
                        $this->contenido->delContenido($id);
                        $this->comentarios->deleteComentarioNoticia($id);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}

}
