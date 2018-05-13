<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imprimir extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->model('pedido','',TRUE);
		$this->load->model('gasto','',TRUE);
		$this->load->model('cheque','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->helper(array('form', 'url'));
	}

	public function index($nombre=null,$fechaDesde=null,$fechaHasta=null)
	{
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');
			$data['page'] = 'imprimir';
			$hoy = date("Y-m-d");
			list($dia, $mes, $ano) = explode("-", $hoy);
			$lafecha = $ano."-".$mes."-".$dia;
			if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
				$data['agregados'] = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
				$data['gasto'] = $this->gasto->getGastoTotal($hoy,$hoy);
				$data['cheque'] = $this->cheque->getChequeTotal($hoy,$hoy);
				$data['nombre'] = "%20";
					$data['fechaDesde'] = "%20";
					$data['fechaHasta'] = "%20";
			}else{
				$n = str_replace("%20"," ",$nombre);
				$desde = str_replace("%20"," ",$fechaDesde);
				$hasta = str_replace("%20"," ",$fechaHasta);
				$data['agregados'] = $this->pedido->getPedidosPedientes($n,$desde,$hasta,"No");
				$data['nombre'] = $nombre;
				if ($desde !=" " && $hasta !=" "){
					list($dia, $mes, $ano) = explode("-", $desde);
					$fd = $ano ."-".$mes."-".$dia;
					list($dia2, $mes2, $ano2) = explode("-", $hasta);
					$fh = $ano2."-".$mes2."-".$dia2;
					$fechaDesde = $fd;
					$fechaHasta = $fh;
					$data['gasto'] = $this->gasto->getGastoTotal($fd,$fh);
					$data['cheque'] = $this->cheque->getChequeTotal($fd,$fh);
					$data['fechaDesde'] = $desde;
					$data['fechaHasta'] = $hasta;
				}else{
					$data['gasto'] =null;
					$data['cheque'] =null;
					$data['fechaDesde'] = "%20";
					$data['fechaHasta'] = "%20";
					
				}
				
			}
			$this->layout->view('pages/imprimir', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	
	public function generarPDF($nombre=null,$fechaDesde=null,$fechaHasta=null){
		if($this->session->userdata('logged_in'))
		{
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
				$this->TemplatePdf->setTitulos('Liquidacion','Correspondiente al dia '.$lafecha);//espero que ande :P
			}else{
				$n = str_replace("%20"," ",$nombre);
				$desde = str_replace("%20"," ",$fechaDesde);
				$hasta = str_replace("%20"," ",$fechaHasta);
				$pedidos = $this->pedido->getPedidosPedientes($n,$desde,$hasta,"No");
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
			$this->TemplatePdf->SetFillColor(229, 229, 229); 
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
				$resta = $total; 
			$this->TemplatePdf->Ln(5);
			$this->TemplatePdf->Cell(20,5,"Total: $".$resta,0,0,'L',0);
			
			
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
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
			
		}
	}
	
	public function do_upload()
    {
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $data['page'] = 'imprimir';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    $this->layout->view('pages/imprimir', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $data['results'] = $data;
                    $this->layout->view('pages/imprimir', $data);
            }
    }

}
