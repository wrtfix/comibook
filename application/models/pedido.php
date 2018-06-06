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
	
        function getPedidoPedientes($filter=null,$fecha){
            if ($filter==null){
                $this -> db -> from('pedidos');
                $this -> db-> order_by('numero desc');
                $this -> db-> where("fecha <=",$fecha);
            }else{
                $this->db->select('*')
                ->from('pedidos')
                ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                -> where("fecha <=",$fecha)
                ->order_by('numero desc');
            }
            $query = $this -> db -> get();
            $result =$query->result();
            return $result;
	}
        
	function getNoticiasMasLeidas($filter=null, $fecha){
            if ($filter==null){
                $this -> db -> from('pedidos');
                $this -> db-> where("fecha <=",$fecha);
            }else{
                $this->db->select('*')
                ->from('pedidos')
                ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('pedidos.Fecha <= ',$fecha)
                -> order_by('numero desc');
            }
            $this -> db-> order_by('Bultos desc');
            $query = $this -> db -> get();
            return $query->result();
	}

	function getNoticiasMasPopulares($filter=null,$fecha){
		if ($filter==null){
                    $this -> db -> from('pedidos');
                    $this -> db-> where("fecha <=",$fecha);
                }else{
                    $this->db->select('*')
                    ->from('pedidos')
                    ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                    ->where('rContenidoMenu.idMenu ='.$filter)
                    ->where('pedidos.Fecha <= ',$fecha);
                }
		$this -> db-> order_by('valorDeclarado desc');
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getNoticiasRelacionadas($filter=null,$fecha){
		
                $this->db->select('*')
                ->from('pedidos')
                ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
		->where('pedidos.Fecha <= ',$fecha);
		$query = $this -> db -> get();
		return $query->result();
	}


	function delPedido($identificador){
		return $this->db->delete('pedidos', array('Numero' => $identificador));
	}
        
        function getNoticia($idNoticia){
		$this -> db -> from('pedidos');
                $this -> db -> where("numero",$idNoticia);
		$query = $this -> db -> get();
		return $query->result();
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
	
        function updateVisita($idNoticia){
            return $this->db->query('UPDATE pedidos SET Bultos = Bultos + 1 where numero ='.$idNoticia);
	}
        
        function updateLike($idNoticia){
            return $this->db->query('UPDATE pedidos SET valorDeclarado = valorDeclarado + 1 where numero ='.$idNoticia);
	}
        
        function updateUnLike($idNoticia){
            return $this->db->query('UPDATE pedidos SET CostoFlete = CostoFlete + 1 where numero ='.$idNoticia);
	}
        
        public function get_current_page_records($limit, $start,$filter,$fecha) 
        {   
            $this->db->limit($limit, $start);
        
            if ($filter==null){
                $this -> db -> from('pedidos');
                $this -> db-> where("fecha <=",$fecha);
                $this -> db-> order_by('numero desc');
                
            }else{
                $this->db->select('*')
                ->from('pedidos')
                ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('pedidos.Fecha <= ',$fecha)
                ->order_by('numero desc');
            }
            $query = $this -> db -> get();
            
            
            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }

                return $data;
            }

            return false;
        }
     
        public function get_total($filter,$fecha) 
        {
            if ($filter==null){
                $this->db->select('*');
                $this -> db -> from('pedidos');
                $this -> db-> where("fecha <=",$fecha);
                $this -> db-> order_by('numero desc');
            }else{
                $this->db->select('*')
                ->from('pedidos')
                ->join('rContenidoMenu', 'pedidos.numero = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('pedidos.Fecha <= ',$fecha)
                ->order_by('numero desc');
            }
            $result = $this->db->count_all_results();
            
            return $result;
        }
	
}
?>