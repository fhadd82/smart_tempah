<?php
$dalTablereservationugrights = array();
$dalTablereservationugrights["TableName"] = array("type"=>200,"varname"=>"TableName", "name" => "TableName", "autoInc" => "0");
$dalTablereservationugrights["GroupID"] = array("type"=>3,"varname"=>"GroupID", "name" => "GroupID", "autoInc" => "0");
$dalTablereservationugrights["AccessMask"] = array("type"=>200,"varname"=>"AccessMask", "name" => "AccessMask", "autoInc" => "0");
$dalTablereservationugrights["Page"] = array("type"=>201,"varname"=>"Page", "name" => "Page", "autoInc" => "0");
$dalTablereservationugrights["TableName"]["key"]=true;
$dalTablereservationugrights["GroupID"]["key"]=true;

$dal_info["reservation_at_localhost__reservationugrights"] = &$dalTablereservationugrights;
?>