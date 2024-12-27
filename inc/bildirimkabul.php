<?php


session_start();

$kabul = $_POST["kabul"];

if($kabul != "evet") die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

mysql_query("update "._MX."uye set topbildirim='0' where id='$uyeid'");

die();

?>