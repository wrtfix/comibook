<?php

class Ambientes extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addAmbiente()
	{
		$data = array(
			'nombre' => $this->input->post('nombre'),
			
		);
		return $this->db->insert('ambiente', $data);
	}
        
        function getMenuConfig(){
            	$this -> db -> from('menu');
		$this -> db-> order_by('idMenu desc');
		$query = $this -> db -> get();
		return $query->result();
        }
        function getMenuConfigName($name){
            	$this -> db -> from('menu');
                $this -> db -> where('grupo like "'.$name.'"');
		$query = $this -> db -> get();
		return $query->result();
        }
	
	function getAmbiente(){
		$this -> db -> from('ambiente');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delAmbiente($identificador){
		return $this->db->delete('ambiente', array('idAmbiente' => $identificador));
	}

	function updateAmbiente($id){
		$data = array(
			'nombre' => $this->input->post('nombre'),
		);
		$this->db->where('idAmbiente', $id);
        return $this->db->update('ambiente', $data);
	}
        
        function getUsuarioMenuConfig($idUsuario){
            $this->db->select('*');    
            $this->db->from('menu');
            $this->db->join('(SELECT rUsuarioMenu.idMenu as `id`, rUsuarioMenu.idUsuario, rUsuarioMenu.idRUsuarioMenu from rUsuarioMenu WHERE rUsuarioMenu.idUsuario ='.$idUsuario.') AS B','B.id = menu.idMenu','left outer');
            $this -> db -> where('grupo not like "frontend"');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
	}
        
        function getUsuarioMenu($idUsuario){
            $this->db->select('*');    
            $this->db->from('menu');
            $this->db->join('(SELECT rUsuarioMenu.idMenu as `id`, rUsuarioMenu.idUsuario, rUsuarioMenu.idRUsuarioMenu from rUsuarioMenu WHERE rUsuarioMenu.idUsuario ='.$idUsuario.') AS B','B.id = menu.idMenu','join');
            $this -> db -> where('grupo not like "frontend"');
            $query = $this->db->get();
            $result = $query->result();
            return $result;
	}
        
        function addRUsuarioMenu($menuItems)
	{
		foreach($menuItems as $item) :
                        $nose = $item->idMenu;
                        $value =$this->input->post($nose);
			if (!empty($value)){
                            $data = array(
                                    'idUsuario' => $this->input->post('idUsuario'),	
                                    'idMenu' => $item->idMenu
                            );		
			$this->db->insert('rUsuarioMenu', $data);
			}
		endforeach;

		return true;
	}
        
        function getCountMenu($idUsuario){
            $this -> db -> from('rUsuarioMenu');
            $this -> db-> where('idUsuario like '.$idUsuario);
            $query = $this -> db -> get();
            return count($query->result());
        }
        
                
        function deleteRUsuarioMenu($idUsuario)
	{
            return $this->db->delete('rUsuarioMenu', array('idUsuario' => $idUsuario));
	}
	
}
?>