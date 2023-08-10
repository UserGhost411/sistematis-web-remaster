<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklists extends MY_Controller
{
	protected $access_namespace = "checklists_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/checklists/list_checklists';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->select(["checklist.*", "shift_name","shift_color","device_name"])
				->join("shift", 'shift.id = checklist.checklist_shift')
				->join("device", 'device.id = checklist.checklist_device')
				->get_where("checklist", [])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "log" && $param!="") {
			if (!hasPermission($this, $this->access_namespace, "r")) die(json_encode(["status" => 403, "message" => "Accces Denied"]));
			$a = $this->db->select(["checklist_data.*","shift_color" ,"checklist_name","shift_name","account_name"])
				->join("account", 'account.id = checklist_data.checklist_actor','left')
				->join("checklist", 'checklist.id = checklist_data.checklist_id')
				->join("shift", 'shift.id = checklist.checklist_shift')
				->get_where("checklist_data", ["date(sistms_checklist_data.created_at)"=>$param])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('checklist', [
				"checklist_name" => $this->input->post("checklist_name"),
				"checklist_desc" => $this->input->post("checklist_desc"),
				"checklist_repeat" => $this->input->post("checklist_repeat"),
				"checklist_repeat_info" => $this->input->post("checklist_repeat_info"),
				"checklist_device" => $this->input->post("checklist_device"),
				"checklist_shift" => $this->input->post("checklist_shift"),
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
			$a = $this->db->update('checklist', [
				"checklist_name" => $this->input->post("checklist_name"),
				"checklist_desc" => $this->input->post("checklist_desc"),
				"checklist_repeat" => $this->input->post("checklist_repeat"),
				"checklist_repeat_info" => $this->input->post("checklist_repeat_info"),
				"checklist_device" => $this->input->post("checklist_device"),
				"checklist_shift" => $this->input->post("checklist_shift"),
			], array('id' => $this->input->post("checklist_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('checklist', array('id' => $this->input->post("checklist_id")));
		} else if ($act == "addlog" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('checklist_data', [
				"checklist_id" => $this->input->post("checklist_id"),
				"checklist_status" => $this->input->post("checklist_status"),
				"checklist_actor" => $this->input->post("checklist_actor"),
				"created_at" => date("Y-m-d H:i:s",strtotime($this->input->post("created_at"))),
			]);
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "editlog" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->update('checklist_data', [
				"checklist_id" => $this->input->post("checklist_id"),
				"checklist_status" => $this->input->post("checklist_status"),
				"checklist_actor" => $this->input->post("checklist_actor"),
			], array('id' => $this->input->post("checklist_data_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "deletelog" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('checklist_data', array('id' => $this->input->post("checklist_data_id")));
		} else {
		}
	}
	public function log($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['data'] = $this->db->get_where("checklist", ["id" => $uid])->row();
		if(!$data['data']) redirect(base_url("checklists"));
		$data['view'] = 'panel/checklists/log_checklists';
		$this->load->view("layout", $data);
	}
	public function editlog($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("checklist_data", ["id" => $uid])->row();
		$data['checklist'] = $this->db->get_where("checklist", [])->result();
		$data['account'] = $this->db->get_where("account", [])->result();
		$this->load->view("panel/checklists/edit_log_checklists", $data);
	}
	public function createlog($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['checklist'] = $this->db->get_where("checklist", [])->result();
		$data['account'] = $this->db->get_where("account", [])->result();
		$data['date'] = strtotime($uid);
		$this->load->view("panel/checklists/add_log_checklists", $data);
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("checklist", ["id" => $uid])->row();
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$data['device'] = $this->db->get_where("device", [])->result();
		$this->load->view("panel/checklists/edit_checklists", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$data['device'] = $this->db->get_where("device", [])->result();
		$this->load->view("panel/checklists/add_checklists", $data);
	}
}
