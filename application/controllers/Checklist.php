<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checklist extends MY_Controller
{
	protected $access_namespace = "checklist";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/checklist/list_checklist';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
				
			$mydate = date("Y-m-d");
			$myshift = $this->db->get_where("schedule", ["schedule_date"=>$mydate,"schedule_account"=>$this->userdata->id])->row();
			if($myshift==null) die(json_encode(["status" => 200, "data" => []]));
			$where = ["checklist_shift"=>$myshift->schedule_shift];
			if($this->userdata->account_company!=1) $where['device_company']= $this->userdata->account_company;
			$a = $this->db->select(["checklist.*","shift_name","shift_color","device_name"])
			->join("shift", 'shift.id = checklist.checklist_shift','left')
			->join("device", 'device.id = checklist.checklist_device', "left")
			->get_where("checklist", $where)->result();

			$checklist_avalaible = [];
			foreach($a as $val){
				$ck_data = false;
				if($val->checklist_repeat==0){ //daily
					$ck_data = $this->db->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id,"date(created_at)"=>$mydate])->row();
				}else if($val->checklist_repeat==1 && $val->checklist_repeat_info == date("w")){ //weekly
					$ck_data = $this->db->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id,"date(created_at)"=>$mydate])->row();
				}else if($val->checklist_repeat==2 || $val->checklist_repeat==3 || $val->checklist_repeat==4){ //monthly | 3 monthly | 6 monthly
					$ck_data = $this->db->order_by("created_at","desc")->select(["checklist_data.*","date(created_at) as datenya"])->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id])->row();
					$rangemonth = [0,0,1,3,6];
					if($ck_data){
						
						$a = strtotime("+".$rangemonth[$val->checklist_repeat]." month",strtotime($ck_data->datenya." 00:00:00"));
						if(((time()-strtotime($ck_data->datenya." 00:00:00"))>86400)){
							if((time()-$a)<0) continue;
						}
					}
				}else{
					continue;
				}
				$val->has_check = ($ck_data?true:false);
				$val->data_id = ($ck_data?$ck_data->id:"0");
				$val->data_value = ($ck_data?$ck_data->checklist_status:"0");
				$checklist_avalaible[] = $val;
			}
			output_json(["status" => 200, "data" => $checklist_avalaible]);
		} else if ($act == "submit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('checklist_data', [
				"checklist_id" => $this->input->post("checklist_id"),
				"checklist_status" => $this->input->post("checklist_status"),
				"checklist_actor" => $this->userdata->id,
			]);
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->update('checklist_data', [
				"checklist_status" => $this->input->post("checklist_status"),
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
			$this->db->delete('checklist_data', array('id' => $this->input->post("checklist_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("checklist", ["id" => $uid])->row();
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$this->load->view("panel/checklist/edit_checklist", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$this->load->view("panel/checklist/add_checklist", $data);
	}
}
