<?php

class Comentarios extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addComentario($fecha)
	{
		$data = array(
			'Nombre' => strtoupper($this->input->post('nombre')),
			'Email' => $this->input->post('email'),		
			'Comentario' => $this->input->post('comentario'),
                        'idNoticia' => $this->input->post('idNoticia'),
			'Fecha' => $fecha,
		);
		return $this->db->insert('comentarios', $data);
	}
	
	function getComentarios($idNoticia){
		$this -> db -> from('comentarios') 
                ->where('idNoticia ='.$idNoticia);
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getUltimosComentarios($cantidad=0){
            
		$this -> db -> from('comentarios');
                $this-> db ->limit($cantidad,0);
                $this -> db-> order_by('fecha desc');
		$query = $this -> db -> get();
                $result = $query->result();
                
		return $result;
	}
	
	function deleteComentario($idComentario){
		return $this->db->delete('comentarios', array('idComentario' => $idComentario));
	}
        function deleteComentarioNoticia($idNoticia){
		return $this->db->delete('comentarios', array('idNoticia' => $idNoticia));
	}
	
}
?>