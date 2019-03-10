<?php

class Horarios extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addHorario() {
        $data = array(
            'nombre' => strtoupper($this->input->post('dia')),
            'horaDesde' => $this->input->post('horaDesde'),
            'horaHasta' => $this->input->post('horaHasta'),
            'idConsultorio' => $this->input->post('idConsultorio'),
        );
        return $this->db->insert('dia', $data);
    }

    function getHorario($idConsultorio) {
        $this->db->from('dia');
        $this->db->where('idConsultorio', $idConsultorio);
        $query = $this->db->get();
        return $query->result();
    }

    function delHorario($identificador) {
        return $this->db->delete('dia', array('idDia' => $identificador));
    }

    function getCliente($nombre, $cuil, $numero, $localidad) {
        $this->db->from('clientes');
        if ($nombre != ' ')
            $this->db->like("Nombre", $nombre);
        if ($cuil != ' ')
            $this->db->where("Cuit", $cuil);
        if ($numero != ' ')
            $this->db->like("Numero", $numero);
        if ($localidad != ' ')
            $this->db->like("Localidad", $localidad);

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
        );
        $this->db->where('idDia', $id);
        return $this->db->update('dia', $data);
    }

}

?>