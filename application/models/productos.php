<?php

class Productos extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
                $this->load->model('auditoria','',TRUE);
	}

	function addProducto()
	{
		$data = array(
			'nombre' => strtoupper($this->input->post('nombre')),
			'numero' => $this->input->post('numero'),
                        'peso' => $this->input->post('peso'),
                        'imagen' => $this->input->post('imagen'),
                        'precio' => $this->input->post('precio'),
                        'idLocal' => $this->input->post('idLocal'),
                        'idProveedor' => $this->input->post('idProvedor'),
                        'descripcion' => $this->input->post('descripcion')
		);
                $result = $this->db->insert('productos', $data);
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Agregar productos por local');
		return $result;
	}
	
	function delProducto($identificador){
		return $this->db->delete('productos', array('idProducto' => $identificador));
	}
        
        function getProductos(){
		$this -> db -> from('productos');
		$query = $this -> db -> get();
		return $query->result();
	}
        
	function getProductosByLocal($idLocal){
		$this -> db -> from('productos');
                $this-> db ->where('idLocal', $idLocal);
		$query = $this -> db -> get();
                $result = $query->result();
                $outQuery = $this->db->last_query();
                if ($this->session->userdata('logged_in') != null)
                    $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Listar productos por local');
                else{
                    $this->auditoria->addActivity($outQuery, 1, 'Listar productos por local');
                }
		return $result;
	}
        
        function getProductosPorLocalProveedor($idLocal){
		$this -> db -> from('productos');
                $this->db->join('clientes','clientes.Numero = productos.idProveedor','join');
                
                $this-> db ->where('idLocal', $idLocal);
                $this-> db ->where('clientes.tipo', 'PROVEDOR');
                $this -> db -> where('ambiente',$this->session->userdata('logged_in')['idAmbiente']);
                
		$query = $this -> db -> get();
                $result = $query->result();
                
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Listar productos por local');
                
		return $result;
	}
        
        
        function getProducto($id){
		$this -> db -> from('productos');
		$this-> db ->where('idProducto', $id);
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
                        'descripcion' => $this->input->post('descripcion'),
                        'idProveedor' => $this->input->post('idProvedor')
		);
		$this->db->where('idProducto', $id);
                return $this->db->update('productos', $data);
	}
}
?>