<?php

session_start();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();


$mailler = $_POST["mailler"];
$mesaj = $_POST["mesaj"];

$mailler = explode(",", $mailler);

$sayi = count($mailler);

	if(!$mesaj) $mesaj = "Bu site cok harika hemen uye olmani isterim";
	
	$mesaj = nl2br(turkce($mesaj));
	
	$uyeadi = uyeadi();
	
	$admin = ayar("mail");
	
	list($uyemail) = mysql_fetch_row(mysql_query("select email from "._MX."uye where id='$uyeid'"));
	
				$subject=""._AD." : Davet Edildiniz";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Sayin kullanicimiz sitemize <b>$uyeadi</b> rumuzlu uyemiz tarafindan davet edildiniz,</p>
				<p class=\"style2\">Size ozel mesaji : $mesaj</p>
				<p class=\"style2\"><a href=\""._URL."\" target=\"_blank\"><font size=3 color=red><b>Hemen tikla, uye ol</b></font></a></p>
				<p class=\"style2\">Tarih : ".date("d.m.Y H:i")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$admin.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$admin.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				
				
for($i = 0; $i < $sayi; $i++){

	$mail = $mailler[$i];
	
	if($mail){
	
		if(strstr($mail, "@") and strstr($mail, ".")){
		
			mail($mail, $subject, $message, $headers);	
		
		}
	
	}

}

die("ok");
?>