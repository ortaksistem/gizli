<?php

include("ayarlar.php");
include("fonksiyon.php");

function turkceyecevir($param){
	$param = strtr($param,"моЧнажќіўчi№§?%","USCIGOuoscigi,,");
	return $param;
}
// bitti

	$result = @mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyerenk from "._MX."online");
	
	$onlinekisiler = NULL;
	
	while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyerenk) = @mysql_fetch_row($result)){
		
		list($img, $sohbetdurum) = mysql_fetch_row(mysql_query("select img, sohbetdurum from "._MX."uye where id='$uye'"));
		
		$img = uyeavatar($img, $cinsiyet);
		$cinsiyet = cinsiyet($cinsiyet);
		
		$onlinekisiler .= $uye ."|". $sohbetdurum ."|". $ad ."|". $yas ."|". $cinsiyet ."|". $img ."|". $sehir ."|". $seviyead ."|". $seviyerenk ."|||"; 
	
	}

	$actim = fopen("ypsohbetdosyalar/kisiler.log",'w');
	
	if($actim){
		
		fputs($actim,"$onlinekisiler");
	
	}
	
	fclose($actim);

die("yazildi");
?>