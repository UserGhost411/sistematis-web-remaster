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
        redirect(base_url("auth/login"));
    }
    public function login()
    {
        $username = $this->input->post("username", true);
        $password = $this->input->post("password", true);
        $remember_me = $this->input->post("remember_me", true);
        if(get_cookie("embrace_session")){
            $right = @json_decode($this->encrypt->decode(get_cookie("embrace_session")));
            if($right){
                if($right->b = md5(date("i (s) d-Y-m H",$right->a))){
                    $this->session->set_userdata([
                        "sistms_login" => true,
                        "sistms_uid" => $right->mid,
                        "sistms_uid_master" => $right->mid,
                    ]);
                    redirect(base_url("/"));
                }
            }
        }
        if ($username != "" && $password != "") {
            //die($remember_me."=".($remember_me=="on"));
            $result = $this->db->get_where("account", ["account_username" => $username])->row();
            if ($result) {
                if (password_verify($password, $result->account_password)) {
                    $this->db->insert("login_log", ["login_account" => $result->id, "login_status" => 1, "login_ip" => client_real_ip(), "login_ua" => $_SERVER['HTTP_USER_AGENT']]);
                    $this->session->set_userdata([
                        "sistms_login" => true,
                        "sistms_uid" => $result->id,
                        "sistms_uid_master" => $result->id,
                    ]);
                    $this->checkLogs($result->id);
                    if($remember_me=="on"){
                        $a = time();
                        $b = md5(date("i (s) d-Y-m H",$a)); 
                        set_cookie(
                            "embrace_session",
                            $this->encrypt->encode(json_encode(["mid"=>$result->id,"a"=>$a,"b"=>$b])),
                            25920000
                        );
                    }
                    redirect(base_url("/"));
                } else {
                    $this->db->insert("login_log", ["login_account" => $result->id, "login_status" => 0, "login_ip" => client_real_ip(), "login_ua" => $_SERVER['HTTP_USER_AGENT']]);
                    $this->session->set_flashdata('login_msg', "Unable Log in. Please Check your password and Username!");
                }
            } else {
                $this->session->set_flashdata('login_msg', "Unable Log in. Please Check your password and Username!");
            }
        }
        $this->load->view('auth/login');
    }
    private function checkLogs($uid){
        $total = $this->db->get_where("login_log", ["login_account"=>$uid])->num_rows();
        $max = 50;
        if( $total > $max){
            $this->db->order_by("created_at","ASC")->limit($total-$max)->delete("login_log",["login_account"=>$uid]);
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie('embrace_session');
        redirect(base_url("auth/login"));
    }
}
