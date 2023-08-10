<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access extends MY_Controller
{
	protected $access_namespace = "access_management";
	protected $permission_list = [
		"dashboard", "users_management", "company_management","device_management", 
		"incident_management","access_management","stock_management",
		"stockcat_management","shift_management","shifts_management",
		"privilege_management","menu_management","checklists_management",
		"division_management",
		"checklist","report","account","company","change_session"
	];
	/*

	permission note:
	incident_management - for privilege > 3
	shift_management - for scheduling shift with account - /shift
	shifts_management - for listing master shift(ie: shift 1, shift 2 , shift 3) - /shifts

	*inmind: are we need /schedule for user to manage their shift and schedule?
	*/
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['view'] = 'panel/access/list_access';
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
				->select(["sistms_privilege.id as id", "privilege_name", "COUNT(sistms_access.access_privilege) AS access_count"])
				->join("access", 'sistms_access.access_privilege = sistms_privilege.id', "left")
				->group_by("privilege_name")
				->get_where("sistms_privilege", ["sistms_privilege.id>" => "1"])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "lista" && $param != "") {
			if (!hasPermission($this, $this->access_namespace, "r")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->get_where("access", ["access_privilege" => $param])->result();
			$ret = ["status" => 200, "data" => $a];
			die(json_encode($ret));
		} else if ($act == "add" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "c")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$a = $this->db->insert('access', [
				"access_namespace" => $this->input->post("access_namespace"),
				"access_c" => $this->input->post("access_c"),
				"access_r" => $this->input->post("access_r"),
				"access_u" => $this->input->post("access_u"),
				"access_d" => $this->input->post("access_d"),
				"access_privilege" => $this->input->post("access_privilege"),
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
			$a = $this->db->update('access', [
				"access_namespace" => $this->input->post("access_namespace"),
				"access_c" => $this->input->post("access_c"),
				"access_r" => $this->input->post("access_r"),
				"access_u" => $this->input->post("access_u"),
				"access_d" => $this->input->post("access_d"),
			], array('id' => $this->input->post("access_id")));
			if ($a) {
				die(json_encode(["status" => 200]));
			}
			die(json_encode(["status" => 0, "message" => "Error"]));
		} else if ($act == "delete" && count($this->input->post()) > 0) {
			if (!hasPermission($this, $this->access_namespace, "d")) {
				die(json_encode(["status" => 403, "message" => "Accces Denied"]));
				return;
			}
			$this->db->delete('access', array('id' => $this->input->post("access_id")));
		} else {
		}
	}
	public function show($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['privi'] = $this->db->get_where("privilege", ["id" => $uid])->row();
		$data['view'] = 'panel/access/show_access';
		$this->load->view('layout', $data);
	}
	public function edit($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "u")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['permit'] = $this->permission_list;
		$data['data'] = $this->db->get_where("access", ["id" => $uid])->row();
		$this->load->view("panel/access/edit_access", $data);
	}
	public function create($uid = "")
	{
		if (!hasPermission($this, $this->access_namespace, "c")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		$data['privi'] = $this->db->get_where("privilege", ["id" => $uid])->row();
		$data['permit'] = $this->permission_list;
		$this->load->view("panel/access/add_access", $data);
	}
}
