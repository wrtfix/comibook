<?php

class Gasto extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addGasto()
	{
		//list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
		
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'importe' => $this->input->post('importe')
			//'fecha' => $ano."-".$mes."-".$dia
		);
		
		return $this->db->insert('gastos', $data);
	}
	
	function getGastos(){
		$this -> db -> from('gastos');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delGastos($identificador){
		return $this->db->delete('gastos', array('idGasto' => $identificador));
	}
	function getGasto($nombre,$fechaDesde,$fechaHasta){
		$this -> db -> from('gastos');
		if ($nombre !=' ')
			$this -> db -> like("nombre",$nombre);
		if ($fechaDesde !=' ' && $fechaHasta !=' '){
			list($dia, $mes, $ano) = explode("-", $fechaDesde);
			list($dia2, $mes2, $ano2) = explode("-", $fechaHasta);
			if ($nombre !=' ')
				return $this->db->query("select * from gastos where fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "' AND nombre like '".$nombre."'")->result();
			else{ 				
				return $this->db->query("select * from gastos where fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "'")->result();
			}
		}
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updateGastos($id){
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'fecha' => $this->input->post('fecha'),		
			'importe' => strtoupper($this->input->post('importe')),
		);
		$this->db->where('idGasto', $id);
        return $this->db->update('gastos', $data);
	}
	
	function  getGastoTotal($fechaDesde,$fechaHasta){
		return $this->db->query("select sum(importe) as importe from gastos where fecha BETWEEN '".$fechaDesde."' AND '".$fechaHasta."'")->result();
	}
}
?>