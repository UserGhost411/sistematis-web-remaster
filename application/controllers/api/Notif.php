<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends MY_ApiController
{
    protected $access_namespace = "stock_management";
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $a = $this->db->get_where("notif", ["notif_target" => $this->userdata->id, "notif_read" => 0])->result();
        
        output_json(["status" => 200, "data" => $a]);
    }
    public function status($read=1){
        $a = $this->db->get_where("notif", ["notif_target" => $this->userdata->id, "notif_read" => $read])->result();
        output_json(["status" => 200, "data" => $a]);
    }
}
