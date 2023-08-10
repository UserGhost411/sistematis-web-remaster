<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Companys extends MY_Controller
{
	protected $access_namespace = "company_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/company/list_company';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db
				->select(["sistms_company.id as id", "company_name", "company_location", "COUNT(sistms_account.account_company) AS account_count"])
				->join("account", 'sistms_account.account_company = sistms_company.id', "left")
				->group_by("company_name")
				->get_where("sistms_company", [])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('company', [
				"company_name" => $this->input->post("company_name"),
				"company_location" => $this->input->post("company_location"),
				"company_info" => $this->input->post("company_info"),
			]);
			$id_company = $this->db->insert_id();
			$b = $this->db->insert('division', [
				"division_name" => $this->input->post("company_name"),
				"division_company" => $id_company,
			]);
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->update('company', [
				"company_name" => $this->input->post("company_name"),
				"company_location" => $this->input->post("company_location"),
				"company_info" => $this->input->post("company_info"),
			], array('id' => $this->input->post("company_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('company', array('id' => $this->input->post("company_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("company", ["id" => $uid])->row();
		$this->load->view("panel/company/edit_company", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data = [];
		$this->load->view("panel/company/add_company", $data);
	}
}
