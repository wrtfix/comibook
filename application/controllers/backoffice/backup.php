<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Backup extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('configuraciones', '', TRUE);
                $this->layout->placeholder("title", $this->configuraciones->getConfiguracion("SITE_NAME")[0]->valor);
		$this->load->model('backups','',TRUE);
		$this->load->spark('markdown-extra/0.0.0');
                $this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['page'] = 'backup';
                        $data['databaseLogs'] = $this->backups->getDatabaseLogs();
                        $this->load->library('form_validation');		
			$this->layout->view('pages/backoffice/backup', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
        
        public function generar()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['page'] = 'backup';
                        $this->load->library('form_validation');
			$data['agregados'] =  $this->backups->generarBackUp();
			$this->layout->view('pages/backoffice/backup', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);

		}
	}
        
        public function ejecutar($nombre){
	    $this->backups->ejecutarSQL($nombre);
            $this->layout->view('pages/backoffice/backup', $data);
        }
        
        public function restaurar(){
	    $this->backups->restoreDataBase();
            $this->layout->view('pages/backoffice/backup', $data);
        }
        
        public function eliminarDatabaseLog($nombre)
	{
		
		if($this->session->userdata('logged_in'))
		{
                        $data['databaseLogs'] = $this->backups->delDatabaseLog($nombre);
                        if(unlink("/opt/lampp/htdocs/saltaChequeado/database/".$nombre)) {
                            echo 'deleted successfully';
                        }
                        else {
                             echo 'errors occured';
                        }
                        
			$this->layout->view('pages/backoffice/backup', $data);
		}else{
			$data['page'] = 'construccion';
			$this->load->view('pages/construccion', $data);
		}
	}
        
        public function do_upload()
        {
            $config['upload_path']          = './database/';
            $config['allowed_types']        = 'txt';
            $config['max_size']             = 3000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $data['page'] = 'backup';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    $this->layout->view('pages/backup', $error);
            }
            else
            {       $results=$this->upload->data();
                    $data['results'] = $results;
                    $this->backups->addScript($results['file_name']);
                    $data['databaseLogs'] = $this->backups->getDatabaseLogs();
                    $this->layout->view('pages/backup', $data);
            }
    }
        
        

}
