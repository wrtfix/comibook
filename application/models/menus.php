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
			'grupo' => $this->input->post('grupo'),
                        'code' => $this->input->post('code')
		);
		return $this->db->insert('menu', $data);
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
	
	function getMenu(){
		$this -> db -> from('menu');
                $this -> db -> where('grupo like "frontend"');
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
                        'code' => $this->input->post('code'),
		);
		$this->db->where('idMenu', $id);
        return $this->db->update('menu', $data);
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
        
        function addItemRusuarioMenu($idUsuario, $idMenu){
            $data = array(
                    'idUsuario' => $idUsuario,	
                    'idMenu' => $idMenu
            );		
            $this->db->insert('rUsuarioMenu', $data);
            
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