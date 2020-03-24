<?php
Class Consultorios extends CI_Model
{
        function updateConsultorio($id){
            $data = array(
			'nombre' => $this->input->post('nombre'),
                        'direccion' => $this->input->post('direccion'),
                        'especialidad' => $this->input->post('especialidad'),
			'telefono' => $this->input->post('telefono'),
                        'horario' => $this->input->post('horario'),
                        'provee' => $this->input->post('provee'),
                        'imagen' =>  $this->input->post('imagen')
		);
            $this->db->where('idConsultorio', $id);
            return $this->db->update('consultorios', $data);
        }
        
        function addConsultorio(){
            $data = array(
			'nombre' => $this->input->post('nombre'),
                        'direccion' => $this->input->post('direccion'),
                        'especialidad' => $this->input->post('especialidad'),
			'telefono' => $this->input->post('telefono'),
			'horario' =>  $this->input->post('horario'),
                        'imagen' =>  $this->input->post('imagen'),
                        'provee' => $this->input->post('provee'),
                        'ambiente' => $this->session->userdata('logged_in')['idAmbiente']
		);
            return $this->db->insert('consultorios', $data);
        }
        
        function getConsultorios(){
            $this -> db -> from('consultorios');
            $this-> db -> where('ambiente' ,$this->session->userdata('logged_in')['idAmbiente']);
            $query = $this -> db -> get();
            return $query->result();
        }
        
        function getConsultoriosWithOutSession(){
            $this -> db -> from('consultorios');
            $query = $this -> db -> get();
            return $query->result();
        }
        
        function getConsultorio($idConsultorio){
            $this -> db -> from('consultorios');
            $this->db->where('idConsultorio', $idConsultorio);
            if ($this->session->userdata('logged_in')['idAmbiente'] !== null) {
                $this->db->where('ambiente', $this->session->userdata('logged_in')['idAmbiente']);
            }
            $query = $this -> db -> get();
            return $query->result();
        }
        
        function delConsultorio($id){
            return $this->db->delete('consultorios', array('idConsultorio' => $id));
        }
}
?>