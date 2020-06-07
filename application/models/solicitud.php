<?php

class Solicitud extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addSolicitud()
	{
		$data = array(
			'nombre' => strtoupper($this->input->post('nombre')),
			'telefono' => $this->input->post('telefono'),		
			'email' => strtoupper($this->input->post('email')),
                        'domicilio' => strtoupper($this->input->post('domicilio')),
                        'formaPago' => strtoupper($this->input->post('formaPago')),
                        'idLocal'=> $this->input->post('idLocal'),
		);
		
		return $this->db->insert('solicitudes', $data);
	}
        
        function getSolicitudProductos(){
            $this -> db -> from('solicitudes');
            $query = $this -> db -> get();
            return $query->result();
	}
        
        function getSolicitudProductosPorLocal($idLocal){
            $this -> db -> from('solicitudes');
            $this->db->where('idLocal', $idLocal);
            $query = $this -> db -> get();
            return $query->result();
	}
	
	function getCheques(){
		$this -> db -> from('cheques');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delCheques($identificador){
		return $this->db->delete('cheques', array('id' => $identificador));
	}
	function getCheque($nombre,$fechaDesde,$fechaHasta){
		$this -> db -> from('cheques');
		if ($nombre !=' ')
			$this -> db -> like("proviene",$nombre);
		if ($fechaDesde !=' ' && $fechaHasta !=' '){
			list($dia, $mes, $ano) = explode("-", $fechaDesde);
			list($dia2, $mes2, $ano2) = explode("-", $fechaHasta);
			if ($nombre !=' ')
				return $this->db->query("select * from cheques where fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "' AND nombre like '".$nombre."'")->result();
			else{ 				
				return $this->db->query("select * from cheques where fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "'")->result();
			}
		}
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updateCheques($id){
		list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
		list($dia2, $mes2, $ano2) = explode("-", $this->input->post('fechavto'));
		$data = array(
			'banco' => strtoupper($this->input->post('banco')),
			'importe' => $this->input->post('importe'),		
			'fecha' => $ano."-".$mes."-".$dia,
			'fechavto' => $ano2."-".$mes2."-".$dia2,
			'proviene' => $this->input->post('proviene'),
			'entregado' => $this->input->post('entregado'),
		);
		$this->db->where('id', $id);
        return $this->db->update('cheques', $data);
	}
	
	function  getChequeTotal($fechaDesde,$fechaHasta){
		return $this->db->query("select sum(importe) as importe from cheques where fecha BETWEEN '".$fechaDesde."' AND '".$fechaHasta."'")->result();
	}
}
?>