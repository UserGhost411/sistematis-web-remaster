<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menus extends MY_Controller
{
	protected $access_namespace = "menu_management";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/menu/list_menu';
		$this->load->view('layout', $data);
	}
	public function data($act = "list", $param = "", $param1 = "")
	{
		if ($act == "list") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db
				->select(["sistms_privilege.id as id", "privilege_name", "COUNT(sistms_menu.menu_privilege) AS menu_count"])
				->join("menu", 'sistms_menu.menu_privilege = sistms_privilege.id', "left")
				->group_by("privilege_name")
				->get_where("sistms_privilege", ["sistms_privilege.id >" => 1])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "lista" && $param != "") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db
				->get_where("menu", ["menu_privilege" => $param, "menu_parent" => ($param1 == "" ? 0 : $param1)])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('menu', [
				"menu_name" => $this->input->post("menu_name"),
				"menu_icon" => $this->input->post("menu_icon"),
				"menu_endpoint" => $this->input->post("menu_endpoint"),
				"menu_position" => $this->input->post("menu_position"),
				"menu_parent" => $this->input->post("menu_parent"),
				"menu_privilege" => $this->input->post("menu_privilege"),
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
			$a = $this->db->update('menu', [
				"menu_name" => $this->input->post("menu_name"),
				"menu_icon" => $this->input->post("menu_icon"),
				"menu_endpoint" => $this->input->post("menu_endpoint"),
				"menu_position" => $this->input->post("menu_position"),
			], array('id' => $this->input->post("menu_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('menu', array('id' => $this->input->post("menu_id")));
		} else {
		}
	}
	public function show($uid = "", $sub = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['privi'] = $this->db->get_where("privilege", ["id" => $uid])->row();
		$data['view'] = 'panel/menu/show_menu';
		if ($sub != "") $data['sub'] = $this->db->get_where("menu", ["id" => $sub])->row();
		$this->load->view('layout', $data);
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['data'] = $this->db->get_where("menu", ["id" => $uid])->row();
		$this->load->view("panel/menu/edit_menu", $data);
	}
	public function create($uid = "", $parent = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['privi'] = $this->db->get_where("privilege", ["id" => $uid])->row();
		$data['parent'] = $parent;
		$this->load->view("panel/menu/add_menu", $data);
	}
	public function errorx()
	{
		http_response_code(404);
		$data['code'] = 404;
		$this->load->view("layout", $data);
	}
}
