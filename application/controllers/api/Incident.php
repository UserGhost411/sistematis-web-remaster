<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Incident extends MY_ApiController
{
    protected $access_namespace = "incident_management";
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a = $this->db
            ->select(["incident.*", "account_name", "device_name"])
            ->join("account", 'account.id = incident.incident_reporter')
            ->join("device", 'device.id = incident.incident_device', "left")
            ->get_where("incident", [])->result();
        output_json(["status" => 200, "data" => $a]);
    }
    public function detail($id = 0)
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a = $this->db
            ->select(["incident.*", "account_name", "device_name"])
            ->join("account", 'account.id = incident.incident_reporter')
            ->join("device", 'device.id = incident.incident_device', "left")
            ->get_where("incident", ["incident.id" => $id])->row();
        $b = $this->db
            ->select(["incident_log.*", "account_name"])
            ->join("account", 'account.id = incident_log.incident_log_actor')
            ->get_where("incident_log", ["incident_id" => $a->id])->result();
        output_json(["status" => 200, "data" => $a, "history" => $b]);
    }
    public function status($status = 0)
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a = $this->db
            ->select(["incident.*", "account_name", "device_name"])
            ->join("account", 'account.id = incident.incident_reporter')
            ->join("device", 'device.id = incident.incident_device', "left")
            ->get_where("incident", ["incident_status" => $status])->result();
        output_json(["status" => 200, "data" => $a]);
    }
    public function ui($act = "",$target=0)
    {
        if($act=="add"){
            //if (!hasPermission($this, $this->access_namespace, "c")) output_json(["status" => 403, "message" => "Accces Denied"]);
            if(count($this->input->post()) > 0){
                
                redirect("?#close_wb");
            }
            if($target!=0){
                $a = $this->db->get_where("checklist", ["id" => $target])->row();
                $data['device_selc'] = $a!=null?($a->checklist_device?$a->checklist_device:0):0;
                $data['checklist'] = $a;
            }else{
                $data['device_selc'] = 0 ;
                $data['checklist'] = null;
            }
            $data['devices'] = $this->db->get_where("device", [])->result();
            $data['external'] = true;
            $this->load->view("panel/incident/add_incident", $data);

        }else if($act==""){

        }
    }
}
