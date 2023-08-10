<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('parser_helper');
    }
    public function index()
    {
        $username = $this->input->post("username", true);
        $password = $this->input->post("password", true);
        if ($username != "" && $password != "") {
            $result = $this->db->get_where("account", ["account_username" => $username])->row();
            if ($result) {
                if (password_verify($password, $result->account_password)) {
                    $new_token = $result->account_token;//"sistematis_".md5(uniqid()."_".time().$result->account_password);
                    $this->db->update("account",["account_token"=>$new_token],["id"=>$result->id]);
                    output_json(["status"=>200,"token"=>$new_token]);
                }   
            }
            output_json(["status"=>403,"message"=>"Invalid Login Crendetial"]);
        }
        output_json(["status"=>404,"message"=>"resource not found!"]);
    }
}
