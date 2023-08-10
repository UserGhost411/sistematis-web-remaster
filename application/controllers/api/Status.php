<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('parser_helper');
    }
    public function index()
    {
        output_json(["status"=>200,"message"=>"System Online!"]);
    }
}
