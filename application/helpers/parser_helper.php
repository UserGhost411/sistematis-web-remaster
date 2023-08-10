<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 function parse_md($tx){
    $tx = str_replace("<h1>","<h1 class='text-white'>",$tx);
    $tx = str_replace("<h2>","<h2 class='text-white'>",$tx);	
    $tx = str_replace("<h3>","<h3 class='text-white'>",$tx);	
    $tx = str_replace("<h4>","<h4 class='text-white'>",$tx);	
    $tx = str_replace("<h5>","<h5 class='text-white'>",$tx);	
    $tx = str_replace("<h6>","<h6 class='text-white'>",$tx);	
    $tx = str_replace("<h7>","<h7 class='text-white'>",$tx);	
    $tx = str_replace("<code>","<code class='text-white'>",$tx);
    $tx = str_replace("<pre>","<pre style='padding: .2em .4em;background-color: #2f3136'>",$tx);	
    $tx = str_replace("<table>","<table style='border-color:#fff' border=1>",$tx);	
    return $tx;
 }
 function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}