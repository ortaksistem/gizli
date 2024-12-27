<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die("hata");

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "sil"){
	
	$id = $_POST["id"];
	
	mysql_query("update "._MX."galeri_talep set sil='1', durum='4' where talepedilen='$uyeid' and id='$id'");
	
	die("ok");

}

if($islem == "onayla"){
	
	$id = $_POST["id"];
	
	mysql_query("update "._MX."galeri_talep set durum='1' where talepedilen='$uyeid' and id='$id'");

	list($talepeden) = mysql_fetch_row(mysql_query("select talepeden from "._MX."galeri_talep where talepedilen='$uyeid' and id='$id'"));
	
	@mysql_query("update "._MX."uye set topgalerionay=topgalerionay+1 where id='$talepeden'");
	
	die("ok");

}

if($islem == "reddet"){
	
	$id = $_POST["id"];
	
	mysql_query("update "._MX."galeri_talep set durum='3' where talepedilen='$uyeid' and id='$id'");
	
	die("ok");

}

if($islem == "temizle"){
	
	$id = $_POST["id"];
	
	mysql_query("delete from "._MX."galeri_talep where id='$id'");
	
	die("ok");

}
?>