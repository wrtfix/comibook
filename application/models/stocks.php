<?php

class Stocks extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function addStock() {
        list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
        $data = array(
            'stockEntrada' => strtoupper($this->input->post('stockEntrada')),
            'stockSalida' => $this->input->post('stockSalida'),
            'fecha' => $ano . "-" . $mes . "-" . $dia,
            'idProducto' => $this->input->post('idProducto'),
            'minimo' => $this->input->post('minimo'),
        );

        return $this->db->insert('stock', $data);
    }

    function getStocks() {
        $this->db->from('stock')->join('productos', 'stock.idProducto = productos.numero');
        $query = $this->db->get();
//        print_r($this->db->last_query());
        return $query->result();
    }

    function delStocks($identificador) {
        return $this->db->delete('stock', array('idStock' => $identificador));
    }

    function getStock($fechaDesde, $fechaHasta) {
        $this->db->from('stock');
        if ($fechaDesde != ' ' && $fechaHasta != ' ') {
            list($dia, $mes, $ano) = explode("-", $fechaDesde);
            list($dia2, $mes2, $ano2) = explode("-", $fechaHasta);
            return $this->db->query("select * from stock where fecha BETWEEN '" . $ano . "-" . $mes . "-" . $dia . "' AND '" . $ano2 . "-" . $mes2 . "-" . $dia2 . "'")->result();
        }
        $query = $this->db->get();
        return $query->result();
    }

    function updateStock($id) {
        list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
        $data = array(
            'idProducto' => $this->input->post('idProducto'),
            'minimo' => $this->input->post('minimo'),
            'fecha' => $ano . "-" . $mes . "-" . $dia,
            'stockEntrada' => $this->input->post('stockEntrada'),
            'stockSalida' => $this->input->post('stockSalida'),
        );
        $this->db->where('idStock', $id);
        return $this->db->update('stock', $data);
    }

    function getChequeTotal($fechaDesde, $fechaHasta) {
        return $this->db->query("select sum(importe) as importe from cheques where fecha BETWEEN '" . $fechaDesde . "' AND '" . $fechaHasta . "'")->result();
    }
    
    function getProductoStocks($idProduct) {
        $this->db->from('stock')->join('productos', 'stock.idProducto = productos.numero')->where('stock.idProducto',$idProduct);
        $query = $this->db->get();
//        print_r($this->db->last_query());
        return $query->result();
    }

}

?>