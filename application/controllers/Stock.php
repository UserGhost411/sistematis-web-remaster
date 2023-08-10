<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends MY_Controller
{
	protected $access_namespace = "stock_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/stock/list_stock';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "")
	{
		$uid = $this->session->userdata("sistms_uid");
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db
				->select(["stock.id as id", "stock_name", "stock_location", "stock_type_name", "COALESCE(SUM(CASE WHEN stock_status = 1 THEN stock_value ELSE -stock_value END), 0) AS total_stock"])
				->join("stock_io", 'stock_io.stock_id = stock.id', "left")
				->join("stock_type", 'stock_type.id = stock.stock_type')
				->group_by("stock_name")
				->get_where("stock", ["stock_division" => $this->userdata->account_division])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "history" && $param != "") {
			if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
				
			$a = $this->db->select(["stock_io.*", "account_name"])
				->join("account", 'account.id = stock_io.stock_actor')
				->get_where("stock_io", ["stock_id" => $param])->result();
			output_json(["status" => 200, "data" => $a]);
		} else if ($act == "exchange" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);
				
			$a = $this->db->insert('stock_io', [
				"stock_id" => $this->input->post("stock_id"),
				"stock_status" => $this->input->post("stock_status"),
				"stock_value" => $this->input->post("stock_total"),
				"stock_reason" => $this->input->post("stock_reason"),
				"stock_actor" => $uid,
			]);
			if ($a) {
				output_json(["status" => 200]);
			}
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$a = $this->db->insert('stock', [
				"stock_name" => $this->input->post("stock_name"),
				"stock_desc" => $this->input->post("stock_desc"),
				"stock_location" => $this->input->post("stock_location"),
				"stock_type" => $this->input->post("stock_type"),
			]);
			$stock_id = $this->db->insert_id();
			if ($a) {
				if ($this->input->post("stock_total") != "" || $this->input->post("stock_total") != "0") {
					$this->db->insert('stock_io', [
						"stock_id" => $stock_id,
						"stock_status" => 1,
						"stock_reason" => "Initial Stock Data",
						"stock_value" => $this->input->post("stock_total"),
						"stock_actor" => $uid,
					]);
				}
				output_json(["status" => 200]);
			}
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "edit" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "u")) output_json(["status" => 403, "message" => "Accces Denied"]);

			$a = $this->db->update('stock', [
				"stock_name" => $this->input->post("stock_name"),
				"stock_desc" => $this->input->post("stock_desc"),
				"stock_location" => $this->input->post("stock_location"),
				"stock_type" => $this->input->post("stock_type"),
			], array('id' => $this->input->post("stock_id")));
			if ($a) {
				output_json(["status" => 200]);
			}
			output_json(["status" => 0, "message" => "Error"]);
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) output_json(["status" => 403, "message" => "Accces Denied"]);
			$this->db->delete('stock', array('id' => $this->input->post("stock_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("stock", ["id" => $uid])->row();
		$data['stock_type'] = $this->db->get_where("stock_type", [])->result();
		$this->load->view("panel/stock/edit_stock", $data);
	}
	public function io($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("stock", ["id" => $uid])->row();
		$this->load->view("panel/stock/io_stock", $data);
	}
	public function history($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("stock", ["id" => $uid])->row();
		$this->load->view("panel/stock/history_stock", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['stock_type'] = $this->db->get_where("stock_type", [])->result();
		$this->load->view("panel/stock/add_stock", $data);
	}
}
