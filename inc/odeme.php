<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "kredikarti"){

	$ad = $_POST["ad"];
	$tel = $_POST["tel"];
	$mail = $_POST["mail"];
	$num1 = $_POST["num1"];
	$num2 = $_POST["num2"];
	$num3 = $_POST["num3"];
	$num4 = $_POST["num4"];
	$ay = $_POST["ay"];
	$yil = $_POST["yil"];
	$tutar = $_POST["tutar"];
	$cvc = $_POST["cvc"];

	
	$ad = turkce($ad);
	
	if(!$tutar or $tutar == "undefined") die("hata1");
	
	list($seviye, $sure) = explode(";", $tutar);
	
	$odenecektutar = seviye($seviye, "$sure");
	
	$tutar = $odenecektutar;
	
	if(strlen($ay) == 1) $ay = "0". $ay;
	

	$cc_gonder = curl_init();
	curl_setopt($cc_gonder, CURLOPT_URL, "http://www.dekatek.com/YKBODeme/batuodeme.php");
	curl_setopt($cc_gonder, CURLOPT_POST, 1);
	curl_setopt($cc_gonder, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($cc_gonder, CURLOPT_POSTFIELDS,"gkodu=145314533&ad=".urlencode($ad)."&num1=$num1&num2=$num2&num3=$num3&num4=$num4&ay=$ay&yil=$yil&tutar=$tutar&cvc=$cvc");
	$sonuc = curl_exec ($cc_gonder);
	curl_close ($cc_gonder);

	$file = 'cc.log';
	$veri = file_get_contents($file);
	$veri .= $sonuc;
	@file_put_contents($file, $veri);

	
	if($sonuc == "ok"){

		$birgun = 60*60*24; // 60 saniye 1 saat 60 dakika 1 g�n 24 saat
		
		switch($sure){
			case "aylik"; $eklezaman = $birgun * 30;break;
			case "aylik3"; $eklezaman = $birgun * 90;break;
			case "aylik6"; $eklezaman = $birgun * 180;break;
			case "yillik"; $eklezaman = $birgun * 365;break;
			case "sinirsiz"; $eklezaman = 0;break;
		}
		
		$uyecinsiyet = uyebilgi("cinsiyet");
		
		$seviyeoncelik = seviye($seviye, "oncelik");
		
		$oncelik = $uyecinsiyet * $seviyeoncelik;
		
		list($uyekayit) = mysql_fetch_row(mysql_query("select kayit from "._MX."uye where id='$uyeid'"));
		
		$zamanzaman = 60 * 60 * 24 * 2;
		
		$suankizaman = time();
		
		if($uyekayit + $zamanzaman > $suankizaman){
			$olala = 1;
		}
		else {
			list($satisadet) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme2"));
			list($satisadet2) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme"));
			
			$satisadet = $satisadet + $satisadet2;
			
			if($satisadet%2 == 0) $olala = 2;
			else $olala = 1;
		
		}
		
		if($sure == "sinirsiz"){

			$result = mysql_query("update "._MX."uye set bitis='0', satissatis='$olala', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");		
		
		}
		else {
		
			$uyezaman = uyebilgi("bitis");
			
			$simdi = time();
			
			if($uyezaman > $simdi){
			
			$zaman = $uyezaman + $eklezaman;
		
			}
			
			else {
			
			$zaman = $simdi + $eklezaman;
			
			}
			$result = mysql_query("update "._MX."uye set bitis='$zaman', satissatis='$olala', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");
			
			
		}
		
		$kayit = time();
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '1', '$ad', '$tel', '', '$mail', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '1')");
		
		die("ok");
		
		
	
	}
	else {
	die("hata2");
	}
	

}

if($islem == "havale"){

	$ad = $_POST["ad"];
	$tel = $_POST["tel"];
	$mail = $_POST["mail"];
	$tutar = $_POST["tutar"];
	$mesaj = $_POST["mesaj"];
	$banka = $_POST["banka"];

	
	$ad = turkce($ad);
	$mesaj = $mesaj ."<p>�deme Yap�lan Banka : <b>$banka</b></p>";
	$mesaj = turkce($mesaj);
	
	if(!$tutar or $tutar == "undefined") die("hata1");
	
	list($seviye, $sure) = explode(";", $tutar);
	
	$odenecektutar = seviye($seviye, "$sure");

	$kayit = time();
	
	$ip = $_SERVER["REMOTE_ADDR"];
	
	$mesaj = addslashes($mesaj);
	
	mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '2', '$ad', '$tel', '$mesaj', '$mail', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '2')");
		
	die("ok");

}
?>