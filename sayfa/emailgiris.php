<?php

session_start();

$kullanici = $_GET["k"];
$sifre = $_GET["s"];
$id = $_GET["id"];
$_SESSION[_COOKIE."ref"] = "mailler";

if($kullanici and $sifre){
	
	if(filter_var($kullanici, FILTER_VALIDATE_EMAIL)){
	
		
		$result = mysql_query("select count(id) from "._MX."uye where email='$kullanici'");
		
		list($warmi) = mysql_fetch_row($result);
		
		if($warmi >= 1){
		
			@mysql_query("delete from "._MX."mail where mail='$kullanici'");
			
			echo '<script>alert(\'Sitemizde email adresiniz zaten kay�tl�d�r, Anasayfaya y�nlendiriliyorsunuz\'); window.location = "index.php";</script>';
		
		}
		else {
		
			@mysql_query("update "._MX."mail set durum='1' where mail='$kullanici'");
			
			echo '<script>alert(\'Sayin Uyemiz uye ol adimlarini tamamlamadiginiz icin mesaj icerigini okuyamassiniz devam etmek i�in tamam� t�klay�n�z.\'); window.location = "index.php?sayfa=uyeolyeni&k='.$kullanici.'";</script>';
		
		}
	
	
	}
	else {
	
		echo '<script>alert(\'Ge�ersiz giri� yap�ld�, Anasayfaya y�nlendiriliyorsunuz\'); window.location = "index.php";</script>';
		
	}

}
else {
	echo '<script>alert(\'Ge�ersiz giri� yap�ld�, Anasayfaya y�nlendiriliyorsunuz\'); window.location = "index.php";</script>';
}

?>