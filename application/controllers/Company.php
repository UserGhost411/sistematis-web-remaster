<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends MY_Controller
{
	protected $access_namespace = "company";
	public function index()
	{
		if (!hasPermission($this, $this->access_namespace, "r")) {
			$this->load->view('layout', ["view" => "errors/403"]);
			return;
		}
		if (count($this->input->post()) > 0) {
			$this->db->update(
				'company',
				[
					"company_name" => $this->input->post("company_name"),
					"company_location" => $this->input->post("company_location"),
					"company_info" => $this->input->post("company_info")
				],
				["id" => $this->userdata->account_company]
			);
			$this->session->set_flashdata('msg', "Company Profile Saved!");
			redirect(base_url("company"));
			die();
		}
		$data['permission'] = getPermission($this, $this->access_namespace);
		$data['data'] = $this->db->get_where("company", ["id" => $this->userdata->account_company])->row();
		$data['view'] = 'panel/company/company';
		$this->load->view('layout', $data);
	}
	public function logo_upload()
	{
		$config['upload_path']          = './public/uploads/logo/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name']			= true;
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 1024;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			die(json_encode(["status" => 0, "message" => $this->upload->display_errors('', '')]));
		} else {
			$fn = $this->upload->data('file_name');
			$a = $this->db->update('company', [
				"company_logo" => $fn,
			], array('id' => $this->userdata->account_company));
			if ($a) die(json_encode(["status" => 200, "logo" => $fn]));
			die(json_encode(["status" => 403, "message" => "Error Applying Logo"]));
		}
	}
}
