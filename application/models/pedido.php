<?php

class Pedido extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addPedido()
	{
		list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
		$data = array(
			'Fecha' => $ano."-".$mes."-".$dia,
			'ClienteOrignen' => strtoupper($this->input->post('ClienteOrigen')),		
			'Bultos' => $this->input->post('Bultos'),
			'ClienteDestino' => strtoupper($this->input->post('ClienteDestino')),
			'valorDeclarado' => $this->input->post('valorDeclarado'),
			'Contrareembolso' => $this->input->post('Contrareembolso'),
			'CostoFlete' => $this->input->post('CostoFlete'),
			'Pago' => $this->input->post('Pago'),
			'Observaciones' => strtoupper($this->input->post('Observaciones')),
		);
		
		return $this->db->insert('pedidos', $data);
	}
	
	function getPedidoPedientes(){
		$this -> db -> from('pedidos');
		$this -> db -> like('pago','0');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delPedido($identificador){
		return $this->db->delete('pedidos', array('Numero' => $identificador));
	}
	function getPedidosPedientes($nombre,$fechaDesde,$fechaHasta,$pediente){
		$this -> db -> from('pedidos');
		if ($nombre !=' ' && $fechaDesde ==' ' && $fechaHasta ==' '){
			return $this->db->query("select * from pedidos where ClienteOrignen like '%".$nombre."%' OR ClienteDestino like '%".$nombre."%'")->result();
		}
		
		$pen="";
		if ($pediente != 'No'){
			$pen = "Pago like '0' and" ;
			$this -> db -> where("Pago",0);
		}
		if ($fechaDesde !=' ' && $fechaHasta !=' '){
			list($dia, $mes, $ano) = explode("-", $fechaDesde);
			list($dia2, $mes2, $ano2) = explode("-", $fechaHasta);
			if ($nombre !=' '){
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "' AND ( ClienteOrignen like '%".$nombre."%' OR ClienteDestino like '%".$nombre."%')")->result();
			}else{ 	
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "'")->result();
			}
		}
		
		$this->db->order_by("numero", "desc"); 
		$query = $this -> db -> get();
		
		return $query->result();
	}
	
	function getPedidos($fecha){
		$this -> db -> from('pedidos');
		list($dia, $mes, $ano) = explode("-", $fecha);
		return $this->db->query("select * from pedidos where fecha = '".$ano."-".$mes."-".$dia. "' order by numero")->result();
	}
	
	
	function updatePedidos($id){
		list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
		$data = array(
			'Fecha' => $ano."-".$mes."-".$dia,
			'ClienteOrignen' => strtoupper($this->input->post('ClienteOrigen')),		
			'Bultos' => $this->input->post('Bultos'),
			'ClienteDestino' => strtoupper($this->input->post('ClienteDestino')),
			'valorDeclarado' => $this->input->post('valorDeclarado'),
			'Contrareembolso' => $this->input->post('Contrareembolso'),
			'CostoFlete' => $this->input->post('CostoFlete'),
			'Pago' => $this->input->post('Pago'),
			'Observaciones' => strtoupper($this->input->post('Observaciones')),
		);
		$this->db->where('Numero', $id);
        return $this->db->update('pedidos', $data);
	}
	
	
}
?>