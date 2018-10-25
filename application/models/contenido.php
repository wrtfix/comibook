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
                                    'idMenu' => $item->idMenu
                            );		
			$this->db->insert('rContenidoMenu', $data);
			}
		endforeach;

		return true;
	}
        
        function deleteRContenidoMenu($idNoticia)
	{
            return $this->db->delete('rContenidoMenu', array('idNoticia' => $idNoticia));
	}
		
	function getContenido($idNoticia){
            $this->db->select('*');    
            $this->db->from('rContenidoMenu');
            $this->db->join('contenido', 'rContenidoMenu.idNoticia = contenido.idNoticia');
            $this->db->join('noticias', 'rContenidoMenu.idNoticia = noticias.idNoticia');
            $this->db->where('rContenidoMenu.idNoticia ='.$idNoticia);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
	}
        
        function getContenidoNoticia($idNoticia){
            $this->db->select('*');    
            $this->db->from('contenido');
            $this->db->where('contenido.idNoticia ='.$idNoticia);
            $query = $this->db->get();
            return $query->result();
	}
        
        function getItemMenu($idNoticia){
            $this->db->select('*');    
            $this->db->from('menu');
            $this->db->join('(SELECT * from rContenidoMenu WHERE rContenidoMenu.idNoticia ='.$idNoticia.') AS B','B.idMenu = menu.idMenu','left outer');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
	}
        
        function update(){
            $data = array(
                    'Contenido' => $this->input->post('contenido')
            );
            $this->db->where('idContenido', $this->input->post('idContenido'));
            return $this->db->update('contenido', $data);
	}
}
?>