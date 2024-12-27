<?php

$item = $_REQUEST["item_number"];

if($item){
	
	include("ayarlar.php");
	include("fonksiyon.php");
	
	list($idmiz, $uyemiz, $paypal) = @mysql_fetch_row(@mysql_query("select id, uye, paypal from "._MX."paypal where item='$item'"));
	
	
	$uyeid = $uyemiz;
	
	// if($uyeid == $uyemiz){
		
		
		list($seviye, $sure) = explode(";", $paypal);
		
		$odenecektutar = seviye($seviye, "$sure");
		
		$tutar = $odenecektutar;
		
		if(strlen($ay) == 1) $ay = "0". $ay;
		
		$birgun = 60*60*24; // 60 saniye 1 saat 60 dakika 1 gün 24 saat
		
		switch($sure){
			case "aylik"; $eklezaman = $birgun * 30;break;
			case "aylik3"; $eklezaman = $birgun * 90;break;
			case "aylik6"; $eklezaman = $birgun * 180;break;
			case "yillik"; $eklezaman = $birgun * 365;break;
			case "sinirsiz"; $eklezaman = 0;break;
		}
		
		list($uyecinsiyet, $uyezaman) = @mysql_fetch_row(@mysql_query("select cinsiyet, bitis from "._MX."uye where id='$uyeid'"));
		
		// $uyecinsiyet = uyebilgi("cinsiyet");
		
		$seviyeoncelik = seviye($seviye, "oncelik");
		
		$oncelik = $uyecinsiyet * $seviyeoncelik;
		
		list($uyekayit) = mysql_fetch_row(mysql_query("select kayit from "._MX."uye where id='$uyeid'"));
		
		$zamanzaman = 60 * 60 * 24 * 2;
		
		$suankizaman = @mktime();
		
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
		
			// $uyezaman = uyebilgi("bitis");
			
			$simdi = time();
			
			if($uyezaman > $simdi){
			
			$zaman = $uyezaman + $eklezaman;
		
			}
			
			else {
			
			$zaman = $simdi + $eklezaman;
			
			}
			$result = mysql_query("update "._MX."uye set bitis='$zaman', satissatis='$olala', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");
			
			
		}
		
		$kayit = @mktime();
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		@mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '1', 'PAYPAL - $item numarali odeme', 'PayPal Odemesi', '', '', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '1')");
		
		@mysql_query("delete from "._MX."paypal where id='$idmiz'");
	
		die("ok");
		
	// }
}
else {
	die("hata");
}

?>