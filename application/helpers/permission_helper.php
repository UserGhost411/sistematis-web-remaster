<?php
defined('BASEPATH') or exit('No direct script access allowed');

function hasPermission($ins, $act, $do = "r")
{
    if ($ins->userdata->account_level == 1) return true;
    $que = $ins->db->get_where("access", ["access_$do" => 1, "access_namespace" => $act, "access_privilege" => $ins->userdata->account_level]);
    return ($que->num_rows() > 0);
}
function getPermission($ins, $act)
{
    if ($ins->userdata->account_level == 1) return json_decode(json_encode(["r" => 1, "c" => 1, "u" => 1, "d" => 1]));
    $que = $ins->db->get_where("access", ["access_namespace" => $act, "access_privilege" => $ins->userdata->account_level]);
    if ($que->num_rows() > 0) {
        $a = $que->row();
        return json_decode(json_encode(["r" => $a->access_r, "c" => $a->access_c, "u" => $a->access_u, "d" => $a->access_d]));
    } else {
        return false;
    }
}
