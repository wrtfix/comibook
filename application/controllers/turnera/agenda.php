<?php

class Agenda extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->model('turnos', '', TRUE);
        $this->load->model('horarios', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
        ini_set('memory_limit', '-1');
    }

    public function index($fecha = null) {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->load->library('form_validation');
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            if ($fecha != null) {
                $data['fechaSeleccionada'] = $fecha;
                $lafecha = $fecha;
                list($newDia, $newMes, $newAno) = explode("-", $lafecha);
                $datetime = DateTime::createFromFormat('Y-m-d', $newAno."-".$newMes."-".$newDia);
                $nombreDia = $datetime->format('D');
            } else {
                $data['fechaSeleccionada'] = null;
                $lafecha = $ano . "-" . $mes . "-" . $dia;
                $datetime = DateTime::createFromFormat('Y-m-d', $hoy);
                $nombreDia = $datetime->format('D');
            }
            $idConsultorio = $this->input->post('idConsultorio');
            $data['turnos'] = $this->turnos->getTurnos($idConsultorio, $lafecha);
            $data['horario'] = $this->horarios->getHorarioDia($idConsultorio, $nombreDia);
            $data['idConsultorio'] = $idConsultorio;
            $this->layout->view('pages/turnera/agenda', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function insertOrUpdateAgenda() {
        if ($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001')) {
            $this->load->library('form_validation');
            $this->turnos->addTurno();
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
}
