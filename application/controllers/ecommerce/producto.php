<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Producto extends CI_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Sistema de Gestion de Pedidos");
		$this->load->spark('markdown-extra/0.0.0');
		$this->load->model('productos','',TRUE);
	}

	public function index()
	{
                $this->load->library('form_validation');
                $data['detalle']= $this->productos->getProducto($this->input->post('idProducto'));
                $this->layout->setLayout("layouts/empty");
                $this->layout->view('pages/ecommerce/producto', $data);
	}
        
        public function agregarProducto(){
            $data = array(
            'id' => $this->input->post('product_id'), 
            'name' => $this->input->post('product_name'), 
            'price' => $this->input->post('product_price'), 
            'qty' => $this->input->post('quantity'), 
            );
            $this->cart->insert($data);
            echo $this->show_cart(); 
        
        }

        
}
