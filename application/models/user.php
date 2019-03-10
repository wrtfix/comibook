<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('id, username, password, idAmbiente');
		$this -> db -> from('users');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
        function updateUser($id){
            $data = array(
			'username' => $this->input->post('nombre'),
			'password' => MD5($this->input->post('password')),		
		);
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
        }
        
        function addUser(){
            $data = array(
			'username' => $this->input->post('username'),
			'password' => MD5($this->input->post('password')),
			'email' =>  $this->input->post('email'),
			'telefono' =>  $this->input->post('tel')
		);
            return $this->db->insert('users', $data);
        }
        
        function getUsers(){
            $this -> db -> from('users');
            $query = $this -> db -> get();
            return $query->result();
        }
        
        function getUser($idUsuario){
            $this -> db -> from('users');
            $this->db->where('id', $idUsuario);
            $query = $this -> db -> get();
            return $query->result();
        }
        
        function delUser($id){
            return $this->db->delete('users', array('id' => $id));
        }
}
?>