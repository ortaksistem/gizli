<?php

include("fonksiyon.php");


$ip = $_SERVER["REMOTE_ADDR"];
if(filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
if(filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
       $ip = $_SERVER['HTTP_CLIENT_IP'];
       $iparray = explode('.', $ip);
       $ipdecimal = ($iparray[0] * 16777216) + ($iparray[1] * 65536) + ($iparray[2] * 256) + ($iparray[3]);
	   
	echo $ipdecimal ."<br />";  
$sql="SELECT code,name FROM ip2country WHERE ".$ipdecimal." BETWEEN min AND max";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$usercountrycode = $row[0];
$usercountryname = $row[1];

echo "You live in".$usercountryname." - ".$usercountrycode;

?>