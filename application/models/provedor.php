<?php

class Provedor extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addCliente()
	{
		$data = array(
			'Numero' => $this->input->post('numero'),	
			'Nombre' => strtoupper($this->input->post('nombre')),
			'Numero' => $this->input->post('numero'),		
			'Domicilio' => strtoupper($this->input->post('domicilio')),
			'Localidad' => strtoupper($this->input->post('localidad')),
			'Telefono' => strtoupper($this->input->post('telefono')), 
			'Cuit' => strtoupper($this->input->post('cuit')), 
                        'tipo' => 'PROVEDOR',
                        'ambiente' => $this->session->userdata('logged_in')['idAmbiente']
		);
		return $this->db->insert('clientes', $data);
	}
	
	function getClientes(){
		$this -> db -> from('clientes') ->like('tipo','PROVEDOR');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delClientes($identificador){
		return $this->db->delete('clientes', array('id' => $identificador));
	}
	function getCliente($nombre,$cuil,$numero,$localidad){
		$this -> db -> from('clientes');
		if ($nombre !=' ')
			$this -> db -> like("Nombre",$nombre);
		if ($cuil !=' ')
			$this -> db -> where("Cuit",$cuil);
		if ($numero !=' ')
			$this -> db -> like("Numero",$numero);
		if ($localidad !=' ')
			$this -> db -> like("Localidad",$localidad);
                
                $this -> db ->like('tipo','PROVEDOR');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function getClientelLocalidad($nombre){
		$this -> db -> from('clientes');
		$this -> db -> like("Localidad",$nombre);
                $this -> db -> like('tipo','PROVEDOR');
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
                $this -> db -> like('tipo','PROVEDOR');
        return $this->db->update('clientes', $data);
	}
}
?>