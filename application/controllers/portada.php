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
        $this->layout->setLayout("layouts/portada_layout");
    }

    private function getSetters($filter) {
        $data['page'] = 'portada_view';
        $data['menu'] = $this->gasto->getGastos();
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano . "-" . $mes . "-" . $dia;
        $data['noticiasPrincipales'] = $this->pedido->getPedidoPedientes($filter);
        $data['noticiasMasLeidas'] = $this->pedido->getNoticiasMasLeidas($filter);
        $data['resumenNoticias'] = $this->pedido->getNoticiasMasPopulares($filter);
        
        //Manejo de configuracion
        $data['logo'] = $this->cheque->getCheque("SITE_IMAGE");
        $data['menuColor'] = $this->cheque->getCheque("SITE_MENU_PRINCIPAL");
        $data['topBanner'] = $this->cheque->getCheque("TOP_BANNER");
        $data['downBanner'] = $this->cheque->getCheque("DOWN_BANNER");
        $data['leftBanner'] = $this->cheque->getCheque("LEFT_BANNER");
        
        $zona_horaria = "-3";
        $formato = "d M Y";
        $fecha = gmdate($formato, time() + ($zona_horaria * 3600));
        
        setlocale(LC_ALL,"es_ES");
        $data['fechaActual'] = strftime("%A %d de %B del %Y");
        return $data;
    }

    function index($filter = null) {
        $this->load->helper('form');
        $data = self::getSetters($filter);
        $this->layout->view('portada_view', $data);
    }

    function detalle($filter = null) {
        $this->load->library('form_validation');
        $data = self::getSetters(null);
        $data['noticiasRelacionadas'] = $this->pedido->getNoticiasRelacionadas($filter);
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
        $this->load->library('form_validation');
        $filter = $this->input->post('idNoticia');
        $data = self::getSetters(null);
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