<?php

header('Content-Type: text/html; charset=utf-8');
$cek = @file_get_contents("http://mozcast.com/");

preg_match('#<div class="span8 offset1">(.*?)</div>#si', $cek, $aktar);


preg_match('#<img src="http://cdn.mozcast.com/img/icons/large/(.*?).png" class="icon icon-large">#si', $cek, $aktar2);


$derece = trim($aktar[1]);
$derece = explode("&", $derece);
$derece = $derece[0];
$durum = $aktar2[1];

include("../fonksiyon.php");

$tarih = date("Y-m-d");

// $kayit = @mktime();
@mysql_query("insert into moz values(NULL, '$derece', '$durum', '$tarih')");

die("ok");

/*
switch($durum){
	case "sunny": $durum = "G�ne�li";break;
	case "ptcloudy": $durum = "Yar� G�ne�li";break;
	case "stormy": $durum = "Ya�murlu";break;
	case "rainy": $durum = "�im�ekli";break;
	case "cloudy": $durum = "Bulutlu";break;
	default: $durum = "G�ne�li";break;
}

echo "Bugun Google $durum ve $derece derece";

*/
?>