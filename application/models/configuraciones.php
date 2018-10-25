<?php

class Configuraciones extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addConfiguracion()
	{
		$data = array(
			'atributo' => strtoupper($this->input->post('atributo')),
			'valor' => $this->input->post('valor'),
			'descripcion' => $this->input->post('descripcion'),
		);
		return $this->db->insert('configuracion', $data);
	}
	
	function getConfiguraciones(){
		$this -> db -> from('configuracion');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delConfiguracion($identificador){
		return $this->db->delete('configuracion', array('id' => $identificador));
	}
	function getConfiguracion($nombre){
		$this -> db -> from('configuracion');
		$this -> db -> like("atributo",$nombre);
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updateConfiguracion($id){
		$data = array(
			'atributo' => strtoupper($this->input->post('atributo')),
			'valor' => $this->input->post('valor'),
			'descripcion' => $this->input->post('descripcion'),
		);
		$this->db->where('id', $id);
        return $this->db->update('configuracion', $data);
	}
	
}
?>