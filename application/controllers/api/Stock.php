<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends MY_ApiController
{
    protected $access_namespace = "stock_management";
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a = $this->db
            ->select(["stock.id as id", "stock_name", "stock_location", "stock_type_name", "COALESCE(SUM(CASE WHEN stock_status = 1 THEN stock_value ELSE -stock_value END), 0) AS total_stock"])
            ->join("stock_io", 'stock_io.stock_id = stock.id', "left")
            ->join("stock_type", 'stock_type.id = stock.stock_type')
            ->group_by("stock_name")
            ->get_where("stock", ["stock_division" => $this->userdata->account_division])->result();
        output_json(["status" => 200, "data" => $a]);
    }
    public function detail($id = 0)
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a =  $this->db
        ->select(["stock.id as id", "stock_name", "stock_location", "stock_type_name", "COALESCE(SUM(CASE WHEN stock_status = 1 THEN stock_value ELSE -stock_value END), 0) AS total_stock"])
        ->join("stock_io", 'stock_io.stock_id = stock.id', "left")
        ->join("stock_type", 'stock_type.id = stock.stock_type')
        ->group_by("stock_name")
        ->get_where("stock", ["stock.id" => $id])->row();
        if(!$a) output_json(["status" => 404, "message" => "Not found"]);
        $b = $this->db
        ->select(["stock_io.*","account.account_name as account_name"])
        ->join("account", 'account.id = stock_io.stock_actor', "left")
        ->get_where("stock_io", ["stock_id" => $a->id])->result();
        output_json(["status" => 200, "data" => $a,"history"=>$b]);
       
    }
    public function history($id = 0)
    {
        if (!hasPermission($this, $this->access_namespace, "r")) output_json(["status" => 403, "message" => "Accces Denied"]);
        $a = $this->db->get_where("stock", ["id" => $id])->row();
        if(!$a) output_json(["status" => 404, "message" => "Not found"]);
        $b = $this->db
            ->select(["stock.id as id", "stock_name", "stock_location", "stock_type_name", "COALESCE(SUM(CASE WHEN stock_status = 1 THEN stock_value ELSE -stock_value END), 0) AS total_stock"])
            ->join("stock_io", 'stock_io.stock_id = stock.id', "left")
            ->join("stock_type", 'stock_type.id = stock.stock_type')
            ->group_by("stock_name")
            ->get_where("stock", ["stock_division" => $this->userdata->account_division])->result();
        output_json(["status" => 200, "data" => $a,"history"=>$b]);
    }
}
