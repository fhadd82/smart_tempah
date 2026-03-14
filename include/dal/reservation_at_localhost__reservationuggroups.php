<?php
$dalTablereservationuggroups = array();
$dalTablereservationuggroups["GroupID"] = array("type"=>3,"varname"=>"GroupID", "name" => "GroupID", "autoInc" => "1");
$dalTablereservationuggroups["Label"] = array("type"=>200,"varname"=>"Label", "name" => "Label", "autoInc" => "0");
$dalTablereservationuggroups["Provider"] = array("type"=>200,"varname"=>"Provider", "name" => "Provider", "autoInc" => "0");
$dalTablereservationuggroups["Comment"] = array("type"=>201,"varname"=>"Comment", "name" => "Comment", "autoInc" => "0");
$dalTablereservationuggroups["GroupID"]["key"]=true;

$dal_info["reservation_at_localhost__reservationuggroups"] = &$dalTablereservationuggroups;
?>