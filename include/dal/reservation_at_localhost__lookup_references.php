<?php
$dalTablelookup_references = array();
$dalTablelookup_references["id"] = array("type"=>3,"varname"=>"id", "name" => "id", "autoInc" => "1");
$dalTablelookup_references["category"] = array("type"=>200,"varname"=>"category", "name" => "category", "autoInc" => "0");
$dalTablelookup_references["value"] = array("type"=>200,"varname"=>"fldvalue", "name" => "value", "autoInc" => "0");
$dalTablelookup_references["id"]["key"]=true;

$dal_info["reservation_at_localhost__lookup_references"] = &$dalTablelookup_references;
?>