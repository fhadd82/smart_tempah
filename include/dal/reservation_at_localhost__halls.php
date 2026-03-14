<?php
$dalTablehalls = array();
$dalTablehalls["id"] = array("type"=>3,"varname"=>"id", "name" => "id", "autoInc" => "1");
$dalTablehalls["hall_id"] = array("type"=>200,"varname"=>"hall_id", "name" => "hall_id", "autoInc" => "0");
$dalTablehalls["hall_name"] = array("type"=>200,"varname"=>"hall_name", "name" => "hall_name", "autoInc" => "0");
$dalTablehalls["capacity"] = array("type"=>3,"varname"=>"capacity", "name" => "capacity", "autoInc" => "0");
$dalTablehalls["location"] = array("type"=>200,"varname"=>"location", "name" => "location", "autoInc" => "0");
$dalTablehalls["status"] = array("type"=>200,"varname"=>"status", "name" => "status", "autoInc" => "0");
$dalTablehalls["id"]["key"]=true;

$dal_info["reservation_at_localhost__halls"] = &$dalTablehalls;
?>