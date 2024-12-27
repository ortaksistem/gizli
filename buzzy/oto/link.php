<?php
session_start();
ini_set('max_execution_time', 0);
include("../fonksiyon.php");
include("../fonksiyonsirabulucu.php");

$bitis = @mktime();

$result = mysql_query("select id, site, link from linkler where bitis='1' or bitis > $bitis");


while(list($id, $site, $link) = @mysql_fetch_row($result)){

	
			
			$site = linkduzelt($site);
			$link = linkduzelt($link);
			
			$cek = @file_get_contents("http://".$site);
			
			if(!$cek){
				$durum = 3;
			}
			else {
			
				if(preg_match("#".$link."#si", $cek)) { 
							
						$durum = 1;
						
				}
				else {
					
						$durum = 2;
					
				}
			
			}
			
			
			@mysql_query("update linkler set sondurum='$durum', songoruntulenme='$bitis' where id='$id'");
			
			
			unset($durum);
			
			


}

die("ok");
?>