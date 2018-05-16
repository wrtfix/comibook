<?php

class Contenido extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addContenido()
	{
		$data = array(
			'idNoticia' => $this->input->post('idNoticia'),	
			'Contenido' => $this->input->post('contenido')
		);
		return $this->db->insert('contenido', $data);
	}

	function addRContenidoMenu($menuItems)
	{
		foreach($menuItems as $item) :
                        $nose = $item->idGasto;
                        $value =$this->input->post($nose);
			if (!empty($value)){
                            $data = array(
                                    'idNoticia' => $this->input->post('idNoticia'),	
                                    'idMenu' => $item->idGasto
                            );		
				$this->db->insert('rContenidoMenu', $data);
			}
		endforeach;

		return true;
	}
		
	function getContenido($idNoticia){
		$this -> db -> from('contenido');
		$this->db->where('idNoticia', $idNoticia);
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updateCliente($idContenido){
		$data = array(
			'Contenido' => $this->input->post('contenido')
		);
		$this->db->where('id', $idContenido);
        return $this->db->update('clientes', $data);
	}
}
?>