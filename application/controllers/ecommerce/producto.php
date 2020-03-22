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
            $respuesta = json_encode($this->listarCart());
            print_r($respuesta);
            return  $respuesta;
        
        }
        
        public function listarCart(){
            $respuesta = [];
            foreach ($this->cart->contents() as $items) {
                $elem = new stdClass();
                $elem->name = $items['name'];
                $elem->price = $items['price'];
                $elem->qty = $items['qty'];
                $elem->subtotal = $items['subtotal'];
                $elem->rowid = $items['rowid'];            
                array_push($respuesta,$elem);
            }
            return $respuesta;
        }
        
        public function detalleCart(){
            $respuesta = new stdClass();
            $respuesta->list = $this->listarCart();
            $respuesta->total = $this->cart->total();
            $respuesta = json_encode($respuesta);
            print_r($respuesta);
            return  $respuesta;
        }
        
        public function detalleCartView(){
            $this->layout->setLayout("layouts/empty");
            $data['agregados'] = $this->listarCart();
            $data['total'] = $this->cart->total();
            $this->layout->view('pages/ecommerce/productoList', $data);
        }
        
        public function borrarItem(){
            $data = array(
                'rowid' => $this->input->post('row_id'), 
                'qty' => 0, 
            );
            $this->cart->update($data);
        }


        
}
