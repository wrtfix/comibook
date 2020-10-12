<?php 
class Busqueda extends CI_Controller 
{
	public function __construct()
	{
            parent:: __construct();
            $this->load->model('configuraciones', '', TRUE);
            $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
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
            $data['acercaDe'] = $this->configuraciones->getConfiguracion("ECOMMERSE_ACERCA_DE")[0]->valor;
            $data['showSearchs'] = $this->configuraciones->getConfiguracion("SHOW_SEARCH")[0]->valor;
            $data['headerImage'] = $this->configuraciones->getConfiguracion("ECOMMERSE_HEADER_IMAGE")[0]->valor;
            $data['imageLogo'] = $this->configuraciones->getConfiguracion("ECOMMERCE_IMAGE_LOGO")[0]->valor;
	    $data['pageShow'] = $this->configuraciones->getConfiguracion("ECOMMERCE_PAGE_SHOW")[0]->valor;
	    $data['showCategories'] = $this->configuraciones->getConfiguracion("ECOMMERCE_SHOW_CATEGORIES")[0]->valor;
		

		
            
            $data['type']= $type;
            if($type=="servicios"){
                $data['agregados'] = $this->consultorios->getConsultoriosWithOutSession();
            }else{
                $data['type']= "productos";
                $local = $this->consultorios->getConsultorio($idLocal);
                $this->layout->placeholder("title", $local[0]->nombre);
                $this->layout->placeholder("descripcion", $local[0]->direccion." <br> Telefono: ".$local[0]->telefono." <br> Horario: ".$local[0]->horario);
                $data['idLocal'] = $idLocal;
                $data['telefono'] = $local[0]->telefono;
                $data['agregados'] = $this->productos->getProductosByLocal($idLocal);
            }
            
            $this->layout->view('pages/turnera/busqueda', $data);
	}
	
                
}
