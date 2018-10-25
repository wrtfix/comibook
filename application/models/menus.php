<?php

class Menus extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addMenu()
	{
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'peso' => $this->input->post('peso'),
			'grupo' => $this->input->post('grupo')
		);
		return $this->db->insert('menu', $data);
	}
	
	function getMenu(){
		$this -> db -> from('menu');
		$this -> db-> order_by('peso desc');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delMenu($identificador){
		return $this->db->delete('menu', array('idMenu' => $identificador));
	}

	function updateMenu($id){
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'grupo' => $this->input->post('grupo'),		
			'peso' => $this->input->post('peso'),
		);
		$this->db->where('idMenu', $id);
        return $this->db->update('menu', $data);
	}
	
}
?>