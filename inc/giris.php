<?php

error_reporting(0);
session_start();

header('Content-Type: text/html; charset=iso-8859-9'); 

$kullanici = $_POST["kullanici"];
$sifre = $_POST["sifre"];

if($kullanici and $sifre){

	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	$kullanici = suz($kullanici);

	$kullanici = turkce($kullanici);
	$kullanici = strtr($kullanici,"ÜÞÇÝÐÖüöþçiðý?","USCIGOuoscigi,");

	$sifre = sifrele($sifre);
	
	$result = mysql_query("select id, sifre, email, cinsiyet, dogum, sehir, img, sohbetdurum, bansebep, banbitis, sononline, bitis, oncelik, seviye, calintimi, durum from "._MX."uye where kullanici='$kullanici'");
	
	if(mysql_num_rows($result) >= 1){
		
		list($id, $sqlsifre, $kemail, $cinsiyet, $dogum, $sehir, $uyeavatar, $sohbetdurum, $bansebep, $banbitis, $sononline, $bitis, $oncelik, $seviye, $calintimi, $durum) = mysql_fetch_row($result);
		

		$aazaman = time();

		$cccikar = 60 * 60 * 24 * 31 * 3;

		$aakalan = $aazaman - $cccikar;
		
		/*
		if($cinsiyet != 1){
		if($sononline < $aakalan){
		
						echo "Sayin üyemzi sistemimize uzun süre giriþ yapmadýðýnýz için güvenlik sebebi ile üyeliðiniz kapatýlmýþtýr, Sistemimizden yeniden faydalanmak için yeni bir üyelik almanýz yeterli olacaktýr.";
						
						
						die();	
		
		}
		}
		*/
		
		
		if($calintimi == 0){

			function uretbakim() {



				$chars = "abcdefghijkmnopqrstuvwxyz023456789";

				srand((double)microtime()*1000000);

				$i = 0;

				$pass = '' ;



				while ($i <= 12) {

					$num = rand() % 33;

					$tmp = substr($chars, $num, 1);

					$pass = $pass . $tmp;

					$i++;

				}



				return $pass;



			}
			
				$randomkod = uretbakim();
				$randomkod2 = uretbakim();
				$randomkod3 = uretbakim();
				$randomkod4 = uretbakim();
				$randomkod5 = uretbakim();
				$randomkod6 = uretbakim();
		
			include("class.phpmailer.php");
		
			$yenisifre = rand(100000, 999999);
			
			$mailmesaj = '<p><b><font face="Tahoma" size="2" color="#FF0000">Yeni þifreniz : '.$yenisifre.'</font></b></p>';
						
			$mail = new PHPMailer(true);
																			
			$mail->IsSMTP();
			$mail->Host       = "173.192.198.112";		
			$mail->SMTPDebug  = 2;
			$mail->SMTPAuth   = true;         		    
			$mail->Host       = "173.192.198.112";		
			$mail->Port       = 587; 		
			$mail->Username   = "batuhandemirkan@ask-mesk.com";		
			$mail->Password   = "s9d8t7";
			$mail->AddReplyTo('ileti@engellenenler.com', "Yatakpartner Yeni Sifreniz");		
			$mail->SetFrom('ileti@engellenenler.com', "Yatakpartner Yeni Sifreniz");					
			// $mail->Subject = ''.$boadi.' & '.$mesajinkonusu.'';		
			$mail->Subject = 'Yatakpartner Yeni sifreniz';		
			// $mail->AltBody = ''.$boadi.' & '.$mesajinkonusu.'';
			$mail->AltBody = 'Yatakpartner Yeni Sifreniz';
			$mail->AddAddress($kemail, "Yatakpartner Yeni Sifreniz");
			$mail->MsgHTML("$mailmesaj");									  
			$mail->Send();
						
						
						@mysql_query("update "._MX."uye set sifre='$yenisifre', calintimi='1' where id='$id'");
						
						
						echo "Sayýn üyemiz güvenliðiniz için þifreniz deðiþtirilmiþ olup, mail adresinize gönderilmiþtir. Ayrýca güvenliðiniz için mail þifenizi de deðiþtirmenizi tavsiye ederiz. Ýlginiz için teþekkür eder, iyi eðlenceler dileriz.";
						
						
						die();
			
			
		}
		
		if($sqlsifre == $sifre){
		
			/*
			if($durum != 1){
			
				die("hata3");
			}
			*/
			
			$hata = NULL;
			
			if($durum == 4) $hata = "Sistemden süresiz banlandýnýz.\nBan sebebi : $bansebep";
			
			if($durum == 5) $hata = "Üyeliðiniz sizin tarafýnýzdan silindiðinden sisteme giriþ yapamazsýnýz";
			
			if($durum == 6) $hata = "Üyeliðiniz editör tarafýndan silinmiþtir";
			
			if($durum == 7){
				if($banbitis > $kayit){
					
					$banbitis = date("d.m.Y", $banbitis);
					
					$hata = "Üyeliðiniz $banbitis tarihine kadar banlanmýþtýr.\nBan sebebi : $bansebep";
				
				}
				else {
					
					@mysql_query("update "._MX."uye set durum='1' where id='$id'");
				
				}
			
			}
			
			if($hata){
				die($hata);
			}
			
			$zaman = time();

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
			
			if($durum == 1){
			
			$resultonline = mysql_query("select count(uye) from "._MX."online where uye='$id'");
			
			list($online) = mysql_fetch_row($resultonline);	
						
			if($online >= 1){
			
				mysql_query("delete from "._MX."online where uye='$id'");
				
			}
				
			mysql_query("update "._MX."uye set sononline='$zaman', sononline2='$sononline', girissayisi=girissayisi+1 where id='$id'");
			
			mysql_query("insert into "._MX."online values('$id', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");
			
			}
			
			$data = $id .";;;". $kullanici .";;;". $sifre .";;;". $cinsiyet .";;;". $dogum .";;;". $sehir .";;;". $uyeavatar;
			
			$data = base64_encode($data);
			
			$resultarkadas = @mysql_query("select uye, arkadas, durum from "._MX."uye_arkadas where uye='$id' or arkadas='$id'");
			
			$arkadaslarim = NULL;
			
			while(list($arkadas1, $arkadas2, $durum) = @mysql_fetch_row($resultarkadas)){
					
					if($durum == 1){
						if($arkadas1 == $id) $arkadaslarim .= $arkadas2 ."|";
						else $arkadaslarim .= $arkadas1 ."|";
					}
			}
			
			$uyeavatar = uyeavatar($uyeavatar, $cinsiyet);
			$cinsiyet = cinsiyet($cinsiyet);
			
			$dosya = "../ypsohbetdosyalar/kisiler.log";
			$handle = @fopen($dosya, "r");
			$icerik = @fread($handle, filesize($dosya));
			@fclose($handle);
			if(!strstr($icerik, "".$id ."|")){
			
				$fh = @fopen($dosya, 'w');
				$veri = $id ."|". $sohbetdurum ."|". $kullanici ."|". $yas ."|". $cinsiyet ."|". $uyeavatar ."|". $sehir ."|". $seviyead ."|". $renk ."|||"; 
				@fwrite($fh, $icerik.$veri);
				@fclose($fh); 
			}
			
			$_SESSION[_COOKIE] = $data;
			$_SESSION[_COOKIE."seviye"] = $dataseviye;
			
			$_SESSION[_COOKIE."arkadas"] = $arkadaslarim;
			$_SESSION[_COOKIE."sohbetdata"] = $cinsiyet ."|". $seviyead;
			$_SESSION["username"] = turkceyecevir($kullanici);
			$_SESSION["sohbetdurum"] = $sohbetdurum;
			
			if(mobilcihazmi()) die("mobil");
			die("ok");
		}
		else {
			die("hata2");
		}
	}
	else {
		die("hata2");
	}
}
else {
	die("hata1");
}
function turkceyecevir($param){
	$param = strtr($param,"ÜÞÇÝÐÖüöþçiðý?%","USCIGOuoscigi,,");
	$param = str_replace(' ', '_', $param);
	return $param;
}
?>