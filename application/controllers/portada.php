<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portada extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        
        $this->load->model('menus', '', TRUE);
        $this->load->model('noticia', '', TRUE);
        $this->load->model('contenido', '', TRUE);
        $this->load->model('configuraciones', '', TRUE);
        $this->load->model('comentarios', '', TRUE);
        
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->spark('markdown-extra/0.0.0');
        // load Pagination library
        $this->load->library('pagination');
        // load URL helper
        $this->load->helper('url');

        $this->layout->setLayout("layouts/portada_layout");
    }

    private function getSetters($filter, $lafecha, $url, $title, $description, $imagen) {
        $data['page'] = 'portada_view';
        $data['menu'] = $this->menus->getMenu();

        $data['banner'] = $this->noticia->getPedidoPedientesMax(null, $lafecha, $this->configuraciones->getConfiguracion("MARQUE_MAX_ROWS")[0]->valor);
        $data['noticiasMasLeidas'] = $this->noticia->getNoticiasMasLeidas($filter, $lafecha);
        $data['resumenNoticias'] = $this->noticia->getNoticiasMasPopulares($filter, $lafecha);

        $data['comentarios'] = $this->comentarios->getUltimosComentarios($this->configuraciones->getConfiguracion("MAX_COMMENTS")[0]->valor);

        //Manejo de configuracion
        $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
        $data['logoUpside'] = $this->configuraciones->getConfiguracion("SITE_IMAGE_UPSIDE");
        $data['twitterMessage'] = $this->configuraciones->getConfiguracion("SHARE_TWITTER");
        $data['twitterUser'] = $this->configuraciones->getConfiguracion("USER_TWITTER");
        $data['instagramUser'] = $this->configuraciones->getConfiguracion("USER_INSTAGRAM");
        $data['menuColor'] = $this->configuraciones->getConfiguracion("SITE_MENU_PRINCIPAL");
        $data['topBanner'] = $this->configuraciones->getConfiguracion("TOP_BANNER");
        $data['downBanner'] = $this->configuraciones->getConfiguracion("DOWN_BANNER");
        $data['leftBanner'] = $this->configuraciones->getConfiguracion("LEFT_BANNER");
        $data['imageCarrusel'] = $this->configuraciones->getConfiguracion("CARRUSEL_IMAGE");
        $data['styleCustom'] = $this->configuraciones->getConfiguracion("CUSTOM_STYLE");
        $data['login'] = $this->configuraciones->getConfiguracion("SHOW_LOGIN");
        $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");

        $data['ogurl'] = $url;
        $data['ogtype'] = "website";
        $data['ogtitle'] = $title;
        $data['ogdescription'] = $description;
        $data['ogimage'] = $imagen;
        $data['fbapp_id'] = $this->configuraciones->getConfiguracion("FACEBOOK_KEY")[0]->valor;


        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $arrayDias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');

        $data['fechaActual'] = $arrayDias[date('w')] . ", " . date('d') . " de " . $arrayMeses[date('m') - 1] . " de " . date('Y');
        return $data;
    }

    function index($filter = null) {
        $this->load->helper('form');
        $paginaNoticias = $this->configuraciones->getConfiguracion("SHOW_NEWS_PAGE");
        if ($paginaNoticias[0]->valor != 'false') {
            $this->load->library('recaptcha');

            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            $lafecha = $ano . "-" . $mes . "-" . $dia;

            $socialTitle = $this->configuraciones->getConfiguracion("SOCIAL_TITLE");
            $socialDescription = $this->configuraciones->getConfiguracion("SOCIAL_DESCRIPTION");
            $socialImage = $this->configuraciones->getConfiguracion("SOCIAL_IMAGE");

            $data = self::getSetters(null, $hoy, base_url(), $socialTitle[0]->valor, $socialDescription[0]->valor, $socialImage[0]->valor);

            $limit_per_page = 10;
            $start_index = 0;
            $total_records = $this->noticia->get_total($filter, $hoy);

            $this->session->set_userdata('filter', $filter);
            $data['totalRecords'] = $total_records;
            if ($total_records > 0) {
                // get current page records
                $hoy = date("Y-m-d");
                list($dia, $mes, $ano) = explode("-", $hoy);
                $lafecha = $ano . "-" . $mes . "-" . $dia;
                $data["noticiasPrincipales"] = $this->noticia->get_current_page_records($limit_per_page, $start_index, $filter, $hoy);

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
        } else {
            
            $paginaNoticias = $this->configuraciones->getConfiguracion("SHOW_HOME_PAGE");
             if ($paginaNoticias[0]->valor != 'false') {
                                     
                $this->layout->setLayout("layouts/login_layout_3");
                $data['page'] = 'login_view';
                $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
                $data['loginGoogle'] = $this->configuraciones->getConfiguracion("GOOGLE_LOGIN");
                $data['loginFacebook'] = $this->configuraciones->getConfiguracion("FACEBOOK_LOGIN");
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $this->layout->view('home_views', $data);
             }else{
                $this->layout->setLayout("layouts/login_layout_2");
                $this->load->library('FacebookSDK');
                
                if (!session_id()) {
                    session_start();
                }
                $fb = new Facebook\Facebook(array(
                    'app_id' => $this->configuraciones->getConfiguracion("FACEBOOK_KEY")[0]->valor,
                    'app_secret' => $this->configuraciones->getConfiguracion("FACEBOOK_APP_SECRET")[0]->valor,
                    'default_graph_version' => 'v3.3'
                ));
                $helper = $fb->getRedirectLoginHelper();
                $permissions = ['email']; // Optional permissions
                $loginUrl = $helper->getLoginUrl('http://localhost/saltaChequeado/facebooklogin/login', $permissions);
                $data['loginUrlFacebook'] = '<a href="' . htmlspecialchars($loginUrl) . '"><i class="fa fa-facebook-official"></i> Facebook </a>';
                $data['page'] = 'login_view';
                $data['loginFacebook'] = $this->configuraciones->getConfiguracion("FACEBOOK_LOGIN");
                $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
                $data['loginGoogle'] = $this->configuraciones->getConfiguracion("GOOGLE_LOGIN");
                date_default_timezone_set('America/Argentina/Buenos_Aires');
                $this->layout->view('login_view', $data);   
             }
            
        }
    }

    function paginado() {
        $this->load->helper('form');
        $filter = $this->session->all_userdata()['filter'];

        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano . "-" . $mes . "-" . $dia;

        $socialTitle = $this->configuraciones->getConfiguracion("SOCIAL_TITLE");
        $socialDescription = $this->configuraciones->getConfiguracion("SOCIAL_DESCRIPTION");
        $socialImage = $this->configuraciones->getConfiguracion("SOCIAL_IMAGE");

        $data = self::getSetters(null, $hoy, base_url(), $socialTitle[0]->valor, $socialDescription[0]->valor, $socialImage[0]->valor);

        $limit_per_page = 10;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->noticia->get_total($filter, $hoy);
        $data['totalRecords'] = $total_records;
        if ($total_records > 0) {
            // get current page records

            $data["noticiasPrincipales"] = $this->noticia->get_current_page_records($limit_per_page, $start_index, $filter, $hoy);

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
        $paginaNoticias = $this->configuraciones->getConfiguracion("SHOW_NEWS_PAGE");
        if ($paginaNoticias[0]->valor != 'false') {
            $this->load->library('recaptcha');
            $this->load->library('form_validation');
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            $lafecha = $ano . "-" . $mes . "-" . $dia;
            $result = $this->contenido->getContenido($filter);
            $data = self::getSetters(null, $hoy, base_url() . "index.php/portada/detalle/" . $filter, $result[0]->ClienteOrignen, $result[0]->ClienteDestino, $result[0]->Observaciones);

            $data['noticiasRelacionadas'] = $this->noticia->getNoticiasRelacionadas($filter, $hoy);
            $this->noticia->updateVisita($filter);

            $data['idNoticia'] = $filter;
            $data['noticia'] = $result;
            $data['page'] = 'portada_detalle';
            $data['comentarios'] = $this->comentarios->getComentarios($filter);
            $this->layout->view('portada_detalle', $data);
        } else {
            $this->layout->setLayout("layouts/login_layout_2");
            $data['page'] = 'login_view';
            $data['registrarse'] = $this->configuraciones->getConfiguracion("SHOW_REGISTER");
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $this->layout->view('login_view', $data);
        }
    }

    function like() {
        $this->noticia->updateLike($this->input->post('idNoticia'));
    }

    function unlike() {
        $this->noticia->updateUnLike($this->input->post('idNoticia'));
    }

    function addComentario() {

        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $lafecha = $ano . "-" . $mes . "-" . $dia;
        $this->load->library('form_validation');
        $filter = $this->input->post('idNoticia');
        $data = self::getSetters(null, $lafecha);
        $result = $this->contenido->getContenido($filter);
        $fecha = date("Y-m-d");

        // Load the library
        $this->load->library('recaptcha');

        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        // Processing ...
        if ($response['success']) {
            $this->comentarios->addComentario($fecha);
        }
        $data['comentarios'] = $this->comentarios->getComentarios($filter);
        $data['noticia'] = $result;
        $data['idNoticia'] = $filter;
        $data['page'] = 'portada_detalle';
        $this->layout->view('portada_detalle', $data);
    }

}

?>