<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

if($islem == "kapat"){

	$_SESSION["sohbetdurum"] = 0;
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	$uyeid = uyeid();
	
	$result = mysql_query("update "._MX."uye set sohbetdurum='0' where id='$uyeid'");

			$dosya = "kisiler.log";
			$handle = @fopen($dosya, "r");
			$icerik = @fread($handle, filesize($dosya));
			@fclose($handle);
			if(strstr($icerik, "".$id ."|")){
			
				$fh = @fopen($dosya, 'w');
				$icerik = str_replace("$uyeid|1", "$uyeid|0", $icerik);
				@fwrite($fh, $icerik);
				@fclose($fh); 
			}
			
	die();

}

if($islem == "ac"){
	
	$_SESSION["sohbetdurum"] = 1;
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	$uyeid = uyeid();
	
	$result = mysql_query("update "._MX."uye set sohbetdurum='1' where id='$uyeid'");

			$dosya = "kisiler.log";
			$handle = @fopen($dosya, "r");
			$icerik = @fread($handle, filesize($dosya));
			@fclose($handle);
			if(strstr($icerik, "".$id ."|")){
			
				$fh = @fopen($dosya, 'w');
				$icerik = str_replace("$uyeid|0", "$uyeid|1", $icerik);
				@fwrite($fh, $icerik);
				@fclose($fh); 
			}
			
	die();	


}

?>