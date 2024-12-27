<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die(2);

$yapan = $_POST["yapan"];
$yapilan = $_POST["yapilan"];


if(!is_numeric($yapan) or !is_numeric($yapilan)) die(1);


include("../ayarlar.php");
include("../fonksiyon.php");

$yapanad = uyeadi();
list($yapilanad, $yapilancinsiyet) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet from "._MX."uye where id='$yapilan'"));

if($islem == "yasakla"){

	$result = mysql_query("select count(id) from "._MX."uye_yasakli where yasaklayan='$yapan' and yasakli='$yapilan'");
	
	list($varmi) = mysql_fetch_row($result);

	if($varmi >= 1) die("var");
	
	$kayit = time();
	
	$result = mysql_query("insert into "._MX."uye_yasakli values(NULL, '$yapan', '$yapilan', '$yapanad', '$yapilanad', '$kayit')");

	die("ok");
}

if($islem == "arkadas"){

	$result = mysql_query("select count(id) from "._MX."uye_arkadas where uye='$yapan' and arkadas='$yapilan'");
	
	list($varmi) = mysql_fetch_row($result);

	if($varmi >= 1) die("var");
	
	$kayit = time();
	
	$result = mysql_query("insert into "._MX."uye_arkadas values(NULL, '$yapan', '$yapilan', '$yapanad', '$yapilanad', '$kayit', '2')");

	mysql_query("update "._MX."uye set toparkadas=toparkadas+1 where id='$yapilan'");
	
	die("ok");
}

if($islem == "opucuk"){

	$result = mysql_query("select count(id) from "._MX."uye_opucuk where uye='$yapilan' and gonderen='$yapan'");
	
	list($varmi) = mysql_fetch_row($result);

	if($varmi >= 1) die("var");
	
	$result = mysql_query("select count(id) from "._MX."uye_opucuk where uye='$yapilan'");
	
	list($kactane) = mysql_fetch_row($result);
	
	if($kactane >= 75){
		list($silinecek) = mysql_fetch_row(mysql_query("select id from "._MX."uye_opucuk where uye='$yapilan' order by id asc limit 1"));
		mysql_query("delete from "._MX."uye_opucuk where id='$silinecek'");
	}
	
	$yapancinsiyet = uyebilgi("cinsiyet");
	$yapandogum = uyebilgi("dogum");
	$yapansehir = uyebilgi("sehir");
		
	$kayit = time();
	
	$result = mysql_query("insert into "._MX."uye_opucuk values(NULL, '$yapilan', '$yapan', '$yapilanad', '$yapanad', '$yapancinsiyet', '$yapandogum', '$yapansehir', '$kayit')");
	
	if($kactane < 75) mysql_query("update "._MX."uye set topopucuk=topopucuk+1 where id='$yapilan'");

	die("ok");
}

if($islem == "cicek"){

	$result = mysql_query("select count(id) from "._MX."uye_cicek where uye='$yapilan' and gonderen='$yapan'");
	
	list($varmi) = mysql_fetch_row($result);

	if($varmi >= 1) die("var");
	
	$result = mysql_query("select count(id) from "._MX."uye_cicek where uye='$yapilan'");
	
	list($kactane) = mysql_fetch_row($result);
	
	if($kactane >= 75){
		list($silinecek) = mysql_fetch_row(mysql_query("select id from "._MX."uye_cicek where uye='$yapilan' order by id asc limit 1"));
		mysql_query("delete from "._MX."uye_cicek where id='$silinecek'");
	}
	
	$yapancinsiyet = uyebilgi("cinsiyet");
	$yapandogum = uyebilgi("dogum");
	$yapansehir = uyebilgi("sehir");
	
	
	$kayit = time();
	
	$result = mysql_query("insert into "._MX."uye_cicek values(NULL, '$yapilan', '$yapan', '$yapilanad', '$yapanad', '$yapancinsiyet', '$yapandogum', '$yapansehir', '$kayit')");

	if($kactane < 75) mysql_query("update "._MX."uye set topcicek=topcicek+1 where id='$yapilan'");
	
	die("ok");
}

if($islem == "begeni"){

	$begeni = $_POST["begeni"];
	
	$result = mysql_query("select count(id) from "._MX."uye_begeniler where uye='$yapilan' and begeni='$begeni'");
	
	list($warmi) = mysql_fetch_row($result);

	$yapancinsiyet = uyebilgi("cinsiyet");	
		
	$begenen = $yapan .";". $yapanad .";". $yapancinsiyet;
		
			
	if($warmi < 1){
		
		mysql_query("insert into "._MX."uye_begeniler values(NULL, '$yapilan', '$yapilanad', '$yapilancinsiyet', '$begeni', '$begenen', '1')");
		
		die("ok");
	
	}
	else {
	
		list($begenenler) = mysql_fetch_row(mysql_query("select begenenler from "._MX."uye_begeniler where uye='$yapilan' and begeni='$begeni'"));
		
		if(!strstr($begenenler, $begenen)){
			
			$begenenler = $begenenler .":::". $begenen;
			
			mysql_query("update "._MX."uye_begeniler set begenenler='$begenenler', hit=hit+1 where uye='$yapilan' and begeni='$begeni'");
			
			die("ok");
		}
		else {
			die("var");
		}
	}

}

if($islem == "oy"){
	
	$puan = $_POST["puan"];

	$ay = date("m");
	
	$yil = date("Y");

	$zaman = time();
	
	$kullanan = $yapan .";". $yapanad .";". $puan .";". $zaman;
	
	$result = mysql_query("select count(uye) from "._MX."uye_oy where uye='$yapilan' and ay='$ay' and yil='$yil'");
	
	list($varmi) = mysql_fetch_row($result);
	
	if($varmi < 1){
	
		list($yapilancinsiyet, $yapilanyas, $yapilansehir) = mysql_fetch_row(mysql_query("select cinsiyet, dogum, sehir from "._MX."uye where id='$yapilan'"));


		$result = mysql_query("insert into "._MX."uye_oy values('$yapilan', '$yapilanad', '$yapilancinsiyet', '$yapilanyas', '$yapilansehir', '1', '$puan', '$kullanan', '$ay', '$yil')");
		
		mysql_query("update "._MX."uye set bakiye=bakiye+$puan where id='$yapilan'");
		
		die("ok");
		
	}
	else {
		
		$kullanan2 = $yapan .";". $yapanad;
		
		$result = mysql_query("select count(uye) from "._MX."uye_oy where oylar like '%$kullanan2%' and uye='$yapilan' and ay='$ay' and yil='$yil'");
		
		list($count) = mysql_fetch_row($result);
		
		if($count >= 1) die("var");
		
		list($oylar) = mysql_fetch_row(mysql_query("select oylar from "._MX."uye_oy where uye='$yapilan' and ay='$ay' and yil='$yil'"));
		
		$oylar = $oylar .":". $kullanan;
		
		$result = mysql_query("update "._MX."uye_oy set toplamoy=toplamoy+1, toplampuan=toplampuan+$puan, oylar='$oylar' where uye='$yapilan' and ay='$ay' and yil='$yil'");
		
		mysql_query("update "._MX."uye set bakiye=bakiye+$puan where id='$yapilan'");
		
		die("ok");
	
	}

	
}

if($islem == "galeritalep"){

	$galeri = $_POST["galeri"];
	
	list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_talep where galeri='$galeri' and talepeden='$yapan' and talepedilen='$yapilan'"));
	
	if($warmi >= 1){
		die("var");
	}
	else {
		
		@mysql_query("update "._MX."uye set topgaleritalep=topgaleritalep+1 where id='$yapilan'");
		
		mysql_query("insert into "._MX."galeri_talep values(NULL, '$galeri', '$yapan', '$yapilan', '".time()."', '0', '2')");
		
		die("ok");
		
	
	}
	
	
	
}
?>