<?php
$dalTableusers = array();
$dalTableusers["id"] = array("type"=>3,"varname"=>"id", "name" => "id", "autoInc" => "1");
$dalTableusers["username"] = array("type"=>200,"varname"=>"username", "name" => "username", "autoInc" => "0");
$dalTableusers["password"] = array("type"=>200,"varname"=>"password", "name" => "password", "autoInc" => "0");
$dalTableusers["email"] = array("type"=>200,"varname"=>"email", "name" => "email", "autoInc" => "0");
$dalTableusers["phone_number"] = array("type"=>200,"varname"=>"phone_number", "name" => "phone_number", "autoInc" => "0");
$dalTableusers["role"] = array("type"=>200,"varname"=>"role", "name" => "role", "autoInc" => "0");
$dalTableusers["full_name"] = array("type"=>200,"varname"=>"full_name", "name" => "full_name", "autoInc" => "0");
$dalTableusers["userpic"] = array("type"=>128,"varname"=>"userpic", "name" => "userpic", "autoInc" => "0");
$dalTableusers["id"]["key"]=true;

$dal_info["reservation_at_localhost__users"] = &$dalTableusers;
?>