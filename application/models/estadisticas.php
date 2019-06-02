<?php

class Estadisticas extends CI_Model {
    private $arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
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
    
    function getImporteAcumuladosGastoTotal() {
        return $this->db->query("select sum(importe) as gastos from gastos")->result();
    }
    
    function getImporteAcumuladosPedidoTotal() {
        return $this->db->query("select sum(CostoFlete) as pedidos from pedidos")->result();
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
        list($ano, $mes, $dia) = explode("-", $hoy);
        $consulta = "select count(*) as pedidos from pedidos where fecha = '" . $ano . "-" . $mes . "-" . $dia . "'";
        return $this->db->query($consulta)->result();
    }
    
    function getMovimientoAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result = [];

        $consulta = "select sum(CostoFlete) as recaudado, MONTH(fecha) as mes from pedidos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha)";
        $aux = $this->db->query($consulta)->result();
        foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'total'=>$value->recaudado]);
        }    
        
        return json_encode($result);
    }
    
     function getGastoAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result = [];
        $consulta = "select sum(importe) as recaudado, MONTH(fecha) as mes from gastos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha) ";
        $aux = $this->db->query($consulta)->result();
        foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'total'=>$value->recaudado]);
        }    
         
        return json_encode($result);
    }
    
    function getPedidosAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result = [];
        $consulta = "select count(*) as recaudado, MONTH(fecha) as mes from pedidos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha)";
        $aux = $this->db->query($consulta)->result();
        foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'total'=>$value->recaudado]);
        }    
            
        return json_encode($result);
    }
    
    function getHistoricoMensual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result=[];
        
        for ($j=2014; $j<2020; $j++){
            $consulta = "select count(*) as recaudado, MONTH(fecha) as mes from pedidos where YEAR(fecha) = '" . $j . "' GROUP BY MONTH(fecha) ";
            $aux = $this->db->query($consulta)->result();
            foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'ano'=>$j ,'total'=>$value->recaudado]);
            }
        }
        
        return json_encode($result);
    }

    
    function getHistoricoGanadoMensual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result=[];
        
        for ($j=2014; $j<2019; $j++){
            $consulta = "select sum(CostoFlete) as recaudado, MONTH(fecha) as mes from pedidos where YEAR(fecha) = '" . $j . "' GROUP BY MONTH(fecha)";
            $aux = $this->db->query($consulta)->result();
            foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'ano'=>$j ,'total'=>$value->recaudado]);
            }
        }
        return json_encode($result);
    }
    
    function getHistoricoGastadoMensual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result=[];
        
        for ($j=2014; $j<2019; $j++){
            $consulta = "select sum(importe) as gastado, MONTH(fecha) as mes from gastos where YEAR(fecha) = '" . $j . "GROUP BY MONTH(fecha)";
            $aux = $this->db->query($consulta)->result();
            foreach ($aux as $value) {
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'ano'=>$j ,'total'=>$value->recaudado]);
            }
            
        }
        return json_encode($result);
    }
    
    function getGastosMensuales(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result = [];
        
        $consulta = "select count(*) as recaudado , MONTH(fecha) as mes from gastos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha) ";
        $aux = $this->db->query($consulta)->result();
        foreach ($aux as $value) {
            array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1], 'total'=>$value->recaudado]);
        }
        
        return json_encode($result);
    }
    
    function getGananciasMensuales(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result = [];
        
        $consulta = "select sum(importe) as recaudado , MONTH(fecha) as mes from gastos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha) ";
        $aux = $this->db->query($consulta)->result();

        $consulta = "select sum(CostoFlete) as recaudado, MONTH(fecha) as mes from pedidos where YEAR(fecha) = '" . $ano . "' GROUP BY MONTH(fecha)";
        $aux2 = $this->db->query($consulta)->result();
        foreach ($aux2 as $value) {
                $gasto = $this->getArrayValue($aux, $value->mes);
                $calculo = $value->recaudado - $gasto;
                array_push($result, ['mes'=>$this->arrayMeses[$value->mes-1],'total'=> $calculo]);
        } 
        return json_encode($result);
        
    }
    private function getArrayValue($gastos, $elem){
        foreach ($gastos as $value) {
            if ($elem === $value->mes){
                return $value->recaudado;
            }
        }
        return 0;
    }
    
    function getGananciaAnual(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        return $this->db->query("select sum(CostoFlete) as pedidos from pedidos where YEAR(fecha) = '" . $ano . "'")->result()[0]->pedidos - $this->db->query("select sum(importe) as gastos from gastos where YEAR(fecha) = '" . $ano . "'")->result()[0]->gastos;
    }
    
    function getAcumuladaFeleteMes(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $consulta = $this->db->query("select sum(CostoFlete) as pedidos from pedidos where YEAR(fecha) = '" . $ano . "' AND MONTH(fecha) = '". $mes . "'")->result()[0]->pedidos;
        return ;
    }
    
    function getAcumuladaGastoMes(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        return $this->db->query("select sum(importe) as gastos from gastos where YEAR(fecha) = '" . $ano . "' AND MONTH(fecha) = '". $mes . "'")->result()[0]->gastos;
    }
    
    
    function getGananciasAnuales(){
        
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $hoy = date("Y-m-d");
        list($ano, $mes, $dia) = explode("-", $hoy);
        $result=[];
        
        for ($j=2014; $j<$ano; $j++){
            $resultado = $this->db->query("select sum(CostoFlete) as pedidos from pedidos where YEAR(fecha) = '" . $j . "'")->result()[0]->pedidos - $this->db->query("select sum(importe) as gastos from gastos where YEAR(fecha) = '" . $j . "'")->result()[0]->gastos;
            array_push($result, ['ano'=>$j ,'total'=>$resultado]);
            
        }
        return json_encode($result);
        
    }
}

?>