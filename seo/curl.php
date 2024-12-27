<?php 

	// ayarlar
	$kadi = "webadam";
	$sifre = "g+0J%oSY";
	$girisurl = "https://188.166.48.130:8083/login/";
	$cekilcekdosya = "https://188.166.48.130:8083/download/backup/?backup=webadam.2014-12-31.tar";
	
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $girisurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');


	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'user='.$kadi.'&password='.$sifre);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6');
		$cek = curl_exec($ch);
	die($cek ."asd $kadi $sifre");
	curl_setopt($ch, CURLOPT_URL, "https://188.166.48.130:8083/");
	
	
	$cek = curl_exec($ch);
	
	
	
	
	file_put_contents('indirdim.tar', $content);
?> 