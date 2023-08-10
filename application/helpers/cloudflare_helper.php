<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 function client_real_ip(){
    $ip = $_SERVER['REMOTE_ADDR'];
    foreach(cloudflare_proxys() as $val){
        if(strpos($ip, $val) !== false){
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    return $ip;
 }
 function cloudflare_proxys(){
     return 
     [
        "173.245.48." ,"103.21.244.","103.22.200.","103.31.4."   ,"141.101.64.",
        "108.162.192.","190.93.240.","188.114.96.","197.234.240.","198.41.128.",
        "162.158.0."  ,"172.64.0."  ,"131.0.72."  ,"104.16.0."   ,"104.24.0."
     ];
 }
?>
