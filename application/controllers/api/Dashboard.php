<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('parser_helper');
    }
    public function index()
    {
        $a = $this->db
            ->select(["incident.*", "account_name", "device_name"])
            ->join("account", 'account.id = incident.incident_reporter')
            ->join("device", 'device.id = incident.incident_device', "left")
            ->get_where("incident", ["incident_status"=>0])->result();
        output_json([
            "status" => 200,
            "data" => [
                "account_name" => $this->userdata->account_name,
                "division_name" => $this->userdata->division_name,
                "company_name" => $this->userdata->company_name,
            ],
            "checklist" => $this->count_checklist(),
            "insiden"=> $a
        ]);
    }
    private function count_checklist(){
        $mydate = date("Y-m-d");
        $myshift = $this->db->get_where("schedule", ["schedule_date"=>$mydate,"schedule_account"=>$this->userdata->id])->row();
        if($myshift==null) die(json_encode(["status" => 200, "data" => []]));
        $where = ["checklist_shift"=>$myshift->schedule_shift];
        if($this->userdata->account_company!=1) $where['device_company']= $this->userdata->account_company;
        $a = $this->db->select(["checklist.*","shift_name","shift_color","device_name"])
        ->join("shift", 'shift.id = checklist.checklist_shift','left')
        ->join("device", 'device.id = checklist.checklist_device', "left")
        ->get_where("checklist", $where)->result();
        $done = 0;
        $checklist_avalaible = [];
        foreach($a as $val){
            $ck_data = false;
            if($val->checklist_repeat==0){ //daily
                $ck_data = $this->db->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id,"date(created_at)"=>$mydate])->row();
            }else if($val->checklist_repeat==1 && $val->checklist_repeat_info == date("w")){ //weekly
                $ck_data = $this->db->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id,"date(created_at)"=>$mydate])->row();
            }else if($val->checklist_repeat==2 || $val->checklist_repeat==3 || $val->checklist_repeat==4){ //monthly | 3 monthly | 6 monthly
                $ck_data = $this->db->order_by("created_at","desc")->select(["checklist_data.*","date(created_at) as datenya"])->get_where("checklist_data", ["checklist_id"=>$val->id,"checklist_actor"=>$this->userdata->id])->row();
                $rangemonth = [0,0,1,3,6];
                if($ck_data){
                    
                    $a = strtotime("+".$rangemonth[$val->checklist_repeat]." month",strtotime($ck_data->datenya." 00:00:00"));
                    if(((time()-strtotime($ck_data->datenya." 00:00:00"))>86400)){
                        if((time()-$a)<0) continue;
                    }
                }
            }else{
                continue;
            }
            $val->has_check = ($ck_data?true:false);
            $val->data_id = ($ck_data?$ck_data->id:"0");
            $val->data_value = ($ck_data?$ck_data->checklist_status:"0");
            if($ck_data) $done++;
            $checklist_avalaible[] = $val;
        }
        return json_decode(json_encode(["total"=>count($checklist_avalaible),"done"=>$done]));
    }
}
