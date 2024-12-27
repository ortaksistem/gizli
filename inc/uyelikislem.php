<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "maildegistir"){

$email = $_POST["email"];
$sifremiz = $_POST["sifre"];


	if(!strstr($email, "@") and !strstr($email, ".")) die("hata2");
	
	$result = mysql_query("select sifre from "._MX."uye where id='$uyeid'");
	
	list($sqlsifre) = mysql_fetch_row($result);
	
	if($sqlsifre != sifrele($sifremiz)) die("hata1");
	
	$result = mysql_query("update "._MX."uye set email='$email' where id='$uyeid'");
	
	if($result) die("ok");
	else die("hata3");
}

if($islem == "sifredegistir"){

$yeni = $_POST["yeni"];
$sifremiz = $_POST["sifre"];
	
	$result = mysql_query("select sifre from "._MX."uye where id='$uyeid'");
	
	list($sqlsifre) = mysql_fetch_row($result);
	
	if($sqlsifre != sifrele($sifremiz)) die("hata1");
	
	$result = mysql_query("update "._MX."uye set sifre='".sifrele($yeni)."' where id='$uyeid'");
	
	if($result) {
	session_destroy();
	die("ok");
	}
	else die("hata3");
}

if($islem == "onaykodu"){
	
	include("../fonksiyon2.php");
	
	$uyeadi = uyeadi();
	
	$kod = koduret(16);
	
	$admin = ayar("mail");
	
	list($uyemail) = mysql_fetch_row(mysql_query("select email from "._MX."uye where id='$uyeid'"));
	
				$subject=""._AD." : Uyelik iptali";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Sevgili $uyeadi,</p>
				<p class=\"style2\">Talebiniz uzerine uyelik iptali icin onay kodunuz gonderilmistir.</p>
				<p class=\"style2\"><font size=3><b>Onay Kodunuz : $kod</b></font></p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$admin.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$admin.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($uyemail, $subject, $message, $headers);
	
	$result = mysql_query("select count(uye) from "._MX."uye_sil where uye='$uyeid'");
	
	list($warmi) = mysql_fetch_row($result);
	
	if($warmi >= 1){
		mysql_query("update "._MX."uye_sil set kod='$kod' where uye='$uyeid'");
	}
	else {
		mysql_query("insert into "._MX."uye_sil values('$uyeid', '$kod')");
	}
	
	
	die("ok");

}

if($islem == "uyeliksil"){

	$kod = $_POST["kod"];

	$result = mysql_query("select kod from "._MX."uye_sil where uye='$uyeid'");
	
	list($sqlkod) = mysql_fetch_row($result);
	
	if($kod != $sqlkod) die("hata");
	
	// anket log sil
	mysql_query("delete from "._MX."anket_log where uye='$uyeid'");
	
	// galeri sil
	/*
	$result = mysql_query("select id, resim from "._MX."galeri where uye='$uyeid'");
	
	while(list($galeri, $galeriresim) = mysql_fetch_row($result)){
	
		$resultresim = mysql_query("select id, resim from "._MX."galeri_resim where galeri='$galeri'");
		
		while(list($id, $resim) = mysql_fetch_row($result)){
		
			@unlink("../$resim");
			
			mysql_query("delete from "._MX."galeri_resim where id='$id'");
		}
		
		@unlink("../$galeriresim");
		
		@rmdir("../img_uye/galeri/$galeri");
		
		mysql_query("delete from "._MX."galeri where id='$galeri'");
	}
	*/
	
	// galeri talep sil
	mysql_query("delete from "._MX."galeri_talep where talepeden='$uyeid' or talepedilen='$uyeid'");
	
	// arkadas sil
	mysql_query("delete from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid'");
	
	// begeniler sil
	mysql_query("delete from "._MX."uye_begeniler where uye='$uyeid'");
	
	// cicek sil
	mysql_query("delete from "._MX."uye_cicek where uye='$uyeid' or gonderen='$uyeid'");
	
	// haftanun uyesi sil
	mysql_query("delete from "._MX."uye_hafta where uye='$uyeid'");
	
	// hit sil
	mysql_query("delete from "._MX."uye_hit where uye='$uyeid'");
	
	// mesaj sil
	mysql_query("delete from "._MX."uye_mesaj where gonderen='$uyeid' or gonderilen='$uyeid'");
	mysql_query("delete from "._MX."uye_mesaj_giden where gonderen='$uyeid' or gonderilen='$uyeid'");
	
	// opucuk sil
	mysql_query("delete from "._MX."uye_opucuk where uye='$uyeid' or gonderen='$uyeid'");
	
	// oy sil
	mysql_query("delete from "._MX."uye_oy where uye='$uyeid'");
	
	// resim sil
	/*$result = mysql_query("select id, resim from "._MX."uye_resim where uye='$uyeid'");
	
	while(list($id, $resim) = mysql_fetch_row($result)){
		@unlink("../$resim");
		
		mysql_query("delete from "._MX."uye_resim where id='$id'");
	}
	*/
	
	// yasakli sil
	mysql_query("delete from "._MX."uye_yasakli where yasaklayan='$uyeid' or yasakli='$uyeid'");
	
	
	// onay kodu sil
	mysql_query("delete from "._MX."uye_sil where uye='$uyeid'");
	
	// silmeler sanýrsam bu kadar uyeyi deaktif edicez tamamen silmioruz
	
	mysql_query("update "._MX."uye set durum='5' where id='$uyeid'");
	
	
	die("ok");
	
	
}
?>