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
			'ClienteOrignen' => $this->input->post('ClienteOrigen'),		
			'Bultos' => $this->input->post('Bultos'),
			'ClienteDestino' => $this->input->post('ClienteDestino'),
			'valorDeclarado' => $this->input->post('valorDeclarado'),
			'Contrareembolso' => $this->input->post('Contrareembolso'),
			'CostoFlete' => $this->input->post('CostoFlete'),
			'Pago' => $this->input->post('Pago'),
			'Observaciones' => $this->input->post('Observaciones'),
		);
		
		return $this->db->insert('pedidos', $data);
	}
	
	function getPedidoPedientes(){
		$this -> db -> from('pedidos');
		$this -> db-> order_by('Fecha desc');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function getNoticiasMasLeidas(){
		$this -> db -> from('pedidos');
		$this -> db-> order_by('Bultos desc');
		$query = $this -> db -> get();
		return $query->result();
	}

	function getNoticiasMasPopulares(){
		$this -> db -> from('pedidos');
		$this -> db-> order_by('valorDeclarado desc');
		$query = $this -> db -> get();
		return $query->result();
	}

	function delPedido($identificador){
		return $this->db->delete('pedidos', array('Numero' => $identificador));
	}
	function getPedidosPedientes($nombre,$fechaDesde,$fechaHasta,$pediente){
		$this -> db -> from('pedidos');
		if ($nombre !=' '){
			$this -> db -> like("ClienteOrignen",$nombre);
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
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "' AND ClienteOrignen like '%".$nombre."%'")->result();
			}else{ 		
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "'")->result();
			}
		}
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function updatePedidos($id){
		list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
		$data = array(
			'Fecha' => $ano."-".$mes."-".$dia,
			'ClienteOrignen' => $this->input->post('ClienteOrigen'),		
			'Bultos' => $this->input->post('Bultos'),
			'ClienteDestino' => $this->input->post('ClienteDestino'),
			'valorDeclarado' => $this->input->post('valorDeclarado'),
			'Contrareembolso' => $this->input->post('Contrareembolso'),
			'CostoFlete' => $this->input->post('CostoFlete'),
			'Pago' => $this->input->post('Pago'),
			'Observaciones' => $this->input->post('Observaciones'),
		);
		$this->db->where('Numero', $id);
        return $this->db->update('pedidos', $data);
	}
	
	
}
?>