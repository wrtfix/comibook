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
		$data = array(
			'atributo' => strtoupper($this->input->post('atributo')),
			'valor' => $this->input->post('valor'),
			'descripcion' => $this->input->post('descripcion'),
		);
                $result = $this->db->insert('configuracion', $data);
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
		return $result;
	}
	
	function getConfiguraciones(){
		$this -> db -> from('configuracion');
		$query = $this -> db -> get();
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
		return $query->result();
	}
	
	function delConfiguracion($identificador){
            $result = $this->db->delete('configuracion', array('id' => $identificador));
            $outQuery = $this->db->last_query();
            $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Configuracion');
            return $result;
	}
	function getConfiguracion($nombre){
		$this -> db -> from('configuracion');
		$this -> db -> like("atributo",$nombre);
		$query = $this -> db -> get();
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, '0', 'Configuracion');
		return $query->result();
	}
	
	function updateConfiguracion(){
            $jsonObject = $this->input->post('updateData');
            $consult = null;
            foreach ($jsonObject as $value) {
                $data = array(
                    'atributo' => strtoupper($value['atributo']),		
                    'valor' => $value['valor'],
                    'descripcion' => strtoupper($value['descripcion']),
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