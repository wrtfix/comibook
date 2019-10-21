<?php

class Productos extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addProducto()
	{
		$data = array(
			'nombre' => strtoupper($this->input->post('nombre')),
			'numero' => $this->input->post('numero'),
                        'peso' => $this->input->post('peso'),
                        'imagen' => $this->input->post('imagen'),
                        'descripcion' => $this->input->post('descripcion')
		);
		return $this->db->insert('productos', $data);
	}
	
	function delProducto($identificador){
		return $this->db->delete('productos', array('idProducto' => $identificador));
	}
	function getProductos(){
		$this -> db -> from('productos');
		$query = $this -> db -> get();
		return $query->result();
	}
        
        
        function getProducto($id){
		$this -> db -> from('productos');
		$this-> db ->where('numero', $id);
                $query = $this -> db -> get();
		return $query->result();
	}
        
        function getProductoNombre($nombre){
		$this -> db -> from('productos');
		$this-> db ->like('nombre', $nombre);
                $query = $this -> db -> get();
                print_r($this->db->last_query());
		return $query->result();
	}
	
	function updateProducto($id){
		$data = array(
			'nombre' => strtoupper($this->input->post('nombre')),
			'numero' => $this->input->post('numero'),		
                        'peso' => $this->input->post('peso'),
                        'precio' => $this->input->post('precio'),
                        'imagen' => $this->input->post('imagen'),
                        'descripcion' => $this->input->post('descripcion')
		);
		$this->db->where('idProducto', $id);
        return $this->db->update('productos', $data);
	}
}
?>