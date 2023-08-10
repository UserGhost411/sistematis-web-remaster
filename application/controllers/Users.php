<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	protected $access_namespace = "users_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/users/list_user';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}

			$a = $this->db->select(["account.id as id", "account_name", "account_username", "division_name", "account_email", "account_telp", "company_name", "account_status", "privilege_name", "account.created_at"])
				->join("privilege", 'privilege.id = account.account_level')
				->join("company", 'company.id = account.account_company')
				->join("division", 'division.id = account.account_division')
				->get_where("account", ($this->userdata->account_level == 1 ? [] : ["account_level >" => 1]))->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "division" && $param != "") {
			$a = $this->db->get_where("division", ["division_company" => $param])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) output_json(["status" => 403, "message" => "Accces Denied"]);

			$a = $this->db->insert('account', [
				"account_username" => $this->input->post("account_username", true),
				"account_name" => $this->input->post("account_name", true),
				"account_status" => $this->input->post("account_status"),
				"account_level" => $this->input->post("account_level"),
				"account_company" => $this->input->post("account_company"),
				"account_division" => $this->input->post("account_division"),
				"account_telp" => $this->input->post("account_telp"),
				"account_email" => $this->input->post("account_email"),
				"account_password" => password_hash($this->input->post("account_password"), PASSWORD_BCRYPT),
			]);
			if ($a) output_json(["status" => 200]);
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "pass" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db->update('account', [
				"account_password" => password_hash($this->input->post("password"), PASSWORD_BCRYPT),
			], array('id' => $this->input->post("account_id")));
			if ($a) output_json(["status" => 200]);

			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);

			$a = $this->db->update('account', [
				"account_username" => $this->input->post("account_username", true),
				"account_name" => $this->input->post("account_name", true),
				"account_status" => $this->input->post("account_status"),
				"account_level" => $this->input->post("account_level"),
				"account_company" => $this->input->post("account_company"),
				"account_division" => $this->input->post("account_division"),
				"account_telp" => $this->input->post("account_telp"),
				"account_email" => $this->input->post("account_email"),
			], array('id' => $this->input->post("account_id")));
			if ($a) output_json(["status" => 200]);
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) output_json(["status" => 403, "message" => "Accces Denied"]);

			$this->db->delete('account', array('id' => $this->input->post("account_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['userdata'] = $this->panel->GetUser($uid);
		$data['company'] = $this->db->get_where("company", [])->result();
		$data['division'] = $this->db->get_where("division", ["division_company" => $data['userdata']->account_company])->result();
		$data['level'] =  $this->db->get_where("privilege", ($this->userdata->account_level == 1 ? [] : ["id >" => 1]))->result();
		$this->load->view("panel/users/edit_user", $data);
	}
	public function pass($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}

		$data['data'] = $this->panel->GetUser($uid);
		$this->load->view("panel/users/change_password", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['company'] = $this->db->get_where("company", [])->result();
		$data['division'] = $this->db->get_where("division", ["division_company" => $data['company'][0]->id])->result();
		$data['level'] =  $this->db->get_where("privilege", ($this->userdata->account_level == 1 ? [] : ["id >" => 1]))->result();
		$this->load->view("panel/users/add_user", $data);
	}
	public function errorx()
	{
		http_response_code(404);
		$data['code'] = 404;
		$this->load->view("layout", $data);
	}
}
