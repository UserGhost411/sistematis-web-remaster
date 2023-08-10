<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stockcat extends MY_Controller
{
	protected $access_namespace = "stockcat_management"; 
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/stock_type/list';
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
				->get_where("stock_type", [])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('stock_type', [
				"stock_type_name" => $this->input->post("stock_type_name"),
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
			$a = $this->db->update('stock_type', [
				"stock_type_name" => $this->input->post("stock_type_name"),
			], array('id' => $this->input->post("stock_type_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('stock_type', array('id' => $this->input->post("stock_type_id")));
		} else {
		}
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("stock_type", ["id" => $uid])->row();
		$this->load->view("panel/stock_type/edit", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout',["view"=>"errors/403"]);
			return;
		}
		$data = [];
		$this->load->view("panel/stock_type/add", $data);
	}
	public function errorx()
	{
		http_response_code(404);
		$data['code'] = 404;
		$this->load->view("layout", $data);
	}
}
