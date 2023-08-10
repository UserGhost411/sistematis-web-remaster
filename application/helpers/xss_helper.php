<?php

function xss_fil($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}