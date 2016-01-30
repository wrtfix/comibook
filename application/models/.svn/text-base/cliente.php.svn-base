<?php

class Cliente extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addCliente()
	{
		$data = array(
			'id' => $this->input->post('numero'),	
			'Nombre' => strtoupper($this->input->post('nombre')),
			'Numero' => $this->input->post('numero'),		
			'Domicilio' => strtoupper($this->input->post('domicilio')),
			'Localidad' => strtoupper($this->input->post('localidad')),
			'Telefono' => strtoupper($this->input->post('telefono')), 
			'Cuit' => strtoupper($this->input->post('cuit')), 
		);
		return $this->db->insert('clientes', $data);
	}
	
	function getClientes(){
		$this -> db -> from('clientes');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delClientes($identificador){
		return $this->db->delete('clientes', array('id' => $identificador));
	}
	function getCliente($nombre,$cuil,$numero){
		$this -> db -> from('clientes');
		if ($nombre !=' ')
			$this -> db -> like("nombre",$nombre);
		if ($cuil !=' ')
			$this -> db -> where("cuit",$cuil);
		if ($numero !=' ')
			$this -> db -> where("numero",$numero);
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updateCliente($id){
		$data = array(
			'Nombre' => $this->input->post('nombre'),
			'Numero' => $this->input->post('numero'),		
			'Domicilio' => strtoupper($this->input->post('domicilio')),
			'Localidad' => strtoupper($this->input->post('localidad')),
			'Telefono' => strtoupper($this->input->post('telefono')), 
			'Cuit' => strtoupper($this->input->post('cuit')), 
		);
		$this->db->where('id', $id);
        return $this->db->update('clientes', $data);
	}
}
?>