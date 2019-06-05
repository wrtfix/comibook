<?php

class Pedido extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addPedido()
	{
		
                $jsonObject = $this->input->post('newData');
                $consult = null;
                foreach ($jsonObject as $value) {
                    list($dia, $mes, $ano) = explode("-", $value['fecha']);
                    $data = array(
			'Fecha' => $ano."-".$mes."-".$dia,
			'ClienteOrignen' => strtoupper($value['ClienteOrigen']),		
			'Bultos' => $value['Bultos'],
			'ClienteDestino' => strtoupper($value['ClienteDestino']),
			'valorDeclarado' => $value['valorDeclarado'],
			'Contrareembolso' => $value['Contrareembolso'],
			'CostoFlete' => $value['CostoFlete'],
			'Pago' => $value['Pago'],
			'Observaciones' => strtoupper($value['Observaciones']),
                    );
                    $consult = $this->db->insert('pedidos', $data);
                
                }
        	return $consult;
	}
	
	function getPedidoPedientes(){
		$this -> db -> from('pedidos');
		$this -> db -> like('pago','0');
		$query = $this -> db -> get();
		return $query->result();
	}
	
	function delPedido(){
                $jsonObject = $this->input->post('removeElem');
                $consult = null;
                foreach ($jsonObject as $value) {
                    $consult = $this->db->delete('pedidos', array('Numero' => $value['Numero']));
                }
		return $consult;
	}
	function getPedidosPedientes($nombre,$fechaDesde,$fechaHasta,$pediente){
		$this -> db -> from('pedidos');
		if (!empty($nombre) && empty($fechaDesde)  && empty($fechaHasta) && $pediente != 'No' ){
			return $this->db->query("select * from pedidos where Pago like '0' and ClienteOrignen like '%".$nombre."%' OR ClienteDestino like '%".$nombre."%'")->result();
		}
		
		$pen="";
		if ($pediente != 'No'){
			$pen = "Pago like '0' and" ;
			$this -> db -> where("Pago",0);
		}
		if (!empty($fechaDesde) && !empty($fechaHasta)){
			list($dia, $mes, $ano) = explode("-", $fechaDesde);
			list($dia2, $mes2, $ano2) = explode("-", $fechaHasta);
			if (!empty($nombre)){
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "' AND ( ClienteOrignen like '%".$nombre."%' OR ClienteDestino like '%".$nombre."%')")->result();
			}else{ 	
				return $this->db->query("select * from pedidos where ".$pen." fecha BETWEEN '".$ano."-".$mes."-".$dia."' AND '".$ano2."-".$mes2."-".$dia2. "'")->result();
			}
		}
		
		$this->db->order_by("numero", "desc"); 
		$query = $this -> db -> get();
		
		return $query->result();
	}
	
	function getPedidos($fecha,$ids=null){
		$this -> db -> from('pedidos');
		list($dia, $mes, $ano) = explode("-", $fecha);
                $consulta = "select * from pedidos where fecha = '".$ano."-".$mes."-".$dia. "'";
                if ($ids !=null){
                    $listaIds = str_replace(",","' OR Numero='",$ids);
                    $consulta = $consulta ." AND Numero='".$listaIds."'" ;
                }
                $consulta = $consulta." order by numero";
		return $this->db->query($consulta)->result();
	}
	
	
	function updatePedidos(){
                $jsonObject = $this->input->post('updateData');
                $consult = null;
                foreach ($jsonObject as $value) {
                    list($dia, $mes, $ano) = explode("-", $value['fecha']);
                    $data = array(
			'Fecha' => $ano."-".$mes."-".$dia,
			'ClienteOrignen' => strtoupper($value['ClienteOrigen']),		
			'Bultos' => $value['Bultos'],
			'ClienteDestino' => strtoupper($value['ClienteDestino']),
			'valorDeclarado' => $value['valorDeclarado'],
			'Contrareembolso' => $value['Contrareembolso'],
			'CostoFlete' => $value['CostoFlete'],
			'Pago' => $value['Pago'],
			'Observaciones' => strtoupper($value['Observaciones']),
                    );
                    $this->db->where('Numero', $value['Numero']);
                    $consult = $this->db->update('pedidos', $data);
                
                }
        	return $consult;
	}
        
        function addComentario($id){
            $data = array(
                    'Comentarios' => strtoupper($this->input->post('comentarios')),
            );
            $this->db->where('Numero', $id);
            return $this->db->update('pedidos', $data);
	}
        
        public function generarPDF($fecha){
			$this->load->library('TemplatePdf');
			// Creacion del PDF
		
			/*
			 * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			 * heredó todos las variables y métodos de fpdf
			 */
			$this->TemplatePdf = new TemplatePdf();
			
			if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
				$hoy = date("Y-m-d");
				list($dia, $mes, $ano) = explode("-", $hoy);
				$lafecha = $ano."-".$mes."-".$dia;
				$pedidos = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
				$gastos = $this->gasto->getGastoTotal($hoy,$hoy);
				$cheques = $this->cheque->getChequeTotal($hoy,$hoy);
				$this->TemplatePdf->setTitulos('Liquidacion','Correspondiente al dia '.$lafecha);
			}else{
				$n = str_replace("null"," ",$nombre);
				$h = str_replace("%20"," ",$n);
				$desde = str_replace("null"," ",$fechaDesde);
				$hasta = str_replace("null"," ",$fechaHasta);
				$pedidos = $this->pedido->getPedidosPedientes($h,$desde,$hasta,"No");
				if ($desde !=" " && $hasta !=" "){
					list($dia, $mes, $ano) = explode("-", $desde);
					$fd = $ano ."-".$mes."-".$dia;
					list($dia2, $mes2, $ano2) = explode("-", $hasta);
					$fh = $ano2."-".$mes2."-".$dia2;
					$fechaDesde = $fd;
					$fechaHasta = $fh;
					$gastos = $this->gasto->getGastoTotal($fd,$fh);
					$cheques = $this->cheque->getChequeTotal($fd,$fh);
					if ($desde!=$hasta)
						$this->TemplatePdf->setTitulos('Liquidacion','Correspondiente del dia '.$desde.' al dia '.$hasta);//espero que ande :P
					else 
						$this->TemplatePdf->setTitulos('Liquidacion','Correspondiente al dia '.$desde);//espero que ande :P
				}else{
						$cheques = null;
						$gastos = null;
						if ($n!=' ')
							$this->TemplatePdf->setTitulos('Liquidacion','Bajo el nombre '.$nombre);//espero que ande :P
						else 
							$this->TemplatePdf->setTitulos('Liquidacion','');//espero que ande :P
				}
			}
						
			
			$columnas = array('Fecha','Cliente Origen','Bultos','Cliente Destino','Valor declarado','Costo de Flete','Contrareembolso','Pago?','Observaciones');
			$alineacion = array('C','C','C','C','C','C', 'C', 'C', 'C');
			$ancho = array(20, 40, 15, 45,30,45,30,15,40);
			$this->TemplatePdf->setTabla($columnas, $ancho, $alineacion);
			
			// Agregamos una página
			$this->TemplatePdf->AddPage();
			// Define el alias para el número de página que se imprimirá en el pie
			$this->TemplatePdf->AliasNbPages();

			/* Se define el titulo, márgenes izquierdo, derecho y
			 * el color de relleno predeterminado
			 */
			//$this->TemplatePdf->SetFont('Arial','B',16);
			//$this->PdfAgencia->Cell(200,10,'Listado de Ciudades',0,0,'C');
			
			// Se define el formato de fuente: Arial, negritas, tamaño 9
			$this->TemplatePdf->SetFont('Arial', 'B', 9);
			/*
			 * TITULOS DE COLUMNAS
			 *
			 * $this->PdfAgencia->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			 */

			$x = 1;
			$total = 0;
			foreach ($pedidos as $item) {
				// se imprime el numero actual y despues se incrementa el valor de $x en uno
				//$this->PdfAgencia->Cell(15,5,$x++,'BL',0,'C',0);
				// Se imprimen los datos de cada ciudad
				$this->TemplatePdf->Cell(20,5,$item->Fecha,'B',0,'C',0);
				$this->TemplatePdf->Cell(40,5,$item->ClienteOrignen,'B',0,'C',0);
				$this->TemplatePdf->Cell(15,5,$item->Bultos,'B',0,'C',0);
				$this->TemplatePdf->Cell(45,5,$item->ClienteDestino,'B',0,'C',0);
				$this->TemplatePdf->Cell(30,5,$item->valorDeclarado,'B',0,'C',0);
				$this->TemplatePdf->Cell(45,5,$item->CostoFlete,'B',0,'C',0);
				if ($item->ContraReembolso==0)
					$this->TemplatePdf->Cell(30,5,'No','B',0,'C',0);
				else 
					$this->TemplatePdf->Cell(30,5,'Si','B',0,'C',0);
				if ($item->Pago ==0) 
					$this->TemplatePdf->Cell(15,5,'No','B',0,'C',0);
				else
					$this->TemplatePdf->Cell(15,5,'Si','B',0,'C',0);
				$this->TemplatePdf->Cell(40,5,$item->Observaciones,'B',0,'C',0);
				//Se agrega un salto de linea
				$this->TemplatePdf->Ln(5);
				$total=$total+$item->CostoFlete;
			}
			/*$this->TemplatePdf->SetFillColor(229, 229, 229); 
			$this->TemplatePdf->Ln(5);
			$this->TemplatePdf->Cell(20,5,"Saldo en mano: $".$total,0,0,'L',0);
			if ($cheques !=null && $cheques[0]->importe!=''){
				$this->TemplatePdf->Ln(5);
				$this->TemplatePdf->Cell(20,5,"Saldo en cheques: $".$cheques[0]->importe,0,0,'L',0);
			}
			if ($gastos !=null &&  $gastos[0]->importe!=''){
				$this->TemplatePdf->Ln(5);
				$this->TemplatePdf->Cell(20,5,"Gastos: $".$gastos[0]->importe,0,0,'L',0);
			}
			if ($gastos!=null)
				$resta = $total - $gastos[0]->importe;
			else 
				$resta = $total; */
			$this->TemplatePdf->Ln(5);
			$this->TemplatePdf->Cell(20,5,"Total: $".$total,0,0,'L',0);
			
			
			/*
			 * Se manda el pdf al navegador
			 *
			 * $this->pdf->Output(nombredelarchivo, destino);
			 *
			 * I = Muestra el pdf en el navegador
			 * D = Envia el pdf para descarga
			 *
			 */
			$this->TemplatePdf->Output("impresion.pdf", 'I');
	
	}
	
	
}
?>