<?php 
class Pedientes extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('pedido','',TRUE);
	}

	public function index()
	{
		$data['page'] = 'pedientes';
		$this->load->library('form_validation');
                
                $nombre = $this->input->post('nombreBusqueda');
                $fechaDesde = $this->input->post('desde');
                $fechaHasta = $this->input->post('hasta');
                
		if (empty($nombre) && empty($fechaDesde) && empty($fechaHasta)){
			$data['agregados'] =  $this->pedido->getPedidoPedientes();
			$data['nombre'] = "null";
			$data['fechaDesde'] = "null";
			$data['fechaHasta'] = "null";		
		}else{
			$n = str_replace("null"," ",$nombre);
			$h = str_replace("%20"," ",$n);
			$desde = str_replace("null"," ",$fechaDesde);
			$hasta = str_replace("null"," ",$fechaHasta);
			$data['agregados'] = $this->pedido->getPedidosPedientes($h,$desde,$hasta,"Si");
			$data['nombre'] = $h;
			$data['fechaDesde'] = $desde;
			$data['fechaHasta'] = $hasta;		
		}
		$this->layout->view('pages/pedientes', $data);
	}

	public function generarPDF(){
			$this->load->library('TemplatePdf');
			// Creacion del PDF
		
			/*
			 * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			 * heredó todos las variables y métodos de fpdf
			 */
			$this->TemplatePdf = new TemplatePdf();
                        
                                        
                        $nombre = $this->input->post('nombreBusqueda');
                        $fechaDesde = $this->input->post('desde');
                        $fechaHasta = $this->input->post('hasta');
			
			if (empty($nombre) && empty($fechaDesde) && empty($fechaHasta)){
				$hoy = date("Y-m-d");
				list($dia, $mes, $ano) = explode("-", $hoy);
				$lafecha = $ano."-".$mes."-".$dia;
				$pedidos = $this->pedido->getPedidosPedientes(' ',$lafecha,$lafecha,"No");
				$this->TemplatePdf->setTitulos('Pendientes','Correspondiente al dia '.$lafecha);
			}else{
				$n = str_replace("null"," ",$nombre);
				$h = str_replace("%20"," ",$n);
				
				$desde = str_replace("null"," ",$fechaDesde);
				$desde = str_replace("%20"," ",$desde); 

				$hasta = str_replace("null"," ",$fechaHasta);
				$hasta = str_replace("%20"," ",$hasta); 

				$pedidos = $this->pedido->getPedidosPedientes($h,$desde,$hasta,"No");
				if (!empty($desde) && !empty($hasta)){
					list($dia, $mes, $ano) = explode("-", $desde);
					$fd = $ano ."-".$mes."-".$dia;
					list($dia2, $mes2, $ano2) = explode("-", $hasta);
					$fh = $ano2."-".$mes2."-".$dia2;
					$fechaDesde = $fd;
					$fechaHasta = $fh;
					if ($desde!=$hasta)
						$this->TemplatePdf->setTitulos('Pendientes','Correspondiente del dia '.$desde.' al dia '.$hasta);//espero que ande :P
					else 
						$this->TemplatePdf->setTitulos('Pendientes','Correspondiente al dia '.$desde);//espero que ande :P
				}else{
						if (!empty($h))
							$this->TemplatePdf->setTitulos('Pendientes','Bajo el nombre '.$nombre);//espero que ande :P
						else 
							$this->TemplatePdf->setTitulos('Pendientes','');//espero que ande :P
				}
			}
						
			
			$columnas = array('Fecha','Cliente Origen','Cliente Destino','Importe en $');
			$alineacion = array('C','C','C','C');
			$ancho = array(20, 85, 85, 90);
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
				$this->TemplatePdf->Cell(85,5,$item->ClienteOrignen,'B',0,'C',0);
				$this->TemplatePdf->Cell(85,5,$item->ClienteDestino,'B',0,'C',0);
				$this->TemplatePdf->Cell(90,5,$item->CostoFlete,'B',0,'C',0);
				//Se agrega un salto de linea
				$this->TemplatePdf->Ln(5);
				$total=$total+$item->CostoFlete;
			}
			$this->TemplatePdf->Ln(5);
			$this->TemplatePdf->Cell(20,5,"Total: $".$total,0,0,'L',0);
			
			$this->TemplatePdf->Output("pedientes.pdf", 'I');
	
	}


}
