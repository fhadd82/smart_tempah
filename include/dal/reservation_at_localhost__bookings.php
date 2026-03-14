<?php
$dalTablebookings = array();
$dalTablebookings["id"] = array("type"=>3,"varname"=>"id", "name" => "id", "autoInc" => "1");
$dalTablebookings["user_id"] = array("type"=>3,"varname"=>"user_id", "name" => "user_id", "autoInc" => "0");
$dalTablebookings["hall_id"] = array("type"=>200,"varname"=>"hall_id", "name" => "hall_id", "autoInc" => "0");
$dalTablebookings["purpose"] = array("type"=>200,"varname"=>"purpose", "name" => "purpose", "autoInc" => "0");
$dalTablebookings["start_datetime"] = array("type"=>135,"varname"=>"start_datetime", "name" => "start_datetime", "autoInc" => "0");
$dalTablebookings["end_datetime"] = array("type"=>135,"varname"=>"end_datetime", "name" => "end_datetime", "autoInc" => "0");
$dalTablebookings["approval_status"] = array("type"=>200,"varname"=>"approval_status", "name" => "approval_status", "autoInc" => "0");
$dalTablebookings["supervisor_remarks"] = array("type"=>201,"varname"=>"supervisor_remarks", "name" => "supervisor_remarks", "autoInc" => "0");
$dalTablebookings["created_at"] = array("type"=>135,"varname"=>"created_at", "name" => "created_at", "autoInc" => "0");
$dalTablebookings["booking_id"] = array("type"=>200,"varname"=>"booking_id", "name" => "booking_id", "autoInc" => "0");
$dalTablebookings["id"]["key"]=true;

$dal_info["reservation_at_localhost__bookings"] = &$dalTablebookings;
?>