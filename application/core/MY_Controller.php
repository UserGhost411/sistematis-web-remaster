<?php
class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//session checking for panel here , hehe
		if (!$this->session->has_userdata('sistms_login') || !$this->session->has_userdata('sistms_uid')) redirect(base_url("auth"));
		$this->userdata = $this->db->get_where("account", ["id" => $this->session->userdata('sistms_uid')])->row();
		if (($this->session->has_userdata('sistms_uid_master') && $this->session->userdata('sistms_uid_master') != $this->session->userdata('sistms_uid'))) $this->userdata_master = $this->db->get_where("account", ["id" => $this->session->userdata('sistms_uid_master')])->row();
		$this->notifs = $this->db->get_where("notif", ["notif_target" => $this->session->userdata('sistms_uid'), "notif_read" => 0])->result();
	}
}

class MY_ApiController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!($this->input->get_request_header("publickey") && $this->input->get_request_header("sistm_token"))) output_json(["status"=>403,"message"=>"Not Authenticated"]);
		if($this->input->get_request_header("publickey")!="6f8fe502badc981ce80563da9f09041db1faba7a") output_json(["status"=>403,"message"=>"Not Authenticated"]);
		//if(!$this->session->has_userdata('sistms_login') || !$this->session->has_userdata('sistms_uid')) redirect(base_url("auth"));
		$this->userdata = 
		$this->db
		->select(["account.*","division_name","company_name"])
		->join("company","company.id = account.account_company")
		->join("division","division.id = account.account_division")
		->get_where("account", ["account_token" => $this->input->get_request_header("sistm_token")])->row();
		if(!$this->userdata) output_json(["status"=>403,"message"=>"Invalid Token!"]);
		//if(($this->session->has_userdata('sistms_uid_master') && $this->session->userdata('sistms_uid_master') != $this->session->userdata('sistms_uid'))) $this->userdata_master = $this->db->get_where("account",["id"=>$this->session->userdata('sistms_uid_master')])->row();
		//$this->notifs = $this->db->get_where("notif",["notif_target"=>$this->session->userdata('sistms_uid'),"notif_read"=>0])->result();
	}
}
