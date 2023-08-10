<?php
defined('BASEPATH') or exit('No direct script access allowed');

function output_json($data,$http_code=200)
{
    http_response_code($http_code);
    header("content-type: application/json");
    die(json_encode($data));
}

