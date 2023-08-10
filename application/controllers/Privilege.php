<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privilege extends MY_Controller
{
	protected $access_namespace = "privilege_management"; 
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/privilege/list_privilege';
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
				->select(["sistms_privilege.id as id", "privilege_name", "COUNT(sistms_account.account_level) AS account_count"])
				->join("account", 'sistms_account.account_level = sistms_privilege.id', "left")
				->group_by("privilege_name")
				->get_where("sistms_privilege", ["sistms_privilege.id >"=>1])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('privilege', [
				"privilege_name" => $this->input->post("privilege_name"),
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
			$a = $this->db->update('privilege', [
				"privilege_name" => $this->input->post("privilege_name"),
			], array('id' => $this->input->post("privilege_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('privilege', array('id' => $this->input->post("privilege_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("sistms_privilege", ["id" => $uid])->row();
		$this->load->view("panel/privilege/edit_privilege", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data = [];
		$this->load->view("panel/privilege/add_privilege", $data);
	}
	public function errorx()
	{
		http_response_code(404);
		$data['code'] = 404;
		$this->load->view("layout", $data);
	}
}
