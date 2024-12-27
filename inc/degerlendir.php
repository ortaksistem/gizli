<?php

$tur = $_POST["tur"];
$deger = $_POST["deger"];

if(!$tur) die("hata");

if(!$deger) die("hata");
function degerlendir($param){

	if(strstr($param, "<object") or strstr($param, "<applet") or strstr($param, "<title") or strstr($param, "<meta") or strstr($param, "<script")) return true;
	else return false;
}
switch($tur){
	case "ad";
	case "soyad";
		if(!degerlendir($deger)) echo "ok";
		die();
	break;
	case "d3":
		if(strlen($deger) == 4 and is_numeric($deger)) echo "ok";
		else echo "hata";
		die();
	break;
	case "no2":
		if(strlen($deger) == 7 and is_numeric($deger)) echo "ok";
		else echo "hata";
		die();	
	break;
	case "mail":

	
		if(!filter_var($deger, FILTER_VALIDATE_EMAIL)) die("hata");
		
		
			include("../ayarlar.php");
			$result = mysql_query("select id from "._MX."uye where email='$deger'");
			if(mysql_num_rows($result) >= 1) die("email");
			else die("ok");
			

	break;
	case "cinsiyet";
	case "sehir";
	case "ulke";
		if($deger) die("ok");
		else die("hata");
	break;
	case "rumuz":
		if(degerlendir($deger)) echo "hata";
		if(is_numeric($deger)) die("sayi");
		
		if(strlen($deger) < 4) die("karakter");
		
		include("../ayarlar.php");
		include("../fonksiyon.php");

		$deger = turkce($deger);
		$deger = strtr($deger,"ÜŞÇİĞÖüöşçiğı?","USCIGOuoscigi,");
		

		
		/*
		$result = mysql_query("select id from "._MX."filtre where ad like '%$deger%' and tur='1'");
		
		if(mysql_num_rows($result) >= 1) die("rumuz2");
		*/
		
		$result = mysql_query("select ad from "._MX."filtre where tur='1'");
		
		while(list($filtread) = mysql_fetch_row($result)){
			
			if(strstr($deger, $filtread)) die("rumuz2");
		
		}
		
		
		$result = mysql_query("select id from "._MX."uye where kullanici='$deger'");
		if(mysql_num_rows($result) >= 1) die("rumuz");		
		
		die("ok");
		
	break;
	case "sifre":
		if(strlen($deger) < 5) die("hata");
		else die("ok");
	break;

}

?>