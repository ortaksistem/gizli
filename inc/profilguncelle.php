<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");
	
$uyeid = uyeid();

if(!$uyeid) die();

if($islem == "kisiselbilgiler"){

	$ad = $_POST["ad"];
	$soyad = $_POST["soyad"];
	$d1 = $_POST["d1"];
	$d2 = $_POST["d2"];
	$d3 = $_POST["d3"];
	$no1 = $_POST["no1"];
	$no2 = $_POST["no2"];
	$sehir = $_POST["sehir"];
	$ulke = $_POST["ulke"];

	if($ad and $soyad and $d1 and $d2 and $d3 and $no1 and $no2 and $sehir and $ulke){
		
		$ad = turkce($ad);
		$soyad = turkce($soyad);
		$sehir = turkce($sehir);
		$ulke = turkce($ulke);
		
		$dogum = @mktime(0,0,0, $d2, $d1, $d3);
		
		$no = $no1 ."-". $no2;
		
		$result = mysql_query("update "._MX."uye set ad='$ad', soyad='$soyad', tel='$no', dogum='$dogum', ulke='$ulke', sehir='$sehir' where id='$uyeid'");
		
		if($result) die("ok");
		else die("hata");
		
		
		
	}
	else {
		die("hata");
	}
}

if($islem == "tanitim"){
	
	$tanitim = trim($_POST["tanitim"]);
	
	if($tanitim){
	
		$tanitim = suz(turkce($tanitim));
		
		$result = mysql_query("update "._MX."uye set tanitim='$tanitim', tanitimonay='2' where id='$uyeid'");
		
		if($result) die("ok");
		else die("hata");	
	}
	else die("hata");
}
?>