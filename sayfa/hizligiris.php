<?php

$kullanici = $_GET["k"];
$sifre = $_GET["s"];



if($kullanici and $sifre){

	$kullanici = suz($kullanici);
	
	$sifre = sifrele($sifre);
	
	$result = mysql_query("select id, sifre, cinsiyet, dogum, sehir, img, sononline, bitis, oncelik, seviye, durum from "._MX."uye where kullanici='$kullanici'");
	
	if(mysql_num_rows($result) >= 1){
		
		list($id, $sqlsifre, $cinsiyet, $dogum, $sehir, $uyeavatar, $sononline, $bitis, $oncelik, $seviye, $durum) = mysql_fetch_row($result);
		
		if($sqlsifre == $sifre){
		
			/*
			if($durum != 1){
			
				die("hata3");
			}
			*/

			if($durum == 5) { echo '<script>window.location = "index.php";</script>'; die(); }
			
			if($durum == 6) { echo '<script>window.location = "index.php";</script>'; die(); }
			
			
			$zaman = @mktime();

			$anaseviye = ayar("seviye");
			
			if($anaseviye != $seviye){
			
				if($bitis){
				
					if($bitis < $zaman){
					
						$seviye = $anaseviye;
						
						$oncelik = seviye($seviye, "oncelik");
						
						mysql_query("update "._MX."uye set bitis='0', oncelik='$oncelik', seviye='$seviye' where id='$id'");
					
					}
				
				}
				
			}
			
						
			$resultseviye = mysql_query("select ad, icon, renk, oncelik, profil, goruntuleme, profilbakan, profilbakan2, profilresmi, profilresmilimit, album, albumlimit, album2, mesaj, mesajlimit, mesajoku, mesajcevapla, arama, arama2, opucuk, opucukgor, opucukgor2, cicek, cicekgor, cicekgor2, yasakla, yasaklagor, yasaklagor2, yasaklagor3, yasaklagor4, arkadas, arkadasgor, online, sohbet, oyun, bilgiler, arkadaslistele, davet, mesajfiltre from "._MX."seviye where id='$seviye'");
			
			list($seviyead, $seviyeicon, $renk, $oncelik1, $profil, $goruntuleme, $profilbakan, $profilbakan2, $profilresmi, $profilresmilimit, $album, $albumlimit, $album2, $mesaj, $mesajlimit, $mesajoku, $mesajcevapla, $arama, $arama2, $opucuk, $opucukgor, $opucukgor2, $cicek, $cicekgor, $cicekgor2, $yasakla, $yasaklagor, $yasaklagor2, $yasaklagor3, $yasaklagor4, $arkadas, $arkadasgor, $online, $sohbet, $oyun, $bilgiler, $arkadaslistele, $davet, $mesajfiltre) = mysql_fetch_row($resultseviye);
			
			$dataseviye = "!seviyeid=$seviye&!seviyead=$seviyead&!seviyeicon=$seviyeicon&!renk=$renk&!oncelik=$oncelik1&!profil=$profil&!goruntuleme=$goruntuleme&!profilbakan=$profilbakan&!profilbakan2=$profilbakan2&!profilresmi=$profilresmi&!profilresmilimit=$profilresmilimit&!album=$album&!albumlimit=$albumlimit&!album2=$album2&!mesaj=$mesaj&!mesajlimit=$mesajlimit&!mesajoku=$mesajoku&!mesajcevapla=$mesajcevapla&!arama=$arama&!arama2=$arama2&!opucuk=$opucuk&!opucukgor=$opucukgor&!opucukgor2=$opucukgor2&!cicek=$cicek&!cicekgor=$cicekgor&!cicekgor2=$cicekgor2&!yasakla=$yasakla&!yasaklagor=$yasaklagor&!yasaklagor2=$yasaklagor2&!yasaklagor3=$yasaklagor3&!yasaklagor=$yasaklagor4&!arkadas=$arkadas&!arkadasgor=$arkadasgor&!online=$online&!sohbet=$sohbet&!oyun=$oyun&!bilgiler=$bilgiler&!arkadaslistele=$arkadaslistele&!davet=$davet&!mesajfiltre=$mesajfiltre&";
			
			$uyeonceligi = $cinsiyet * $oncelik1;
			
			$yas = (date("Y")-date("Y", $dogum));
			
			$sure = ayar("sure");
			
			$ekle = (60 * $sure) + $zaman;

			$resultonline = mysql_query("select count(uye) from "._MX."online where uye='$id'");
			
			list($online) = mysql_fetch_row($resultonline);	
						
			if($online >= 1){
			
				mysql_query("delete from "._MX."online where uye='$id'");
				
			}
				
			mysql_query("update "._MX."uye set sononline='$zaman', sononline2='$sononline', girissayisi=girissayisi+1 where id='$id'");
			
			mysql_query("insert into "._MX."online values('$id', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");
			
			$data = $id .";;;". $kullanici .";;;". $sifre .";;;". $cinsiyet .";;;". $dogum .";;;". $sehir .";;;". $uyeavatar;
			

			
			$data = base64_encode($data);
			
			$_SESSION[_COOKIE] = $data;
			$_SESSION[_COOKIE."seviye"] = $dataseviye;
			
			echo '<script>window.location = "index.php?sayfa=giris";</script>';
			
		}
		else {
			echo '<script>window.location = "index.php";</script>';
		}
	}
	else {
		echo '<script>window.location = "index.php";</script>';
	}
}
else {
	echo '<script>window.location = "index.php";</script>';
}

?>