<?php
	class Auth_model extends CI_Model{

		public function login($user,$pass){
			$query = $this->db->get_where('account', array('username' => $user));
			if ($query->num_rows() == 0){
				return false;
			}else{
				$result = $query->row();
				if(password_verify($pass,$result->password))return $result;
				return false;
			}
		}
		public function checkuser($user,$email){
			$this->db->select('*');
			$this->db->from('account');
			$this->db->where('username', $user);
			$this->db->or_where('email', $email);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return true;
			}else
				return false;
		}
		public function insertdata($table,$data){
			$this->db->insert($table,$data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}

	}

?>