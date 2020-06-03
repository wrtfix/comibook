<?php

Class User extends CI_Model {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('auditoria','',TRUE);
    }


    function login($username, $password) {
        $this->db->select('id, username, password, idAmbiente');
        $this->db->from('users');
        $this->db->where('username = ' . "'" . $username . "'");
        $this->db->where('password = ' . "'" . MD5($password) . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();

            $outQuery = $this->db->last_query();
            $this->auditoria->addActivity($outQuery, $result[0]->id, 'Ingreso');
            return $result;
        } else {
            return false;
        }
    }

    function updateUser($id) {
        $data = array(
            'username' => $this->input->post('nombre'),
            'password' => MD5($this->input->post('password')),
        );
        $this->db->where('id', $id);
        $result = $this->db->update('users', $data);

        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, $id, 'Actualizar Usuario');

        return $result;
    }

    function addUserById($idAmbiente) {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => MD5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'telefono' => $this->input->post('tel'), 
            'idAmbiente' => $idAmbiente
        );
        $result = $this->db->insert('users', $data);
        $id = $this->db->insert_id();
        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, $id, 'Agregar Usuario');
        return $id;
    }
    
    function addUser() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => MD5($this->input->post('password')),
            'email' => $this->input->post('email'),
            'telefono' => $this->input->post('tel')
        );
        $result = $this->db->insert('users', $data);
        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, 1, 'Agregar Usuario');
        return $result;
    }

    function getUsers() {
        $this->db->from('users');
        $query = $this->db->get();
        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Listar Usuarios');

        $result = $query->result();
        return $result;
    }

    function getUser($idUsuario) {
        $this->db->from('users');
        $this->db->where('id', $idUsuario);
        $query = $this->db->get();
        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Obtener detalle de usuario');
        return $query->result();
    }

    function delUser($id) {
        $result = $this->db->delete('users', array('id' => $id));
        $outQuery = $this->db->last_query();
        $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Borrar Usuarios');
        return $result;
    }

}

?>