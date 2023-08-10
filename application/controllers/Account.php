<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{
	protected $access_namespace = "account";
	protected $session_access_namespace = "change_session";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		if (count($this->input->post()) > 0) {
			$this->db->update(
				'account',
				[
					"account_name" => $this->input->post("account_name"),
					"account_email" => $this->input->post("account_email"),
					"account_telp" => $this->input->post("account_telp")
				],
				["id" => $this->userdata->id]
			);
			$this->session->set_flashdata('msg', "Profile Saved!");
			redirect(base_url("account"));
			die();
		}
		$this->userdata->company_name = $this->db->get_where("company",["id"=>$this->userdata->account_company])->row()->company_name;
		$this->userdata->division_name = $this->db->get_where("division",["id"=>$this->userdata->account_division])->row()->division_name;
		
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/account/profile';
		$this->load->view('layout', $data);
	}
	public function change_session($act="as")
	{
		if($this->session->has_userdata('sistms_uid_master') && $this->session->userdata('sistms_uid_master')!=$this->session->userdata('sistms_uid')){
			if($act!="back") output_json(["status" => 403, "message" => "Please Back to your Original Session First"]);
		}else{
			if (!hasPermission($this, $this->session_access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
		}

		if($act=="switcher"){
			$data['company'] = $this->db->get_where("company",[])->result();
			$data['users'] = $this->db->get_where("account",["account_level >"=>1,"id <>"=>$this->userdata->id,"account_company"=>$data['company'][0]->id])->result();
			
			$this->load->view('panel/account/change_session', $data);
		}else if($act=="switcher-company"){
			$company_id = $this->input->post("company_id");
			$a = $this->db->select(["account.*","division_name"])
			->join("division","division.id=account.account_division")
			->get_where("account",["account_company"=>$company_id])->result();
			//"account_level >"=>1,"account.id <>"=>$this->userdata->id,
			$divisi = [];
			$temps = [];
			foreach ($a as $val) {
				if(!in_array($val->division_name,$divisi)) $divisi[] = $val->division_name;
			}
			foreach ($divisi as $div) {
				$temp = [];
				foreach ($a as $val) {
					if($val->division_name==$div)$temp[] = ["id"=>$val->id,"text"=>$val->account_name];
				}
				$temps[]= ["text"=>$div,"children"=>$temp];
			}
			output_json(["status" => 200,"data"=>$temps]);
		}else if($act=="as"){
			$target = $this->input->post("target");
			$target_data = $this->db->get_where("account",["id"=>$target])->row();
			if($target_data){
				$this->session->set_userdata(["sistms_uid"=>$target_data->id,"sistms_uid_master"=>$this->userdata->id]);
				output_json(["status" => 200]);
			}else{
				output_json(["status" => 404, "message" => "No Target Found!"]);
			}
		}else if($act=="back" && $this->session->has_userdata('sistms_uid_master')){
			if($target_data = $this->db->get_where("account",["id"=>$this->session->userdata('sistms_uid_master')])->row()){
				$this->session->set_userdata(["sistms_uid"=>$this->session->userdata('sistms_uid_master')]);
				redirect(base_url(""));
				return;
			}else{
				$this->session->sess_destroy();
				output_json(["status" => 403,"message"=>"Something is Wrong. Force Logout!"]);
			}
		}
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "log") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db->get_where("login_log", ["login_account" => $this->userdata->id])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "changepass" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db->update('account', [
				"account_password" => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
			], array('id' => $this->userdata->id));
			if ($a) output_json(["status" => 200]);
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "changepic" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db->update('account', [
				"account_pic" => $this->input->post("account_pic"),
			], array('id' => $this->userdata->id));
			if ($a) output_json(["status" => 200]);
			output_json(["status" => 0, "message" => "Error"]);
		}
	}
	public function password($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data = [];
		$this->load->view("panel/account/change_password", $data);
	}
	public function log($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['view'] = 'panel/account/login_log';
		$this->load->view('layout', $data);
	}
}
