<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();
$uyeadi = uyeadi();

if(!is_numeric($uyeid)) die();


if($islem == "ekle"){
	
	
	$dosya = $_POST["dosya"];
	
	$dosyauzanti = explode(".", $dosya);
	
	$dosyauzanti = $dosyauzanti[count($dosyauzanti)-1];
	
	
	list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."video"));
	
	$maxid++;
	
	
	$yeniad = $uyeadi ."-". $uyeid ."-". $maxid .".". $dosyauzanti;
	
	
	if(@rename("../video/files/$dosya", "../video/files/$yeniad")){
	
		$dosyad = $yeniad;
		
	}
	else {
	
		$dosyad = $dosya;
	
	}
	
	if(!@file_exists("../video/files/$dosyad")){
		die("hata");
	}
	
	$tarih = time();
	
	$result = mysql_query("insert into "._MX."video (id, uye, dosya, kayit, durum) values('$maxid', '$uyeid', '$dosyad', '$tarih', '2')");
	
	if($result) die("ok");
	else die("hata");

}
?>