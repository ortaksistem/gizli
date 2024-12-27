<?php
session_start();

$isim = $_POST["a1"];
$email = $_POST["a2"];
$tel = $_POST["a3"];
$konu = $_POST["a4"];
$mesaj = $_POST["a5"];

if($isim and $konu and $mesaj){
	

	if($tel or $email){
	
		if($email){
			if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){ 
				die("Email adresiniz geçersizdir");
			}
		}
		include("../fonksiyon.php");
		
		
		$isim = suz2($isim);
		$email = suz2($email);
		$tel = suz2($tel);
		$konu = suz2($konu);
		$mesaj = suz2($mesaj);
		
		$mesaj = nl2br($mesaj);
		
		if(uye()){
			
			$uye = uyebilgi("kullaniciadi");
			
		}
		else {
			$uye = "Uye degildir";
		}
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
				$subject=""._AD." : İletisim Talebi";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Gonderen $isim,</p>
				<p class=\"style2\">Konu : $konu</p>
				<p class=\"style2\">Mail : $email</p>
				<p class=\"style2\">Tel : $tel</p>
				<p class=\"style2\">Uye Adi : $uye</p>
				<p class=\"style2\">Mesaji : $mesaj</p>
				<p class=\"style2\">IP : $ip</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: ".$email." <".$email.">\n";
				$headers .= "X-Sender: <".$email.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$email.">\n";
				$headers .= "Content-Type: text/html; charset=utf-8\n";
				@mail(_MAIL, $subject, $message, $headers);
				
				die("tamam");
		
	}
	else {
		die("Bir iletişim aracı yazın");
	}

}
else {
	die("Tüm alanları doldurun");
}
?>