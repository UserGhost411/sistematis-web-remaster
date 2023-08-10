<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Division extends MY_Controller
{
	protected $access_namespace = "division_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/division/list_division';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db
				->select(["division.id as id", "division_name","company_name"])
				->join("company", 'company.id = division.division_company')
				->get_where("division", [])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) output_json(["status" => 403, "message" => "Accces Denied"]);
			
			$a = $this->db->insert('division', [
				"division_name" => $this->input->post("division_name"),
				"division_company" => $this->input->post("division_company"),
			]);
			if ($a) output_json(["status" => 200]);
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);
			
			$a = $this->db->update('division', [
				"division_name" => $this->input->post("division_name"),
				"division_company" => $this->input->post("division_company"),
			], array('id' => $this->input->post("division_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) output_json(["status" => 403, "message" => "Accces Denied"]);
			
			$this->db->delete('division', array('id' => $this->input->post("division_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("division", ["id" => $uid])->row();
		$data['company'] = $this->db->get_where("company", [])->result();
		$this->load->view("panel/division/edit_division", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['company'] = $this->db->get_where("company", [])->result();
		$this->load->view("panel/division/add_division", $data);
	}
}
