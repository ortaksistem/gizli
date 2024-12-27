<?php

header('Content-Type: text/html; charset=utf-8');
$cek = @file_get_contents("http://mozcast.com/");

preg_match('#<div class="span8 offset1">(.*?)</div>#si', $cek, $aktar);


preg_match('#<img src="http://cdn.mozcast.com/img/icons/large/(.*?).png" class="icon icon-large">#si', $cek, $aktar2);


$derece = trim($aktar[1]);
$derece = explode("&", $derece);
$derece = $derece[0];
$durum = $aktar2[1];


switch($durum){
	case "sunny": $durum = "Güneşli";break;
	case "ptcloudy": $durum = "Yarı Güneşli";break;
	case "stormy": $durum = "Yağmurlu";break;
	case "rainy": $durum = "Şimşekli";break;
	case "cloudy": $durum = "Bulutlu";break;
	default: $durum = "Güneşli";break;
}

echo "Bugun Google $durum ve $derece derece";

?>