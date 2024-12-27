<?php

$uyeid = uyeid();

$zaman = time();

if($uyeid){

	$result = mysql_query("select count(uye) from "._MX."online where uye='$uyeid'");
	
	list($online) = mysql_fetch_row($result);	
	
	$sure = ayar("sure");
				
	$ekle = (60 * $sure) + $zaman;
				
	if($online >= 1){
	
		// guncelle
		mysql_query("update "._MX."online set kayit='$ekle' where uye='$uyeid'");
		
		
	}
	else {
	
		$kullanici = uyeadi();
		
		$cinsiyet = uyebilgi("cinsiyet");
		
		$yas = uyebilgi("dogum");
		
		$yas = date("Y")-date("Y", $yas);
		
		$sehir = uyebilgi("sehir");
		
		$seviyead = seviyeal("seviyead");
		
		$seviyeicon = seviyeal("seviyeicon");
		
		$renk = seviyeal("renk");
		
		$oncelik = seviyeal("oncelik");
		
		$uyeonceligi = $cinsiyet * $oncelik;
		
		mysql_query("insert into "._MX."online values('$uyeid', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");
	
	
	}

} // uyeid if


?>