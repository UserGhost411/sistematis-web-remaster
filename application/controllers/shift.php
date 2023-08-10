<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shift extends MY_Controller
{
	protected $access_namespace = "shift_management"; 
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/shift/shift';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$start = $this->input->get("start");
			$end = $this->input->get("end");
			$a = $this->db
				->select(["schedule.id", "account_name", "schedule_date", "COUNT(sistms_account.account_name) AS shift_count"])
				->join("account", 'account.id = schedule.schedule_account', "left")
				->group_by("schedule_date")
				->where("schedule_date BETWEEN '$start' AND '$end'")
				->get("schedule")->result();
			$b = [];
			$begin = new DateTime($start);
			$end = new DateTime($end);
			$interval = DateInterval::createFromDateString('1 day');
			$period = new DatePeriod($begin, $interval, $end);
			$blacklist = [];
			foreach ($a as $val) {
				$b[] = [
					"title"	=> $val->shift_count . " on duty",
					"start"	=> $val->schedule_date,
					"end"	=> $val->schedule_date,
					"url"	=> base_url("/shift/show/" . urlencode(base64_encode($val->schedule_date))),
					"className" => 'text-center py-2 bg-success',
					"borderColor" => "var(--cui-green)"
				];
				$blacklist[] = $val->schedule_date;
			}
			foreach ($period as $dt) {
				if(in_array($dt->format("Y-m-d"),$blacklist)) continue;
				$b[] = [
					"title"	=> "0 on duty",
					"start"	=> $dt->format("Y-m-d"),
					"end"	=>$dt->format("Y-m-d"),
					"url"	=> base_url("/shift/show/" . urlencode(base64_encode($dt->format("Y-m-d")))),
					"className" => 'text-center py-2 bg-danger',
					"borderColor" => "var(--cui-danger)"
				];
			}
			
			$ret = ["status" => 200, "data" => $b];
			header("content-type: application/json");
			die(json_encode($b));
		} else if ($act == "lista") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$date =  $this->input->get("date");
			$a = $this->db
				->select(["schedule.id as id", "schedule_date", "shift_start", "shift_end", "shift_name", "shift_color", "account_name"])
				->join("account", 'account.id = schedule.schedule_account')
				->join("shift", 'shift.id = schedule.schedule_shift')
				->get_where("schedule", ["schedule_date" => $date])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('schedule', [
				"schedule_account" => $this->input->post("schedule_account"),
				"schedule_shift" => $this->input->post("schedule_shift"),
				"schedule_date" => $this->input->post("schedule_date"),
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
			$a = $this->db->update('schedule', [
				"schedule_shift" => $this->input->post("schedule_shift"),
			], array('id' => $this->input->post("schedule_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('schedule', array('id' => $this->input->post("schedule_id")));
		} else {
		}
	}
	public function show($date = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['date'] = base64_decode(urldecode($date));
		$data['view'] = 'panel/shift/show';
		$this->load->view('layout', $data);
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("schedule", ["id" => $uid])->row();
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$data['account'] = $this->db->get_where("account", ["id" => $data['data']->schedule_account])->row();
		$this->load->view("panel/shift/edit_shift", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['account'] = $this->db->get_where("account", [])->result();
		$data['shift'] = $this->db->get_where("shift", [])->result();
		$this->load->view("panel/shift/add_shift", $data);
	}
}
