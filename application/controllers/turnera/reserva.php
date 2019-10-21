<?php

class Reserva extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('turnos', '', TRUE);
        $this->load->model('horarios', '', TRUE);
        $this->load->model('configuraciones', '', TRUE);
        $this->load->model('consultorios', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
        ini_set('memory_limit', '-1');
    }

    public function index($idConsultorio) {
        $this->load->library('form_validation');
        $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
        $this->layout->setLayout("layouts/login_layout_3");
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $espacios = $this->turnos->getEspacios($idConsultorio);
        $otorgados = $this->turnos->getTurnosOtorgados($idConsultorio, 7);
        $totales = array();
        $diasMap = array();
        //HASH
        $diasMap['MON'] = "Lunes";
        $diasMap['THU'] = "Martes";
        $diasMap['WED'] = "Miercoles";
        $diasMap['TUE'] = "Jueves";
        $diasMap['FRI'] = "Viernes";
        $diasMap['SAT'] = "Sabado";
        $diasMap['SUN'] = "Domingo";
        //Fin de hash
        
        //Fechas
        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $arrayDias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        
        $fecha = date('Y-m-j');
        $diasMax = 7;
        $fechas = array();
        for ($i = 0; $i < $diasMax; $i++) {
            $nuevafecha = strtotime ( '+'.$i.' day' , strtotime ( $fecha ) ) ;
            array_push($fechas, [ 'fechaLabel' => $arrayDias[date ( 'w' , $nuevafecha )], 'fecha' => date('Y-m-d', $nuevafecha), 'fechaFormat' => date('d-m-Y', $nuevafecha)]);
        }
        
        //Fin de fechas
        if ($otorgados != null) {
            foreach ($otorgados as $otorgado):
                foreach ($espacios as $espacio):
                    if ($espacio->nombre == $otorgado->Dias) {
                        $elem = ['total' => $espacio->HORAS - $otorgado->Turnos, 'dia' => $otorgado->Dias, 'fecha' => $otorgado->fecha, 'diaLabel' => $diasMap[$otorgado->Dias]];
                        array_push($totales, $elem);
                    }
                endforeach;
            endforeach;
        } else {
            foreach ($espacios as $espacio):
                $elem = ['total' => $espacio->HORAS, 'dia' => $espacio->nombre, 'fecha' => '', 'diaLabel' => $diasMap[$espacio->nombre]];
                array_push($totales, $elem);
            endforeach;
        }
        
        foreach ($espacios as $espacio):
            $exist=false;
            foreach ($totales as $total):
                if ($espacio->nombre == $total['dia']){
                    $exist=true;
                }
            endforeach;
            if (!$exist){
                array_push($totales, ['total' => $espacio->HORAS, 'dia' => $espacio->nombre, 'fecha' => '', 'diaLabel' => $diasMap[$espacio->nombre]]);
            }
        endforeach;


        $data['type'] = "servicios";
        $data['totales'] = $totales;
        $data['fechas'] = $fechas;
        $data['idConsultorio'] = $idConsultorio;

        $this->layout->view('pages/turnera/reserva', $data);
    }
    
    public function obtenerTurnosLibres() {
        $this->load->library('form_validation');
        $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
        $this->layout->setLayout("layouts/empty");
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        
        $idConsultorio = $this->input->post('idConsultorio');
        $lafecha = $this->input->post('fecha');
        list($newDia, $newMes, $newAno) = explode("-", $lafecha);
        $datetime = DateTime::createFromFormat('Y-m-d', $newDia."-".$newMes."-".$newAno);
        $nombreDia = $datetime->format('D');
        
        $data['turnos'] = $this->turnos->getTurnos($idConsultorio, $newAno."-".$newMes."-".$newDia);
        $data['horario'] = $this->horarios->getHorarioDia($idConsultorio, $nombreDia);      
        $data['idConsultorio'] = $idConsultorio;
        $data['fecha'] = $newAno."-".$newMes."-".$newDia;
        $this->layout->view('pages/turnera/listado', $data);
        
    }

    public function save() {
        
    }
    public function reservarHorario(){
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        $data['idConsultorio'] = $this->input->post('idConsultorio');
        $data['fecha'] = $this->input->post('fecha');
        $data['horario'] = $this->input->post('horario');
        $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
        $data['type'] = "servicios";
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->layout->setLayout("layouts/login_layout_3");
        $this->layout->view('pages/turnera/reservarTurno', $data);
        
    }
    
    public function realizarReserva(){
         // Load the library
        $this->load->library('recaptcha');

        // Catch the user's answer
        $captcha_answer = $this->input->post('g-recaptcha-response');

        // Verify user's answer
        $response = $this->recaptcha->verifyResponse($captcha_answer);

        // Processing ...
        if ($response['success']) {
           //Valido que exista usuario y tomo id
           //Valido que no este ocupado el turno
           //Agrego el turno 
        }
        $data['fecha'] = $this->input->post('fecha');
        $data['horario'] = $this->input->post('horario');
        $data['consultorio'] = $this->consultorios->getConsultorio($this->input->post('idConsultorio'));
        $data['type'] = "servicios";
        $data['logo'] = $this->configuraciones->getConfiguracion("SITE_IMAGE");
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->layout->setLayout("layouts/login_layout_3");
        $this->layout->view('pages/turnera/confirmacionTurno', $data);
    }
}
