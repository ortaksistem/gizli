<?php

session_start();


$tur = $_POST["tur"];

if(!$tur) die("hata");


$uyeid = $_POST["uyeid"];

if($tur == "uyeol"){
	
	$telefon = $_POST["no1"] ."". $_POST["no2"];
	
	if(!is_numeric($telefon)) die("Telefon numaraniz gecersizdir !");
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	include("../smssifreleme.php");
	
	$sifrelisi = smssifrele($telefon);
	
	$result = mysql_query("select count(anan) from "._MX."orospu where eben='$sifrelisi'");
	
	list($warmi) = mysql_fetch_row($result);
	
	if($warmi >= 1) die("Telefon numarasi baska uye tarafindan kullanilmaktadir !");
	
	$onaykodu = rand(100000,999999);
	
	$_SESSION["onaykodu"] = $onaykodu;
	
	$_SESSION["telefon"] = $telefon;
	
	function sendRequest($site_name,$send_xml,$header_type=array('Content-Type: text/xml')) 
	{

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
        @curl_setopt($ch, CURLOPT_HEADER, 0);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        @curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        $result = curl_exec($ch);

        return $result;
    }

	$xml = "
	<SMS>
	   <oturum>
		  <kullanici>5533380000</kullanici>
		  <sifre>624470</sifre>
	   </oturum>
	   <mesaj>
		  <baslik></baslik>
		  <metin>Onay Kodunuz : $onaykodu . Onay kodunu belirtilen alana giriniz.</metin>
		  <alicilar>$telefon</alicilar>
	   </mesaj>
	</SMS>";


	$gonder = sendRequest("http://www.dakiksms.com//api/xml_api.php",$xml);
	
	die("ok");

}

if($tur == "ceponayla"){
	
	$telefon = $_POST["no1"] ."". $_POST["no2"];
	
	if(!is_numeric($telefon)) die("Telefon numaraniz gecersizdir !");
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	include("../smssifreleme.php");
	
	$sifrelisi = smssifrele($telefon);
	
	$result = mysql_query("select count(anan) from "._MX."orospu where eben='$sifrelisi'");
	
	list($warmi) = mysql_fetch_row($result);
	
	if($warmi >= 1) die("Telefon numarasi baska uye tarafindan kullanilmaktadir !");
	
	$onaykodu = rand(100000,999999);
	
	$_SESSION["onaykodu"] = $onaykodu;
	
	$_SESSION["telefon"] = $telefon;
	
	function sendRequest($site_name,$send_xml,$header_type=array('Content-Type: text/xml')) 
	{

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$site_name);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
        @curl_setopt($ch, CURLOPT_HEADER, 0);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        @curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        $result = curl_exec($ch);

        return $result;
    }

	$xml = "
	<SMS>
	   <oturum>
		  <kullanici>5533380000</kullanici>
		  <sifre>624470</sifre>
	   </oturum>
	   <mesaj>
		  <baslik></baslik>
		  <metin>Onay Kodunuz : $onaykodu . Onay kodunu belirtilen alana giriniz.</metin>
		  <alicilar>$telefon</alicilar>
	   </mesaj>
	</SMS>";


	$gonder = sendRequest("http://www.dakiksms.com//api/xml_api.php",$xml);
	
	die("ok");

}

if($tur == "kodonayla"){

	$kod = $_POST["kod"];
	$kod2 = $_SESSION["onaykodu"];
	
	if($kod == $kod2){
	
		include("../ayarlar.php");
		include("../fonksiyon.php");
		include("../smssifreleme.php");
		
		$telefon = $_SESSION["telefon"];
		$uyeid2 = smssifrele($uyeid);
		$telefon = smssifrele($telefon);
		
		
		// $result = @mysql_query("insert into "._MX."orospu values(NULL, '$uyeid2', '$telefon')");
		// $result = @mysql_query("update "._MX."uye set tel='', telonay='1' where id='$uyeid'");
	
		die("ok");
	}
	else {
		die("Kod gecersizdir, lutfen tekrar deneyiniz");
	}

}


?>