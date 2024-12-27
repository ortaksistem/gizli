<?php


$sifre = $_POST["sifre"];
$sifre2 = $_POST["sifre2"];

if($sifre and $sifre2){
	if(strlen($sifre) >= 5){
		if($sifre == $sifre2){
			
			$puan = 1;
			
			if(strlen($sifre) > 6 and !is_numeric($sifre)){
				if(strlen($sifre) >= 10) $puan++;
				
				if(eregi("[^a-z]", $sifre)) $puan++;
				
				if(eregi("[0-9\.\-]", $sifre)) $puan++;
				
				if(eregi("[^A-Z]", $sifre)) $puan++;
			}
		
			if(strlen($sifre) >= 10){
				$puan++;
				$puan++;
			}
			
			if($puan < 3) die("1");
			if($puan >= 3 and $puan < 5) die("2");
			if($puan >= 5) die("3");
			
		}
		else {
			die("hata");
		}
	}
	else {
		die("hata");
	}
}
else {
	die("hata");
}
?>