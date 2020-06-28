<?php 
class Consultorio extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Contenidos");
		$this->load->model('consultorios','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')&& ($this->session->userdata('logged_in')['menu'][0]->peso === '50'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001'))
		{
			$this->load->library('form_validation');
                        if ($this->session->userdata('logged_in')['menu'][0]->peso !== '1000'){
                            $data['agregados'] = $this->consultorios->getConsultorios();
                        }else{
                            $data['agregados'] = $this->consultorios->getConsultoriosWithOutSession();
                        }
			
			$this->layout->view('pages/turnera/consultorio', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	public function addConsultorio(){
		if($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001'))
		{
			$this->load->library('form_validation');
			$this->consultorios->addConsultorio();
			$data['agregados'] = $this->consultorios->getConsultorios();
                        $this->layout->view('pages/turnera/consultorio', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function delConsultorio($id){
		if($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000' || $this->session->userdata('logged_in')['menu'][0]->peso === '1001'))
		{
			$this->load->library('form_validation');
			$this->consultorios->delConsultorio($id);
			$data['agregados'] = $this->consultorios->getConsultorios();
			$this->layout->view('pages/turnera/consultorio', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
	
	public function updateConsultorio(){
            if($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001'))
            {
                    $this->load->library('form_validation');
                    $jsonObject = $this->input->post('dataPost');
                    foreach ($jsonObject as $value) {
                        $result = $this->consultorios->updateConsultorio($value['id'],$value['nombre'],$value['direccion'],$value['especialidad'],$value['telefono'],$value['horario'],$value['provee'],$value['imagen']);
                    }
                    
	    }else{
                    $data['page'] = 'construccion';
                    $this->load->view('pages/construccion', $data);
	    }
	}
        
        public function selectConsultrio()
	{
		if($this->session->userdata('logged_in') && ($this->session->userdata('logged_in')['menu'][0]->peso === '30'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1000'  || $this->session->userdata('logged_in')['menu'][0]->peso === '1001'))
		{
			$this->load->library('form_validation');
			if ($this->session->userdata('logged_in')['menu'][0]->peso !== '1000'){
                            $data['agregados'] = $this->consultorios->getConsultorios();
                        }else{
                            $data['agregados'] = $this->consultorios->getConsultoriosWithOutSession();
                        }
			$this->layout->view('pages/turnera/consultorios', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        public function loadCard(){
            $this->layout->setLayout("layouts/empty");
            $this->layout->view('pages/turnera/consultorioCard');
        }
                
}
