<?php

class Pedidos extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
        $this->load->model('pedido', '', TRUE);
        $this->load->model('cliente', '', TRUE);
        $this->load->spark('markdown-extra/0.0.0');
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

    public function addPedido() {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->pedido->addPedido();
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function updatePedido($id) {
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ClienteOrigen', 'ClienteOrigen', 'required');
            $this->form_validation->set_rules('Bultos', 'Bultos', 'required|numeric');
            $this->form_validation->set_rules('ClienteDestino', 'ClienteDestino', 'required');
            $this->form_validation->set_rules('valorDeclarado', 'valorDeclarado', 'numeric');
            $this->form_validation->set_rules('CostoFlete', 'CostoFlete', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->output->set_status_header('400'); //Triggers the jQuery error callback
            } else {
                $this->pedido->updatePedidos($id);
            }
        } else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

    public function delPedido($id) {
        if ($this->session->userdata('logged_in')) {
            $this->pedido->delPedido($id);
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
            $remitosIds = $this->input->post('remitosIds');
            $pedidos = $this->pedido->getPedidos($lafecha, $remitosIds);

            $this->load->library('TemplateRemitoPdf');
            $this->TemplateRemitoPdf = new TemplateRemitoPdf();
            $this->TemplateRemitoPdf->AddPage();

            foreach ($pedidos as $item) {
                $this->TemplateRemitoPdf->SetFont('Arial', 'B', 5);
                $this->TemplateRemitoPdf->Cell(200, 8, "Desarrollado por One more code - wrtfix@gmail.com - 249 - 4609270", 'B', 0, 'L', 0);
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
                    $this->TemplateRemitoPdf->Cell(100, 10, "Domicilio ", 0, 0, 'L');
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
                $this->TemplateRemitoPdf->Cell(30, 25, $item->Bultos, 0, 0, 'C');
                
                
                $comentarioBulto = $item->Bultos > 1 ? 'Bultos ' : 'Bulto ';
                $comentarioContrareembolso = $item->ContraReembolso == 1 ? 'Contra reembolso $'.$item->CostoFlete : '';
                
                if ($item->Comentarios != ""){
                    $this->TemplateRemitoPdf->Cell(130, 25, $comentarioBulto.$comentarioContrareembolso.$item->Comentarios, 0, 0, 'C');
                } else
                    $this->TemplateRemitoPdf->Cell(130, 25, $comentarioBulto.$comentarioContrareembolso , 0, 0, 'C');
                
                if (strpos($item->Observaciones, 'F/O') !== false ){
                    $this->TemplateRemitoPdf->Cell(30, 25, '', 0, 0, 'C');
                } else {
                    if (strpos($item->Observaciones, 'F/D') !== false ){
                        $this->TemplateRemitoPdf->Cell(30, 25, $item->CostoFlete, 0, 0, 'C');
                    }else{
                        $this->TemplateRemitoPdf->Cell(30, 25, '', 0, 0, 'C');
                    }
                }
                $this->TemplateRemitoPdf->Ln(15);
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
            }
            $nombre = "remitos" . $lafecha . '.pdf';

            $this->TemplateRemitoPdf->Output($nombre, 'I');
        }else {
            $data['page'] = 'construccion';
            $this->load->view('pages/construccion', $data);
        }
    }

}
