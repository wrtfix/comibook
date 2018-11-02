<?php 
class Cheques extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('cheque','',TRUE);
		$this->load->model('cliente','',TRUE);
	}

	public function index($nombre=null,$fechaDesde=null,$fechaHasta=null)
	{
		$this->load->library('form_validation');
		$data['page'] = 'cheques';
		if ($nombre==null && $fechaDesde==null && $fechaHasta==null){
			$data['agregados'] =  $this->cheque->getCheques();
		}else{
			$n = str_replace("null"," ",$nombre);
			$desde = str_replace("null"," ",$fechaDesde);
			$hasta = str_replace("null"," ",$fechaHasta);
			$data['agregados'] = $this->cheque->getCheque($n,$desde,$hasta);
		}
		$this->layout->view('pages/cheques', $data);
	}
	
	public function addCheques(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('banco','banco','required');
	   	$this->form_validation->set_rules('importe','importe','required|numeric');
	   	$this->form_validation->set_rules('origen','origen','required');
	   	$this->form_validation->set_rules('fecha','fecha','required');
	   	$this->form_validation->set_rules('vencimiento','vencimiento','required');
	   	if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {		
			$result = $this->cheque->addCheque();	
        }
		$data['page'] = 'cheques';
		$data['agregados'] =  $this->cheque->getCheques();
		$this->layout->view('pages/cheques', $data);
	}
	
	public function delCheque($id){
		$this->load->library('form_validation');
		$result = $this->cheque->delCheques($id);	
		$data['page'] = 'cheque';
		$data['agregados'] =  $this->cheque->getCheques();
		$this->layout->view('pages/cheques', $data);
	}
	
	
	public function updateCheque($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('banco','banco','required');
	   	$this->form_validation->set_rules('importe','importe','required|numeric');
	   	$this->form_validation->set_rules('proviene','proviene','required');
	   	$this->form_validation->set_rules('fecha','fecha','required');
	   	$this->form_validation->set_rules('fechavto','vencimiento','required');
	   	if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header('400'); //Triggers the jQuery error callback
        } else {		
			$result = $this->cheque->updateCheques($id);
        }
	}
	
	public function getCliente($numero){
		$respuesta = json_encode($this->cliente->getCliente(" "," ",$numero," "));
		print_r($respuesta); 
		return $respuesta;			
	}
}
