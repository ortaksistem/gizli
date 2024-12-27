<?php
ob_start();
session_start();
include("fonksiyon.php");

$item_number = $_GET["item_number"];
$item = $_GET["item"];

if(is_numeric($item) and is_numeric($item_number)){

	
	$result = @mysql_query("select uye, tur, zaman from paypal where id='$item' and item='$item_number'");
	
	if(@mysql_num_rows($result) >= 1){
			
		list($uye, $tur, $zaman) = @mysql_fetch_row($result);
		
		$suan = @mktime();
		
		$cikar = 60 * 60;
		
		if($suan - $cikar < $zaman){
			
			$ekle = 60 * 60 * 24 * 31; 

			list($bitis) = @mysql_fetch_row(@mysql_query("select bitis from kullanici where id='$uye'"));
				
			if($bitis >= 1){	
				if($bitis >= $suan){	
					$bitis = $bitis + $ekle;
				}
				else {
					$bitis = $suan + $ekle;
				}
			}
			else {
				$bitis = $suan + $ekle;		
			}
				
			if($tur == "large"){
				
				@mysql_query("update kullanici set ahrefs='1000', rakip='1000', sira='1000', takip='1000', bitis='$bitis', seviye='3' where id='$uye'");
				
				@mysql_query("insert into odeme values(NULL, '$uye', '69', '$tur', '1 Aylık', '$suan')");
				
				@mysql_query("delete from paypal where id='$item'");
			}
			
			if($tur == "medium"){
				
				@mysql_query("update kullanici set ahrefs='100', rakip='10', sira='1000', takip='1000', bitis='$bitis', seviye='2' where id='$uye'");
				
				@mysql_query("insert into odeme values(NULL, '$uye', '49', '$tur', '1 Aylık', '$suan')");
				
				@mysql_query("delete from paypal where id='$item'");
			
			}
			
			yonlendir("index.php");
			
			die();
		
		
		}
		else { yonlendir("index.php"); die(); }
	
	}
	else { yonlendir("index.php"); die(); }


}
else {
	yonlendir("index.php");die();
}	

?>