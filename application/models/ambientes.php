<?php

class Ambientes extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addAmbiente() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'ambiente' => $this->session->userdata('logged_in')['idAmbiente']
        );
        return $this->db->insert('ambiente', $data);
    }

    function getMenuConfig() {
        $this->db->from('menu');
        $this->db->order_by('idMenu desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getMenuConfigName($name) {
        $this->db->from('menu');
        $this->db->where('grupo like "' . $name . '"');
        $query = $this->db->get();
        return $query->result();
    }

    function getAmbiente() {
        $this->db->from('ambiente');
        $query = $this->db->get();
        return $query->result();
    }

    function delAmbiente($identificador) {
        return $this->db->delete('ambiente', array('idAmbiente' => $identificador));
    }

    function updateAmbiente($id) {
        $data = array(
            'nombre' => $this->input->post('nombre'),
        );
        $this->db->where('idAmbiente', $id);
        return $this->db->update('ambiente', $data);
    }

    function getUsuarioMenuConfig($idUsuario) {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('(SELECT rUsuarioMenu.idMenu as `id`, rUsuarioMenu.idUsuario, rUsuarioMenu.idRUsuarioMenu from rUsuarioMenu WHERE rUsuarioMenu.idUsuario =' . $idUsuario . ') AS B', 'B.id = menu.idMenu', 'left outer');
        $this->db->where('grupo not like "frontend"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getUsuarioMenu($idUsuario) {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('(SELECT rUsuarioMenu.idMenu as `id`, rUsuarioMenu.idUsuario, rUsuarioMenu.idRUsuarioMenu from rUsuarioMenu WHERE rUsuarioMenu.idUsuario =' . $idUsuario . ') AS B', 'B.id = menu.idMenu', 'join');
        $this->db->where('grupo not like "frontend"');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function addRUsuarioMenu($menuItems) {
        foreach ($menuItems as $item) :
            $nose = $item->idMenu;
            $value = $this->input->post($nose);
            if (!empty($value)) {
                $data = array(
                    'idUsuario' => $this->input->post('idUsuario'),
                    'idMenu' => $item->idMenu
                );
                $this->db->insert('rUsuarioMenu', $data);
            }
        endforeach;

        return true;
    }

    function getCountMenu($idUsuario) {
        $this->db->from('rUsuarioMenu');
        $this->db->where('idUsuario like ' . $idUsuario);
        $query = $this->db->get();
        return count($query->result());
    }

    function deleteRUsuarioMenu($idUsuario) {
        return $this->db->delete('rUsuarioMenu', array('idUsuario' => $idUsuario));
    }

    function getUsuarioAmbienteConfig($idUsuario) {
        $this->db->select('*');
        $this->db->from('ambiente');
        $this->db->join('(SELECT rUsuarioAmbiente.idAmbiente as `id`, rUsuarioAmbiente.idUsuario, rUsuarioAmbiente.idRUsuarioAmbiente from rUsuarioAmbiente WHERE rUsuarioAmbiente.idUsuario =' . $idUsuario . ') AS B', 'B.id = ambiente.idAmbiente', 'left outer');
        $query = $this->db->get();
        $result = $query->result();
//        print_r($this->db->last_query());
        return $result;
    }
    
    function getUsuarioAmbiente($idUsuario) {
        $this->db->select('*');
        $this->db->from('ambiente');
        $this->db->join('(SELECT rUsuarioAmbiente.idAmbiente as `id`, rUsuarioAmbiente.idUsuario, rUsuarioAmbiente.idRUsuarioAmbiente from rUsuarioAmbiente WHERE rUsuarioAmbiente.idUsuario =' . $idUsuario . ') AS B', 'B.id = ambiente.idAmbiente', 'inner');
        $query = $this->db->get();
        $result = $query->result();
//        print_r($this->db->last_query());
        return $result;
    }

    function getCountAmbiente($idUsuario) {
        $this->db->from('rUsuarioAmbiente');
        $this->db->where('idUsuario like ' . $idUsuario);
        $query = $this->db->get();
        return count($query->result());
    }

    function addRUsuarioAmbiente($menuItems) {
        foreach ($menuItems as $item) :
            $nose = $item->idAmbiente;
            $value = $this->input->post($nose);
            if (!empty($value)) {
                $data = array(
                    'idUsuario' => $this->input->post('idUsuario'),
                    'idAmbiente' => $item->idAmbiente
                );
                $this->db->insert('rUsuarioAmbiente', $data);
            }
        endforeach;

        return true;
    }

    function deleteRUsuarioAmbiente($idUsuario) {
        return $this->db->delete('rUsuarioAmbiente', array('idUsuario' => $idUsuario));
    }
    
    function updateUsuarioAmbiente() {
        $idUsuario = $this->input->post('idUsuario');
        $idAmbiente = $this->input->post('idAmbiente');
        $data = array(
               'idAmbiente' => $idAmbiente
            );
        $this->db->where('id', $idUsuario);
        $this->db->update('users', $data);
    }

}

?>