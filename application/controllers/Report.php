<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
	protected $access_namespace = "report";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/report/report';
		$this->load->view('layout', $data);
	}
	public function custom(){
		$this->load->view('panel/report/custom', []);
	}
	public function prints($id = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['end'] = time(); 
		if($id==1){ //daily
			$data['title'] = "Daily";
			$data['start'] = strtotime(date("Y-m-d")." 00:00:00");
		}else if($id==2){ //weekly
			$data['title'] = "Weekly";
			$data['start'] = strtotime(date("Y-m-d",strtotime("-1 week"))." 00:00:00"); 
		}else if($id==3){ //montly
			$data['title'] = "Monthly";
			$data['start'] = strtotime(date("Y-m-d",strtotime("-1 month"))." 00:00:00");
		}else if($id==4){ //3 montly
			$data['title'] = "3 Month";
			$data['start'] = strtotime(date("Y-m-d",strtotime("-3 month"))." 00:00:00");
		}else if($id==5){ //6 montly
			$data['title'] = "6 Month";
			$data['start'] = strtotime(date("Y-m-d",strtotime("-6 month"))." 00:00:00");
		}else if($id==6){ //Custom
			$data['title'] = "Custom";
			$data['end'] = strtotime($this->input->get("end")." 23:59:59");
			$data['start'] = strtotime($this->input->get("start")." 00:00:00");
		}
		$data['logo'] = ($this->userdata->account_company!=1)?$this->db->get_where("company", ["id"=>$this->userdata->account_company])->row()->company_logo:"pelindo.png";
		$data['progress'] = [];
		$where = ["incident_status" => 0,"incident.created_at >="=>date("Y-m-d H:i:s",$data['start']),"incident.created_at <="=>date("Y-m-d H:i:s",$data['end'])];
		if($this->userdata->account_company!=1) $where["device_company"] = $this->userdata->account_company;
	
		foreach($this->db->select(["incident.*","device_name"])->join('device','device.id = incident.incident_device','left')->get_where("incident", $where)->result() as $val){
			$val->incident_by = [];
			$val->incident_desc = [];
			foreach($this->db->select(["incident_log.*","account_name"])->join('account','account.id = incident_log.incident_log_actor')->get_where("incident_log", ["incident_id" => $val->id])->result() as $v){
				if(!in_array($v->account_name,$val->incident_by)) $val->incident_by[] = htmlspecialchars($v->account_name);
				$val->incident_desc[] = htmlspecialchars($v->incident_log_desc);
			}
			$val->incident_by = join(",",$val->incident_by);
			$val->incident_desc = join(",",$val->incident_desc);
			$data['progress'][] = $val;
		}

		$data['done'] = [];
		$where = ["incident_status" => 1,"incident.created_at >="=>date("Y-m-d H:i:s",$data['start']),"incident.created_at <="=>date("Y-m-d H:i:s",$data['end'])];
		if($this->userdata->account_company!=1) $where["device_company"] = $this->userdata->account_company;
		foreach($this->db->select(["incident.*","device_name"])->join('device','device.id = incident.incident_device','left')->get_where("incident", $where)->result() as $val){
			$val->incident_by = [];
			$val->incident_desc = [];
			foreach($this->db->select(["incident_log.*","account_name"])->join('account','account.id = incident_log.incident_log_actor')->get_where("incident_log", ["incident_id" => $val->id])->result() as $v){
				if(!in_array($v->account_name,$val->incident_by)) $val->incident_by[] = htmlspecialchars($v->account_name);
				$val->incident_desc[] = htmlspecialchars($v->incident_log_desc);
			}
			$val->incident_by = join(",",$val->incident_by);
			$val->incident_desc = join(",",$val->incident_desc);
			$data['done'][] = $val;
		}

		$data['hold'] = [];
		$where = ["incident_status" => 2,"incident.created_at >="=>date("Y-m-d H:i:s",$data['start']),"incident.created_at <="=>date("Y-m-d H:i:s",$data['end'])];
		if($this->userdata->account_company!=1) $where["device_company"] = $this->userdata->account_company;
		foreach($this->db->select(["incident.*","device_name"])->join('device','device.id = incident.incident_device','left')->get_where("incident", $where)->result() as $val){
			$val->incident_by = [];
			$val->incident_desc = [];
			foreach($this->db->select(["incident_log.*","account_name"])->join('account','account.id = incident_log.incident_log_actor')->get_where("incident_log", ["incident_id" => $val->id])->result() as $v){
				if(!in_array($v->account_name,$val->incident_by)) $val->incident_by[] = htmlspecialchars($v->account_name);
				$val->incident_desc[] = htmlspecialchars($v->incident_log_desc);
			}
			$val->incident_by = join(",",$val->incident_by);
			$val->incident_desc = join(",",$val->incident_desc);
			$data['hold'][] = $val;
		}

		$data['checklist'] = $this->db->select(["checklist_data.*","device_name","checklist_device","shift_name","account_name","checklist_name"])
		->join('checklist','checklist.id = checklist_data.checklist_id','left')
		->join('shift','shift.id = checklist.checklist_shift','left')
		->join('device','device.id = checklist.checklist_device','left')
		->join('account','account.id = checklist_data.checklist_actor','left')
		->get_where("checklist_data", ["checklist_status" => 0,"checklist_data.created_at >="=>date("Y-m-d H:i:s",$data['start']),"checklist_data.created_at <="=>date("Y-m-d H:i:s",$data['end'])])->result();

		
		$this->load->view('panel/report/print', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$ret = ["status" => 200, "data" => [
				[
					"report" => [
						"id" => 1,
						"report_name" => "Daily Report"
					],
					"report_start" => date("d/m/Y"),
					"report_end" => date("d/m/Y"),
				],
				[
					"report" => [
						"id" => 2,
						"report_name" => "Weekly Report"
					],
					"report_start" => date("d/m/Y", strtotime("-1 week")),
					"report_end" => date("d/m/Y"),
				],
				[
					"report" => [
						"id" => 3,
						"report_name" => "Montly Report"
					],
					"report_start" => date("d/m/Y", strtotime("-1 month")),
					"report_end" => date("d/m/Y"),
				],
				[
					"report" => [
						"id" => 4,
						"report_name" => "3 Montly Report"
					],
					"report_start" => date("d/m/Y", strtotime("-3 month")),
					"report_end" => date("d/m/Y"),
				],
				[
					"report" => [
						"id" => 5,
						"report_name" => "6 Montly Report"
					],
					"report_start" => date("d/m/Y", strtotime("-6 month")),
					"report_end" => date("d/m/Y"),
				],
				[
					"report" => [
						"id" => 6,
						"report_name" => "Custom Report"
					],
					"report_start" => "-",
					"report_end" => "-",
				]
			]];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('device', [
				"device_name" => $this->input->post("device_name"),
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
			$a = $this->db->update('device', [
				"device_name" => $this->input->post("device_name"),
				"device_location" => $this->input->post("device_location"),
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
			$this->db->delete('device', array('id' => $this->input->post("device_id")));
		} else {
		}
	}
}
