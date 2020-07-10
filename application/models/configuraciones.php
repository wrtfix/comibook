<?php

class Configuraciones extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
                $this->load->model('auditoria','',TRUE);
	}

	function addConfiguracion()
	{
                $this->db->cache_delete_all();
		$data = array(
			'atributo' => strtoupper($this->input->post('atributo')),
			'valor' => $this->input->post('valor'),
			'descripcion' => $this->input->post('descripcion'),
                        'propietario' => $this->input->post('propietario') != null ? $this->input->post('propietario') : "",
		);
                $result = $this->db->insert('configuracion', $data);
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
		return $result;
	}
	
	function getConfiguraciones(){
            $this->db->cache_on();
            $this -> db -> from('configuracion');
            $query = $this -> db -> get();
            $outQuery = $this->db->last_query();
            if ($this->session->userdata('logged_in')['id'] != null){
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
            }else{
                $this->auditoria->addActivity($outQuery, 'Anonimo', 'Configuracion');
            }

            return $query->result();
	}
        
        function getNoAdminConfiguraciones(){
		$this -> db -> from('configuracion');
		$this -> db -> not_like("propietario","ADMIN");
                
                $query = $this -> db -> get();
                
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
		return $query->result();
	}
        
        
	
	function delConfiguracion($identificador){
            $this->db->cache_delete_all();
            $result = $this->db->delete('configuracion', array('id' => $identificador));
            $outQuery = $this->db->last_query();
            $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
            return $result;
	}
	function getConfiguracion($nombre){
            $array  = $this->getConfiguraciones();
            foreach ($array as $value) {
                if ($value->atributo === $nombre){
                    return array($value);
                }
            }
        }
	
	function updateConfiguracion(){
            $this->db->cache_delete_all();
            $jsonObject = $this->input->post('updateData');
            $consult = null;
            foreach ($jsonObject as $value) {
                $data = array(
                    'atributo' => strtoupper($value['atributo']),		
                    'valor' => $value['valor'],
                    'descripcion' => strtoupper($value['descripcion']),
                    'propietario' => strtoupper($value['propietario']),
                );
                $this->db->where('id', $value['id']);
                $consult = $this->db->update('configuracion', $data);

            }
            $outQuery = $this->db->last_query();
            $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
            return $consult;
	}
	
}
?>