<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portada extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->layout->placeholder("title", "Salta Chequeado");
        $this->load->spark('markdown-extra/0.0.0');
        $this->load->model('gasto', '', TRUE);
        $this->load->model('pedido', '', TRUE);
        $this->load->model('contenido', '', TRUE);
        $this->load->model('cheque', '', TRUE);
        $this->load->model('comentarios', '', TRUE);
        
        // load Pagination library
        $this->load->library('pagination');
        // load URL helper
        $this->load->helper('url');
        
        $this->layout->setLayout("layouts/portada_layout");
    }

    private function getSetters($filter,$lafecha) {
        $data['page'] = 'portada_view';
        $data['menu'] = $this->gasto->getGastos();
        
        $data['banner'] = $this->pedido->getPedidoPedientes(null,$lafecha);
        $data['noticiasMasLeidas'] = $this->pedido->getNoticiasMasLeidas($filter,$lafecha);
        $data['resumenNoticias'] = $this->pedido->getNoticiasMasPopulares($filter,$lafecha);
        
        //Manejo de configuracion
        $data['logo'] = $this->cheque->getCheque("SITE_IMAGE");
        $data['logoUpside'] = $this->cheque->getCheque("SITE_IMAGE_UPSIDE");
        $data['twitterMessage'] = $this->cheque->getCheque("SHARE_TWITTER");
        $data['twitterUser'] = $this->cheque->getCheque("USER_TWITTER");
        $data['instagramUser'] = $this->cheque->getCheque("USER_INSTAGRAM");
        $data['menuColor'] = $this->cheque->getCheque("SITE_MENU_PRINCIPAL");
        $data['topBanner'] = $this->cheque->getCheque("TOP_BANNER");
        $data['downBanner'] = $this->cheque->getCheque("DOWN_BANNER");
        $data['leftBanner'] = $this->cheque->getCheque("LEFT_BANNER");
        $data['imageCarrusel'] = $this->cheque->getCheque("CARRUSEL_IMAGE");
        
        
        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre','Noviembre', 'Diciembre');
        $arrayDias = array( 'Domingo', 'Lunes', 'Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado');
     
        $data['fechaActual'] = $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
        return $data;
    }
    
    function index($filter=null) {
        $this->load->helper('form');
        
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano."-".$mes."-".$dia;
        
        $data = self::getSetters(null,$hoy);
        $limit_per_page = 10;
        $start_index = 0;
        $total_records = $this->pedido->get_total($filter,$hoy);
        
        $this->session->set_userdata('filter', $filter);
        
        if ($total_records > 0) 
        {
            // get current page records
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            $lafecha = $ano."-".$mes."-".$dia;
            $data["noticiasPrincipales"] = $this->pedido->get_current_page_records($limit_per_page, $start_index,$filter,$hoy);
            
            $config['base_url'] = base_url() . 'index.php/portada/paginado';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
            
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="article-pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            
            $config['cur_tag_open'] = '<li class="active"> <a href=#>';
            $config['cur_tag_close'] = '</a></li>';
            
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            
            $config['first_link'] = 'Primera';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
             
            $config['last_link'] = 'Ultima';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
             
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $data['totalRecords'] = $total_records;
            $this->pagination->initialize($config);
             
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }
        
        $this->layout->view('portada_view', $data);
    }
    
    function paginado() {
        $this->load->helper('form');
        $filter=$this->session->all_userdata()['filter'];
        
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano."-".$mes."-".$dia;
        $data = self::getSetters($filter,$hoy);
        
        $limit_per_page = 10;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->pedido->get_total($filter,$hoy);
        
        if ($total_records > 0) 
        {
            // get current page records
            
            $data["noticiasPrincipales"] = $this->pedido->get_current_page_records($limit_per_page, $start_index,$filter,$hoy);
             
            $config['base_url'] = base_url() . 'index.php/portada/paginado';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
            
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
            $config['full_tag_open'] = '<div class="article-pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            
            $config['cur_tag_open'] = '<li class="active"> <a href=#>';
            $config['cur_tag_close'] = '</a></li>';
            
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            
            $config['first_link'] = 'Primera';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
             
            $config['last_link'] = 'Ultima';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
             
            $config['next_link'] = '>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = '<';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            
            $this->pagination->initialize($config);
            $data['totalRecords'] = $total_records;
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }
        
        $this->layout->view('portada_view', $data);
    }
    
    function detalle($filter = null) {
        $this->load->library('form_validation');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano."-".$mes."-".$dia;
        $data = self::getSetters(null,$hoy);
        
        $data['noticiasRelacionadas'] = $this->pedido->getNoticiasRelacionadas($filter,$hoy);
        $this->pedido->updateVisita($filter);
        $result = $this->contenido->getContenido($filter);
        $data['idNoticia'] = $filter;
        $data['noticia'] = $result;
        $data['page'] = 'portada_detalle';
        $data['comentarios'] = $this->comentarios->getComentarios($filter);
        $this->layout->view('portada_detalle', $data);
    }
    
    function like() {
        $this->pedido->updateLike($this->input->post('idNoticia'));
    }
    
        
    function unlike() {
        $this->pedido->updateUnLike($this->input->post('idNoticia'));
    }

    function addComentario() {
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano."-".$mes."-".$dia;
        $this->load->library('form_validation');
        $filter = $this->input->post('idNoticia');
        $data = self::getSetters(null,$lafecha);
        $result = $this->contenido->getContenido($filter);
        $fecha = date("Y-m-d");

        $this->comentarios->addComentario($fecha);
        $data['comentarios'] = $this->comentarios->getComentarios($filter);
        $data['noticia'] = $result;
        $data['idNoticia'] = $filter;
        $data['page'] = 'portada_detalle';
        $this->layout->view('portada_detalle', $data);
    }

}

?>