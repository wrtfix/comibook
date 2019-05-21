<?php

class Literal extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addLiteral() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'idioma' =>$this->input->post('idioma'),
            'valor' =>$this->input->post('valor'),
        );
        return $this->db->insert('literales', $data);
    }

    function getLiterales() {
        $this->db->from('literales');
        $query = $this->db->get();
        return $query->result();
    }

    function delLiteral($identificador) {
        return $this->db->delete('literales', array('idLiteral' => $identificador));
    }

    function updateLiteral($id) {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'valor' => $this->input->post('valor'),
            'idioma' => $this->input->post('idioma'),
        );
        $this->db->where('idLiteral', $id);
        return $this->db->update('literales', $data);
    }

}

?>