<?php
	
	$id = 1838;
	$kullanici = "batu";
	
			$dosya = "../ypsohbetdosyalar/kisiler.log";
			$handle = fopen($dosya, "r");
			$icerik = fread($handle, filesize($dosya));
			fclose($handle);
			
			
				$fh = @fopen($dosya, 'w');
				$veri = $id ."|". $kullanici ."|". $yas ."|". $sehir ."|". $seviyead ."|". $renk ."|||"; 
				fwrite($fh, $icerik.$veri);
				fclose($fh); 
			
			
?>