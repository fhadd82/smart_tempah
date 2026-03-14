<?php
$dalTablereservationugmembers = array();
$dalTablereservationugmembers["UserName"] = array("type"=>200,"varname"=>"UserName", "name" => "UserName", "autoInc" => "0");
$dalTablereservationugmembers["GroupID"] = array("type"=>3,"varname"=>"GroupID", "name" => "GroupID", "autoInc" => "0");
$dalTablereservationugmembers["Provider"] = array("type"=>200,"varname"=>"Provider", "name" => "Provider", "autoInc" => "0");
$dalTablereservationugmembers["UserName"]["key"]=true;
$dalTablereservationugmembers["GroupID"]["key"]=true;
$dalTablereservationugmembers["Provider"]["key"]=true;

$dal_info["reservation_at_localhost__reservationugmembers"] = &$dalTablereservationugmembers;
?>