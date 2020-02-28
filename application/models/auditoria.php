<?php

class Auditoria extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addActivity($query, $usuario, $funcionalidad) {
        $type = 'Consulto';
        
        if (strpos($query,'DELETE') !== false){
            $type = 'Borrar';
        }
        if (strpos($query,'UPDATE') !== false){
            $type = 'Actualizo';
        }
        if (strpos($query,'INSERT') !== false){
            $type = 'Agrego';
        }

                
        
        $data = array(
            'tipo' => $type,
            'consulta' => $query,
            'idUsuario' => $usuario,
            'funcionalidad' => $funcionalidad
        );
        
        return $this->db->insert('auditoria', $data);
    }

    function getAuditoria() {
        $this->db->from('auditoria');
        $this->db->join('users', 'idUsuario = id');
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }


}

?>