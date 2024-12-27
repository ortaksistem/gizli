<?php
session_start();

$islem = $_GET["islem"];

if(!$islem) die("Go");

if($islem == "sifremiunuttum"){
	$kullaniciadi = $_POST["k"];
	
	if($kullaniciadi){
		
		include("../fonksiyon.php");
		
		$kullaniciadi = suz2($kullaniciadi);
		
		$result = mysql_query("select id, kullaniciadi, eposta  from kullanici where eposta='$kullaniciadi' or kullaniciadi='$kullaniciadi'");
		
		
		if(@mysql_num_rows($result) >= 1){
		
			list($kid, $kadi, $keposta) = mysql_fetch_row($result);
			
			$yenisifre = rand(100000, 999999);
			
			$sifrele = sifrele($yenisifre);
			
			$result = mysql_query("update kullanici set sifre='$sifrele' where id='$kid'");
			
			if($result){
			
					$subject=""._AD." yeni sifre";
					$message = "
					<style type=\"text/css\">
					.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
					</style>
					</head>
					<body>
					<p class=\"style2\">Kullanici Adiniz : $kadi,</p>
					<p class=\"style2\">Sifreniz : $yenisifre,</p>
					<p class=\"style2\">Sifrenizi siz sifirlamadiysaniz uzgunuz. Yeni sifreniz yukarida belirtilendir. IP adresinide gonderiliyoruz. Saygilarimizla.</p>
					<p class=\"style2\">IP : ".$_SERVER["REMOTE_ADDR"]."</p>
					<p class=\"style2\">Tarih : ".date("d.m.Y H:i")."</p>
					</body>
					</html>";
					$headers = "From: "._AD." <"._AD.">\n";
					$headers .= "X-Sender: <"._MAIL.">\n";
					$headers .= "X-Mailer: PHP\n"; //mailer
					$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
					$headers .= "Return-Path: <"._MAIL.">\n";
					$headers .= "Content-Type: text/html; charset=utf-8\n";
					@mail($keposta, $subject, $message, $headers);
		
					die("ok");
			
			}
			else {
				die("Şifrenizi değiştiremedik, üzgünüz. Yeniden dener misiniz?");
			}
			
		}
		else {
		
			die("Sistemimizde böyle bir kullanıcı olduğunu düşünmüyoruz");
		}
	
	}
	else {
		die("Kullanıcı adını yazmanız gerekmiyor mu?");
	}

}
if($islem == "giris"){
	$kullaniciadi = $_POST["k"];
	$sifre = $_POST["s"];
	

	if($kullaniciadi and $sifre){
		
		/*
		$girisban = $_SESSION["girissay"];
		
		if($girisban){
			
			list($zaman, $sayi) = explode("||", $girisban);
			
			if($sayi > 5){
				
				$sure = 60 * 15;
				
				$sure = time() + $sure;
				
				if($zaman > $sure) {
					
					$_SESSION["girissay"] = time()."||0";
					
				}
				else {
					
					die("Zorlamanıza artık gerek kalmadı. 15 dakika banlandınız. Sonra deneyin");
					
				}
			
			}
			
		}
		*/
		
		include("../fonksiyon.php");
		
		$kullaniciadi = suz2($kullaniciadi);
		$sifre = suz2($sifre);
		
		$result = mysql_query("select id, kullaniciadi, eposta, sifre, seviye from kullanici where eposta='$kullaniciadi' or kullaniciadi='$kullaniciadi'");
		
		$zaman = time();
		
		if(@mysql_num_rows($result) >= 1){
			
			list($kid, $kadi, $keposta, $ksifre, $kseviye) = mysql_fetch_row($result);
			
			if(sifrele($sifre) == $ksifre){
				
				$bilgiler = "$kid||$kadi||$keposta||$ksifre||$kseviye";
				
				$_SESSION[_COOKIE."kullanici"] = base64_encode($bilgiler);
				
				@mysql_query("insert into kullanici_log (kullanici, tip, ip, tarayici, zaman) values('$kid', '1', '".$_SERVER["REMOTE_ADDR"]."', '".$_SERVER["HTTP_USER_AGENT"]."', '$zaman')");

				die("ok");
				
			}
			else {
				/*
				if($girisban){
					list($zaman, $sayi) = explode("||", $girisban);
					$sayi++;
					$_SESSION["girissay"] = time()."||".$sayi;
				}
				else {
					$_SESSION["girissay"] = time()."||1";
				}
				*/
				die("Giriş bilgilerinizi kontrol ediniz");
			}
		
		}
		else {
			/*
				if($girisban){
					list($zaman, $sayi) = explode("||", $girisban);
					$sayi++;
					$_SESSION["girissay"] = time()."||".$sayi;
				}
				else {
					$_SESSION["girissay"] = time()."||1";
				}
				*/
			die("Böyle bir kullanıcı bulunmamaktadır");
		}
		
	
	}
	else {
		die("Yazmanız gereken yerler boş değil mi?");
	}
}

if($islem == "uyeol"){
	
	$kullaniciadi = $_POST["k"];
	$sifre = $_POST["s"];
	$eposta = $_POST["e"];
	
	if($kullaniciadi and $sifre and $eposta){
		
		if(!strstr($eposta, "@") and !strstr($eposta, ".")){
			die("Eposta geçersiz gibi görünüyor");
		}
		
		if(strlen($sifre) < 6){
			die("Şifreniz güvensiz bir şifre değil mi?");
		}
		
		if($kullaniciadi == $eposta){
			die("Eposta ve kullanici adının aynı olması sence mantıklı mı?");
		}
		
		include("../fonksiyon.php");
		
		$kullaniciadi = suz2($kullaniciadi);
		$sifre = suz2($sifre);
		$eposta = suz2($eposta);
		
		$warmi = @mysql_query("select id from kullanici where kullaniciadi='$kullaniciadi'");
		if(@mysql_num_rows($warmi) >= 1){
			die("Kullanıcı adı sistemde kayıtlı");	
		}
		
		$warmi = @mysql_query("select id from kullanici where eposta='$eposta'");
		if(@mysql_num_rows($warmi) >= 1){
			die("E-posta adresi sistemde kayıtlı");
		}
		
		$sifre = sifrele($sifre);
		$kayit = @mktime();
		
		$result = mysql_query("insert into kullanici (kullaniciadi, sifre, eposta, kayit, durum) values('$kullaniciadi', '$sifre', '$eposta', '$kayit', '1')");
		
		if($result){
			die("tamam");
		}
		else {
			die("Üyeliği açamadık, tekrar dener misiniz?");
		}
		
		
	}
	else {
		die("Tüm bilgileri doldurun.");
	}
	
}

?>