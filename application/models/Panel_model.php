<?php
	class Panel_model extends CI_Model{

		public function GetUser($id){
			$query = $this->db
			->select(["id","account_name","account_username","account_email","account_telp","account_company","account_status","account_level","updated_at","created_at"])
			->get_where("account",["id"=>$id]);
			if ($query->num_rows() == 0){
				return false;
			}else
				return $query->row();
		}
		public function GetUserbyUsername($users){
			$this->db->select('username,id,level,status,email,bio');
			$this->db->from('account');
			$this->db->where('username', $users);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return false;
			}else
				return $query->row();
		}
		public function GetUserStat($uid){
			$this->db->select('id');
			$this->db->from('comments');
			$this->db->where(array("id_user"=>$uid));
			$query = $this->db->get();
			$comm = $query->num_rows();
			$this->db->select('id');
			$this->db->from('solved');
			$this->db->where(array("id_user"=>$uid));
			$query = $this->db->get();
			$solved = $query->num_rows();
			return array("points"=>$this->GetUserPoint($uid),"solved"=>$solved,"comments"=>$comm);
		}
		public function GetUserPoint($uid){
			$this->db->select('sum(challenge.point) as hasil');
			$this->db->from('solved');
			$this->db->join('challenge', 'challenge.id = solved.id_challenge');
		 	$this->db->where(array("solved.id_user"=>$uid));
			$query = $this->db->get();
			return $query->row()->hasil;
		}
		public function GetChallenge($id){
			$this->db->select('challenge.id,challenge.id_author,challenge.title,challenge.msg,challenge.type,challenge.point,challenge.flag,challenge.created,challenge.status,account.username as author');
			$this->db->from('challenge');
			$this->db->join('account', 'account.id = challenge.id_author');
			$this->db->where('challenge.id', $id);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return false;
			}else
				return $query->row();
		}
		public function GetChallenges($where=""){
			$this->db->select('challenge.id,challenge.id_author,challenge.title,challenge.msg,challenge.type,challenge.point,challenge.flag,challenge.created,challenge.status,account.username as author');
			$this->db->from('challenge');
			$this->db->join('account', 'account.id = challenge.id_author');
			if($where) $this->db->where($where);
			//$this->db->order_by("id", "desc");
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return [];
			}else
				return $query->result();
		}
		public function GetComments($id){
			$this->db->select('comments.id,comments.id_user,comments.id_challenge,comments.comment,comments.tgl,account.username as author');
			$this->db->from('comments');
			$this->db->join('account', 'account.id = comments.id_user');
			$this->db->where('comments.id_challenge', $id);
			$this->db->order_by("id", "desc");
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return [];
			}else
				return $query->result();
		}
		public function GetSolvedByid($id){
			$this->db->select('*');
			$this->db->from('solved');
			$this->db->where('id', $id);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return false;
			}else
				return $query->row();
		}
		public function GetSolvedByChallenge($idch){
			$this->db->select('*');
			$this->db->from('solved');
			$this->db->where('id_challenge', $idch);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return [];
			}else
				return $query->result();
		}
		public function Is_Solved($id_ch,$id_user){
			$this->db->select('*');
			$this->db->from('solved');
			$this->db->where('id_challenge', $id_ch);
			$this->db->where('id_user', $id_user);
			$query = $this->db->get();
			if ($query->num_rows() == 0){
				return false;
			}else
				return $query->row()->id;
		}
		public function insertdata($table,$data){
			$this->db->insert($table,$data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
		public function updatedata($table,$where,$data){
			$this->db->update($table, $data, $where);
		}
		public function deletedata($table,$where){
			$this->db->delete($table, $where);
		}
	}

?>