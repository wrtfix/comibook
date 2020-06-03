<?php

class Cliente extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
                $this->load->model('auditoria','',TRUE);
	}

	function addCliente()
	{
		$data = array(
			'Nombre' => strtoupper($this->input->post('nombre')),
			'Numero' => $this->input->post('numero'),		
			'Domicilio' => strtoupper($this->input->post('domicilio')),
			'Localidad' => strtoupper($this->input->post('localidad')),
			'Telefono' => strtoupper($this->input->post('telefono')), 
			'Cuit' => strtoupper($this->input->post('cuit')),
                        'ambiente' => $this->session->userdata('logged_in')['idAmbiente']
		);
                
                $result = $query->result();
                $outQuery = $this->db->last_query();
                $this->auditoria->addActivity($outQuery, $this->session->userdata('logged_in')['id'], 'Alta de cliente');
		return $result;
	}
	
	function getClientes($tipo=null){
            
		$this -> db -> from('clientes');
                if($tipo==null){
                    $this -> db -> like("tipo","CLIENTE");
                }else{
                    $this -> db -> like("tipo",$tipo);
                }
                $this -> db -> where('ambiente',$this->session->userdata('logged_in')['idAmbiente']);
                
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getClientePorNumero($numero,$tipo){
            $this -> db -> from('clientes');
            $this -> db -> like("tipo",$tipo);
            $this -> db -> where('ambiente',$this->session->userdata('logged_in')['idAmbiente']);
            $this -> db -> where('Numero',$numero);
            $query = $this -> db -> get();
            
            $result = $query->result();
            $outQuery = $this->db->last_query();
            $this->auditoria->addActivity($outQuery, 1, 'Consulto cliente');

            return $result;
	}
	
	function delClientes($identificador){
		return $this->db->delete('clientes', array('id' => $identificador));
	}
	function getCliente($nombre,$cuil,$numero,$localidad, $tipo=null){
		$this -> db -> from('clientes');
		if ($nombre !=' ')
			$this -> db -> like("Nombre",$nombre);
		if ($cuil !=' ')
			$this -> db -> where("Cuit",$cuil);
		if ($numero !=' ')
			$this -> db -> like("Numero",$numero);
		if ($localidad !=' ')
			$this -> db -> like("Localidad",$localidad);
                if($tipo==null){
                    $this -> db -> like("tipo","CLIENTE");
                }else{
                    $this -> db -> like("tipo",$tipo);
                }
                if($this->session->userdata('logged_in')['idAmbiente'] !== null){
                    $this -> db -> where('ambiente',$this->session->userdata('logged_in')['idAmbiente']);
                }
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function getClientelLocalidad($nombre, $tipo=null){
		$this -> db -> from('clientes');
		$this -> db -> like("Localidad",$nombre);
                if($tipo==null){
                    $this -> db -> like("tipo","CLIENTE");
                }else{
                    $this -> db -> like("tipo",$tipo);
                }
                $this-> db -> where('ambiente', $this->session->userdata('logged_in')['idAmbiente']);
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