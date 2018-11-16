<?php

class Estadisticas extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getGastos() {
        $this->db->from('gastos');
        $query = $this->db->get();
        return $query->result();
    }

    function getClienteTotal() {
        return $this->db->query("select count(*) as clientes from clientes")->result();
    }
    
    function getGastoTotal() {
        return $this->db->query("select count(*) as gastos from gastos")->result();
    }

    function getPedidoPedientesTotal() {
        $this->db->from('pedidos');
        $this->db->like('pago', '0');
        $query = $this->db->get();
        return count($query->result());
    }

    function getPedidosTotal() {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $consulta = "select count(*) as pedidos from pedidos where fecha = '" . $dia . "-" . $mes . "-" . $ano . "'";
        return $this->db->query($consulta)->result();
    }
    
    function getMovimientoAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $result = [];
        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        for ($i=0; $i<12; $i++){
            $realMes = $mes - $i;
            $realAno = $dia;
            if ($realMes==0){
                $realAno = $realAno - 1;
                print_r($realAno);
                $realMes=12;
            }
            $consulta = "select sum(CostoFlete) as recaudado from pedidos where YEAR(fecha) = '" . $realAno . "' AND MONTH(fecha) = '" . $realMes . "'";
            $aux = $this->db->query($consulta)->result();
            array_push($result, ['mes'=>$arrayMeses[date($realMes-1)],'total'=>$this->db->query($consulta)->result()[0]->recaudado]);
        }
        return json_encode($result);
    }
    
    function getPedidosAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $result = [];
        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        for ($i=0; $i<12; $i++){
            $realMes = $mes - $i;
            $realAno = $dia;
            if ($realMes==0){
                $realAno = $realAno - 1;
                print_r($realAno);
                $realMes=12;
            }
            $consulta = "select count(*) as recaudado from pedidos where YEAR(fecha) = '" . $realAno . "' AND MONTH(fecha) = '" . $realMes . "'";
            $aux = $this->db->query($consulta)->result();
            array_push($result, ['mes'=>$arrayMeses[date($realMes-1)],'total'=>$this->db->query($consulta)->result()[0]->recaudado]);
        }
        return json_encode($result);
    }
    
    function getHistoricoMensual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($dia, $mes, $ano) = explode("-", $hoy);
        $result = [];
        $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        for ($j=2014; $j<2018; $j++){
            for ($i=0; $i<12; $i++){
                $realMes = $mes - $i;
                $realAno = $dia;
                if ($realMes==0){
                    $realAno = $realAno - 1;
                    print_r($realAno);
                    $realMes=12;
                }
                $consulta = "select count(*) as recaudado from pedidos where YEAR(fecha) = '" . $realAno . "' AND MONTH(fecha) = '" . $realMes . "'";
                $aux = $this->db->query($consulta)->result();
                array_push($result, ['mes'=>$arrayMeses[date($realMes-1)].$j,'total'=>$this->db->query($consulta)->result()[0]->recaudado]);
            }
        }
        return json_encode($result);
    }

}

?>