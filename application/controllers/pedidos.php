<?php

class Pedidos extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('configuraciones', '', TRUE);
        $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
        $this->load->model('pedido', '', TRUE);
        $this->load->model('cliente', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
        ini_set('memory_limit', '-1');
    }

    public function index($fecha = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            if ($fecha != null) {
                $data['fechaSeleccionada'] = $fecha;
                $lafecha = $fecha;
            } else {
                $data['fechaSeleccionada'] = null;
                $lafecha = $ano . "-" . $mes . "-" . $dia;
            }
            $data['page'] = 'pedidos';

            $data['agregados'] = $this->pedido->getPedidos($lafecha);
            $this->layout->view('pages/pedidos', $data);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
            
    function clienteWithOutInformation(){
        $clientes = $this->input->post('clientes');
        $response = [];
        foreach($clientes as $item): 
            $nombre = $item['nombre'];
            $result = $this->cliente->getCliente($nombre, ' ', ' ', ' ');
            if (empty($result)){
                array_push($response, $item);
            }
            
        endforeach;
        $data['clientes'] = $response;
        $this->layout->setLayout("layouts/empty");
        $this->layout->view('pages/nuevoDestino', $data);
        
        
    }

    public function addPedido() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            return $this->pedido->addPedido();
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updatePedido() {
        if ($this->session->userdata('logged_in')) {
            return $this->pedido->updatePedidos();
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delPedido($id) {
        if ($this->session->userdata('logged_in')) {
            return $this->pedido->delPedido($id);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function addComentario($id) {
        if ($this->session->userdata('logged_in')) {
            $this->pedido->addComentario($id);
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function generarPDF($fecha = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            if ($fecha != null) {
                $data['fechaSeleccionada'] = $fecha;
                $lafecha = $fecha;
            } else {
                $data['fechaSeleccionada'] = null;
                $lafecha = $ano . "-" . $mes . "-" . $dia;
            }
            $remitosIdsString =  $this->input->post('remitosIds');
            $remitosIds = json_decode($remitosIdsString);
            $pedidos = $this->pedido->getPedidos($lafecha, $remitosIds);
            
            $this->load->library('TemplateRemitoPdf');
            $this->TemplateRemitoPdf = new TemplateRemitoPdf();
            $this->TemplateRemitoPdf->AddPage();
            $cont =0;
            foreach ($pedidos as $item) {
                $cont = $cont + 1;
                
                
                
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 5);
                $this->TemplateRemitoPdf->Cell(200, 8, "Desarrollado por One more code - wrtfix@gmail.com - 249 - 4609270", 'T', 0, 'T', 0);
                $this->TemplateRemitoPdf->Ln('15');

                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 13);
                $this->TemplateRemitoPdf->Cell(5);

                $this->TemplateRemitoPdf->Cell(100, 10, "Diego Lopez", 0, 0, 'L');
                $this->TemplateRemitoPdf->Ln('5');


                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(100, 10, "Comisiones", 0, 0, 'L');
                $this->TemplateRemitoPdf->Cell(80, 10, "N: " . $item->Numero, 0, 0, 'R');
                $this->TemplateRemitoPdf->Ln(5);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(100, 10, "Servicio diario - Puerta a puerta", 0, 0, 'L');
                $this->TemplateRemitoPdf->Cell(80, 10, "Fecha: " . $lafecha, 0, 0, 'R');
                $this->TemplateRemitoPdf->Ln(5);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(100, 10, "Cargas generales - Mudanzas - Tramites", 0, 0, 'L');

                $this->TemplateRemitoPdf->Ln(5);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(200, 10, "Tandil - Azul - Olavarria | 0249 - 15 4698546 / 15 4390602", 0, 0, 'L');

                $this->TemplateRemitoPdf->Ln(10);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);

                $clienteOrigen = $this->cliente->getCliente($item->ClienteOrignen, ' ', ' ', ' ');
                $clienteDestino = $this->cliente->getCliente($item->ClienteDestino, ' ', ' ', ' ');

                $this->TemplateRemitoPdf->Cell(100, 10, "Remitente " . $item->ClienteOrignen, 0, 0, 'L');
                $this->TemplateRemitoPdf->Cell(100, 10, "Destinatario " . $item->ClienteDestino, 0, 0, 'L');
                $this->TemplateRemitoPdf->Ln(5);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                if (count($clienteOrigen) > 0) {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio " . $clienteOrigen[0]->Domicilio, 0, 0, 'L');
                } else {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio ", 0, 0, 'L');
                }
                
                
                if (count($clienteDestino) > 0) {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio " . $clienteDestino[0]->Domicilio, 0, 0, 'L');
                } else {
                    $extraInforCliente = $this->extraInfo($remitosIds,$item->Numero);
                    if ($extraInforCliente != null){
                        $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio ".strtoupper($extraInforCliente->domicilio). " Tel ".$extraInforCliente->telefono , 0, 0, 'L');
                    }else{
                        $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio ", 0, 0, 'L');
                    }
                    
                }
                $this->TemplateRemitoPdf->Ln(5);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 8);
                $this->TemplateRemitoPdf->Cell(5);
                if (count($clienteOrigen) > 0) {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Localidad " . $clienteOrigen[0]->Localidad, 0, 0, 'L');
                } else {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Localidad ", 0, 0, 'L');
                }
                if (count($clienteDestino) > 0) {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Localidad " . $clienteDestino[0]->Localidad, 0, 0, 'L');
                } else {
                    $this->TemplateRemitoPdf->Cell(100, 10, "Localidad ", 0, 0, 'L');
                }

                $this->TemplateRemitoPdf->Ln(10);

                $this->TemplateRemitoPdf->SetFillColor(200, 200, 200);
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 10);
                $this->TemplateRemitoPdf->Cell(5);


                $this->TemplateRemitoPdf->Cell(30, 7, "Cant. Bultos", 1, 0, 'C', true);
                $this->TemplateRemitoPdf->Cell(130, 7, "Descripcion", 1, 0, 'C', true);
                $this->TemplateRemitoPdf->Cell(30, 7, "Total", 1, 0, 'C', true);

                $this->TemplateRemitoPdf->Ln(7);

                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 9);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(30, 10, $item->Bultos, 0, 0, 'C');
                
                
                $comentarioBulto = $item->Bultos > 1 ? 'Bultos ' : 'Bulto ';
                $comentarioContrareembolso = $item->ContraReembolso == 1 ? 'Contra reembolso $'.$item->valorDeclarado : '';
                $comentario = $item->Comentarios;

                $this->TemplateRemitoPdf->Cell(130, 10, $comentarioBulto, 2, 0, 'C');

                if (strpos($item->Observaciones, 'F/O') !== false ){
                    $this->TemplateRemitoPdf->Cell(30, 10, '', 0, 0, 'C');
                } else {
                    if (strpos($item->Observaciones, 'F/D') !== false ){
                        $this->TemplateRemitoPdf->Cell(30, 10, $item->CostoFlete, 0, 0, 'C');
                    }else{
                        $this->TemplateRemitoPdf->Cell(30, 10, '', 0, 0, 'C');
                    }
                }
                
                if ($comentarioContrareembolso && $comentario != ""){
                    $this->TemplateRemitoPdf->Ln(5);
                    $this->TemplateRemitoPdf->Cell(5);
                    $this->TemplateRemitoPdf->Cell(30, 10, '', 0, 0, 'C');
                    $this->TemplateRemitoPdf->Cell(130, 10, $comentarioContrareembolso , 0, 0, 'C');
                }
                
                if ($comentario != ""){
                    $this->TemplateRemitoPdf->Ln(5);
                    $this->TemplateRemitoPdf->Cell(5);
                    $this->TemplateRemitoPdf->Cell(30, 10, '', 0, 0, 'C');
                    $this->TemplateRemitoPdf->Cell(130, 10, $comentario, 2, 0, 'C');
                }
                
                $this->TemplateRemitoPdf->Ln(5);
                if (strpos($item->Observaciones, 'F/O') !== false ){
                    $this->TemplateRemitoPdf->Cell(190, 40, "", 0, 0, 'R');
                }else{
                    if (strpos($item->Observaciones, 'F/D') !== false ){
                        $this->TemplateRemitoPdf->Cell(190, 40, "Total $: " . $item->CostoFlete, 0, 0, 'R');
                    }else{
                        $this->TemplateRemitoPdf->Cell(190, 40, '', 0, 0, 'R');
                    }
                }
                
                $this->TemplateRemitoPdf->Ln(25);
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(60, 10, "", 0, 0, 'L');
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(60, 10, "", 0, 0, 'L');
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(60, 10, "", 'B', 0, 'C', 0);
                $this->TemplateRemitoPdf->Ln(10);
                $this->TemplateRemitoPdf->Cell(62, 10, "", 0, 0, 'C');
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(62, 10, "", 0, 0, 'C');
                $this->TemplateRemitoPdf->Cell(5);
                $this->TemplateRemitoPdf->Cell(62, 10, "Firma", 0, 0, 'C');
                $this->TemplateRemitoPdf->Ln(10);
                
                $this->TemplateRemitoPdf->Cell(200, 8, "", 'T', 0, 'T', 0);
                $this->TemplateRemitoPdf->Ln('10');
                
                if ($cont >= 2){
                    $this->TemplateRemitoPdf->AddPage();
                    $cont = 0;
                }
                
            }
            $nombre = "remitos" . $lafecha . '.pdf';

            $this->TemplateRemitoPdf->Output($nombre, 'I');
        }else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }
    
    private function extraInfo($jsonObject, $id){
        $result = null;
        foreach ($jsonObject as $item):
            if ($id == $item->id){
                $result = $item;
            }
        endforeach;
        return $result;
    }
    
    
    public function generarPlanilla($fecha = null) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $hoy = date("Y-m-d");
            list($dia, $mes, $ano) = explode("-", $hoy);
            if ($fecha != null) {
                $data['fechaSeleccionada'] = $fecha;
                $lafecha = $fecha;
            } else {
                $data['fechaSeleccionada'] = null;
                $lafecha = $ano . "-" . $mes . "-" . $dia;
            }
            $remitosIds = $this->input->post('remitosIds');
            $pedidos = $this->pedido->getPedidos($lafecha, $remitosIds);

            $this->load->library('TemplatePdf');
            $this->TemplatePdf = new TemplatePdf();
            $this->TemplatePdf->setTitulos('Fecha: '.$fecha, ''); 
            
            $columnas = array('Origen', 'Bultos', 'Destino', 'Valor declarado', 'Contrareembolso', 'Pago Contra.?', 'Costo de Flete', 'Pago Flete?');
            $alineacion = array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C');
            $ancho = array(50, 15, 50, 30, 30, 30, 45, 25);
            $this->TemplatePdf->setTabla($columnas, $ancho, $alineacion);

            $this->TemplatePdf->AddPage();
            $this->TemplatePdf->AliasNbPages();
            $this->TemplatePdf->SetFont('Arial', 'B', 9);

            $x = 1;
            foreach ($pedidos as $item) {
                $this->TemplatePdf->Cell(50, 5, $item->ClienteOrignen, 'LRB', 0, 'C', 0);
                $this->TemplatePdf->Cell(15, 5, $item->Bultos, 'LRB', 0, 'C', 0);
                $this->TemplatePdf->Cell(50, 5, $item->ClienteDestino, 'LRB', 0, 'C', 0);
                $this->TemplatePdf->Cell(30, 5, $item->valorDeclarado, 'LRB', 0, 'C', 0);
                
                if ($item->ContraReembolso == 0)
                    $this->TemplatePdf->Cell(30, 5, 'No', 'LRB', 0, 'C', 0);
                else
                    $this->TemplatePdf->Cell(30, 5, 'Si', 'LRB', 0, 'C', 0);
                
                $this->TemplatePdf->Cell(30, 5, "", 'LRB', 0, 'C', 0);
                
                if (strpos($item->Observaciones, 'F/D') !== false ){
                    if ($item->ContraReembolso == 0){
                        $this->TemplatePdf->Cell(45, 5, "", 'LRB', 0, 'C', 0);    
                    }else{
                        $this->TemplatePdf->Cell(45, 5, $item->CostoFlete, 'LRB', 0, 'C', 0);    
                    }
                    
                }else{
                        $this->TemplatePdf->Cell(45, 5, "", 'LRB', 0, 'C', 0);
                }
                
                
                if ($item->Pago == 0)
                    $this->TemplatePdf->Cell(25, 5, '', 'LRB', 0, 'C', 0);
                else
                    $this->TemplatePdf->Cell(25, 5, '', 'LRB', 0, 'C', 0);
                $this->TemplatePdf->Ln(5);
            }
            
            $nombre = "remitos" . $lafecha . '.pdf';

            $this->TemplatePdf->Output($nombre, 'I');
        }else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
