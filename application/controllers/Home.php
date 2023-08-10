<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	protected $access_namespace = "dashboard";
	public function index()
	{
		$permit = getPermission($this, $this->access_namespace);
		$hoho = $permit->c + $permit->r + $permit->u + $permit->d ;
		$last = ["","vendor","division","division","admin"];
		if ($last[$hoho]=="") {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['view'] = 'panel/dashboard/'.$last[$hoho];
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
		if ($act == "active_shift") {
			$a = $this->db
				->select(["schedule.id as id", "company_name", "schedule_date", "shift_start", "shift_end", "shift_name", "shift_color", "account_name"])
				->join("account", 'account.id = schedule.schedule_account', 'left')
				->join("company", 'company.id = account.account_company', 'left')
				->join("shift", 'shift.id = schedule.schedule_shift', 'left')
				->get_where("schedule", ["schedule_date" => date("Y-m-d"), "shift_start <=" => date("H:i:s"), "shift_end >=" => date("H:i:s")])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "low_stock") {
			$a = $this->db
				->select(["stock.id as id", "stock_name", "stock_location", "stock_type_name", "COALESCE(SUM(CASE WHEN stock_status = 1 THEN stock_value ELSE -stock_value END), 0) AS total_stock"])
				->join("stock_io", 'stock_io.stock_id = stock.id', "left")
				->join("stock_type", 'stock_type.id = stock.stock_type')
				->group_by("stock_name")->order_by("total_stock", "asc")->limit(10)
				->get_where("stock", [])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "incidents") {
			$a = $this->db
				->select(["incident.*", "account_name", "device_name"])
				->join("account", 'account.id = incident.incident_reporter')
				->join("device", 'device.id = incident.incident_device', "left")
				->get_where("incident", ["incident_status <>"=>1])->result();
			output_json(["status" => 200, "data" => $a]);
		}
	}
	public function notif($id = 0)
	{
		$notif = $this->db->get_where("notif", ["notif_target" => $this->userdata->id, "id" => $id])->row();
		if (!$notif) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$this->db->update("notif", ["notif_read" => 1], ["id" => $notif->id]);
		redirect(base_url($notif->notif_click));
		return;
	}

	public function errorx()
	{
		http_response_code(404);
		$data['code'] = 404;
		$this->load->view("layout", $data);
	}
}
