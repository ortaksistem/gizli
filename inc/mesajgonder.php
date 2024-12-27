<?php

session_start();

$gonderen = $_POST["gonderen"];
$gonderilen = $_POST["gonderilen"];
$mesaj = $_POST["mesaj"];
$konu = $_POST["konu"];

if(!is_numeric($gonderen) or !is_numeric($gonderilen)) die("hata");

if($konu and $mesaj){
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	$mesajlimit = seviyeal("mesajlimit");
	$oncelik = seviyeal("oncelik");
	$mesajfiltre = seviyeal("mesajfiltre");
	$cinsiyet = uyebilgi("cinsiyet");
	$zaman = time();
	$zaman2 = date("Y-m-d");
	$mesajonceligi = $cinsiyet * $oncelik;
	$gonderenad = uyeadi();
	
	
	list($yasaklimi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_yasakli where yasaklayan='$gonderilen' and yasakli='$gonderen'"));
	
	if($yasaklimi >= 1){
		
		die("ok");
	
	}
	
	$result = mysql_query("select count(id) from "._MX."uye_mesaj where gonderen='$gonderen' and tarih='$zaman2'");
	
	list($gonderilenmesaj) = mysql_fetch_row($result);
	
	if($gonderilenmesaj >= $mesajlimit) die("hata1");
	
	$konu = suz(turkce($konu));
	
	$mesaj = suz(turkce($mesaj));
	
	
	if($mesajfiltre == 1){
		
			$result = mysql_query("select ad from "._MX."filtre where tur='2'");
			
			while(list($ad) = mysql_fetch_row($result)){
			
				if(strstr($mesaj, $ad)) $mesaj = str_replace($ad, "<font color=red>[gizlendi]</font>", $mesaj);
				if(strstr($konu, $ad)) $konu = str_replace($ad, "<font color=red>[gizlendi]</font>", $konu);
			}
		
	}
	
	$mesajengel = ayar("mesaj");
	
	
	if($mesajengel == 1){
	
		
		if($gonderilen != 1838 and $gonderen != 1838){
		
		list($gonderilencins) = mysql_fetch_row(mysql_query("select cinsiyet from "._MX."uye where id='$gonderilen'"));
		
		
		if($cinsiyet == 3 and $gonderilencins == 3){
		
	
			$mesajayargiden = uyebilgi("mesajayargiden");
			
			if($mesajayargiden == 1){
				
				$result = mysql_query("insert into "._MX."uye_mesaj_giden (gonderen, gonderilen, gonderenad, konu, mesaj, kayit, tarih, oncelik, yer, durum) values('$gonderen', '$gonderilen', '$gonderenad', '$konu', '$mesaj', '$zaman', '$zaman2', '$mesajonceligi', '1', '2')");			
			
			}
			
			die("ok");
				
		
		}
		
		}
		
	
	}
	
	if($gonderen == 1838) $mesajonceligi = 1;
	
	$result = mysql_query("insert into "._MX."uye_mesaj (gonderen, gonderilen, gonderenad, konu, mesaj, kayit, tarih, oncelik, yer, durum) values('$gonderen', '$gonderilen', '$gonderenad', '$konu', '$mesaj', '$zaman', '$zaman2', '$mesajonceligi', '1', '2')");
	
	if($result) {
	
	
		mysql_query("update "._MX."uye set topmesaj=topmesaj+1 where id='$gonderilen'");
		// giden kutusu kayit
		
		$mesajayargiden = uyebilgi("mesajayargiden");
		
		if($mesajayargiden == 1){
			
			$result = mysql_query("insert into "._MX."uye_mesaj_giden (gonderen, gonderilen, gonderenad, konu, mesaj, kayit, tarih, oncelik, yer, durum) values('$gonderen', '$gonderilen', '$gonderenad', '$konu', '$mesaj', '$zaman', '$zaman2', '$mesajonceligi', '1', '2')");			
		
		}
		
		list($gkullanici, $gsifre, $gmail, $mesajayarmail) = mysql_fetch_row(mysql_query("select kullanici, sifre, email, mesajayarmail from "._MX."uye where id='$gonderilen'"));
	
		if($mesajayarmail == 1){
			
			
			$subject = "$gonderenad rumuzlu uyeden mesaj aldiniz";
			
			$message="<body>	
			<p><b>Sayin uyemiz "._AD." Sitesinden <font color='#FF0000'></font>
			<br>
			$gonderenad rumuzlu uyemizden yeni bir mesaj aldiniz</b></p>
			<p><b>Mesaji Okumak icin Lutfen Siteye Giris Yapiniz..</b></p>
			<p><b>&nbsp;</b></p>
			<p><b>Giris Bilgileriniz</b></p>
			<p><b>Kullanici Adiniz : $gkullanici</b></p>
			<p><b>Sifreniz : $gsifre</b></p>
			<p><font color='#FF0000'><b>
			<a target='_blank' href='"._URL."index.php?sayfa=hizligiris&k=$gkullanici&s=$gsifre' style='text-decoration: none'>
			<font color='#FF0000'>Giris yapmak icin BURAYA TIKLAYINIZ...</font></a></b></font></p>
			<p><font color='#0000FF'><b>
			<a target='_blank' href='"._URL."' style='text-decoration: none'>
			"._URL."</a></b></font></p>
			</body>	
			";
			$headers = "From: no-reply@yatakpartner.com <no-reply@yatakpartner.com>\n";
			$headers .= "X-Sender: <no-reply@yatakpartner.com>\n";
			$headers .= "X-Mailer: PHP\n"; //mailer
			$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
			$headers .= "Return-Path: <no-reply@yatakpartner.com>\n";
			$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
			mail($gmail, $subject, $message, $headers);
		
		}	
	
		die("ok");
	}
	else die("hata");

}
else die("hata");

?>