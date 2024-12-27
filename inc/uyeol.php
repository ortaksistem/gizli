<?php

session_start();

$ad = $_POST["ad"];
$soyad = $_POST["soyad"];
$d1 = $_POST["d1"];
$d2 = $_POST["d2"];
$d3 = $_POST["d3"];
$no1 = $_POST["no1"];
$no2 = $_POST["no2"];
$email = $_POST["email"];
$cinsiyet = $_POST["cinsiyet"];
$sehir = $_POST["sehir"];
$ulke = $_POST["ulke"];
$rumuz = $_POST["rumuz"];
$sifre = $_POST["sifre"];


if($ad and $soyad and $d1 and $d2 and $d3 and $email and $cinsiyet and $sehir and $ulke and $rumuz and $sifre){
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	$rumuz = turkce($rumuz);
	$rumuz = strtr($rumuz,"моЧнажќіўчi№§?","USCIGOuoscigi,");
	
	$result = mysql_query("select id from "._MX."uye where kullanici='$rumuz'");
	
	if(mysql_fetch_row($result) < 1){
	
		$ad = turkce($ad);
		$soyad = turkce($soyad);
		$sehir = turkce($sehir);
		$ulke = turkce($ulke);
		$sifre = sifrele($sifre);
		$kayit = time();
		$kayit2 = 60 * 120 * 720;
		$kayit2 = $kayit - $kayit2;
		
		

		$dogum = @mktime(0,0,0, $d2, $d1, $d3);
		
		$no = $no1 ."-". $no2;
		
		$seviyeid = seviye(NULL, "id");
		$seviye = seviye($seviyeid, "oncelik");
		
		$oncelik = $cinsiyet * $seviye;
		
		$uyelik = ayar("uyelik");
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		$bakbakalim = @mysql_query("select count(id) from "._MX."uye where sononline > $kayit2 and ip='$ip'");
		
		list($bakbakalim2) = @mysql_fetch_row($bakbakalim);
		
		if($bakbakalim2 >= 1) die("uyeolmus");
		
		
		list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
		$maxid++;
		
		$ref = $_SESSION[_COOKIE."ref"];
		
		if(!$ref) $ref = NULL;
		
		$result = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, sononline, girissayisi, ip, kayit, ref, oncelik, seviye, calintimi, durum) values('$maxid', '$rumuz', '$sifre', '$email', '$ad', '$soyad', '$no', '$dogum', '$cinsiyet', '$ulke', '$sehir', '$kayit', '1', '$ip', '$kayit', '$ref', '$oncelik', '$seviyeid', '1', '$uyelik')");
		
		include("../smssifreleme.php");

		$telefon = $_SESSION["telefon"];
		$uyeid2 = smssifrele($maxid);
		$telefon = smssifrele($telefon);
		
		if($telefon){
		@mysql_query("insert into "._MX."orospu values(NULL, '$uyeid2', '$telefon')");
		@mysql_query("update "._MX."uye set tel='', telonay='1' where id='$maxid'");
		}
		
		if($result){
		
			if($uyelik == 3){
			
				include("../fonksiyon2.php");
				
				$kod = koduret(10);
				
				$result = mysql_query("insert into "._MX."uye_onay (kullanici, kod) values('$maxid', '$kod'");
				
				// onay maili gіnderilecek
				
			}
			echo $maxid;
			die();
		}
		else {
			die("hata");
		}
		
	}
	else {
		die("hata");
	}	
}
else {
	die("hata");
}
?>