<?php

session_start();


$id = $_POST["id"];

if(!is_numeric($id)) die();

$tur = $_POST["tur"];

if(!$tur) die();


if($tur == "puan"){
	
	$puan = $_POST["puan"];
	
	include("../ayarlar.php");
	
	
	$result = mysql_query("update "._MX."video set oy=oy+1, puan=puan+1 where id='$id'");
	
	
	if($result) die("ok");
	else die("hata");

}

?>