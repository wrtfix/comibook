<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Scrapping extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
                $this->load->model('menus','',TRUE);
                $this->load->model('noticia','',TRUE);
                $this->load->model('contenido','',TRUE);
                $this->load->model('configuraciones', '', TRUE);
                $this->load->library('SimpleHTMLDOM');

	}

	public function index($diario='clarin')
	{
		if($this->session->userdata('logged_in'))
		{
                        
                        $scrapping = new SimpleHTMLDOM();
                        $session_data = $this->session->userdata('logged_in');


                        if ($diario == 'clarin'){
                            $data['noticias'] = $scrapping->getTitelUrlContentFromUrl('https://www.clarin.com',"h2",".mt a");
                        }
                        if ($diario == 'quepasasalta'){
                            $data['noticias'] = $scrapping->getTitelUrlContentFromUrl('https://www.quepasasalta.com.ar',"h2","a.link");
                        }
                        if ($diario == 'eltribuno'){
                            $data['noticias'] = $scrapping->getTitelUrlContentFromUrl('https://www.eltribuno.com/salta',"h2",".title a");
                        }
                        
                        $data['diario'] = $diario;
			$data['page'] = 'about';
			$this->layout->view('pages/cms/scrapping', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        
        public function getContenido(){
            $scrapping = new SimpleHTMLDOM();
            $diario = $this->input->post('diario');
            if ($diario == 'clarin'){
                $result = json_encode($scrapping->getContetFromUrl($this->input->post('urlContent'),"div.news","h2",'div.body-nota')[0]);
            }
            if ($diario == 'quepasasalta'){
                $result = json_encode($scrapping->getContetFromUrl($this->input->post('urlContent'),"article","h2.description","div.content")[0]);
            }
            if ($diario == 'eltribuno'){
                $result = json_encode($scrapping->getContetFromUrl($this->input->post('urlContent'),"article","p.preview",'div.note-body p')[0]);
            }
            
            print_r($result);
            return  $result;
        }
        
        public  function saveContenido(){
            if($this->session->userdata('logged_in'))
            {
                    $this->load->library('form_validation');
                    $titulo = $this->input->post('title');
                    $resumen = $this->input->post('description');
                    $this->noticia->addNoticiaScraping($titulo, $resumen);
                    $idNoticia = $this->noticia->getIdNoticia($titulo)[0];
                    $contenido = $this->input->post('content');
                    $this->contenido->addContenidoScrapping($idNoticia->idNoticia, $contenido);
                    $this->contenido->addRContenidoMenuScrapping($idNoticia->idNoticia, 5);                    
            } else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);

	    }
        }

}
