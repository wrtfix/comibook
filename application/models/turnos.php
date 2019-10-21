<?php

class Turnos extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addTurno() {
        $idTurno = $this->input->post('idTurno');
        list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
        $data = array(
            'hora' => $this->input->post('horario'),
            'fecha' => $ano."-".$mes."-".$dia,
            'idPaciente' => $this->input->post('idPaciente'),
            'idConsultorio' => $this->input->post('idConsultorio'),
            'monto' => $this->input->post('monto'),
            'pago' => $this->input->post('pago'),
            'observaciones' => $this->input->post('observaciones')
        );
        if ($idTurno == '') {
            return $this->db->insert('turno', $data);
        }else{
            print_r('aca');
            $this->db->where('idTurno', $idTurno);
            return $this->db->update('turno', $data);
        }
        
        
    }

    function getTurnos($idConsultorio,$fecha) {
        $this->db->from('turno');
        list($dia, $mes, $ano) = explode("-", $fecha);
        $this->db->join('clientes', 'turno.idPaciente = clientes.Id');
        $this->db->where('fecha', $ano."-".$mes."-".$dia);
        $this->db->where('idConsultorio', $idConsultorio);
        $query = $this->db->get();
        return $query->result();
    }

    function delHorario($identificador) {
        return $this->db->delete('dia', array('idDia' => $identificador));
    }

    function getHorarioDia($idConsultorio, $dia) {
        $this->db->from('dia');
        $this->db->like("nombre", $dia);
        $this->db->where("idConsultorio", $idConsultorio);
        $query = $this->db->get();
        return $query->result();
    }

    function getClientelLocalidad($nombre) {
        $this->db->from('clientes');
        $this->db->like("Localidad", $nombre);
        $query = $this->db->get();
        return $query->result();
    }

    function updateHorario($id) {
        $data = array(
            'nombre' => strtoupper($this->input->post('dia')),
            'horaDesde' => $this->input->post('horaDesde'),
            'horaHasta' => $this->input->post('horaHasta'),
            'intervalo' => $this->input->post('intervalo'),
        );
        $this->db->where('idDia', $id);
        return $this->db->update('dia', $data);
    }
    
    function getEspacios($idConsultorio){
        $result = $this->db->query("SELECT nombre, horaHasta, horaDesde, (FLOOR(TIMESTAMPDIFF(SECOND, horaDesde, horaHasta)/(intervalo*60))+1) HORAS FROM dia WHERE idConsultorio = '" . $idConsultorio."'")->result();
        return $result;
    }
    
    function getTurnosOtorgados($idConsultorio, $dias){
        return $this->db->query("select fecha, UPPER(DATE_FORMAT(fecha, '%a')) Dias, COUNT(*) Turnos from turno WHERE idConsultorio = ".$idConsultorio." AND fecha >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND fecha <= DATE_ADD(NOW(), INTERVAL ".$dias." DAY) GROUP BY fecha")->result();
        
    }

}

?>