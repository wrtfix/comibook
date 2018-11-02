<?php

class Imagenes extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addImagen($nombre)
	{
		$data = array(
			'nombre' => $nombre
		);
		return $this->db->insert('imagenes', $data);
	}
	
	function getImagenes(){
		$this -> db -> from('imagenes');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delImagen($nombre){
		return $this->db->delete('imagenes', array('nombre' => $nombre));
	}
	
}
?>