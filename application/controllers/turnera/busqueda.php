<?php 
class Busqueda extends CI_Controller 
{
	public function __construct()
	{
            parent:: __construct();
            $this->layout->placeholder("title", "Sistema de Gestion de Contenidos");
            $this->load->model('configuraciones','',TRUE);
            $this->load->model('consultorios','',TRUE);
            $this->load->model('productos','',TRUE);
            $this->load->spark('markdown-extra/0.0.0');
	}

	public function index($type="servicios",$idLocal=1)
	{
            $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
            $this->layout->setLayout("layouts/login_layout_3");
            $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
            $data['showSearchs'] = $this->configuraciones->getConfiguracion("SHOW_SEARCHS")[0]->valor;
            $data['headerImage'] = $this->configuraciones->getConfiguracion("ECOMMERSE_HEADER_IMAGE")[0]->valor;
            $data['imageLogo'] = $this->configuraciones->getConfiguracion("ECOMMERCE_IMAGE_LOGO")[0]->valor;
            
            $data['type']= $type;
            if($type=="servicios"){
                $data['agregados'] = $this->consultorios->getConsultoriosWithOutSession();
            }else{
                $data['type']= "productos";
                $data['agregados'] = $this->productos->getProductosByLocal($idLocal);
            }
            $this->layout->view('pages/turnera/busqueda', $data);
	}
	
                
}
