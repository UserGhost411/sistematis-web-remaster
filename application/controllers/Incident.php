<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Incident extends MY_Controller
{
	protected $access_namespace = "incident_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/incident/list_incident';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db
				->select(["incident.*", "account_name", "device_name"])
				->join("account", 'account.id = incident.incident_reporter')
				->join("device", 'device.id = incident.incident_device', "left")
				->get_where("incident", [])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "history" && $param != "") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db
				->select(["incident_log.*", "account_name"])
				->join("account", 'account.id = incident_log.incident_log_actor')
				->get_where("incident_log", ["incident_id" => $param])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "report" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('incident_log', [
				"incident_id" => $this->input->post("incident_id"),
				"incident_log_desc" => $this->input->post("incident_log_desc"),
				"incident_log_status" => $this->input->post("incident_log_status"),
				"incident_log_actor" => $this->userdata->id,
			]);
			$this->db->update('incident', [
				"incident_status" => $this->input->post("incident_log_status"),
			], array('id' => $this->input->post("incident_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('incident', [
				"incident_name" => $this->input->post("incident_name"),
				"incident_status" => $this->input->post("incident_status"),
				"incident_device" => $this->input->post("incident_device"),
				"incident_reporter" => $this->userdata->id,
			]);
			$incident_id = $this->db->insert_id();
			if ($a) {
				$this->db->insert('incident_log', [
					"incident_id" => $incident_id,
					"incident_log_desc" => $this->input->post("incident_log_desc"),
					"incident_log_status" => $this->input->post("incident_status"),
					"incident_log_actor" => $this->userdata->id,
				]);
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->update('incident', [
				"incident_name" => $this->input->post("incident_name"),
				"incident_status" => $this->input->post("incident_status"),
				"incident_device" => $this->input->post("incident_device"),
			], array('id' => $this->input->post("incident_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('incident', array('id' => $this->input->post("incident_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("incident", ["id" => $uid])->row();
		$data['devices'] = $this->db->get_where("device", [])->result();
		$this->load->view("panel/incident/edit_incident", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['device_selc'] = ($uid==""?0:$uid);
		$data['devices'] = $this->db->get_where("device", [])->result();
		$this->load->view("panel/incident/add_incident", $data);
	}
	public function history($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data = [];
		$this->load->view("panel/incident/history_incident", $data);
	}
	public function report($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("incident", ["id" => $uid])->row();
		$this->load->view("panel/incident/report_incident", $data);
	}
}
