<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Device extends MY_Controller
{
	protected $access_namespace = "device_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/device/list_device';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->select(["device.*","company_name"])
				->join("company", 'company.id = device.device_company')
				->get_where("device", ($this->userdata->account_company==1?[]:["device_company"=>$this->userdata->account_company]))->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('device', [
				"device_name" => $this->input->post("device_name"),
				"device_company" => ($this->userdata->account_company==1?$this->input->post("device_company"):$this->userdata->account_company),
				"device_location" => $this->input->post("device_location"),
				"device_status" => $this->input->post("device_status"),
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
			$adev = $this->db->get_where("device", ["id" => $this->input->post("device_id")])->row();
			if($this->userdata->account_company!=1 && $adev->device_company!=$this->userdata->account_company) die(json_encode(["status" => 403, "message" => "Accces Denied"]));
			$a = $this->db->update('device', [
				"device_name" => $this->input->post("device_name"),
				"device_location" => $this->input->post("device_location"),
				"device_company" => ($this->userdata->account_company==1?$this->input->post("device_company"):$this->userdata->account_company),
				"device_status" => $this->input->post("device_status"),
			], array('id' => $this->input->post("device_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$adev = $this->db->get_where("device", ["id" => $this->input->post("device_id")])->row();
			if($this->userdata->account_company!=1 && $adev->device_company!=$this->userdata->account_company) die(json_encode(["status" => 403, "message" => "Accces Denied"]));
			$this->db->delete('device', array('id' => $this->input->post("device_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("device", ["id" => $uid])->row();
		if($this->userdata->account_company!=1 && $data['data']->device_company!=$this->userdata->account_company){
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		
		$data['company'] = $this->db->get_where("company", [])->result();
		$this->load->view("panel/device/edit_device", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['company'] = $this->db->get_where("company", [])->result();
		$this->load->view("panel/device/add_device", $data);
	}
}
