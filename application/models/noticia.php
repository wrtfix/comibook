<?php

class Noticia extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addNoticia()
	{
            list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
            $data = array(
                    'fecha' => $ano."-".$mes."-".$dia,
                    'titulo' => $this->input->post('titulo'),		
                    'visitas' => $this->input->post('visitas'),
                    'resumen' => $this->input->post('resumen'),
                    'likes' => $this->input->post('likes'),
                    'unLikes' => $this->input->post('unLikes'),
                    'urlImage' => $this->input->post('urlImage'),
            );

            return $this->db->insert('noticias', $data);
	}
        
	function getNoticiasMasLeidas($filter=null, $fecha){
            if ($filter==null){
                $this -> db -> from('noticias');
                $this -> db-> where("fecha <=",$fecha);
            }else{
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('noticias.fecha <= ',$fecha)
                -> order_by('idNoticia desc');
            }
            $this -> db-> order_by('visitas desc');
            $query = $this -> db -> get();
            return $query->result();
	}

	function getNoticiasMasPopulares($filter=null,$fecha){
            
		if ($filter==null){
                    $this -> db -> from('noticias');
                    $this -> db-> where("fecha <=",$fecha);
                }else{
                    $this->db->select('*')
                    ->from('noticias')
                    ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                    ->where('rContenidoMenu.idMenu ='.$filter)
                    ->where('noticias.fecha <= ',$fecha);
                }
		$this -> db-> order_by('likes desc');
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getNoticiasRelacionadas($filter=null,$fecha){
		
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
		->where('noticias.fecha <= ',$fecha);
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getNoticia($idNoticia){
		$this -> db -> from('noticias');
                $this -> db -> where("idNoticia",$idNoticia);
		$query = $this -> db -> get();
		return $query->result();
	}
        
        function getNoticiaFecha($filter=null,$fecha){
            list($dia, $mes, $ano) = explode("-", $fecha);
            $lafecha = $ano."-".$mes."-".$dia;
            if ($filter==null){
                $this -> db -> from('noticias');
                $this -> db-> order_by('idNoticia desc');
                $this -> db-> where("fecha <=",$lafecha);
            }else{
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                -> where("fecha <=",$fecha)
                ->order_by('idNoticia desc');
            }
            $query = $this -> db -> get();          
            $result =$query->result();
            return $result;
	}
        
	function updateNoticia($id){
            list($dia, $mes, $ano) = explode("-", $this->input->post('fecha'));
            $data = array(
                    'fecha' => $ano."-".$mes."-".$dia,
                    'titulo' => $this->input->post('titulo'),		
                    'visitas' => $this->input->post('visitas'),
                    'resumen' => $this->input->post('resumen'),
                    'likes' => $this->input->post('likes'),
                    'unLikes' => $this->input->post('unLikes'),
                    'urlImage' => $this->input->post('urlImage'),
            );

            $this->db->where('idNoticia', $id);
            return $this->db->update('noticias', $data);
	}
	
        function updateVisita($idNoticia){
            return $this->db->query('UPDATE noticias SET visitas = visitas + 1 where idNoticia ='.$idNoticia);
	}
        
        function updateLike($idNoticia){
            return $this->db->query('UPDATE noticias SET likes = likes + 1 where idNoticia ='.$idNoticia);
	}
        
        function updateUnLike($idNoticia){
            return $this->db->query('UPDATE noticias SET unLikes = unLikes + 1 where idNoticia ='.$idNoticia);
	}
        
        public function get_current_page_records($limit, $start,$filter,$fecha) 
        {   
            $this->db->limit($limit, $start);
        
            if ($filter==null){
                $this -> db -> from('noticias');
                $this -> db-> where("fecha <=",$fecha);
                $this -> db-> order_by('idNoticia desc');
                
            }else{
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('noticias.fecha <= ',$fecha)
                ->order_by('idNoticia desc');
            }
            $query = $this -> db -> get();
            
            
            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }

                return $data;
            }

            return false;
        }
     
        public function get_total($filter,$fecha) 
        {
            if ($filter==null){
                $this->db->select('*');
                $this -> db -> from('noticias');
                $this -> db-> where("fecha <=",$fecha);
                $this -> db-> order_by('idNoticia desc');
            }else{
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                ->where('noticias.fecha <= ',$fecha)
                ->order_by('idNoticia desc');
            }
            $result = $this->db->count_all_results();
            
            return $result;
        }
        
        function delNoticia($identificador){
		return $this->db->delete('noticias', array('idNoticia' => $identificador));
	}
        
        function delNotificFecha($fecha){
            $this->db->where('fecha <=', $fecha);
            $this->db->delete('noticias');
	}
        
        
        function getPedidoPedientesMax($filter=null,$fecha,$max){
            $this -> db ->limit($max, 0);
            if ($filter==null){
                $this -> db -> from('noticias');
                $this -> db-> order_by('idNoticia desc');
                $this -> db-> where("fecha <=",$fecha);
            }else{
                $this->db->select('*')
                ->from('noticias')
                ->join('rContenidoMenu', 'noticias.idNoticia = rContenidoMenu.idNoticia')
                ->where('rContenidoMenu.idMenu ='.$filter)
                -> where("fecha <=",$fecha)
                ->order_by('idNoticia desc');
            }
            $query = $this -> db -> get();
            $result =$query->result();
            return $result;
	}

	
}
?>